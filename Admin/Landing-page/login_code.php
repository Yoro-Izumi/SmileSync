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

// Check if user is already logged in
if (isset($_SESSION['userAdminID'])) {
    header('location:admin_dashboard.php');
    die();
}

$error_message = ""; // Initialize error message variable

if (isset($_POST['login'])) {
    // Sanitize input
    $username = sanitize_input($_POST['username'], $connect_db);
    $password = sanitize_input($_POST['password'], $connect_db);

    // Validate email domain
    if (substr($username, -10) !== '@gmail.com') {
        $error_message = "Please enter a valid email address.";
    } else {
        // Connect to the admin accounts database
        $adminAccountConn = connect_accounts($servername, $username, $password);

        if ($adminAccountConn) {
            // Fetch admin accounts
            $stmt = $adminAccountConn->prepare("SELECT * FROM admin_accounts");
            $stmt->execute();
            $arrayAdminAccount = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $usernameExists = false;
            foreach ($arrayAdminAccount as $adminAccount) {
                if (decryptData($adminAccount['adminEmail'], $key) == $username) {
                    $usernameExists = true;
                    break;
                }
            }

            if (!$usernameExists) {
                $error_message = "Account does not exist."; // Set error message
            } else {
                // Username exists, now check password
                $loggedIn = false;

                foreach ($arrayAdminAccount as $adminAccount) {
                    if (decryptData($adminAccount['admin_email'], $key) == $username && password_verify($password, $adminAccount['admin_password'])) {
                        $_SESSION['userAdminID'] = $adminAccount['admin_id'];
                        $loggedIn = true;
                        break;
                    }
                }

                if ($loggedIn) {
                    echo '<script language="javascript">';
                    echo 'alert("You are now logged in!")';
                    echo '</script>';

                    header("location:admin_dashboard.php");
                    exit();
                } else {
                    $error_message = "Username and Password are mismatched."; // Set error message
                }
            }
        } else {
            $error_message = "Database connection failed."; // Set error message
        }
    }
}
