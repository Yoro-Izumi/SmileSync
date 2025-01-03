<?php
$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$user_id = $_SESSION['userID'];

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);

// Check connection
if (!$connect_appointment) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// SQL query to get the appointment data
$getAppointmentDetails = "
SELECT 
    ap.*,
    p.patient_first_name,
    p.patient_middle_name,
    p.patient_last_name,
    ar.admin_first_name,
    ar.admin_middle_name,
    ar.admin_last_name,
    sr.service_name,
    sr.service_id
FROM 
    smilesync_invoice_services `is`
LEFT JOIN 
    smilesync_appointments ap ON `is`.appointment_id = ap.appointment_id
LEFT JOIN 
    smilesync_invoices inv ON `is`.invoice_id = inv.invoice_id
LEFT JOIN 
    {$patients_db}.smilesync_patient_information p ON ap.patient_info_id = p.patient_info_id
LEFT JOIN 
    {$approvers_db}.smilesync_admin_accounts ar ON ap.admin_id = ar.admin_account_id
LEFT JOIN 
    smilesync_services sr ON `is`.service_id = sr.service_id
WHERE 
    p.patient_info_id = '$user_id'
ORDER BY 
    ap.appointment_id ASC
";

$result = $connect_appointment->query($getAppointmentDetails);
$temp_appointment_id = "";

// Check and process results
if ($result && $result->num_rows > 0) {
    while ($appointment = $result->fetch_assoc()) {
        if ($appointment['appointment_id'] != $temp_appointment_id) {
            $temp_appointment_id = $appointment['appointment_id'];

            $patient_id = $appointment['patient_info_id'] ?? "";
            $admin_id = $appointment['admin_id'] ?? "";
            $appointment_date_time = formatDateTime($appointment['appointment_date_time'] ?? "");
            $appointment_status = $appointment['appointment_status'] ?? "";

            // Patient name
            $patient_first_name = $appointment['patient_first_name'] ?? "";
            $patient_first_name = decryptData($patient_first_name,$key);
            $patient_middle_name = $appointment['patient_middle_name'] ?? "";
            $patient_middle_name = decryptData($patient_middle_name,$key);
            $patient_last_name = $appointment['patient_last_name'] ?? "";
            $patient_last_name = decryptData($patient_last_name,$key);
            $patient_name = trim("$patient_first_name $patient_middle_name $patient_last_name");

            // Approver name
            $approver_first_name = $appointment['admin_first_name'] ?? "";
            $approver_first_name = decryptData($appointment,$key);
            $approver_middle_name = $appointment['admin_middle_name'] ?? "";
            $approver_middle_name = decryptData($approver_middle_name,$key);
            $approver_last_name = $appointment['admin_last_name'] ?? "";
            $approver_last_name = decryptData($approver_last_name,$key);
            $approver_name = trim("$approver_first_name $approver_middle_name $approver_last_name");

            //Invoice
            $invoice_id = sanitize_input($appointment['invoice_id'],$connect_appointment) ?? NULL;
            // Render table row
            ?>
            <tr>
            <td><input type="checkbox" value = "<?php echo $invoice_id?>"></td>
            <td data-label="PATIENT ID"><?php echo sanitize_input($patient_id, $connect_appointment); ?></td>
            <td data-label="PATIENT NAME"><?php echo sanitize_input($patient_name, $connect_appointment); ?></td>
            <td data-label="APPROVER"><?php echo sanitize_input($approver_name, $connect_appointment); ?></td>
            <td data-label="APPOINTMENT"><?php echo sanitize_input($appointment_date_time, $connect_appointment); ?></td>
            <td data-label="STATUS" class="status"><?php echo sanitize_input($appointment_status, $connect_appointment); ?></td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#" >View Details</a>
                    <a href="#">Download</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
            <?php
        }
    }
} else {
    // No appointments found
    ?>
    <tr>
        <td colspan="7">No appointments found.</td>
    </tr>
    <?php
}

// Close the connection
$connect_appointment->close();
?>
