<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../admin_global_files/connect_database.php';
include '../admin_global_files/encrypt_decrypt.php';
include '../admin_global_files/input_sanitizing.php';

// Encryption key (to be changed later)
$key = "TheGreatestNumberIs73";

// Connect to the accounts database
$connect_db = mysqli_connect('localhost', 'root', '', "smilesync_accounts");

if (isset($_POST['email'])) {
    // Format of input sanitization
    $firstName = encryptData(sanitize_input($_POST['firstName'], $connect_db), $key);
    $lastName = encryptData(sanitize_input($_POST['lastName'], $connect_db), $key);
    $middleName = encryptData(sanitize_input($_POST['middleName'], $connect_db), $key);
    $suffix = encryptData(sanitize_input($_POST['suffix'], $connect_db), $key);
    $email = encryptData(sanitize_input($_POST['email'], $connect_db), $key);
    $password = sanitize_input($_POST['password'], $connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPassword'], $connect_db);
    $dateOfCreation = date('Y-m-d');
    $accountStatus = 'Pending';
    $birthday = encryptData(sanitize_input($_POST['birthday'], $connect_db), $key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'], $connect_db), $key);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match!")';
        echo '</script>';
        exit();
    }

    // Hash the password using Argon2
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $password = password_hash($password, PASSWORD_ARGON2I, $options);

    // Insert admin account data
    //INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, `admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`, `date_of_creation`, `account_status`, `admin_birthdate`, `admin_phone`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')
    $qryInsertAdminAccount = "INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, `admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`, `date_of_creation`, `account_status`, `admin_birthdate`, `admin_phone`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $conInsertAdminAccount = mysqli_prepare($connect_db, $qryInsertAdminAccount);
    mysqli_stmt_bind_param($conInsertAdminAccount, 'ssssssssss', $firstName, $lastName, $middleName, $suffix, $email, $password, $dateOfCreation, $accountStatus, $birthday, $phoneNumber);
    mysqli_stmt_execute($conInsertAdminAccount);
    // Execute and handle errors
    if (!mysqli_stmt_execute($conInsertAdminAccount)) {
        echo 'Error: ' . mysqli_stmt_error($conInsertAdminAccount);
    }

    unset($_POST['email']);
    mysqli_close($connect_db);
}

if (isset($_POST['superAdminRegister'])) {
    // Format of input sanitization
    $email = encryptData(sanitize_input($_POST['email'], $connect_db), $key);
    $password = sanitize_input($_POST['password'], $connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPassword'], $connect_db);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match!")';
        echo '</script>';
        exit();
    }

    // Hash the password using Argon2
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $password = password_hash($password, PASSWORD_ARGON2I, $options);

    // Insert super admin account data
    $qryInsertSuperAdminAccount = "INSERT INTO `smilesync_super_admin_accounts`(`super_admin_account_id`, `admin_email`, `admin_password`) VALUES (NULL, ?, ?)";
    $conInsertSuperAdminAccount = mysqli_prepare($connect_db, $qryInsertSuperAdminAccount);
    mysqli_stmt_bind_param($conInsertSuperAdminAccount, 'ss', $email, $password);

    // Execute and handle errors
    if (!mysqli_stmt_execute($conInsertSuperAdminAccount)) {
        echo 'Error: ' . mysqli_stmt_error($conInsertSuperAdminAccount);
    }

    unset($_POST['superAdminRegister']);
    mysqli_close($connect_db);
}
?>
