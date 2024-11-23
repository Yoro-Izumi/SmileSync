<?php
include "../admin_global_files/connect_database";
include "../admin_global_files/encrypt_decrypt.php";

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    $connect_appointment = connect_appointment($servername, $username, $password);
    // Check connection
    if (!$connect_appointment) {
        die("Connection failed: " . mysqli_connect_error());
        exit();
    }

    // Query to fetch appointments with JOINs for associated data
    $getAppointment = "
        SELECT a.*, 
               u.* 
        FROM smilesync_appointments.smilesync.appointments a
        LEFT JOIN smilesync_patient_management.patient_information u ON a.patient_info_id = u.patient_info_id
        WHERE DATE(a.appointment_date_time) = ?
        ORDER BY a.appointment_id DESC
    ";

    if ($stmt = mysqli_prepare($connect_appointment, $getAppointment)) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $date);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $row['patient_first_name'] = decryptData($row['patient_first_name'],$key);
            $row['patient_last_name'] = decryptData($row['patient_last_name'],$key);
            $row['patient_middle_name'] = decryptData($row['patient_middle_name'],$key);
            $row['patient_suffix'] = decryptData($row['patient,suffix'],$key);
            $row['patient_birthdate'] = decryptData($row['birthday'],$key);
            
            $appointments[] = $row;
        }

        // Return the appointments in JSON format
        echo json_encode($appointments);

        // Close statement and connection
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($connect_appointment);
    }

    mysqli_close($connect_appointment);
}
?>
