<?php
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";

$connect_db = connect_appointment($servername,$username,$password);

try {
    // Query to fetch ongoing appointments
    $query = "
    SELECT 
        a.appointment_id, 
        p.patient_last_name AS patient_name, 
        a.appointment_reason, 
        DATE_FORMAT(a.appointment_date_time, '%m-%d-%Y') AS appointment_date, 
        DATE_FORMAT(a.appointment_date_time, '%h:%i %p') AS appointment_time 
    FROM smilesync_appointments a
    LEFT JOIN smilesync_accounts.smilesync_patient_accounts p ON a.patient_info_id = p.patient_account_id
    LEFT JOIN smilesync_patient_management.smilesync_patient_information pi 
        ON p.patient_info_id = pi.patient_info_id
    WHERE a.appointment_status = 'scheduled' 
      AND a.appointment_date_time > NOW()
    ORDER BY a.appointment_date_time ASC
";

    
    $result = $connect_db->query($query);

    if ($result->num_rows > 0) {
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        echo json_encode($appointments); // Return the data as JSON
    } else {
        echo json_encode([]);
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
