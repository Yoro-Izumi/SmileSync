<?php

// Databases
$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$appointment_status_cancelled = "Cancelled";
$appointment_status_done = "Done";

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);

if (!$connect_appointment) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to get the appointment data
$getAppointmentDetails = "
    SELECT 
        a.*,
        p.*,
        ar.*
    FROM 
        `smilesync_appointments` a
    LEFT JOIN 
        `$patients_db`.`smilesync_patient_information` p 
        ON a.patient_info_id = p.patient_info_id
    LEFT JOIN 
        `$approvers_db`.`smilesync_admin_accounts` ar 
        ON a.admin_id = ar.admin_account_id
    WHERE 
        a.appointment_status NOT IN (?, ?)
        AND a.appointment_date_time >= CURDATE()
";

// Prepare statement to prevent SQL injection
$stmt = mysqli_prepare($connect_appointment, $getAppointmentDetails);
mysqli_stmt_bind_param($stmt, "ss", $appointment_status_cancelled, $appointment_status_done);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    error_log("SQL error: " . mysqli_error($connect_appointment));
    die("An error occurred while retrieving appointments.");
}

$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

foreach ($appointments as $appointment) {
    $patient_id = sanitize_input($appointment['patient_info_id'], $connect_appointment);
    $admin_id = sanitize_input($appointment['admin_account_id'], $connect_appointment);
    $appointment_date_time = formatDateTime($appointment['appointment_date_time']);
    $appointment_status = $appointment['appointment_status'];
    $appointment_id = sanitize_input($appointment['appointment_id'], $connect_appointment);

    // Decrypt patient names
    $patient_first_name = decryptData($appointment['patient_first_name'] ?? "", $key);
    $patient_middle_name = decryptData($appointment['patient_middle_name'] ?? "", $key);
    $patient_last_name = decryptData($appointment['patient_last_name'] ?? "", $key);
    $patient_name = trim("$patient_first_name $patient_middle_name $patient_last_name");

    // Decrypt approver names
    $approver_first_name = decryptData($appointment['admin_first_name'] ?? "", $key);
    $approver_middle_name = decryptData($appointment['admin_middle_name'] ?? "", $key);
    $approver_last_name = decryptData($appointment['admin_last_name'] ?? "", $key);
    $approver_name = trim("$approver_first_name $approver_middle_name $approver_last_name");

    ?>
    <tr>
        <td><input type="checkbox" value="<?php echo $appointment_id; ?>"></td>
        <td data-label="PATIENT ID"><?php echo $patient_id; ?></td>
        <td data-label="PATIENT NAME"><?php echo $patient_name; ?></td>
        <td data-label="APPROVER"><?php echo $approver_name; ?></td>
        <td data-label="APPOINTMENT"><?php echo $appointment_date_time; ?></td>
        <td data-label="STATUS" class="status"><?php echo $appointment_status; ?></td>
        <td data-label="ACTIONS">
            <div class="actions">
                <div class="dropdown">
                    <button>⋮</button>
                    <div class="dropdown-content">
                        <a href="appointment-details.php">View Details</a>
                        <?php if ($appointment_status === 'Approved') { ?>
                            <a href="#" class="appointmentStatus" data-id="<?php echo $appointment_id; ?>">Done Appointment</a>
                            <a href="#" class="openCancelAppointmentModal" data-id="<?php echo $appointment_id; ?>">Cancel Appointment</a>
                            <a href="#" class="openReschedAppointmentModal" data-id="<?php echo $appointment_id; ?>">Resched Appointment</a>
                        <?php } elseif ($appointment_status === 'Pending') { ?>
                            <a href="#" class="appointmentApprove" data-id="<?php echo $appointment_id; ?>">Approve Appointment</a>
                            <a href="#" class="openCancelAppointmentModal" data-id="<?php echo $appointment_id; ?>">Cancel Appointment</a>
                            <a href="#" class="openReschedAppointmentModal" data-id="<?php echo $appointment_id; ?>">Resched Appointment</a>
                        <?php } elseif ($appointment_status === 'Ongoing') { ?>
                            <a href="#" class="appointmentStatus" data-id="<?php echo $appointment_id; ?>">Mark as Done</a>
                        <?php } else { ?>
                            <a href="#">Download</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php
}
?>
