<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";

header('Content-Type: application/json');

try {
    // Connect to the database
    $connect_patient = connect_accounts($servername, $username, $password);

    // Query to fetch patient data
    $qryGetPatientInfo = "
        SELECT 
            smilesync_patient_accounts.patient_info_id,
            smilesync_patient_management.smilesync_patient_information.patient_first_name,
            smilesync_patient_management.smilesync_patient_information.patient_last_name,
            smilesync_patient_management.smilesync_patient_information.patient_middle_name,
            smilesync_patient_management.smilesync_patient_information.patient_suffix
        FROM smilesync_patient_accounts
        LEFT JOIN smilesync_patient_management.smilesync_patient_information 
        ON smilesync_patient_accounts.patient_info_id = smilesync_patient_management.smilesync_patient_information.patient_info_id";

    // Execute the query
    $resultGetPatientInfo = $connect_patient->query($qryGetPatientInfo);

    if (!$resultGetPatientInfo) {
        throw new Exception("Database query failed: " . $connect_patient->error);
    }

    // Fetch and process the results
    $patients = [];
    while ($rowGetPatientInfo = $resultGetPatientInfo->fetch_assoc()) {
        $patientFirstName = decryptData($rowGetPatientInfo['patient_first_name'], $key);
        $patientLastName = decryptData($rowGetPatientInfo['patient_last_name'], $key);
        $patientMiddleName = decryptData($rowGetPatientInfo['patient_middle_name'], $key);
        $patientSuffix = decryptData($rowGetPatientInfo['patient_suffix'], $key);

        $patientName = trim(
            $patientFirstName . " " . 
            $patientMiddleName . " " . 
            $patientLastName . " " . 
            $patientSuffix
        );

        $patients[] = [
            'id' => $rowGetPatientInfo['patient_info_id'],
            'name' => $patientName
        ];
    }

    // Return the results as JSON
    echo json_encode($patients);


} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
