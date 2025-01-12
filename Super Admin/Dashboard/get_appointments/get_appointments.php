<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";

// Retrieve query parameters
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$day = isset($_GET['day']) ? $_GET['day'] : date('d');

// Check if required parameters are provided
if (!$month || !$year) {
    echo json_encode(['error' => 'Invalid parameters: month and year are required.']);
    exit;
}

// Create the date condition for the SQL query
$dateCondition = "";
if ($day) {
    $dateCondition = sprintf("DATE(appointment_date_time) = '%s-%02d-%02d'", $year, $month, $day);
} else {
    $dateCondition = sprintf("DATE_FORMAT(appointment_date_time, '%%Y-%%m') = '%s-%02d'", $year, $month);
}

// Connect to the database
$connect_appointment = connect_appointment($servername, $username, $password);
if (!$connect_appointment) {
    die(json_encode(['error' => 'Failed to connect to database: ' . mysqli_connect_error()]));
}

// Fetch appointments based on the date condition
$query = "
    SELECT a.appointment_id, a.appointment_date_time, a.appointment_reason, 
           u.patient_first_name, u.patient_last_name, u.patient_middle_name, u.patient_suffix 
    FROM smilesync_appointments a
    LEFT JOIN smilesync_patient_management.smilesync_patient_information u ON a.patient_info_id = u.patient_info_id
    WHERE $dateCondition
    ORDER BY a.appointment_date_time ASC
";

$result = mysqli_query($connect_appointment, $query);
if (!$result) {
    echo json_encode(['error' => 'Error executing query: ' . mysqli_error($connect_appointment)]);
    mysqli_close($connect_appointment);
    exit;
}

// Process the results
$appointments = [];

while ($row = mysqli_fetch_assoc($result)) {
    $row['patient_first_name'] = decryptData($row['patient_first_name'], $key);
    $row['patient_last_name'] = decryptData($row['patient_last_name'], $key);
    $row['patient_middle_name'] = decryptData($row['patient_middle_name'], $key);
    $row['patient_suffix'] = decryptData($row['patient_suffix'], $key);

    $appointments[] = [
        'id' => $row['appointment_id'],
        'name' => trim($row['patient_first_name'] . " " . $row['patient_last_name']),
        'time' => date("h:i A", strtotime($row['appointment_date_time'])),
        'reason' => $row['appointment_reason']
    ];
}

// Output the appointments as JSON
echo json_encode($appointments);

// Close the database connection
mysqli_close($connect_appointment);
?>
