<?php
// Include necessary files
include '../admin_global_files/connect_database.php';
include '../admin_global_files/input_sanitizing.php';

// Connect to the accounts database
$connect_db = connect_accounts($servername, $username, $password);

// Initialize login attempt limit variables (Disabled)
// $max_attempts = 5;
// $lockout_time = 5 * 60 * 60; // 5 hours in seconds
// $current_time = time();
$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $username = sanitize_input($_POST['email'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Check for super admin accounts
    $stmtSuperAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_super_admin_accounts");
    mysqli_stmt_execute($stmtSuperAdmin);
    $resultSuperAdmin = mysqli_stmt_get_result($stmtSuperAdmin);

    while ($superAdminAccount = mysqli_fetch_assoc($resultSuperAdmin)) {
        if ($superAdminAccount['super_admin_email'] === $username) {
            if ($superAdminAccount['super_admin_password'] === $password) {
                $_SESSION['userSuperAdminID'] = $superAdminAccount['super_admin_account_id'];
                echo '<script>alert("You are now logged in!");</script>';
                header('Location: superadmin_Dashboard.php');
                exit();
            } else {
                $error_message = "Email or Password are mismatched.";
            }
            break;
        }
    }

    // Check for admin accounts
    $stmtAdmin = mysqli_prepare($connect_db, "SELECT * FROM smilesync_admin_accounts");
    mysqli_stmt_execute($stmtAdmin);
    $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

    while ($adminAccount = mysqli_fetch_assoc($resultAdmin)) {
        if ($adminAccount['admin_email'] === $username) {
            if ($adminAccount['admin_password'] === $password) {
                $_SESSION['userAdminID'] = $adminAccount['admin_account_id'];
                echo '<script>alert("You are now logged in!");</script>';
                header('Location: Dashboard.php');
                exit();
            } else {
                $error_message = "Email or Password are mismatched.";
            }
            break;
        }
    }
}

?>