<?php 
$connect_accounts = connect_accounts($servername, $username, $password);
$statusAccount = "Active";
$stmtPatientAccounts = "
                        SELECT smilesync_patient_management.smilesync_patient_information.*
                        , smilesync_patient_accounts.*  
                        FROM smilesync_patient_accounts
                        LEFT JOIN smilesync_patient_management.smilesync_patient_information
                        ON smilesync_patient_information.patient_info_id = smilesync_patient_accounts.patient_info_id
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
            $patient_info_id = $patientAccounts['patient_info_id'] = "";
        } else {
            $patientFirstName = $patientAccounts['patient_first_name'] ?? "";
            $patientFirstName = decryptData($patientFirstName, $key);
            $patientMiddleName = $patientAccounts['patient_middle_name'] ?? "";
            $patientMiddleName = decryptData($patientMiddleName, $key);
            $patientLastName = $patientAccounts['patient_last_name'] ?? "";
            $patientLastName = decryptData($patientLastName, $key);
            $patientID = $patientAccounts['patient_account_id'];
            $patientFullName = $patientLastName . ", " . $patientFirstName . " " . $patientMiddleName;
            $patient_info_id = $patientAccounts[ 'patient_info_id' ]?? " ";
        }
        if ($patientAccounts['admin_id'] === NULL) {
            $approver = "--";
        } else {
            $approver = $patientAccounts['admin_id'];
        }
?>
<tr>
    <td><input type="checkbox" value="<?php echo $patient_info_id;?>"></td>
    <td data-label="ID"><?php echo $patientID; ?></td>
    <td data-label="NAME"><?php echo $patientFullName; ?></td>
    <td data-label="APPROVER"><?php echo $approver; ?></td>
    <td data-label="Date of Creation"><?php echo $patientAccounts['date_of_creation']; ?></td>
    <td data-label="STATUS" class="status"><?php echo $patientAccounts['patient_account_status']; ?></td>
    <td data-label="ACTIONS">
        <div class="actions">
            <div class="dropdown">
              <button>⋮</button>
              <div class="dropdown-content">
                <a href="#">Delete Account</a>
                <a href="#">Edit Account</a>
              </div>
            </div>
          </div>
    </td>
</tr> 
<?php
    }
}
?>
