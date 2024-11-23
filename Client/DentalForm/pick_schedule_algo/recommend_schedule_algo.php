<?php
$command = escapeshellcmd('python3 recommend_schedule_algo.py');
$output = shell_exec($command);

if ($output === null || empty($output)) {
    $result = [
        'status' => 'error',
        'message' => 'Python script did not return any output.'
    ];
} else {
    $json = json_decode($output, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $result = [
            'status' => 'error',
            'message' => 'Invalid JSON output from Python script.',
            'error_detail' => json_last_error_msg(),
            'raw_output' => $output
        ];
    } else {
        $result = [
            'status' => 'success',
            'data' => $json
        ];
    }
}

echo json_encode($result);

?>
