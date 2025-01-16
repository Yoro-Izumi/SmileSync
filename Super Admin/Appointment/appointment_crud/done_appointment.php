<?php
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername, $username, $password);
$connect_inventory = connect_inventory($servername, $username, $password);
$connect_patient_management = connect_patient($servername,$username,$password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminID = $_SESSION['userAdminID'] ?? NULL;
    $appointmentID = $_POST['done_appointment_id'] ?? 1;
    $patient_id = getPatientID($appointmentID, $connect_appointment);
    $newStatus = "Done";

    // Procedures
    $procedures = $_POST['procedureCheck'] ?? [];

    // Dentist selection
    $dentist_choose = $_POST['dentist_choose'] ?? 'input';
    if ($dentist_choose === 'input') {
        $dentist_name = $_POST['dentist_name'] ?? " ";
        $qryInsertDentist = "INSERT INTO `smilesync_doctor_name`(`dentist_name_id`, `dentist_name`) VALUES (NULL, ?)";
        $stmt = mysqli_prepare($connect_patient_management, $qryInsertDentist);
        mysqli_stmt_bind_param($stmt, 's', $dentist_name);
        mysqli_stmt_execute($stmt);
        $dentist_select = mysqli_insert_id($connect_patient_management);
    } elseif ($dentist_choose === 'select') {
        $dentist_select = $_POST['dentist_select'] ?? NULL;
    }

    $number_of_tooth = $_POST['number_of_tooth'] ?? 0;

    // Process items with their quantities
    $itemCheck = $_POST['itemCheck'] ?? [];
    $selectedItems = [];
    foreach ($itemCheck as $item_id) {
        $quantityKey = 'itemQuantity_' . $item_id;
        if (isset($_POST[$quantityKey])) {
            $selectedItems[] = [
                'id' => intval($item_id),
                'quantity' => intval($_POST[$quantityKey]),
            ];
        }
    }

    // Invoice details
    $invoice_amount_charged = $_POST['invoice_amount_charged'] ?? 0;
    $invoice_amount_paid = $_POST['invoice_amount_paid'] ?? 0;
    $invoice_balance = $_POST['invoice_balance'] ?? 0;
    $doctor_remarks = $_POST['doctor_remarks'] ?? " ";
    $request = " ";
    $hmo_verification = "None";
    $invoice_status = $invoice_amount_paid >= $invoice_amount_charged? "Paid":"Pending";
    $invoice_date_time = date('Y-m-d H:i:s');
    $unique_id = generateRandomString(10);
    
    while (ifInvoiceIDExist($unique_id, $connect_appointment)) {
        $unique_id = generateRandomString(10);
    }
    $invoice_unique_id = $unique_id;

    // Insert invoice details
    $qryInsertInvoice = "INSERT INTO `smilesync_invoice`(`invoice_id`, `patient_info_id`, `appointment_id`, `invoice_unique_id`, `hmo_verification`, `amount_due`, `amount_paid`, `balance`, `invoice_remarks`, `request`, `invoice_status`, `number_of_tooth`, `invoice_date_time`, `dentist_name_id`) 
                         VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $prepareInsertInvoice = mysqli_prepare($connect_appointment, $qryInsertInvoice);
    mysqli_stmt_bind_param($prepareInsertInvoice, 'iissdddsssisi', $patient_id, $appointmentID, $invoice_unique_id, $hmo_verification, $invoice_amount_charged, $invoice_amount_paid, $invoice_balance, $doctor_remarks, $request, $invoice_status, $number_of_tooth, $invoice_date_time, $dentist_select);
    mysqli_stmt_execute($prepareInsertInvoice);

    $invoice_id = mysqli_insert_id($connect_appointment);

    // Insert procedures and items
    foreach ($procedures as $procedure) {
        $qryInsertInvoiceService = "INSERT INTO `smilesync_invoice_services`(`invoice_services_id`, `invoice_id`, `service_id`, `appointment_id`) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($connect_appointment, $qryInsertInvoiceService);
        mysqli_stmt_bind_param($stmt, 'iii', $invoice_id, $procedure, $appointmentID);
        mysqli_stmt_execute($stmt);
        $invoice_services_id = mysqli_insert_id($connect_appointment);

        foreach ($selectedItems as $item) {
            $item_id = $item['id'];
            $item_usage = $item['quantity'];

            $qryInsertInvoiceServiceItemsUsed = "INSERT INTO `smilesync_invoice_items`(`invoice_items_id`, `item_id`, `invoice_services_id`, `number_of_used_items`) VALUES (NULL, ?, ?, ?)";
            $stmt = mysqli_prepare($connect_appointment, $qryInsertInvoiceServiceItemsUsed);
            mysqli_stmt_bind_param($stmt, 'iii', $item_id, $invoice_services_id, $item_usage);
            mysqli_stmt_execute($stmt);

            $qryInsertItemUsage = "INSERT INTO `smilesync_inventory_usage`(`usage_id`, `item_id`, `admin_account_id`, `quantity_used`, `sub_total`, `date_of_usage`) VALUES (NULL, ?, ?, ?, ?, current_timestamp())";
            $stmt = mysqli_prepare($connect_inventory, $qryInsertItemUsage);
            $balance = $invoice_amount_paid; // Assuming balance calculation
            mysqli_stmt_bind_param($stmt, 'iiid', $item_id, $adminID, $item_usage, $balance);
            mysqli_stmt_execute($stmt);
        }
    }

    // Update appointment status to Done
    $qryUpdateDoneAppointment = "UPDATE `smilesync_appointments` SET `appointment_status` = ? WHERE `appointment_id` = ?";
    $stmt = mysqli_prepare($connect_appointment, $qryUpdateDoneAppointment);
    mysqli_stmt_bind_param($stmt, 'si', $newStatus, $appointmentID);
    mysqli_stmt_execute($stmt);
    echo "success";
}

function getPatientID($appointmentID, $connect_appointment) {
    $qryGetPatientID = "SELECT patient_info_id FROM smilesync_appointments WHERE appointment_id = ?";
    $stmt = mysqli_prepare($connect_appointment, $qryGetPatientID);
    mysqli_stmt_bind_param($stmt, 'i', $appointmentID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['patient_info_id'] ?? NULL;
}

function ifInvoiceIDExist($generated_id, $connect_appointment) {
    $qryCheckInvoiceID = "SELECT invoice_unique_id FROM smilesync_invoice WHERE invoice_unique_id = ?";
    $stmt = mysqli_prepare($connect_appointment, $qryCheckInvoiceID);
    mysqli_stmt_bind_param($stmt, 's', $generated_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result) ? true : false;
}

function generateRandomString($size) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($characters, $size)), 0, $size);
}
