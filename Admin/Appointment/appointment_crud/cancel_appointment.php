<?php
include "../../admin_global_files/set_sesssion_dir.php";
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername,$username,$password);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $conn = $connect_appointment;

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
    }

    // Sanitize input
    $reason = $conn->real_escape_string($_POST['reason']);
    $otherReason = isset($_POST['otherReason']) ? sanitize_input($connect_appointment,$_POST['otherReason']) : '';
    $appointmentId = $_SESSION['session_appointment_id'];

    // Use the "otherReason" field if the "reason" is "other"
    if ($reason === 'other' && !empty($otherReason)) {
        $reason = $otherReason;
    }

    $sql = "UPDATE `smilesync_appointments` 
            SET `appointment_status` = 'Cancelled', `appointment_reason` = '$reason' 
            WHERE `appointment_id` = '$appointmentId'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating record: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
