<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../global_files/connect_database.php';
include '../global_files/encrypt_decrypt.php';
include '../global_files/input_sanitizing.php';

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
        echo "error";
        exit();
    }

    // Sanitize input
    $username = sanitize_input($_POST['email'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for user accounts
    $stmtUser = mysqli_prepare($connect_db, "SELECT * FROM smilesync_user_accounts");
    mysqli_stmt_execute($stmtUser);
    $resultUser = mysqli_stmt_get_result($stmtUser);

    while ($userAccount = mysqli_fetch_assoc($resultUser)) {
        $decryptedEmail = decryptData($userAccount['user_email'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $userAccount['user_account_id'], 'user', $password, $userAccount['user_password']);
            return; // Stop execution after successful match
        }
    }

    $error_message = "Invalid email or password.";
}

// Function to handle login attempts for user accounts
function handle_login_attempts($connect_db, $user_id, $user_type, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time, $error_message;

    $attempts_table = 'smilesync_user_attempts';
    $id_column = 'user_account_id';
    $first_attempt_time = 'user_first_attempt_time';
    $number_of_attempts = 'user_number_of_attempts';

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
            reset_attempts($connect_db, $user_id);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION['userID'] = $user_id;
        reset_attempts($connect_db, $user_id);
        header('Location: ../Dashboard/UserDashboard.php');
        exit();
    } else {
        $error_message = "Email or Password are mismatched.";
        increment_attempts($connect_db, $user_id);
    }
}

// Function to reset login attempts
function reset_attempts($connect_db, $user_id) {
    $stmtReset = mysqli_prepare($connect_db, "DELETE FROM smilesync_user_attempts WHERE user_account_id = ?");
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Function to increment login attempts
function increment_attempts($connect_db, $user_id) {
    $stmtCheck = mysqli_prepare($connect_db, "SELECT * FROM smilesync_user_attempts WHERE user_account_id = ?");
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        $stmtUpdate = mysqli_prepare($connect_db, "UPDATE smilesync_user_attempts SET user_number_of_attempts = user_number_of_attempts + 1, user_last_attempt_time = NOW() WHERE user_account_id = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        $stmtInsert = mysqli_prepare($connect_db, "INSERT INTO smilesync_user_attempts (user_account_id, user_number_of_attempts, user_first_attempt_time, user_last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}
?>
