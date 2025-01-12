<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";
header('Content-Type: application/json');

$connect_appointment = connect_appointment($servername, $username, $password);

if ($connect_appointment->connect_error) {
    die(json_encode(['error' => $connect_appointment->connect_error]));
}
$query = "SELECT DAYNAME(appointment_date_time) AS day, COUNT(*) AS patient_count 
          FROM smilesync_appointments 
          GROUP BY DAYOFWEEK(appointment_date_time)";
$result = $connect_appointment->query($query);

$data = ['categories' => [], 'series' => []];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data['categories'][] = $row['day'];
        $data['series'][] = (int)$row['patient_count'];
    }
}

echo json_encode($data);
$connect_appointment->close();
?>
