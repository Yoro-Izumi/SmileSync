<?php
include "../../admin_global_files/set_sesssion_dir.php";
session_start();

// Function to fetch appointments from the database
function getAppointments($month, $year) {
    include "../../admin_global_files/connect_database.php";
    include "../../admin_global_files/encrypt_decrypt.php";

    $conn = connect_appointment($servername, $username, $password);
    
    // Calculate the start and end dates for the selected month and year
    $start_date = "$year-$month-01";
    $end_date = "$year-$month-" . date('t', strtotime($start_date));  // Last day of the month
    
    // SQL query to fetch appointments
    $sql = "SELECT * FROM smilesync_appointments WHERE DATE(appointment_date_time) BETWEEN '$start_date'
            LEFT JOIN smilesync_patient_management.patient_id ON smilesync_appointments.patient_id = smilesync_patient_management.patient_id
            ORDER BY appointment_date";
    $result = $conn->query($sql);
    
    $appointments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointments[] = [
                'id' => $row['appointment_id'],
                'name' => $row['patient_name'],
                'time' => $row['appointment_time'],
                'appointment_date' => $row['appointment_date']
            ];
        }
    }
    
    // Close the connection
    $conn->close();
    
    return $appointments;
}

// Function to set the selected appointment in the session
function selectAppointment($appointment_id) {
    $_SESSION['appointment_id_choice'] = $appointment_id;
}

// Handle AJAX request for fetching appointments
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];  // Get month (1-12)
    $year = $_GET['year'];    // Get year (e.g., 2024)
    
    $appointments = getAppointments($month, $year);
    
    // Return appointments as JSON
    echo json_encode($appointments);
    exit;
}

// Handle appointment selection
if (isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];
    selectAppointment($appointment_id);
    
    // Return a success response
    echo json_encode(['success' => true, 'message' => 'Appointment selected']);
    exit;
}

?>
