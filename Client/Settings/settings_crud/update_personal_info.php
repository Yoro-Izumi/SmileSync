<?php
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";

$connect_db = connect_accounts($servername,$username,$password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['userID'];
    $firstName = sanitize_input($_POST['firstName'],$connect_db);
    $lastName = sanitize_input($_POST['lastName'],$connect_db);
    $middleName = sanitize_input($_POST['middleName'],$connect_db);
    $suffix = sanitize_input($_POST['suffix'],$connect_db);
    $birthdate = sanitize_input($_POST['birthdate'],$connect_db);
    $phoneNumber = sanitize_input($_POST['phoneNumber'],$connect_db);
    $email = sanitize_input($_POST['email'],$connect_db);

    //Encrypt all data
    $firstName = encryptData($firstName,$key);
    $lastName = encryptData($lastName,$key);
    $middleName = encryptData($middleName,$key);
    $suffix = encryptData($suffix,$key);
    $birthdate = encryptData($birthdate,$key);
    $phoneNumber = encryptData($phoneNumber,$key);
    $email = encryptData($email,$key);

    $stmt = $connect_db->prepare("UPDATE smilesync_patient_information SET 
        patient_first_name = ?, 
        patient_last_name = ?, 
        patient_middle_name = ?, 
        patient_suffix = ?, 
        patient_birthday = ?, 
        patient_phone_number = ?, 
        patient_account_email = ? 
        WHERE patient_info_id = ?");
    $stmt->bind_param('sssssssi', $firstName, $lastName, $middleName, $suffix, $birthdate, $phoneNumber, $email, $userID);
    
    if ($stmt->execute()) {
        echo 'Personal information updated successfully.';
    } else {
        echo 'Error updating personal information.';
    }
    $stmt->close();
    $connect_db->close();
}
?>
