<?php
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername,$username,$password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentID = isset($_POST['done_appointment_id'])?$_POST['done_appointment_id']:0;
    $newStatus = "Done";
    $qryUpdateDoneAppointment = "UPDATE `smilesync_appointments` SET `appointment_status`= ? WHERE `appointment_id`= ? ";
    $stmt = mysqli_prepare($connect_appointment,$qryUpdateDoneAppointment); 
    mysqli_stmt_bind_param($stmt, 'si', $newStatus, $appointmentID);
    mysqli_stmt_execute($stmt);

}
?>