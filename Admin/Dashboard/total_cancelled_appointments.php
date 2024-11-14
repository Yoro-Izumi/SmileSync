<?php
$connect_appointments = connect_appointment($servername, $username, $password);

$appointmentStatus = "Cancelled";
$totalCancelledAppointments = 0;

$stmtPatientQuantity = mysqli_prepare($connect_appointments,"SELECT * FROM smilesync_appointments WHERE appointment_status = ?");
mysqli_stmt_bind_param($stmtPatientQuantity, 's', $appointmentStatus);
mysqli_stmt_execute($stmtPatientQuantity);
$resultPatientQuantity = mysqli_stmt_get_result($stmtPatientQuantity);

$totalCancelledAppointments = mysqli_num_rows($resultPatientQuantity);
mysqli_stmt_close($stmtPatientQuantity);

?>