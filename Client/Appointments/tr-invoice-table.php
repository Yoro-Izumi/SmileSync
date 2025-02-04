<?php

$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$user_id = $_SESSION['userID'];

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);

// Check connection
if ($connect_appointment->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed: " . $connect_appointment->connect_error]);
    exit;
}

// Connect to accounts database
$connect_accounts = connect_accounts($servername, $username, $password);

// Get patient information
$qryGetPatientInfo = "SELECT * FROM smilesync_patient_accounts 
                      LEFT JOIN smilesync_patient_management.smilesync_patient_information 
                      ON smilesync_patient_accounts.patient_info_id = smilesync_patient_management.smilesync_patient_information.patient_info_id
                      WHERE smilesync_patient_accounts.patient_account_id = ?";
$stmtGetPatientInfo = $connect_accounts->prepare($qryGetPatientInfo);
$stmtGetPatientInfo->bind_param('i', $user_id);
$stmtGetPatientInfo->execute();
$resultGetPatientInfo = $stmtGetPatientInfo->get_result();
$rowGetPatientInfo = $resultGetPatientInfo->fetch_assoc();
$patientID = $rowGetPatientInfo['patient_info_id'];

// Debug: Check if patient ID is valid
if (!$patientID) {
    echo "Invalid Patient ID.";
    exit;
}

// Prepare the SQL query to fetch data from the invoice table
$getAppointmentDetails = $connect_appointment->prepare("SELECT 
    ap.*,
    p.*,
    ar.*,
    sr.*,
    inv.*,
    invs.*
FROM 
    smilesync_invoice inv
LEFT JOIN 
    smilesync_appointments ap ON inv.appointment_id = ap.appointment_id
LEFT JOIN 
    {$patients_db}.smilesync_patient_information p ON ap.patient_info_id = p.patient_info_id
LEFT JOIN 
    {$approvers_db}.smilesync_admin_accounts ar ON ap.admin_id = ar.admin_account_id
LEFT JOIN 
    smilesync_invoice_services invs ON inv.invoice_id = invs.invoice_id
LEFT JOIN 
    smilesync_services sr ON invs.service_id = sr.service_id
WHERE 
    p.patient_info_id = ?
ORDER BY 
    ap.appointment_id ASC
");

// Bind the patient ID
$getAppointmentDetails->bind_param("i", $patientID);

// Execute the query
$getAppointmentDetails->execute();
$result = $getAppointmentDetails->get_result();

// Check and process results
if ($result && $result->num_rows > 0) {
    while ($appointment = $result->fetch_assoc()) {
        $patient_id = $appointment['patient_info_id'] ?? "";
        $admin_id = $appointment['admin_id'] ?? "";
        $appointment_date_time = formatDateTime($appointment['appointment_date_time'] ?? "");
        $appointment_status = $appointment['appointment_status'] ?? "";

        // Patient name
        $patient_first_name = decryptData($appointment['patient_first_name'] ?? "", $key);
        $patient_middle_name = decryptData($appointment['patient_middle_name'] ?? "", $key);
        $patient_last_name = decryptData($appointment['patient_last_name'] ?? "", $key);
        $patient_name = trim("$patient_first_name $patient_middle_name $patient_last_name");

        // Approver name
        $approver_first_name = decryptData($appointment['admin_first_name'] ?? "", $key);
        $approver_middle_name = decryptData($appointment['admin_middle_name'] ?? "", $key);
        $approver_last_name = decryptData($appointment['admin_last_name'] ?? "", $key);
        $approver_name = trim("$approver_first_name $approver_middle_name $approver_last_name");

        // Invoice details
        $invoice_id = sanitize_input($appointment['invoice_id'], $connect_appointment) ?? " ";
        $invoice_unique_id = $appointment['invoice_unique_id'];
        $invoice_status = $appointment['invoice_status'];
        ?>
        <tr>
            <td><input type="checkbox" value="<?php echo $invoice_id; ?>"></td>
            <td data-label="PATIENT ID"><?php echo sanitize_input($patient_id, $connect_appointment); ?></td>
            <td data-label="PATIENT NAME"><?php echo sanitize_input($patient_name, $connect_appointment); ?></td>
            <td data-label="APPROVER"><?php echo sanitize_input($approver_name, $connect_appointment); ?></td>
            <td data-label="APPOINTMENT"><?php echo sanitize_input($appointment_date_time, $connect_appointment); ?></td>
            <td data-label="STATUS" class="status"><?php echo sanitize_input($invoice_status, $connect_appointment); ?></td>
            <td data-label="ACTIONS">
                <div class="actions">
                    <div class="dropdown">
                        <button>⋮</button>
                        <div class="dropdown-content">
                            <a href="#">View Details</a>
                            <a href="#">Download</a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="7">No invoices or appointments found.</td>
    </tr>
    <?php
}

// Close the statement and connection
$getAppointmentDetails->close();
$connect_appointment->close();

?>
