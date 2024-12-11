<?php
session_start();
include "../client_global_files/connect_database.php";
include "../client_global_files/input_sanitizing.php";

$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$user_id = $_SESSION['userID'];
$appointment_status = "Cancelled";

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);

// Check connection
if (!$connect_appointment) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to get the appointment data
$getAppointmentDetails = "
    SELECT 
        a.patient_info_id, 
        a.admin_id, 
        a.appointment_date_time, 
        a.appointment_status,
        a.appointment_id,
        p.patient_first_name,
        p.patient_middle_name,
        p.patient_last_name, 
        ar.admin_first_name,
        ar.admin_middle_name,
        ar.admin_last_name
    FROM 
        smilesync_appointments a
    LEFT JOIN 
        $patients_db.smilesync_patient_information p ON a.patient_info_id = p.patient_info_id
    LEFT JOIN 
        $approvers_db.smilesync_admin_accounts ar ON a.admin_id = ar.admin_account_id
    WHERE 
        a.patient_info_id = '$user_id'
";

$result = mysqli_query($connect_appointment, $getAppointmentDetails);

// Process results
$appointments = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
}
mysqli_close($connect_appointment);

foreach ($appointments as $appointment){
    $patient_id = $appointment['patient_info_id'];
    $admin_id = $appointment['admin_id'];
    $appointment_date_time = formatDateTime($appointment['appointment_date_time']);
    $appointment_status = $appointment['appointment_status'];
    $appointment_id = $appointment['appointment_id'];

    $patient_first_name = $appointment['patient_first_name'] ?? "";
    $patient_middle_name = $appointment['patient_middle_name'] ?? "";
    $patient_last_name = $appointment['patient_last_name'] ?? "";
    $patient_name = trim("$patient_first_name $patient_middle_name $patient_last_name");

    $approver_first_name = $appointment['admin_first_name'] ?? "";
    $approver_middle_name = $appointment['admin_middle_name'] ?? "";
    $approver_last_name = $appointment['admin_last_name'] ?? "";
    $approver_name = trim("$approver_first_name $approver_middle_name $approver_last_name");
?>
    <tr>
        <td><input type="checkbox"></td>
        <td data-label="CLIENT ID">00-00-002</td>
        <td data-label="CLIENT NAME">Dimaculangan, Chorlyn L.</td>
        <td data-label="APPROVER">Dr. OLI, Jonas</td>
        <td data-label="APPOINTMENT">08-10-2024</td>
        <td data-label="STATUS" class="status">Rescheduled</td>
        <td data-label="ACTIONS">
        <div class="actions">
            <div class="dropdown">
                <button>⋮</button>
                <div class="dropdown-content">
                    <a href="appointment-details.php">View Details</a>
                    <a href="#">Download</a>
                    <a href="#" id="appointmentStatus">Done Appointment</a>
                </div>
            </div>
        </div>
        </td>
    </tr>
<?php } ?>
