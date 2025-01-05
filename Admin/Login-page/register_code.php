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
$connect_db = connect_accounts($servername, $username, $password);


if (isset($_POST['firstName'], $_POST['lastName'], $_POST['middleName'], $_POST['suffix'], $_POST['emailRegister'], $_POST['passwordRegister'], $_POST['confirmPasswordRegister'], $_POST['birthday'], $_POST['phoneNumber'])) {

$message = "default"; // For modal

    $firstName = encryptData(sanitize_input($_POST['firstName'], $connect_db), $key);
    $lastName = encryptData(sanitize_input($_POST['lastName'], $connect_db), $key);
    $middleName = encryptData(sanitize_input($_POST['middleName'], $connect_db), $key);
    $suffix = encryptData(sanitize_input($_POST['suffix'], $connect_db), $key);

    $email = sanitize_input($_POST['emailRegister'], $connect_db);
    $password = sanitize_input($_POST['passwordRegister'], $connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPasswordRegister'], $connect_db);

    $birthday = encryptData(sanitize_input($_POST['birthday'], $connect_db), $key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'], $connect_db), $key);
    $accountStatus = 'Pending';

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "error:Passwords do not match";
        exit();
    }

    // Decrypt and check if email already exists
    $qryCheckEmail = "SELECT admin_email FROM smilesync_admin_accounts";
    $result = mysqli_query($connect_db, $qryCheckEmail);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $decryptedEmail = decryptData($row['admin_email'], $key);
            if ($decryptedEmail === $email) {
                echo "error:Email already exists";
                exit();
            }
        }
    }


    // Encrypt email for storage
    $encryptedEmail = encryptData($email, $key);

    // Hash the password using Argon2
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];

    $hashedPassword = password_hash($password, PASSWORD_ARGON2I, $options);


    // Insert admin account data
    $qryInsertAdminAccount = "INSERT INTO smilesync_admin_accounts (admin_first_name, admin_last_name, admin_middle_name, admin_suffix, admin_email, admin_password, account_status, admin_birthdate, admin_phone, date_time_of_creation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
    $stmtInsertAdminAccount = mysqli_prepare($connect_db, $qryInsertAdminAccount);
    mysqli_stmt_bind_param($stmtInsertAdminAccount, 'sssssssss', $firstName, $lastName, $middleName, $suffix, $encryptedEmail, $hashedPassword, $accountStatus, $birthday, $phoneNumber);
    //echo "success";
    if (mysqli_stmt_execute($stmtInsertAdminAccount)) {
        echo "success";
    } else {
        echo "error";
    }

    // Clean up
    mysqli_stmt_close($stmtInsertAdminAccount);
    mysqli_close($connect_db);
    exit();
}

// If required fields are not set
echo "error:Problem with form submission";
exit();
?>
