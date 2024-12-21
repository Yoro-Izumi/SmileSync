<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['appointment_add_value'])){
        $adminUserID = sanitize_input($_POST['adminUserID'], $connect_appointment);
        $client_id = sanitize_input($_POST['client_id'], $connect_appointment);
        $client_name = sanitize_input($_POST['client_name'], $connect_appointment);
        $approver = sanitize_input($_POST['approver'], $connect_appointment);
        $appointment_date = sanitize_input($_POST['appointment_date'], $connect_appointment);
        $appointment_status = "New";
        $appointment_time = sanitize_input($_POST['appointment_time'], $connect_appointment);
        $appointment_description = sanitize_input($_POST['appointment_description'], $connect_appointment);
        $appointment_type = sanitize_input($_POST['appointment_type'], $connect_appointment);
        $appointment_status = "New";
        $appointment_date = date("Y-m-d");
        $appointment_time = date("H:i:s");
    }   
}
?>