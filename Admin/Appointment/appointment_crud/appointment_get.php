<?php
// Start session and set timezone
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

$currentDate = date('Y-m-d');

$id = $_POST['id']; 

header('Content-Type: application/json');

try {
    // Connect to the database
    $connect_appointment = connect_appointment($servername, $username, $password);

    // Query to fetch patient data
    $qryGetPatientInfo = "
        SELECT 
            smilesync_appointments.patient_info_id,
            smilesync_appointments.appointment_date_time,
            smilesync_patient_information.patient_first_name,
            smilesync_patient_information.patient_last_name,
            smilesync_patient_information.patient_middle_name,
            smilesync_patient_information.patient_suffix,
            smilesync_patient_information.patient_phone_number,
            smilesync_patient_information.patient_sex,
            smilesync_patient_information.patient_birthday,
            smilesync_address.street,
            smilesync_address.city,
            smilesync_address.province,
            smilesync_address.postal_code,
            smilesync_address.address_id,
            smilesync_address.country,
            smilesync_services.service_id,
            smilesync_services.service_name,
            smilesync_services.service_price
        FROM smilesync_appointments
        LEFT JOIN smilesync_patient_management.smilesync_patient_information 
            ON smilesync_appointments.patient_info_id = smilesync_patient_information.patient_info_id
        LEFT JOIN smilesync_patient_management.smilesync_address 
            ON smilesync_patient_information.patient_address = smilesync_address.address_id
        LEFT JOIN smilesync_invoice_services 
            ON smilesync_appointments.appointment_id = smilesync_invoice_services.appointment_id
        LEFT JOIN smilesync_services 
            ON smilesync_invoice_services.service_id = smilesync_services.service_id
        WHERE smilesync_appointments.appointment_id = ?
    ";

    // Prepare the query
    $stmtGetPatientInfo = mysqli_prepare($connect_appointment, $qryGetPatientInfo);
    mysqli_stmt_bind_param($stmtGetPatientInfo, 'i', $id);
    mysqli_stmt_execute($stmtGetPatientInfo);
    $resultGetPatientInfo = mysqli_stmt_get_result($stmtGetPatientInfo);
    
    // Fetch and process the results
    $patients = [];
    while ($rowGetPatientInfo = $resultGetPatientInfo->fetch_assoc()) {
// Decrypt patient info
$patientFirstName = !empty($rowGetPatientInfo['patient_first_name']) ? decryptData($rowGetPatientInfo['patient_first_name'], $key) : "";
$patientLastName = !empty($rowGetPatientInfo['patient_last_name']) ? decryptData($rowGetPatientInfo['patient_last_name'], $key) : "";
$patientMiddleName = !empty($rowGetPatientInfo['patient_middle_name']) ? decryptData($rowGetPatientInfo['patient_middle_name'], $key) : "";
$patientSuffix = !empty($rowGetPatientInfo['patient_suffix']) ? decryptData($rowGetPatientInfo['patient_suffix'], $key) : "";
$patientPhoneNumber = !empty($rowGetPatientInfo['patient_phone_number']) ? decryptData($rowGetPatientInfo['patient_phone_number'], $key) : "";
$birthday = !empty($rowGetPatientInfo['patient_birthday']) ? decryptData($rowGetPatientInfo['patient_birthday'], $key) : "";
$patientSex = !empty($rowGetPatientInfo['patient_sex']) ? decryptData($rowGetPatientInfo['patient_sex'], $key) : "";
$birthday = !empty($birthday) ? DateTime::createFromFormat('Y-m-d', $birthday)->format('Y-m-d') : "";
$age = !empty($birthday) ? date_diff(date_create($birthday), date_create($currentDate))->y : 0;

// Decrypt address info
$address = !empty($rowGetPatientInfo['address_id']) && $rowGetPatientInfo['address_id'] !== NULL ? $rowGetPatientInfo['street'] : "";
$city = !empty($rowGetPatientInfo['address_id']) && $rowGetPatientInfo['address_id'] !== NULL ? $rowGetPatientInfo['city'] : "";
$province = !empty($rowGetPatientInfo['address_id']) && $rowGetPatientInfo['address_id'] !== NULL ? $rowGetPatientInfo['province'] : "";

// Appointment details
$appointmentDateTime = !empty($rowGetPatientInfo['appointment_date_time']) ? formatDateTime($rowGetPatientInfo['appointment_date_time']) : "";

// Decrypt service info
$serviceName = !empty($rowGetPatientInfo['service_name']) ? $rowGetPatientInfo['service_name'] : "";
$servicePrice = !empty($rowGetPatientInfo['service_price']) ? $rowGetPatientInfo['service_price'] : "";
$serviceId = !empty($rowGetPatientInfo['service_id']) ? $rowGetPatientInfo['service_id'] : "";


        // Construct patient name
        $patientName = trim(
            $patientFirstName . " " . 
            $patientMiddleName . " " . 
            $patientLastName . " " . 
            $patientSuffix
        );

        $patients[] = [
            'patient_info_id' => $rowGetPatientInfo['patient_info_id'],
            'patient_name' => $patientName,
            'address' => $address,
            'city' => $city,
            'province' => $province,
            'patient_age' => $age,
            'patient_phone_number' => $patientPhoneNumber,
            'patient_sex' => $patientSex,
            'birth_date' => $birthday,
            'appointment_date_time' => $appointmentDateTime,
            'service_name' => $serviceName,
            'service_price' => $servicePrice,
            'service_id' => $serviceId
        ];
    }

    // Return the results as JSON
    echo json_encode($patients);

} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
