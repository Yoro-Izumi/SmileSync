<?php
include "../../client_global_files/set_sesssion_dir.php";
session_start();

$default_value = 40; // Default duration

// Set the recommendation script path
//$recommend_schedule_script = "recommend_schedule_algo2.py";
$recommend_schedule_script = "recommend_schedule_algo2.py";

// Run Recommendation algo
$command_recommend_schedule = escapeshellcmd("C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe $recommend_schedule_script");
$schedule_output = shell_exec($command_recommend_schedule);

// Log the output for debugging
error_log("Schedule recommendation output: " . $schedule_output);

// Check if the schedule recommendation script ran successfully
if ($schedule_output === null || empty($schedule_output)) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Failed to execute schedule recommendation Python script.'
    ]));
}

// Decode the schedule recommendation output
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

// Sort recommended and available times
sort($recommended_times);
sort($available_times);

// Combine the outputs into a single response
$response = [
    'status' => 'success',
    'predicted_durations' => $predicted_durations,
    'recommended_schedule' => $recommended_times,
    'available_times' => $available_times
];

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
