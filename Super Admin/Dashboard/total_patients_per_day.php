<?php
$connect_appointments = connect_appointment($servername, $username, $password);

$currentDate  = date('Y-m-d');
$totalPatients = 0;

$stmtPatientQuantity = mysqli_prepare($connect_appointments,"SELECT * FROM smilesync_appointments");
mysqli_stmt_execute($stmtPatientQuantity);
$resultPatientQuantity = mysqli_stmt_get_result($stmtPatientQuantity);

    if(mysqli_num_rows($resultPatientQuantity) > 0) {
        while ($patientQuantity = mysqli_fetch_assoc($resultPatientQuantity)) {
            $appointmentDate = new DateTime($patientQuantity['appointment_date_time']); //get the appointment datetime
            $appointmentDate = $appointmentDate->format('Y-m-d'); // convert to date format

            if ($appointmentDate === $currentDate) {
                $totalPatients++;
                return; // Stop execution after successful match
            }
        }
    }
    else {
        $totalPatients = 0;
    }

mysqli_stmt_close($stmtPatientQuantity);

?>