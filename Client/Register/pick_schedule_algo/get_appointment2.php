<?php
include "../../client_global_files/set_sesssion_dir.php";
session_start();

// Include database connection
include "../../client_global_files/connect_database.php";

require_once $root_dir . '/vendor/autoload.php';

// Load the .env file
if (!file_exists($root_dir . '/.env')) {
    die("Environment configuration file is missing!");
}
$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
$dotenv->load();

$selectedServicesTest = [1, 2]; 
$selected_date = $_SESSION['selected_date'] ?? "2024-12-04";
$service_id = $_SESSION['service_id'] ?? $selectedServicesTest;

$start_of_day = "$selected_date 09:00:00";
$end_of_day = "$selected_date 17:00:00";
$leeway = 30;
$default_value = 30;

$python_path = $_ENV['PYTHON_PATH'];
$durations = [];
$reservations = [];

// Connect to the database using function insifrde include
$conn = connect_appointment($servername,$username,$password);

// Fetch reservations and service durations in a single query using prepared statements
$query = "
    SELECT 
        a.appointment_date_time,
        s.service_duration
    FROM smilesync_appointments a
    LEFT JOIN smilesync_invoice_services sis ON a.appointment_id = sis.appointment_id
    LEFT JOIN smilesync_services s ON sis.service_id = s.service_id
    WHERE DATE(a.appointment_date_time) = ? 
    AND a.appointment_status != 'Cancelled'  
    AND (s.service_id = ? OR s.service_id IS NULL)
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $selected_date, $service_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$reservations = [];
$durations = [];

while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['appointment_date_time'])) {
        $reservations[] = $row['appointment_date_time'];
    }
}

mysqli_stmt_close($stmt);


// Find appointments with the exact combination of services
$exactAppointments = findAppointmentsWithExactServices($conn, $service_id);
if (!empty($exactAppointments)) {
    foreach ($exactAppointments as $appointment) {
        $durations[] = calculateDuration($appointment['appointment_date_time'], $appointment['invoice_date_time']);
        //$reservations = calculateDuration($appointment['appointment_date_time'], $appointment['invoice_date_time']);
    }
} else {
    // If no appointments found, calculate the default duration
    $durations = getDefaultDurations($conn, $service_id);
}

// If still no durations found, return default
if (empty($durations)) {
    $durations = [$default_value];
}

// Prepare the data to send to the Python script
$data_to_send = json_encode([
    'service_durations' => $durations
]);

// Execute the Python script via stdin1q    ```
$python_script_path = 'linear_regression2.py';
$command = escapeshellcmd("$python_path $python_script_path");

// Open the process and pass the data to stdin
$process = proc_open($command, [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w']
], $pipes);

if (is_resource($process)) {
    fwrite($pipes[0], $data_to_send);
    fclose($pipes[0]);

    $predictions = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    fclose($pipes[2]);
    proc_close($process);

    $predicted_durations = json_decode($predictions, true);

    if (json_last_error() !== JSON_ERROR_NONE || !isset($predicted_durations['predicted_duration'])) {
        die(json_encode(["error" => "Failed to decode Python script response or missing predicted_duration."]));
    }
} else {
    die(json_encode(["error" => "Failed to execute Python script."]));
}

// Ensure $reservations is properly defined before sending
$reservations = []; // You need to populate this array

$data_to_send = json_encode([
    'reservations' => $reservations,
    'start_of_day' => $start_of_day,
    'end_of_day' => $end_of_day,
    'leeway' => $leeway,
    'predicted_durations' => $predicted_durations['predicted_duration'],
    'default_value' => $default_value
]);

$recommend_schedule_script = "recommend_schedule_algo2.py";

$command_recommend_schedule = escapeshellcmd("$python_path $recommend_schedule_script");
$process = proc_open($command_recommend_schedule, [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w']
], $pipes);

if (is_resource($process)) {
    fwrite($pipes[0], $data_to_send);
    fclose($pipes[0]);

    $schedule_output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $error_output = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    if ($schedule_output === null || empty($schedule_output)) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Failed to execute schedule recommendation Python script.',
            'error_detail' => $error_output
        ]));
    }

    $schedule_result = json_decode($schedule_output, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Invalid JSON output from schedule recommendation Python script.',
            'error_detail' => json_last_error_msg(),
            'raw_output' => $schedule_output
        ]));
    }

    $predicted_durations = $schedule_result['predicted_durations'] ?? $default_value;
    $recommended_times = $schedule_result['recommended_times'] ?? [];
    $available_times = $schedule_result['available_slots'] ?? [];

    sort($recommended_times);
    sort($available_times);

    $response = [
        'status' => 'success',
        'recommended_schedule' => $recommended_times,
        'available_times' => $available_times,
        'predicted_durations' => $predicted_durations
    ];

    header('Content-Type: application/json');
    echo json_encode($response);

    proc_close($process);
} else {
    die(json_encode(["error" => "Failed to execute Python script."]));
}

// Close the database connection
mysqli_close($conn);
?>

<?php
// Function to find appointments with the exact combination of services
function findAppointmentsWithExactServices($conn, $selectedServices) {
    if (empty($selectedServices)) return [];

    $placeholders = implode(',', array_fill(0, count($selectedServices), '?'));
    $query = "
        SELECT 
            a.appointment_id, 
            a.appointment_date_time, 
            inv.invoice_date_time
        FROM smilesync_invoice_services isv
        LEFT JOIN smilesync_appointments a ON isv.appointment_id = a.appointment_id
        LEFT JOIN smilesync_invoice inv ON isv.invoice_id = inv.invoice_id
        WHERE isv.service_id IN ($placeholders)
        GROUP BY a.appointment_id
        HAVING COUNT(DISTINCT isv.service_id) = ?
    ";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die(json_encode(["error" => "SQL prepare failed: " . $conn->error]));
    }

    $types = str_repeat('i', count($selectedServices)) . 'i';
    $params = array_merge($selectedServices, [count($selectedServices)]);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to calculate appointment duration
function calculateDuration($startDateTime, $endDateTime) {
    $start = new DateTime($startDateTime);
    $end = new DateTime($endDateTime);
    $interval = $start->diff($end);
    return ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
}

// Function to get default service durations
function getDefaultDurations($conn, $selectedServices) {
    if (empty($selectedServices)) return [100];

    $placeholders = implode(',', array_fill(0, count($selectedServices), '?'));
    $query = "
        SELECT SUM(service_duration) AS total_duration
        FROM smilesync_services
        WHERE service_id IN ($placeholders)
    ";

    $stmt = $conn->prepare($query);
    $types = str_repeat('i', count($selectedServices));
    $stmt->bind_param($types, ...$selectedServices);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return [$row['total_duration'] ?? 100]; // Default to 100 minutes
}
?>
