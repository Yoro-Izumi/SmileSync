<?php
include "../../admin_global_files/connect_database.php";

// Create connection
$conn = connect_appointment($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date and time in the same format as the appointment_date_time (assuming MySQL DATETIME format)
$current_date_time = date('Y-m-d H:i:s');

// SQL query to select appointments that need to be canceled (where date_time is in the past)
$sql = "SELECT `appointment_id`, `patient_info_id`, `admin_id`, `covid_form_id`, `appointment_status`, `appointment_date_time`, `appointment_reason`, `emergency_contact_id`
        FROM `smilesync_appointments`
        WHERE `appointment_date_time` < '$current_date_time' AND `appointment_status` != 'Cancelled'";

// Execute the query
$result = $conn->query($sql);

// Check if there are appointments to cancel
if ($result->num_rows > 0) {
    // Loop through the appointments and update the status to 'Cancelled'
    while ($row = $result->fetch_assoc()) {
        $appointment_id = $row['appointment_id'];
        
        // Update query to set the appointment status to 'Cancelled'
        $update_sql = "UPDATE `smilesync_appointments`
                       SET `appointment_status` = 'Cancelled'
                       WHERE `appointment_id` = $appointment_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Appointment ID $appointment_id has been cancelled successfully.\n";
        } else {
            echo "Error updating record for Appointment ID $appointment_id: " . $conn->error . "\n";
        }
    }
} else {
    echo "No appointments to cancel.\n";
}

// Close the connection
$conn->close();
?>
