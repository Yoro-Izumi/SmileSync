<?php
include "../../client_global_files/set_sesssion_dir.php";
session_start();

// Include database connection
include "../../client_global_files/connect_database.php";

$selected_date = $_SESSION['selected_date'] ?? "2024-12-04";
$service_id = $_SESSION['service_id'] ?? 0;

$start_of_day = "$selected_date 08:00:00";
$end_of_day = "$selected_date 16:00:00";
$leeway = 60;
$default_value = 60;

if ($service_id < 0) {
    die(json_encode(["error" => "Invalid service_id provided."]));
}

// Connect to the database
$connect_appointment = connect_appointment($servername, $username, $password);

// Check if the connection is successful
if (!$connect_appointment) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()])); 
}

// Query to fetch appointments and sum the service durations for each appointment
$reservations_query = "
    SELECT
        a.appointment_date_time
    FROM 
        smilesync_invoice_services sis
    INNER JOIN 
        smilesync_appointments a ON sis.appointment_id = a.appointment_id
    WHERE 
        DATE(a.appointment_date_time) = '$selected_date'
    GROUP BY 
        a.appointment_date_time;
";

// Execute the query
$reservations_result = mysqli_query($connect_appointment, $reservations_query);

$reservations = [];

// Check query success
if ($reservations_result) {
    // Fetch all rows from the result
    while ($row = mysqli_fetch_assoc($reservations_result)) {
        $reservations[] = $row['appointment_date_time'];
    }
} else {
    die(json_encode(["error" => "Query failed: " . mysqli_error($connect_appointment)]));
}

// Fetch service durations based on the service_id from the session
$service_duration_query = "
    SELECT s.service_duration
    FROM smilesync_invoice_services sis
    INNER JOIN smilesync_services s ON sis.service_id = s.service_id
    WHERE s.service_id = $service_id
";

$service_duration_result = mysqli_query($connect_appointment, $service_duration_query);

$durations = [];

if ($service_duration_result) {
    while ($row = mysqli_fetch_assoc($service_duration_result)) {
        $durations[] = (int) $row['service_duration'];
    }
} else {
    die(json_encode(["error" => "Query failed: " . mysqli_error($connect_appointment)]));
}

// If no durations found, fetch directly from smilesync_services
if (empty($durations)) {
    $fallback_query = "
        SELECT service_duration
        FROM smilesync_services
        WHERE service_id = $service_id
    ";

    $fallback_result = mysqli_query($connect_appointment, $fallback_query);

    if ($fallback_result) {
        while ($row = mysqli_fetch_assoc($fallback_result)) {
            $durations[] = (int) $row['service_duration'];
        }
    } else {
        die(json_encode(["error" => "Fallback query failed: " . mysqli_error($connect_appointment)]));
    }

    // If still no durations found, return default
    if (empty($durations)) {
        $durations[0] = $default_value;
    }
}

// Prepare the data to send to the Python script
$data_to_send = json_encode([
    'service_durations' => $durations
]);

// Execute the Python script via stdin
$python_script_path = 'linear_regression2.py';
$command = escapeshellcmd("python3 $python_script_path");

// Open the process and pass the data to stdin
$process = proc_open($command, [
    0 => ['pipe', 'r'],  // stdin (write to python script)
    1 => ['pipe', 'w'],  // stdout (read from python script)
    2 => ['pipe', 'w']   // stderr
], $pipes);

if (is_resource($process)) {
    // Send JSON data to Python script's stdin
    fwrite($pipes[0], $data_to_send);
    fclose($pipes[0]);

    // Read the response from Python script's stdout
    $predictions = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    // Close the error pipe
    fclose($pipes[2]);

    // Close the process
    proc_close($process);

    // Decode predictions
    $predicted_durations = json_decode($predictions, true);

    if (json_last_error() !== JSON_ERROR_NONE || !isset($predicted_durations['predicted_duration'])) {
        die(json_encode(["error" => "Failed to decode Python script response or missing predicted_duration."]));
    }
} else {
    die(json_encode(["error" => "Failed to execute Python script."]));
}

// Prepare the final response with predictions
$response = [
    'reservations' => $reservations,
    'start_of_day' => $start_of_day,
    'end_of_day' => $end_of_day,
    'leeway' => $leeway,
    'predicted_durations' => $predicted_durations['predicted_duration']
];

header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($connect_appointment);
?>
