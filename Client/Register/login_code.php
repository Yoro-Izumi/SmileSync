
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

// Check if user is already logged in
if (isset($_SESSION['userID'])) {
    header('location:user_dashboard.php');
    die();
}

// Initialize login attempt limit variables
$max_attempts = 5;
$lockout_time = 5 * 60 * 60; // 5 hours in seconds
$current_time = time();
$error_message = ""; // Initialize error message variable

if (isset($_POST['login'])) {
    // Sanitize input
    $username = sanitize_input($_POST['username'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for user accounts
    $stmtUser = mysqli_prepare($connect_db, "SELECT * FROM smilesync_patient_accounts");
    mysqli_stmt_execute($stmtUser);
    $resultUser = mysqli_stmt_get_result($stmtUser);

    while ($userAccount = mysqli_fetch_assoc($resultUser)) {
        $decryptedEmail = decryptData($userAccount['patient_account_email'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $userAccount['patient_account_id'], $password, $userAccount['patient_account_password']);
            break;
        }
    }
}

// Function to handle login attempts for user accounts
function handle_login_attempts($db_connection, $user_id, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time, $error_message;

    $stmtCheckAttempts = mysqli_prepare($db_connection, "SELECT * FROM smilesync_patient_attempts WHERE patient_account_id = ?");
    mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
    mysqli_stmt_execute($stmtCheckAttempts);
    $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
    $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);

    if ($login_attempt) {
        $time_since_first_attempt = $current_time - strtotime($login_attempt['patient_first_attempt_time']);

        if ($login_attempt['patient_number_of_attempts'] >= $max_attempts && $time_since_first_attempt <= $lockout_time) {
            $remaining_lockout = ceil(($lockout_time - $time_since_first_attempt) / 60); // Convert to minutes
            die("You have exceeded the maximum login attempts. Please try again after $remaining_lockout minutes.");
        } elseif ($time_since_first_attempt > $lockout_time) {
            // Reset attempts after 5 hours
            reset_attempts($db_connection, $user_id);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION['userID'] = $user_id;
        reset_attempts($db_connection, $user_id);
        echo '<script>alert("You are now logged in!");</script>';
        header('Location: user_dashboard.php');
        exit();
    } else {
        $error_message = "Email or Password are mismatched.";
        increment_attempts($db_connection, $user_id);
    }
}

// Function to reset login attempts
function reset_attempts($db_connection, $user_id) {
    $stmtReset = mysqli_prepare($db_connection, "DELETE FROM smilesync_patient_attempts WHERE patient_account_id = ?");
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Function to increment login attempts
function increment_attempts($db_connection, $user_id) {
    $stmtCheck = mysqli_prepare($db_connection, "SELECT * FROM smilesync_patient_attempts WHERE patient_account_id = ?");
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        $stmtUpdate = mysqli_prepare($db_connection, "UPDATE smilesync_patient_attempts SET patient_number_of_attempts = patient_number_of_attempts + 1, patient_first_attempt_time = NOW() WHERE patient_account_id = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        $stmtInsert = mysqli_prepare($db_connection, "INSERT INTO smilesync_patient_attempts (patient_account_id, patient_number_of_attempts, patient_first_attempt_time, patient_last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}
?>