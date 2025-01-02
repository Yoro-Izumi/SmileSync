<?php 
$connect_accounts = connect_accounts($servername, $username, $password);
$statusAccount = "Deactivated";
$stmtPatientAccounts = "
                        SELECT smilesync_patient_management.smilesync_patient_information.*
                        , smilesync_patient_accounts.*
                        ,smilesync_appointments.smilesync_appointments.* 
                        FROM smilesync_patient_accounts
                        LEFT JOIN smilesync_patient_management.smilesync_patient_information
                        ON smilesync_patient_information.patient_info_id = smilesync_patient_accounts.patient_info_id
                        LEFT JOIN smilesync_appointments.smilesync_appointments
                        ON smilesync_appointments.patient_info_id = smilesync_patient_accounts.patient_info_id
                        WHERE patient_account_status = ?
                        ";
$preparePatientAccounts = mysqli_prepare($connect_accounts, $stmtPatientAccounts);
mysqli_stmt_bind_param($preparePatientAccounts, "s", $statusAccount);
mysqli_stmt_execute($preparePatientAccounts);
$resultsPatientAccounts = mysqli_stmt_get_result($preparePatientAccounts);

if ($resultsPatientAccounts) {
    while ($patientAccounts = mysqli_fetch_assoc($resultsPatientAccounts)) {
        if ($patientAccounts['patient_info_id'] === NULL) {
            $patientFirstName = $patientAccounts['patient_first_name'] = "";
            $patientMiddleName = $patientAccounts['patient_middle_name'] = "";
            $patientLastName = $patientAccounts['patient_last_name'] = "";
        } else {
            $patientFirstName = decryptData($patientAccounts['patient_first_name'],$key) ?? "";
            $patientMiddleName = decryptData($patientAccounts['patient_middle_name'],$key) ?? "";
            $patientLastName = decryptData($patientAccounts['patient_last_name'],$key) ?? "";
            $patientID = $patientAccounts['patient_account_id'];
            $patientFullName = $patientLastName . ", " . $patientFirstName . " " . $patientMiddleName;
            $approver = $patientAccounts['admin_id'] ?? "--";
            $account_status = $patientAccounts['patient_account_status'];
            $appointment_date_time = $patientAccounts['appointment_date_time']??"--";
          }
?>

<tr>
            <td><input type="checkbox" value="<?php echo $patientID?>"></td>
            <td data-label="CLIENT ID"><?php echo $patientID; ?></td>
            <td data-label="CLIENT NAME"><?php echo $patientFullName; ?></td>
            <td data-label="APPROVER"><?php echo $approver; ?></td>
            <td data-label="LAST APPOINTMENT"><?php echo $appointment_date_time;?></td>
            <td data-label="STATUS" class="status"><?php echo $account_status;?></td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Restore</a>
                    <a href="#">Permanent Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>

<?php
    }
}
?>
