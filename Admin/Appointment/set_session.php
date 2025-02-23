<?php
// Start the session at the very beginning
session_start();

// Include the necessary file (ensure the path and filename are correct)
include "../admin_global_files/set_sesssion_dir.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'service' is set and is an array
    if (isset($_POST['service']) && is_array($_POST['service'])) {
        // Sanitize the selected services (optional but recommended)
        $selectedServices = array_map('intval', $_POST['service']); // Example: Convert to integers

        // Save the selected services in the session
        $_SESSION['service_id'] = $selectedServices;

        // Send a success response back to the client
        echo json_encode([
            'status' => 'success',
            'message' => 'Services saved successfully',
            'services' => $selectedServices // Optional: Include the saved services in the response
        ]);
    } else {
        // Send an error response if no services are selected
        echo json_encode([
            'status' => 'error',
            'message' => 'No services selected or invalid data format'
        ]);
    }
} else {
    // Send an error response if the request method is not POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}