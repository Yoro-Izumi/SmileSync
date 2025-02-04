<?php 
$connect_accounts = connect_accounts($servername, $username, $password);
$statusAccount = "Deactivated";

// Prepare and execute the query
$stmtAdminAccounts = "SELECT * FROM smilesync_admin_accounts WHERE account_status = ?";
$prepareAdminAccounts = mysqli_prepare($connect_accounts, $stmtAdminAccounts);
mysqli_stmt_bind_param($prepareAdminAccounts, "s", $statusAccount);
mysqli_stmt_execute($prepareAdminAccounts);
$resultsAdminAccounts = mysqli_stmt_get_result($prepareAdminAccounts);

// Check if results are returned
if ($resultsAdminAccounts) {
    while ($adminAccounts = mysqli_fetch_assoc($resultsAdminAccounts)) {
        // Fetch necessary data
        $adminFirstName = decryptData($adminAccounts['admin_first_name'],$key) ?? "";
        $adminMiddleName = decryptData($adminAccounts['admin_middle_name'],$key) ?? "";
        $adminLastName = decryptData($adminAccounts['admin_last_name'],$key) ?? "";
        $adminID = $adminAccounts['admin_account_id'];
        $adminFullName = $adminLastName . ", " . $adminFirstName . " " . $adminMiddleName;
        $dateOfCreation = $adminAccounts['date_of_creation'] ?? "";
?>

        <tr>
            <td><input type="checkbox" value="<?php echo htmlspecialchars($adminID); ?>"></td>
            <td data-label="ADMIN ID"><?php echo htmlspecialchars($adminID); ?></td>
            <td data-label="ADMIN NAME"><?php echo htmlspecialchars($adminFullName); ?></td>
            <td data-label="APPROVER">--</td>
            <td data-label="Date of Creation"><?php echo htmlspecialchars($dateOfCreation); ?></td>
            <td data-label="STATUS" class="status"><?php echo htmlspecialchars($statusAccount); ?></td>
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

// Close the database connection
mysqli_close($connect_accounts);
?>
