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
if (!$connect_db) {
    error_log("Database connection failed: " . mysqli_connect_error());
    exit("Database connection failed.");
}

// Initialize variables
$max_attempts = 3;
$lockout_time = 5 * 60 * 60; // 5 hours in seconds
$current_time = time();
$error_message = ""; // Initialize error message variable

// Check if both email and password are posted
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Check if CSRF token is valid
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        error_log("CSRF token mismatch: " . $_POST['csrf_token'] . " != " . $_SESSION['csrf_token']);
        echo "Invalid CSRF token.";
        exit();
    }

    // Sanitize input
    $username = sanitize_input($_POST['email'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for super admin accounts
    $stmtSuperAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_super_admin_accounts");
    if ($stmtSuperAdmin) {
        mysqli_stmt_execute($stmtSuperAdmin);
        $resultSuperAdmin = mysqli_stmt_get_result($stmtSuperAdmin);  

        while ($superAdminAccount = mysqli_fetch_assoc($resultSuperAdmin)) {
            $decryptedEmail = decryptData($superAdminAccount['super_admin_email'], $key);
            if ($decryptedEmail === $username) {
                handle_login_attempts($connect_db, $superAdminAccount['super_admin_account_id'], 'superAdmin', $password, $superAdminAccount['super_admin_password']);
                return;
            }
        }
        mysqli_stmt_close($stmtSuperAdmin);
    } else {
        error_log("Failed to prepare super admin query: " . mysqli_error($connect_db));
    }

    // Check for admin accounts
    $stmtAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_admin_accounts");
    if ($stmtAdmin) {
        mysqli_stmt_execute($stmtAdmin);
        $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

        while ($adminAccount = mysqli_fetch_assoc($resultAdmin)) {
            $decryptedEmail = decryptData($adminAccount['admin_email'], $key);
            if ($decryptedEmail === $username) {
                handle_login_attempts($connect_db, $adminAccount['admin_account_id'], 'admin', $password, $adminAccount['admin_password']);
                return;
            }
        }
        mysqli_stmt_close($stmtAdmin);
    } else {
        error_log("Failed to prepare admin query: " . mysqli_error($connect_db));
    }

    // If no matches found
    $error_message = "Email or Password are mismatched.";
}

// Function to handle login attempts
function handle_login_attempts($connect_db, $user_id, $user_type, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time, $error_message;

    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_account_id';
    $first_attempt_time = $user_type === 'admin' ? 'admin_first_attempt_time' : 'super_admin_first_attempt';
    $number_of_attempts = $user_type === 'admin' ? 'admin_number_of_attempts' : 'super_admin_number_of_attempts';

    $stmtCheckAttempts = mysqli_prepare($connect_db, "SELECT * FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
    mysqli_stmt_execute($stmtCheckAttempts);
    $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
    $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);

    if ($login_attempt) {
        $time_since_first_attempt = $current_time - strtotime($login_attempt[$first_attempt_time]);
        if ($login_attempt[$number_of_attempts] >= $max_attempts && $time_since_first_attempt <= $lockout_time) {
            $remaining_lockout = ceil(($lockout_time - $time_since_first_attempt) / 60);
            die("You have exceeded the maximum login attempts. Please try again after $remaining_lockout minutes.");
        } elseif ($time_since_first_attempt > $lockout_time) {
            reset_attempts($connect_db, $user_id, $user_type);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION['userType'] = $user_type;
        $_SESSION[$user_type === 'admin' ? 'userAdminID' : 'userSuperAdminID'] = $user_id;
        reset_attempts($connect_db, $user_id, $user_type);
        header('Location: ' . ($user_type === 'admin' ? '../Dashboard/Dashboard.php' : '../Dashboard/Dashboard.php'));
        exit();
    } else {
        $error_message = "Email or Password are mismatched.";
        increment_attempts($connect_db, $user_id, $user_type);
    }
}

// Reset attempts
function reset_attempts($connect_db, $user_id, $user_type) {
    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_account_id';

    $stmtReset = mysqli_prepare($connect_db, "DELETE FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Increment attempts
function increment_attempts($connect_db, $user_id, $user_type) {
    $attempts_table = $user_type === 'admin' ? 'smilesync_admin_attempts' : 'smilesync_super_admin_attempts';
    $id_column = $user_type === 'admin' ? 'admin_account_id' : 'super_admin_account_id';
    $number_of_attempts = $user_type === 'admin' ? 'admin_number_of_attempts' : 'super_admin_number_of_attempts';

    $stmtCheck = mysqli_prepare($connect_db, "SELECT * FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        $stmtUpdate = mysqli_prepare($connect_db, "UPDATE $attempts_table SET $number_of_attempts = $number_of_attempts + 1 WHERE $id_column = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        $stmtInsert = mysqli_prepare($connect_db, "INSERT INTO $attempts_table ($id_column, $number_of_attempts) VALUES (?, 1)");
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}
?>
