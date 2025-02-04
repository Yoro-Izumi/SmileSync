<?php
date_default_timezone_set('Asia/Manila');
$root_dir = (PHP_OS === 'WINNT') ? 'C:/xampp/htdocs/SmileSync' : '/var/www/html/SmileSync';
include $root_dir . "/Admin/admin_global_files/connect_database.php";

// Create a single database connection
$conn = connect_appointment($servername, $username, $password);
$connect_accounts = connect_accounts($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current date and time without seconds
$current_date_time = date('Y-m-d H:i');

echo "Current Date and Time (excluding seconds): $current_date_time\n";

// Helper function to insert notifications for patients
function insertPatientNotification($connection, $patientInfoId, $message) {
    $accountSql = "
        SELECT `patient_account_id`
        FROM `smilesync_patient_accounts`
        WHERE `patient_info_id` = $patientInfoId
    ";
    $accountResult = $connection->query($accountSql);

    if ($accountResult->num_rows > 0) {
        $accountRow = $accountResult->fetch_assoc();
        $patientAccountId = $accountRow['patient_account_id'];

        $notificationDate = (new DateTime())->format('Y-m-d H:i:s');
        $insertSql = "
            INSERT INTO `smilesync_patient_notifications`
            (`notification`, `patient_account_id`, `notification_date`)
            VALUES ('$message', $patientAccountId, '$notificationDate')
        ";

        if ($connection->query($insertSql) === TRUE) {
            echo "Notification added for patient_account_id: $patientAccountId\n";
        } else {
            echo "Error inserting patient notification: " . $connection->error . "\n";
        }
    }
}

// Helper function to insert notifications for admins
function insertAdminNotification($connection, $message) {
    $notificationDate = (new DateTime())->format('Y-m-d H:i:s');
    $insertSql = "
        INSERT INTO `smilesync_admin_notifications`
        (`notification`, `admin_id`, `notification_date`)
        VALUES ('$message', NULL, '$notificationDate')
    ";

    if ($connection->query($insertSql) === TRUE) {
        echo "Notification added for admins.\n";
    } else {
        echo "Error inserting admin notification: " . $connection->error . "\n";
    }
}

// Helper function to insert notifications for super admins
function insertSuperAdminNotification($connection, $message) {
    $notificationDate = (new DateTime())->format('Y-m-d H:i:s');
    $insertSql = "
        INSERT INTO `smilesync_super_admin_notifications`
        (`notification`, `super_admin_id`, `notification_date`)
        VALUES ('$message', NULL, '$notificationDate')
    ";

    if ($connection->query($insertSql) === TRUE) {
        echo "Notification added for super admins.\n";
    } else {
        echo "Error inserting super admin notification: " . $connection->error . "\n";
    }
}

// 1. Cancel Appointments Where Date-Time Has Passed
function cancelPastAppointments($connection, $connectionAccounts, $currentDateTime) {
    // Add 10-minute leeway to the current time
    $leewayTime = (new DateTime($currentDateTime))->modify('-10 minutes')->format('Y-m-d H:i');

    $sql = "
        SELECT `appointment_id`, `patient_info_id`
        FROM `smilesync_appointments`
        WHERE DATE_FORMAT(`appointment_date_time`, '%Y-%m-%d %H:%i') < ?
        AND `appointment_status` = 'Pending'
    ";

    // Use a prepared statement to avoid SQL injection
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $leewayTime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment_id = $row['appointment_id'];
            $patientInfoId = $row['patient_info_id'];

            // Update the appointment status to 'Cancelled'
            $update_sql = "
                UPDATE `smilesync_appointments`
                SET `appointment_status` = 'Cancelled'
                WHERE `appointment_id` = ?
            ";
            $stmtUpdate = $connection->prepare($update_sql);
            $stmtUpdate->bind_param("i", $appointment_id);

            if ($stmtUpdate->execute()) {
                echo "Appointment ID $appointment_id has been cancelled successfully (with 10-minute leeway).\n";

                // Add notifications for cancellation
                $message = "Appointment ID $appointment_id has been cancelled.";
                insertPatientNotification($connectionAccounts, $patientInfoId, $message);
                insertAdminNotification($connectionAccounts, $message);
                insertSuperAdminNotification($connectionAccounts, $message);
            } else {
                echo "Error updating record for Appointment ID $appointment_id: " . $stmtUpdate->error . "\n";
            }
            $stmtUpdate->close();
        }
    } else {
        echo "No appointments to cancel.\n";
    }
    $stmt->close();
}


// 2. Update Appointments to 'Ongoing' When Current Date-Time Matches
function updateAppointmentStatusToOngoing($connection, $connectionAccounts,$currentDateTime) {
    $sql = "
        SELECT `appointment_id`, `patient_info_id`
        FROM `smilesync_appointments`
        WHERE DATE_FORMAT(`appointment_date_time`, '%Y-%m-%d %H:%i') <= '$currentDateTime'
        AND `appointment_status` = 'Approved'
    ";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment_id = $row['appointment_id'];
            $patientInfoId = $row['patient_info_id'];

            $update_sql = "
                UPDATE `smilesync_appointments`
                SET `appointment_status` = 'Ongoing'
                WHERE `appointment_id` = $appointment_id
            ";

            if ($connection->query($update_sql) === TRUE) {
                echo "Appointment ID $appointment_id has been updated to 'Ongoing'.\n";

                // Add notifications for ongoing status
                $message = "Appointment ID $appointment_id is now ongoing.";
                insertPatientNotification($connectionAccounts, $patientInfoId, $message);
                insertAdminNotification($connectionAccounts, $message);
                insertSuperAdminNotification($connectionAccounts, $message);
            } else {
                echo "Error updating record for Appointment ID $appointment_id: " . $connection->error . "\n";
            }
        }
    } else {
        echo "No appointments to update to 'Ongoing'.\n";
    }
}

// 3. Add Notifications for Appointments Within 1 Hour
function notifyUpcomingAppointments($connection,$connectionAccounts) {
    $currentTime = new DateTime();
    $oneHourLater = (new DateTime())->modify('+1 hour');

    $sql = "
        SELECT `appointment_id`, `patient_info_id`, `appointment_date_time`
        FROM `smilesync_appointments`
        WHERE `appointment_status` = 'Approved'
    ";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointmentDateTime = new DateTime($row['appointment_date_time']);

            if ($appointmentDateTime > $currentTime && $appointmentDateTime <= $oneHourLater) {
                $patientInfoId = $row['patient_info_id'];

                $message = "Upcoming appointment scheduled for " . $appointmentDateTime->format('Y-m-d H:i:s');
                insertPatientNotification($connectionAccounts, $patientInfoId, $message);
                insertAdminNotification($connectionAccounts, $message);
                insertSuperAdminNotification($connectionAccounts, $message);
            }
        }
    } else {
        echo "No upcoming appointments found.\n";
    }
}

// Call the functions
cancelPastAppointments($conn,$connect_accounts, $current_date_time);
updateAppointmentStatusToOngoing($conn,$connect_accounts, $current_date_time);
notifyUpcomingAppointments($conn,$connect_accounts);

// Sleep for 60 seconds before the next iteration
sleep(50);

// Close the connection
//$conn->close();
?>
