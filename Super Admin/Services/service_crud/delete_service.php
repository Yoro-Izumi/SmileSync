<?php
// Database credentials
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
include "../../admin_global_files/connect_database.php";

header('Content-Type: application/json');

// Connect to the database
$connect = connect_appointment($servername,$username,$password); // Replace with your actual database connection function
if (!$connect) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed.']);
    exit();
}

// Check if a service ID (single delete) or service IDs (multiple delete) is sent
if (isset($_POST['service_id'])) {
    // Single deletion
    $serviceID = intval($_POST['service_id']); // Sanitize input
    $new_status = "Unvavailable";

    $deleteQuery = "UPDATE smilesync_services SET service_status = ? WHERE service_id = ?";
    $stmt = $connect->prepare($deleteQuery);
    $stmt->bind_param("i", $newStatus,$serviceID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete service.']);
    }

    $stmt->close();
} elseif (isset($_POST['service_ids'])) {
    // Multiple deletions
    $serviceIDs = json_decode($_POST['service_ids'], true); // Decode JSON array
    if (!is_array($serviceIDs)) {
        echo json_encode(['success' => false, 'error' => 'Invalid data format.']);
        exit();
    }

    // Sanitize IDs and prepare placeholders for SQL
    $serviceIDs = array_map('intval', $serviceIDs);
    $placeholders = implode(',', array_fill(0, count($serviceIDs), '?'));

    $deleteQuery = "DELETE FROM services WHERE serviceID IN ($placeholders)";
    $stmt = $connect->prepare($deleteQuery);

    // Bind parameters dynamically
    $stmt->bind_param(str_repeat('i', count($serviceIDs)), ...$serviceIDs);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete services.']);
    }

    $stmt->close();
} else {
    // No valid input provided
    echo json_encode(['success' => false, 'error' => 'No service ID(s) provided.']);
}

$connect->close();
?>
