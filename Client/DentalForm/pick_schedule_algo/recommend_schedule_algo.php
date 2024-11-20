<?php
$command = 'python3 appointment_algo/recommend_schedule_algo.py 2>&1';
$output = shell_exec($command);

if ($output === null || empty($output)) {
    http_response_code(500);
    $result = [
        'status' => 'error',
        'message' => 'Python script did not return any output or failed to execute.',
    ];
} else {
    $decoded_output = json_decode($output, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $result = [
            'status' => 'success',
            'available_slots' => $decoded_output['available_slots'],
            'recommended_time' => $decoded_output['recommended_time']
        ];
    } else {
        http_response_code(500);
        $result = [
            'status' => 'error',
            'message' => 'Invalid JSON output from Python script.',
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($result);
exit();
?>
