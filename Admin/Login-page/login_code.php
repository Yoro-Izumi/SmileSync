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
if (isset($_SESSION['userSuperAdminID'])) {
    header('location:dashboard.php');
    die();
}
if (isset($_SESSION['userAdminID'])) {
    header('location:admin_dashboard.php');
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

    // Check for super admin accounts
    $stmtSuperAdmin = mysqli_prepare($connect_db, "SELECT * FROM super_admin_accounts");
    mysqli_stmt_execute($stmtSuperAdmin);
    $resultSuperAdmin = mysqli_stmt_get_result($stmtSuperAdmin);

    while ($superAdminAccount = mysqli_fetch_assoc($resultSuperAdmin)) {
        $decryptedEmail = decryptData($superAdminAccount['superAdminEmail'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $superAdminAccount['superAdminID'], 'superAdmin', $password, $superAdminAccount['superAdminPassword']);
            break;
        }
    }

    // Check for admin accounts
    $stmtAdmin = mysqli_prepare($connect_db, "SELECT * FROM admin_accounts");
    mysqli_stmt_execute($stmtAdmin);
    $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

    while ($adminAccount = mysqli_fetch_assoc($resultAdmin)) {
        $decryptedEmail = decryptData($adminAccount['adminEmail'], $key);
        if ($decryptedEmail === $username) {
            handle_login_attempts($connect_db, $adminAccount['adminID'], 'admin', $password, $adminAccount['adminPassword']);
            break;
        }
    }
}

// Function to handle login attempts based on user type
function handle_login_attempts($db_connection, $user_id, $user_type, $password, $stored_password) {
    global $max_attempts, $lockout_time, $current_time, $error_message;

    if ($user_type === 'admin') {
        $stmtCheckAttempts = mysqli_prepare($db_connection, "SELECT * FROM admin_login_attempts WHERE admin_id = ?");
        mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
        mysqli_stmt_execute($stmtCheckAttempts);
        $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
        $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);
    } else {
        $stmtCheckAttempts = mysqli_prepare($db_connection, "SELECT * FROM super_admin_login_attempts WHERE super_admin_id = ?");
        mysqli_stmt_bind_param($stmtCheckAttempts, 'i', $user_id);
        mysqli_stmt_execute($stmtCheckAttempts);
        $resultCheckAttempts = mysqli_stmt_get_result($stmtCheckAttempts);
        $login_attempt = mysqli_fetch_assoc($resultCheckAttempts);
    }

    if ($login_attempt) {
        $time_since_first_attempt = $current_time - strtotime($login_attempt['first_attempt_time']);

        if ($login_attempt['attempts'] >= $max_attempts && $time_since_first_attempt <= $lockout_time) {
            $remaining_lockout = ceil(($lockout_time - $time_since_first_attempt) / 60); // Convert to minutes
            die("You have exceeded the maximum login attempts. Please try again after $remaining_lockout minutes.");
        } elseif ($time_since_first_attempt > $lockout_time) {
            // Reset attempts after 5 hours
            reset_attempts($db_connection, $user_id, $user_type);
        }
    }

    if (password_verify($password, $stored_password)) {
        $_SESSION[$user_type === 'admin' ? 'userAdminID' : 'userSuperAdminID'] = $user_id;
        reset_attempts($db_connection, $user_id, $user_type);
        echo '<script>alert("You are now logged in!");</script>';
        header('Location: ' . ($user_type === 'admin' ? 'admin_dashboard.php' : 'dashboard.php'));
        exit();
    } else {
        $error_message = "Email or Password are mismatched.";
        increment_attempts($db_connection, $user_id, $user_type);
    }
}

// Function to reset login attempts
function reset_attempts($db_connection, $user_id, $user_type) {
    if ($user_type === 'admin') {
        $stmtReset = mysqli_prepare($db_connection, "DELETE FROM admin_login_attempts WHERE admin_id = ?");
    } else {
        $stmtReset = mysqli_prepare($db_connection, "DELETE FROM super_admin_login_attempts WHERE super_admin_id = ?");
    }
    mysqli_stmt_bind_param($stmtReset, 'i', $user_id);
    mysqli_stmt_execute($stmtReset);
}

// Function to increment login attempts
function increment_attempts($db_connection, $user_id, $user_type) {
    if ($user_type === 'admin') {
        $stmtCheck = mysqli_prepare($db_connection, "SELECT * FROM admin_login_attempts WHERE admin_id = ?");
    } else {
        $stmtCheck = mysqli_prepare($db_connection, "SELECT * FROM super_admin_login_attempts WHERE super_admin_id = ?");
    }
    mysqli_stmt_bind_param($stmtCheck, 'i', $user_id);
    mysqli_stmt_execute($stmtCheck);
    $resultCheck = mysqli_stmt_get_result($stmtCheck);
    $attempt = mysqli_fetch_assoc($resultCheck);

    if ($attempt) {
        if ($user_type === 'admin') {
            $stmtUpdate = mysqli_prepare($db_connection, "UPDATE admin_login_attempts SET attempts = attempts + 1, last_attempt_time = NOW() WHERE admin_id = ?");
        } else {
            $stmtUpdate = mysqli_prepare($db_connection, "UPDATE super_admin_login_attempts SET attempts = attempts + 1, last_attempt_time = NOW() WHERE super_admin_id = ?");
        }
        mysqli_stmt_bind_param($stmtUpdate, 'i', $user_id);
        mysqli_stmt_execute($stmtUpdate);
    } else {
        if ($user_type === 'admin') {
            $stmtInsert = mysqli_prepare($db_connection, "INSERT INTO admin_login_attempts (admin_id, attempts, first_attempt_time, last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        } else {
            $stmtInsert = mysqli_prepare($db_connection, "INSERT INTO super_admin_login_attempts (super_admin_id, attempts, first_attempt_time, last_attempt_time) VALUES (?, 1, NOW(), NOW())");
        }
        mysqli_stmt_bind_param($stmtInsert, 'i', $user_id);
        mysqli_stmt_execute($stmtInsert);
    }
}
?>