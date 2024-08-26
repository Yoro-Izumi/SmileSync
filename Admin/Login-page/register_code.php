<?php
  if (isset($_POST['firstName'])) {
    $firstName = encryptData(mysqli_real_escape_string($conn, $_POST['firstName']), $key);
    $lastName = encryptData(mysqli_real_escape_string($conn, $_POST['lastName']), $key);
    $middleName = encryptData(mysqli_real_escape_string($conn, $_POST['middleName']), $key);
    $suffix = encryptData(mysqli_real_escape_string($conn, $_POST['suffix']), $key);
    $email = encryptData(mysqli_real_escape_string($conn, $_POST['email']), $key);
    $username = encryptData(mysqli_real_escape_string($conn, $_POST['username']), $key);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $adminSex = encryptData(mysqli_real_escape_string($conn, $_POST['adminSex']), $key);
    $contactNumber = encryptData(mysqli_real_escape_string($conn, $_POST['contactNumber']), $key);

    // Hash the password using Argon2
    $options = [
      'memory_cost' => 1 << 17, // 128MB memory cost (default)
      'time_cost' => 4,       // 4 iterations (default)
      'threads' => 3,         // Use 3 threads for processing (default)
    ];
    $hashedPassword = password_hash($password, PASSWORD_ARGON2I, $options);

    // here is where information of admin is inserted
    $qryInsertAdminInfo = "INSERT INTO `admin_info`(`adminInfoID`, `admame`, `adminFirstName`, `adminMiddleName`, `adminSex`, `adminContactNumber`, `adminEmail`) VALUES (NULL,?,?,?,?,?,?)";
    $conInsertAdminInfo = mysqli_prepare($conn, $qryInsertAdminInfo);
    mysqli_stmt_bind_param($conInsertAdminInfo, 'ssssss', $lastName, $firstName, $middleName, $adminSex, $contactNumber, $email);
    mysqli_stmt_execute($conInsertAdminInfo);

    //get the id of admin info that was inserted
    $adminInfoID = mysqli_insert_id($conn);

    //here is where the admin account is inserted
    $qryInsertAdminAccount = "INSERT INTO `admin_accounts`(`admin_accounts_id`, `adminInfoID`,`adminShiftID`, `adminUsername`, `adminPassword`) VALUES (NULL,?,?,?,?,?)";
    $conInsertAdminAccount = mysqli_prepare($conn, $qryInsertAdminAccount);
    mysqli_stmt_bind_param($conInsertAdminAccount, 'iiiss', $superAdminID, $adminInfoID, $shift, $username, $hashedPassword);
    mysqli_stmt_execute($conInsertAdminAccount);

    //sendAdminEmail($email,$username,$password,$key);
    
    unset($_POST['firstName']);
  }