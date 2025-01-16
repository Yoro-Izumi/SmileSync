<?php
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

$adminID = NULL;

header('Content-Type: application/json'); // Ensure JSON header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect_appointment($servername, $username, $password);

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
        exit;
    }

    $reason = sanitize_input($_POST['reasonResched'],$conn);
    $otherReason = !empty($_POST['otherReasonResched']) ? sanitize_input($_POST['otherReasonResched'],$conn) : '';

    if ($reason === 'other' && !empty($otherReason)) {
        $reason = $otherReason;
    }

    $appointmentId = $_SESSION['session_appointment_id'] ?? null;
    if (!$appointmentId) {
        echo json_encode(['success' => false, 'message' => 'Missing appointment ID.']);
        exit;
    }

    //get post values
// Get post values
$appointmentDate = isset($_POST['cal-day']) && !empty($_POST['cal-day']) ? sanitize_input($_POST['cal-day'], $conn) : date('Y-m-d');
$appointmentTime = isset($_POST['time']) && !empty($_POST['time']) ? sanitize_input($_POST['time'], $conn) : date('H:i:s');

$appointmentDateTime = $appointmentDate . " " . $appointmentTime;

    $services = isset($_POST['services']) ? sanitize_input($_POST['services'], $conn) : "";





    $stmt = $conn->prepare("UPDATE `smilesync_appointments` 
                            SET `appointment_status` = ?, `appointment_reason` = ?, appointment_date_time = ?, admin_id = ? 
                            WHERE `appointment_id` = ?");
    $status = 'Approved';
    $stmt->bind_param("sssii", $status, $reason,$appointmentDateTime,$adminID, $appointmentId);

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