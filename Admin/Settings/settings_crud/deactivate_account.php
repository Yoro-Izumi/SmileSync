<?php
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['userID'];

    $stmt = $connect_db->prepare("UPDATE smilesync_patient_accounts SET account_status = 'Deactivated' WHERE patient_account_id = ?");
    $stmt->bind_param('i', $userID);

    if ($stmt->execute()) {
        echo 'Account deactivated successfully.';
    } else {
        echo 'Error deactivating account.';
    }
    $stmt->close();
    $connect_db->close();
}
?>
