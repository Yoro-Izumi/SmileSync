<?php
include "../../admin_global_files/set_sesssion_dir.php";  // Ensure this includes session_start()
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername, $username, $password);
$connect_inventory = connect_inventory($servername, $username, $password);
$connect_patient_management = connect_patient($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminID = $_SESSION['userAdminID'] ?? NULL;
    $appointmentID = $_POST['approval_appointment_id'] ?? 1;

    // Ensure that appointmentID is valid
    if (is_numeric($appointmentID) && $appointmentID > 0) {
        $newStatus = "Approved";

        // Procedures
        $procedures = $_POST['procedureCheck'] ?? [];

        // Check if any procedures are selected
        if (!empty($procedures)) {
            // Insert procedures and items
            foreach ($procedures as $procedure) {
                // Ensure that procedure is a valid number
                if (is_numeric($procedure) && $procedure > 0) {
                    $qryInsertInvoiceService = "INSERT INTO `smilesync_invoice_services`(`invoice_services_id`, `invoice_id`, `service_id`, `appointment_id`) VALUES (NULL, NULL, ?, ?)";
                    if ($stmt = mysqli_prepare($connect_appointment, $qryInsertInvoiceService)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $procedure, $appointmentID);
                        $stmtExecuted = mysqli_stmt_execute($stmt);
                        if (!$stmtExecuted) {
                            // Handle failure of query execution
                            echo "Error executing procedure insertion query: " . mysqli_error($connect_appointment);
                        }
                        else{
                            echo "success";
                        }
                    } else {
                        // Handle failure of statement preparation
                        echo "Error preparing statement: " . mysqli_error($connect_appointment);
                    }
                }
            }

            // Update appointment status to 'Approved'
            $qryUpdateDoneAppointment = "UPDATE `smilesync_appointments` SET `appointment_status` = ? WHERE `appointment_id` = ?";
            if ($stmt = mysqli_prepare($connect_appointment, $qryUpdateDoneAppointment)) {
                mysqli_stmt_bind_param($stmt, 'si', $newStatus, $appointmentID);
                $stmtExecuted = mysqli_stmt_execute($stmt);
                if (!$stmtExecuted) {
                    // Handle failure of query execution
                    echo "Error updating appointment status: " . mysqli_error($connect_appointment);
                }
            } else {
                // Handle failure of statement preparation
                echo "Error preparing update statement: " . mysqli_error($connect_appointment);
            }
        } else {
            //echo "No procedures selected.";
            // Update appointment status to 'Approved'
            $qryUpdateDoneAppointment = "UPDATE `smilesync_appointments` SET `appointment_status` = ? WHERE `appointment_id` = ?";
            if ($stmt = mysqli_prepare($connect_appointment, $qryUpdateDoneAppointment)) {
                mysqli_stmt_bind_param($stmt, 'si', $newStatus, $appointmentID);
                $stmtExecuted = mysqli_stmt_execute($stmt);
                if (!$stmtExecuted) {
                    // Handle failure of query execution
                    echo "Error updating appointment status: " . mysqli_error($connect_appointment);
                }
                else{
                    echo "success";
                }
            } else {
                // Handle failure of statement preparation
                echo "Error preparing update statement: " . mysqli_error($connect_appointment);
            }
        }
    } else {
        echo "Invalid appointment ID.";
    }
}
?>
