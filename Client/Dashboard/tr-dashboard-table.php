<?php

$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$user_id = $_SESSION['userID'];
$appointment_status = "Cancelled";

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);

// Check connection
if (!$connect_appointment) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to get the appointment data
$getAppointmentDetails = "
    SELECT 
        a.*, 
        p.*, 
        ar.*
    FROM 
        smilesync_appointments a
    LEFT JOIN 
        $patients_db.smilesync_patient_information p ON a.patient_info_id = p.patient_info_id
    LEFT JOIN 
        $approvers_db.smilesync_admin_accounts ar ON a.admin_id = ar.admin_account_id
    WHERE 
        a.patient_info_id = ?
    AND 
        a.appointment_status = 'Ongoing'
";

$appointments = [];
if ($stmt = mysqli_prepare($connect_appointment, $getAppointmentDetails)) {
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Process results
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}

foreach ($appointments as $appointment) {
    $patient_id = $appointment['patient_info_id'];
    $admin_id = $appointment['admin_id'];
    $appointment_date_time = formatDateTime($appointment['appointment_date_time']);
    $appointment_status = $appointment['appointment_status'];
    $appointment_id = $appointment['appointment_id'];

    $patient_first_name = decryptData($appointment['patient_first_name'] ?? "", $key);
    $patient_middle_name = decryptData($appointment['patient_middle_name'] ?? "", $key);
    $patient_last_name = decryptData($appointment['patient_last_name'] ?? "", $key);
    $patient_name = trim("$patient_first_name $patient_middle_name $patient_last_name");

    $approver_first_name = decryptData($appointment['admin_first_name'] ?? "", $key);
    $approver_middle_name = decryptData($appointment['admin_middle_name'] ?? "", $key);
    $approver_last_name = decryptData($appointment['admin_last_name'] ?? "", $key);
    $approver_name = trim("$approver_first_name $approver_middle_name $approver_last_name");

    // Query to fetch services
    $qryGetServices = "
        SELECT 
            isv.*, 
            s.* 
        FROM 
            smilesync_invoice_services isv
        LEFT JOIN 
            smilesync_services s 
        ON 
            s.service_id = isv.service_id
        WHERE 
            isv.appointment_id = ?
    ";
    $services = "";
    if ($prepareGetServices = mysqli_prepare($connect_appointment, $qryGetServices)) {
        mysqli_stmt_bind_param($prepareGetServices, 'i', $appointment_id);
        mysqli_stmt_execute($prepareGetServices);
        $getServices = mysqli_stmt_get_result($prepareGetServices);

        if (mysqli_num_rows($getServices) > 0) {
            while ($service = mysqli_fetch_assoc($getServices)) {
                $services = trim($services . " " . $service['service_name']);
            }
        }
        mysqli_stmt_close($prepareGetServices);
    }

    // Output the table row
    ?>
    <tr>
        <td><?php echo htmlspecialchars($patient_name); ?></td>
        <td><?php echo htmlspecialchars($services); ?></td>
        <td><?php echo htmlspecialchars($appointment_date_time); ?></td>
    </tr>
<?php
}
?>
