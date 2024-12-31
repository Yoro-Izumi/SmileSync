<?php
// Start session and set timezone
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../admin_global_files/connect_database.php';
include '../admin_global_files/encrypt_decrypt.php';
include '../admin_global_files/input_sanitizing.php';

// Connect to the accounts database
$connect_db = connect_accounts($servername,$username,$password);

$message = "default"; // For modal

if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['middleName']) && isset($_POST['suffix']) && isset($_POST['emailRegister']) && isset($_POST['passwordRegister']) && isset($_POST['confirmPasswordRegister']) && isset($_POST['birthday']) && isset($_POST['phoneNumber'])) {
    // Sanitize and encrypt input data
    $firstName = encryptData(sanitize_input($_POST['firstName'], $connect_db), $key);
    $lastName = encryptData(sanitize_input($_POST['lastName'], $connect_db), $key);
    $middleName = encryptData(sanitize_input($_POST['middleName'], $connect_db), $key);
    $suffix = encryptData(sanitize_input($_POST['suffix'], $connect_db), $key);
    $email = sanitize_input($_POST['emailRegister'], $connect_db); // Don't encrypt yet
    $password = sanitize_input($_POST['passwordRegister'], $connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPasswordRegister'], $connect_db);
    $accountStatus = 'Pending';
    $birthday = encryptData(sanitize_input($_POST['birthday'], $connect_db), $key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'], $connect_db), $key);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo 'error:Passwords do not match';
        exit();
    }

    // Hash the password using Argon2
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $password = password_hash($password, PASSWORD_ARGON2I, $options);

// Prepare the query to fetch all encrypted emails from the database
$qryCheckEmail = "SELECT `admin_email` FROM `smilesync_admin_accounts`";
$conCheckEmail = mysqli_prepare($connect_db, $qryCheckEmail);
mysqli_stmt_execute($conCheckEmail);
mysqli_stmt_bind_result($conCheckEmail, $encryptedEmail); // Get the encrypted email
$emailExists = false;

// Loop through all the emails and decrypt them
while (mysqli_stmt_fetch($conCheckEmail)) {
    // Decrypt the email from the database
    $decryptedEmail = decryptData($encryptedEmail, $key); // Use your decryption function here

    // Compare decrypted email with the user input email
    if ($decryptedEmail === $email) {
        $emailExists = true;
        break; // Exit the loop if the email is found
    }
}

// Close the statement
mysqli_stmt_close($conCheckEmail);

// Check if the email already exists
if ($emailExists) {
    echo 'error:Email already exists';
    exit(); // Stop if email exists
}

    // Insert admin account data if email does not exist
    $qryInsertAdminAccount = "INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, `admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`, `date_time_of_creation`, `account_status`, `admin_birthdate`, `admin_phone`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp(), ?)";
    $conInsertAdminAccount = mysqli_prepare($connect_db, $qryInsertAdminAccount);
    mysqli_stmt_bind_param($conInsertAdminAccount, 'sssssssss', $firstName, $lastName, $middleName, $suffix, $email, $password, $accountStatus, $birthday, $phoneNumber);

    // Execute and handle errors
    if (!mysqli_stmt_execute($conInsertAdminAccount)) {
        echo 'error';
    } else {
        echo 'success';
    }

    // Clean up
    unset($conInsertAdminAccount);
    unset($_POST['firstName']);
    unset($_POST['lastName']);
    unset($_POST['middleName']);
    unset($_POST['suffix']);
    unset($_POST['email']);
    unset($_POST['password']);
    unset($_POST['confirmPassword']);
    unset($_POST['birthday']);
    unset($_POST['phoneNumber']);
    mysqli_close($connect_db);
    exit();
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
    $qryInsertSuperAdminAccount = "INSERT INTO `smilesync_super_admin_accounts`(`super_admin_account_id`, `super_admin_email`, `super_admin_password`) VALUES (NULL, ?, ?)";
    $conInsertSuperAdminAccount = mysqli_prepare($connect_db, $qryInsertSuperAdminAccount);
    mysqli_stmt_bind_param($conInsertSuperAdminAccount, 'ss', $email, $password);

    // Execute and handle errors
    if (!mysqli_stmt_execute($conInsertSuperAdminAccount)) {
        echo 'Error: ' . mysqli_stmt_error($conInsertSuperAdminAccount);
    }

    unset($_POST['superAdminRegister']);
    mysqli_close($connect_db);
    exit();
}
?>
