<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

header('Content-Type: application/json');

$connect_appointment = connect_appointment($servername, $username, $password);

if ($connect_appointment->connect_error) {
    die(json_encode(['error' => $connect_appointment->connect_error]));
}

$query = "SELECT HOUR(appointment_date_time) AS hour, COUNT(*) AS patient_count 
          FROM smilesync_appointments 
          GROUP BY HOUR(appointment_date_time)";
$result = $connect_appointment->query($query);

$data = ['categories' => [], 'series' => []];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data['categories'][] = $row['hour'] . ':00'; // Format as "HH:00"
        $data['series'][] = (int)$row['patient_count'];
    }
}

echo json_encode($data);
$connect_appointment->close();
?>
