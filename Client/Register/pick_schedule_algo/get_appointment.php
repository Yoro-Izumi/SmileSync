<?php
include "../../client_global_files/set_sesssion_dir.php";
session_start();

//getting the values for recommend_schedule algo start

// Include database connection
include "../../client_global_files/connect_database.php";

$selected_date = $_SESSION['selected_date'] ?? "2024-12-04";
$service_id = $_SESSION['service_id'] ?? 0;

$start_of_day = "$selected_date 09:00:00";
$end_of_day = "$selected_date 17:00:00";
$leeway = 30;
$default_value = 30;

$python_path = 'C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe';


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
        DATE(a.appointment_date_time) = '$selected_date' AND appointment_status != 'Cancelled'
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
$command = escapeshellcmd("$python_path $python_script_path");

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

// Prepare the data to send to the Python script
$data_to_send = json_encode([
    'reservations' => $reservations,
    'start_of_day' => $start_of_day,
    'end_of_day' => $end_of_day,
    'leeway' => $leeway,
    'predicted_durations' => $predicted_durations['predicted_duration'],
    'default_value' => $default_value
]);

// Set the recommendation script path
$recommend_schedule_script = "recommend_schedule_algo2.py";

// Run Recommendation algo via command line and pass data to stdin
$command_recommend_schedule = escapeshellcmd("$python_path $recommend_schedule_script");
$process = proc_open($command_recommend_schedule, [
    0 => ['pipe', 'r'],  // stdin
    1 => ['pipe', 'w'],  // stdout
    2 => ['pipe', 'w']   // stderr
], $pipes);

if (is_resource($process)) {
    // Write the JSON data to Python script's stdin
    fwrite($pipes[0], $data_to_send);
    fclose($pipes[0]);

    // Get the output from the Python script
    $schedule_output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    // Get the error output from Python script
    $error_output = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    // Check if the Python script executed successfully
    if ($schedule_output === null || empty($schedule_output)) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Failed to execute schedule recommendation Python script.',
            'error_detail' => $error_output
        ]));
    }

    // Decode the output from Python script
    $schedule_result = json_decode($schedule_output, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Invalid JSON output from schedule recommendation Python script.',
            'error_detail' => json_last_error_msg(),
            'raw_output' => $schedule_output
        ]));
    }

    // Extract predicted durations and recommended times
    $predicted_durations = $schedule_result['predicted_durations'] ?? $default_value;
    $recommended_times = $schedule_result['recommended_times'] ?? [];
    $available_times = $schedule_result['available_slots'] ?? [];

    // Sort recommended and available times
    sort($recommended_times);
    sort($available_times);

// Combine the outputs into a single response
$response = [
    'status' => 'success',
    'recommended_schedule' => $recommended_times,
    'available_times' => $available_times,
    'predicted_durations' => $predicted_durations
];

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);


    // Close the process
    proc_close($process);
} else {
    die(json_encode(["error" => "Failed to execute Python script."]));
}

// Close the database connection
mysqli_close($connect_appointment);
?>
