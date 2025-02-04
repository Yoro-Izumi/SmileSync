<?php
header('Content-Type: application/json');

// Database credentials
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
include "../../admin_global_files/connect_database.php";

$conn = connect_appointment($servername,$username,$password);
// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

// Check if the `id` parameter is set
if (isset($_GET['id'])) {
    $service_id = intval($_GET['id']); // Get the service ID and ensure it's an integer

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT `service_id`, `service_name`, `service_description`, `service_duration`, `service_price`, `service_status` FROM `smilesync_services` WHERE service_id = ?");
    $stmt->bind_param("i", $service_id); // Bind the service ID as an integer

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $service]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Service not found.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
