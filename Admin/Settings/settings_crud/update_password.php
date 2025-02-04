<?php
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";

$connect_db = connect_accounts($servername,$username,$password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['userID'];
    $newPassword = sanitize_input($_POST['newPassword'],$connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPassword'],$key);

    if ($newPassword !== $confirmPassword) {
        echo 'Passwords do not match.';
        exit();
    }

    // Password hashing with Argon2i
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2I, $options);

    $stmt = $connect_db->prepare("UPDATE smilesync_patient_accounts SET patient_account_password = ? WHERE patient_account_id = ?");
    $stmt->bind_param('si', $hashedPassword, $userID);

    if ($stmt->execute()) {
        echo 'Password updated successfully.';
    } else {
        echo 'Error updating password.';
    }
    $stmt->close();
    $connect_db->close();
}
?>
