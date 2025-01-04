<?php
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";
$conn = connect_appointment($servername, $username, $password);

$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$currentDate = date('Y-m-d');

// Set response header for JSON
header('Content-Type: application/json');
//$_POST['id'] = 20;
// Assuming a successful connection to the database
if (isset($_POST['id'])) {
    $itemId = $_POST['id'];
    $query = "SELECT 
        a.*,
        p.*,
        ar.*
    FROM 
        smilesync_appointments a
    LEFT JOIN 
        $patients_db.smilesync_patient_information p ON a.patient_info_id = p.patient_info_id
    LEFT JOIN 
        $approvers_db.smilesync_admin_accounts ar ON a.admin_id = ar.admin_account_id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $product['appointment_id'] = $row['appointment_id'];
        $product['appointment_date_time'] = formatDateTime($row['appointment_date_time']);
        $product['appointment_status'] = $row['appointment_status'];
        $product['patient_info_id'] = $row['patient_info_id'];
        $product['admin_account_id'] = $row['admin_account_id'];
        $product['patient_first_name'] = decryptData($row['patient_first_name'],$key);
        $product['patient_middle_name'] = decryptData($row['patient_middle_name'],$key);
        $product['patient_last_name'] = decryptData($row['patient_last_name'],$key);
        $product['patient_name'] = trim($product['patient_first_name'] . " " . $product['patient_middle_name'] . " " . $product['patient_last_name']);
        $product['patient_email'] = decryptData($row['patient_email'],$key);
        $product['patient_phone_number'] = decryptData($row['patient_phone_number'],$key);
        $product['patient_birthday'] = formatDateTime(decryptData($row['patient_birthday'],$key));
        $product['patient_age'] = $diff = (new DateTime($currentDate))->diff(new DateTime($product['patient_birthday']))->y;
        $product['admin_first_name'] = decryptData($row['admin_first_name'],$key);
        $product['admin_middle_name'] = decryptData($row['admin_middle_name'],$key);
        $product['admin_last_name'] = decryptData($row['admin_last_name'],$key);
        $product['admin_name'] = trim($product['admin_first_name'] . " " . $product['admin_middle_name'] . " " . $product['admin_last_name']);
    }

    echo json_encode($product);
}