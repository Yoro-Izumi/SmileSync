<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Execute Python script and capture the output
    $command = escapeshellcmd('python3 appointment_scheduler.py');
    $output = shell_exec($command);

    // Process the Python output (remove trailing newline)
    $recommended_time = trim($output);

    // Store the result in a PHP associative array
    $result = [
        'status' => 'success',
        'recommended_time' => $recommended_time
    ];

    // Return the result as JSON
    echo json_encode($result);
    exit();
}
?>
