<?php
$connect_appointments = connect_appointment($servername, $username, $password);

$currentDate  = date('Y-m-d');
$totalPatients = []; // Initialize an array to store the count for each date

$stmtPatientQuantity = mysqli_prepare($connect_appointments, "SELECT appointment_date_time FROM smilesync_appointments");
mysqli_stmt_execute($stmtPatientQuantity);
$resultPatientQuantity = mysqli_stmt_get_result($stmtPatientQuantity);

if (mysqli_num_rows($resultPatientQuantity) > 0) {
    while ($patientQuantity = mysqli_fetch_assoc($resultPatientQuantity)) {
        // Get the appointment datetime and convert it to date format
        $appointmentDate = new DateTime($patientQuantity['appointment_date_time']);
        $appointmentDate = $appointmentDate->format('Y-m-d'); // Convert to 'Y-m-d'

        // Initialize the count for this date if not already set
        if (!isset($totalPatients[$appointmentDate])) {
            $totalPatients[$appointmentDate] = 0;
        }

        // Increment the count for this appointment date
        $totalPatients[$appointmentDate]++;
    }
} else {
    // If no appointments, initialize today's date with 0 patients
    $totalPatients[$currentDate] = 0;
}

mysqli_stmt_close($stmtPatientQuantity);

// Now $totalPatients contains the count of patients per day.
// For example, print the patient count for today
echo "Patients for $currentDate: " . ($totalPatients[$currentDate] ?? 0);

?>
