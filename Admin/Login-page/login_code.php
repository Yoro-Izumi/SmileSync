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
$connect_db = connect_accounts($servername, $username, $password);

// Initialize login attempt limit variables
$max_attempts = 3;
$lockout_time = 5 * 60 * 60; // 5 hours in seconds
$current_time = time();
$error_message = ""; // Initialize error message variable

// Check if both email and password are posted
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Check if CSRF token is valid
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        //exit("Invalid CSRF token. Please refresh the page and try again.");
        echo "error";
        exit();
    }

    // Sanitize input
    $username = sanitize_input($_POST['email'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for super admin accounts
    $stmtSuperAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_super_admin_accounts");
    mysqli_stmt_execute($stmtSuperAdmin);
    $resultSuperAdmin = mysqli_stmt_get_result($stmtSuperAdmin);  

    while ($superAdminAccount = mysqli_fetch_assoc($resultSuperAdmin)) {
        $decryptedEmail = decryptData($superAdminAccount['super_admin_email'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $superAdminAccount['super_admin_account_id'], 'superAdmin', $password, $superAdminAccount['super_admin_password']);
            return; // Stop execution after successful match
        }
    }

    // Check for admin accounts
    $stmtAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_admin_accounts");
    mysqli_stmt_execute($stmtAdmin);
    $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

    while ($adminAccount = mysqli_fetch_assoc($resultAdmin)) {
        $decryptedEmail = decryptData($adminAccount['admin_email'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $adminAccount['admin_account_id'], 'admin', $password, $adminAccount['admin_password']);
            return; // Stop execution after successful match
        }
    }
}

// Function to handle login attempts based on user type
function handle_login_attempts($connect_db, $user_id, $user_type, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time, $error_message;

    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $actions_table = $user_type === 'admin' ? 'smilesync_admin_actions' : 'smilesync_super_admin_actions';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_acccount_id';
    $first_attempt_time = $user_type === 'admin' ? 'admin_first_attempt_time' : 'super_admin_first_attempt';
    $number_of_attempts = $user_type === 'admin' ? 'admin_number_of_attempts' : 'super_admin_number_of_attempts';
    $user_action = $user_type === 'admin' ? 'admin_action' : 'super_admin_action';
    $action_time_stamp = $user_action = $user_type === 'admin' ? 'admin_action_time_stamp' : 'super_admin_action_time_stamp';

    $stmtCheckAttempts = mysqli_prepare($connect_db, "SELECT * FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
    mysqli_stmt_execute($stmtCheckAttempts);
    $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
    $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);

    if ($login_attempt) {
        $time_since_first_attempt = $current_time - strtotime($login_attempt[$first_attempt_time]);

        if ($login_attempt[$number_of_attempts] >= $max_attempts && $time_since_first_attempt <= $lockout_time) {
            $remaining_lockout = ceil(($lockout_time - $time_since_first_attempt) / 60); // Convert to minutes
            die("You have exceeded the maximum login attempts. Please try again after $remaining_lockout minutes.");
        } elseif ($time_since_first_attempt > $lockout_time) {
            // Reset attempts after 5 hours
            reset_attempts($connect_db, $user_id, $user_type);
            
            $stmtRecordAttempt = mysqli_prepare($connect_db, "INSERT INTO `$actions_table`(`$id_column`, `$user_action`, `$action_time_stamp`) VALUES (?,?,current_timestamp())");
            mysqli_stmt_bind_param($stmtRecordAttempt, 'i', $user_id);
            mysqli_stmt_execute($stmtCheckAttempts);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION['userType'] = $user_type;
        $_SESSION[$user_type === 'admin' ? 'userAdminID' : 'userSuperAdminID'] = $user_id;
        reset_attempts($connect_db, $user_id, $user_type);
        header('Location: ' . ($user_type === 'admin' ? '../Dashboard/Dashboard.php' : '..Dashboard/Dashboard.php'));
        exit();
    } else {
        $error_message = "Email or Password are mismatched.";
        increment_attempts($connect_db, $user_id, $user_type);
    }
}

// Function to reset login attempts
function reset_attempts($connect_db, $user_id, $user_type) {
    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_account_id';

    $stmtReset = mysqli_prepare($connect_db, "DELETE FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Function to increment login attempts
function increment_attempts($connect_db, $user_id, $user_type) {
    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_account_id';
    $number_of_attempts = $user_type === 'admin' ? 'admin_number_of_attempts' : 'super_admin_number_of_attempts';
    $first_attempt_time = $user_type === 'admin' ? 'admin_first_attempt_time' : 'super_admin_first_attempt';
    $last_attempt_time = $user_type === 'admin' ? 'admin_last_attempt_time' : 'super_admin_last_attempt';

    $stmtCheck = mysqli_prepare($connect_db, "SELECT * FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        $stmtUpdate = mysqli_prepare($connect_db, "UPDATE $attempts_table SET $number_of_attempts = $number_of_attempts + 1, $last_attempt_time = NOW() WHERE $id_column = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        $stmtInsert = mysqli_prepare($connect_db, "INSERT INTO $attempts_table ($id_column, $number_of_attempts, $first_attempt_time, $last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}
