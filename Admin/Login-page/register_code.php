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

if (isset($_POST['adminRegister'])) {
    // format of input sanitization = sanitize_input($_POST['username'], $connect_db);
    $firstName = encryptData(sanitize_input($_POST['firstName'],$connect_db),$key);
    $lastName = encryptData(sanitize_input($_POST['lastName'],$connect_db),$key);
    $middleName = encryptData(sanitize_input($_POST['middleName'],$connect_db),$key);
    $suffix = encryptData(sanitize_input($_POST['suffix'],$connect_db),$key);
    $email = encryptData(sanitize_input($_POST['email'],$connect_db),$key);
    $password = sanitize_input($_POST['password'],$connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPassword'],$connect_db);
    $dateOfCreation = date('Y-m-d');
    $accountStatus = 'Pending';

    if($password !== $confirmPassword){
      echo '<script language="javascript">';
      echo 'alert("Passwords do not match!")';
      echo '</script>';
      exit();
    }

    // Hash the password using Argon2
    $options = [
      'memory_cost' => 1 << 17, // 128MB memory cost (default)
      'time_cost' => 4,       // 4 iterations (default)
      'threads' => 3,         // Use 3 threads for processing (default)
    ];
    $password = password_hash($password, PASSWORD_ARGON2I, $options);

    // here is where information of admin is inserted
    $qryInsertAdminAccount = "INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, ` admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`,`date_of_creation`,`account_status`) VALUES (NULL,?,?,?,?,?,?,?,?)";
    $conInsertAdminAccount = mysqli_prepare($connect_db,$qryInsertAdminAccount);
    mysqli_stmt_bind_param($conInsertAdminAccount, 'ssssssss',$firstName,$lastName,$middleName,$suffix,$email,$password,$dateOfCreation,$status);
    mysqli_stmt_execute($conInsertAdminAccount);

    unset($_POST['adminRegister']);
    mysqli_close($connect_db);
  }


if (isset($_POST['superAdminRegister'])) {
  // format of input sanitization = sanitize_input($_POST['username'], $connect_db)
  $email = encryptData(sanitize_input($_POST['email'],$connect_db),$key);
  $password = sanitize_input($_POST['password'],$connect_db);
  $confirmPassword = sanitize_input($_POST['confirmPassword'],$connect_db);

  if($password !== $confirmPassword){
    echo '<script language="javascript">';
    echo 'alert("Passwords do not match!")';
    echo '</script>';
    exit();
  }

  // Hash the password using Argon2
  $options = [
    'memory_cost' => 1 << 17, // 128MB memory cost (default)
    'time_cost' => 4,       // 4 iterations (default)
    'threads' => 3,         // Use 3 threads for processing (default)
  ];
  $password = password_hash($password, PASSWORD_ARGON2I, $options);

  // here is where information of admin is inserted
  $qryInsertSuperAdminAccount = "INSERT INTO `smilesync_super_admin_accounts`(` super_admin_account_id`,`admin_email`, `admin_password`) VALUES (NULL,?,?)";
  $conInsertSuperAdminAccount = mysqli_prepare($connect_db, $qryInsertSuperAdminAccount);
  mysqli_stmt_bind_param($conInsertSuperAdminAccount, 'ss', $email,$password);
  mysqli_stmt_execute($conInsertSuperAdminAccount);

  unset($_POST['superAdminRegister']);
  mysqli_close($connect_db);
}