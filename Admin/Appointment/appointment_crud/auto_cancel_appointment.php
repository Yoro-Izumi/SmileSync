<?php
date_default_timezone_set('Asia/Manila');
$root_dir = (PHP_OS === 'WINNT') ? 'C:/xampp/htdocs/SmileSync' : '/var/www/html/SmileSync';
include $root_dir . "/Admin/admin_global_files/connect_database.php";

// Create a single database connection
$conn = connect_appointment($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current date and time without seconds
$current_date_time = date('Y-m-d H:i');

echo "Current Date and Time (excluding seconds): $current_date_time\n";

// 1. Cancel Appointments Where Date-Time Has Passed
function cancelPastAppointments($connection, $currentDateTime) {
    // SQL query to select appointments that need to be canceled
    $sql = "
        SELECT `appointment_id`
        FROM `smilesync_appointments`
        WHERE DATE_FORMAT(`appointment_date_time`, '%Y-%m-%d %H:%i') < '$currentDateTime' 
        AND `appointment_status` = 'Pending'
    ";

    // Execute the query
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Loop through the appointments and update their status
        while ($row = $result->fetch_assoc()) {
            $appointment_id = $row['appointment_id'];

            // Update query to set the appointment status to 'Cancelled'
            $update_sql = "
                UPDATE `smilesync_appointments`
                SET `appointment_status` = 'Cancelled'
                WHERE `appointment_id` = $appointment_id
            ";

            if ($connection->query($update_sql) === TRUE) {
                echo "Appointment ID $appointment_id has been cancelled successfully.\n";
            } else {
                echo "Error updating record for Appointment ID $appointment_id: " . $connection->error . "\n";
            }
        }
    } else {
        echo "No appointments to cancel.\n";
    }
}

// 2. Update Appointments to 'Ongoing' When Current Date-Time Matches
function updateAppointmentStatusToOngoing($connection, $currentDateTime) {
    // SQL query to update appointments where datetime matches the current datetime
    $query = "
        UPDATE `smilesync_appointments`
        SET `appointment_status` = 'Ongoing'
        WHERE DATE_FORMAT(`appointment_date_time`, '%Y-%m-%d %H:%i') <= ?
        AND `appointment_status` = 'Approved'
    ";

    if ($stmt = mysqli_prepare($connection, $query)) {
        // Bind the current datetime parameter
        mysqli_stmt_bind_param($stmt, 's', $currentDateTime);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $affectedRows = mysqli_stmt_affected_rows($stmt);
            echo "$affectedRows appointment(s) updated to 'Ongoing'.\n";
        } else {
            echo "Error updating appointment status: " . mysqli_error($connection) . "\n";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the query: " . mysqli_error($connection) . "\n";
    }
}

// Call the functions
cancelPastAppointments($conn, $current_date_time);
updateAppointmentStatusToOngoing($conn, $current_date_time);

    // Sleep for 60 seconds before the next iteration
    sleep(50);

// Close the connection
//$conn->close();
?>
