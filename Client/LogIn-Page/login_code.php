<?php
// Start session and set timezone
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../client_global_files/connect_database.php';
include '../client_global_files/encrypt_decrypt.php';
include '../client_global_files/input_sanitizing.php';


// Connect to the accounts database
$connect_db = connect_accounts($servername, $username, $password);

// Initialize login attempt limit variables
$max_attempts = 3;
$lockout_time = 5 * 60 * 60; // 5 hours in seconds
$current_time = time();
$response = []; // Initialize response array

header('Content-Type: application/json'); // Set response header to JSON

// Check if both email and password are posted
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Check if CSRF token is valid
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid CSRF token.'
        ];
        echo json_encode($response);
        exit();
    }

    // Sanitize input
    $username = sanitize_input($_POST['email'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for user accounts
    $stmtUser = mysqli_prepare($connect_db, "SELECT * FROM smilesync_patient_accounts");
    mysqli_stmt_execute($stmtUser);
    $resultUser = mysqli_stmt_get_result($stmtUser);

    $user_found = false;
    while ($userAccount = mysqli_fetch_assoc($resultUser)) {
        $decryptedEmail = decryptData($userAccount['patient_account_email'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts(
                $connect_db, 
                $userAccount['patient_account_id'], 
                $password, 
                $userAccount['patient_account_password']
            );
            $user_found = true;
            break;
        }
    }

    if (!$user_found) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid email or password.'
        ];
        echo json_encode($response);
    }
} else {
    // Handle missing email or password
    $response = [
        'status' => 'error',
        'message' => 'Email and password are required.'
    ];
    echo json_encode($response);
}

// Function to handle login attempts for user accounts
function handle_login_attempts($connect_db, $user_id, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time;

    $attempts_table = 'smilesync_patient_attempts';
    $id_column = 'patient_account_id';
    $first_attempt_time = 'patient_first_attempt_time';
    $number_of_attempts = 'patient_number_of_attempts';

    $stmtCheckAttempts = mysqli_prepare($connect_db, "SELECT * FROM $attempts_table WHERE $id_column = ?");
    mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
    mysqli_stmt_execute($stmtCheckAttempts);
    $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
    $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);

    if ($login_attempt) {
        $time_since_first_attempt = $current_time - strtotime($login_attempt[$first_attempt_time]);

        if ($login_attempt[$number_of_attempts] >= $max_attempts && $time_since_first_attempt <= $lockout_time) {
            $remaining_lockout = ceil(($lockout_time - $time_since_first_attempt) / 60); // Convert to minutes
            $response = [
                'status' => 'error',
                'message' => "You have exceeded the maximum login attempts. Please try again after $remaining_lockout minutes."
            ];
            echo json_encode($response);
            exit();
        } elseif ($time_since_first_attempt > $lockout_time) {
            reset_attempts($connect_db, $user_id);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION['userID'] = $user_id;
        reset_attempts($connect_db, $user_id);
        $response = [
            'status' => 'success',
            'message' => 'Login successful.',
            'redirect' => '../Dashboard/UserDashboard.php' // Redirect URL
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid email or password.'
        ];
        increment_attempts($connect_db, $user_id);
        echo json_encode($response);
    }
}

// Function to reset login attempts
function reset_attempts($connect_db, $user_id) {
    $stmtReset = mysqli_prepare($connect_db, "DELETE FROM smilesync_patient_attempts WHERE patient_account_id = ?");
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Function to increment login attempts
function increment_attempts($connect_db, $user_id) {
    $stmtCheck = mysqli_prepare($connect_db, "SELECT * FROM smilesync_patient_attempts WHERE patient_account_id = ?");
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        $stmtUpdate = mysqli_prepare($connect_db, "UPDATE smilesync_patient_attempts SET patient_number_of_attempts = patient_number_of_attempts + 1, patient_last_attempt_time = NOW() WHERE patient_account_id = ?");
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        $stmtInsert = mysqli_prepare($connect_db, "INSERT INTO smilesync_patient_attempts (patient_account_id, patient_number_of_attempts, patient_first_attempt_time, patient_last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
