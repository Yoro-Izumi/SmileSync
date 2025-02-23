<?php
include "../../client_global_files/set_sesssion_dir.php";
session_start();

// Include database connection
include "../../client_global_files/connect_database.php";

$selected_date = $_SESSION['selected_date'] ?? "2024-12-04";
$service_id = $_SESSION['service_id'] ?? 0;
$start_of_day = "$selected_date 09:00:00";
$end_of_day = "$selected_date 17:00:00";
$leeway = 30;
$default_value = 30;
$python_path = "C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe"; 

if ($service_id < 0) {
    die(json_encode(["error" => "Invalid service_id provided."]));
}

// Connect to the database
$connect_appointment = connect_appointment($servername, $username, $password);

if (!$connect_appointment) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

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

$stmt = mysqli_prepare($connect_appointment, $query);
mysqli_stmt_bind_param($stmt, "si", $selected_date, $service_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$reservations = [];
$durations = [];

while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['appointment_date_time'])) {
        $reservations[] = $row['appointment_date_time'];
    }
    if (!empty($row['service_duration'])) {
        $durations[] = (int)$row['service_duration'];
    }
}

mysqli_stmt_close($stmt);

// If no durations found, use fallback
if (empty($durations)) {
    $stmt = mysqli_prepare($connect_appointment, "SELECT service_duration FROM smilesync_services WHERE service_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $service_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $durations[] = (int)$row['service_duration'];
    }
    mysqli_stmt_close($stmt);
}

// Use default if no duration is found
$durations = !empty($durations) ? $durations : [$default_value];

// Close database connection early
mysqli_close($connect_appointment);

// Function to execute Python scripts
function execute_python_script($python_path, $script_path, $data) {
    $command = escapeshellcmd("$python_path $script_path");
    $process = proc_open($command, [
        0 => ['pipe', 'r'], 
        1 => ['pipe', 'w'], 
        2 => ['pipe', 'w']
    ], $pipes);

    if (!is_resource($process)) {
        return ["error" => "Failed to execute Python script."];
    }

    fwrite($pipes[0], json_encode($data));
    fclose($pipes[0]);

    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $error_output = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    proc_close($process);

    $decoded_output = json_decode($output, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "Invalid JSON output from Python script.", "details" => json_last_error_msg(), "raw_output" => $output];
    }

    return $decoded_output;
}

// First Python script: Predict durations
$linear_regression_script = "linear_regression2.py";
$prediction_response = execute_python_script($python_path, $linear_regression_script, ['service_durations' => $durations]);

if (isset($prediction_response['error'])) {
    die(json_encode($prediction_response));
}

$predicted_durations = $prediction_response['predicted_duration'] ?? $default_value;

// Second Python script: Recommend schedule
$recommend_schedule_script = "recommend_schedule_algo2.py";
$schedule_response = execute_python_script($python_path, $recommend_schedule_script, [
    'reservations' => $reservations,
    'start_of_day' => $start_of_day,
    'end_of_day' => $end_of_day,
    'leeway' => $leeway,
    'predicted_durations' => $predicted_durations,
    'default_value' => $default_value
]);

if (isset($schedule_response['error'])) {
    die(json_encode($schedule_response));
}

// Sort recommended and available times
$recommended_times = $schedule_response['recommended_times'] ?? [];
$available_times = $schedule_response['available_slots'] ?? [];
sort($recommended_times);
sort($available_times);

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'recommended_schedule' => $recommended_times,
    'available_times' => $available_times,
    'predicted_durations' => $predicted_durations
]);
?>
