<?php
include "../../../client_global_files/set_sesssion_dir.php";
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../../../client_global_files/connect_database.php';
include '../../../client_global_files/encrypt_decrypt.php';
include '../../../client_global_files/input_sanitizing.php';

header('Content-Type: application/json'); // Ensure JSON header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect_appointment($servername, $username, $password);

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
        exit;
    }

    $reason = sanitize_input($_POST['reasonCancel'],$conn);
    $otherReason = !empty($_POST['otherReason']) ? sanitize_input($_POST['otherReason'],$conn) : '';

    if ($reason === 'other' && !empty($otherReason)) {
        $reason = $otherReason;
    }

    $appointmentId = $_SESSION['session_appointment_id'] ?? null;
    if (!$appointmentId) {
        echo json_encode(['success' => false, 'message' => 'Missing appointment ID.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE `smilesync_appointments` 
                            SET `appointment_status` = ?, `appointment_reason` = ? 
                            WHERE `appointment_id` = ?");
    $status = 'Cancelled';
    $stmt->bind_param("sss", $status, $reason, $appointmentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

?>