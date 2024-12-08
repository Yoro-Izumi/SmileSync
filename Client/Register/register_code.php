<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../client_global_files/connect_database.php';
include '../client_global_files/encrypt_decrypt.php';
include '../client_global_files/input_sanitizing.php';

// Encryption key (to be changed later)
$key = "TheGreatestNumberIs73";

// Connect to the accounts databases
$accountConn = connect_accounts($servername, $username, $password);
// Connect to the patients management database
$patientsConn = connect_patient($servername, $username, $password);
// Connect to the appointments database
$appointmentsConn = connect_patient($servername, $username, $password);


  if (isset($_POST['userRegister'])) {
    // format of input sanitization = sanitize_input($_POST['username'], $connect_db);
    //  initialize all inputted data
    $firstName = encryptData(sanitize_input($_POST['firstName'],$patientsConn),$key);
    $lastName = encryptData(sanitize_input($_POST['lastName'],$patientsConn),$key);
    $middleName = encryptData(sanitize_input($_POST['middleName'],$patientsConn),$key);
    $suffix = encryptData(sanitize_input($_POST['suffix'],$patientsConn),$key);
    $sex = encryptData(sanitize_input($_POST['sex'],$patientsConn),$key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'],$patientsConn),$key);

    //input of covid form
    $bodyTemp = sanitize_input($_POST['bodyTemp'],$appointmentsConn);
    $answerOne = sanitize_input($_POST['answerOne'],$appointmentsConn);
    $answerTwo = sanitize_input($_POST['answerTwo'],$appointmentsConn);
    $answerThree = sanitize_input($_POST['answerThree'],$appointmentsConn);
    $answerFour = sanitize_input($_POST['answerFour'],$appointmentsConn);
    $answerFive = sanitize_input($_POST['answerFive'],$appointmentsConn);
    $answerSix = sanitize_input($_POST['answerSix'],$appointmentsConn);
    $answerSeven = sanitize_input($_POST['answerSeven'],$appointmentsConn);
    $answerEight = sanitize_input($_POST['answerEight'],$appointmentsConn);


    //for the account
    $email = encryptData(sanitize_input($_POST['email'],$accountConn),$key);
    $password = sanitize_input($_POST['password'],$accountConn);
    $confirmPassword = sanitize_input($_POST['confirmPassword'],$accountConn);
    $status = 'Pending';
    $dateOfCreation = date('Y-m-d');

    //for the appointment
    $appointmentDate = sanitize_input($_POST['appointmentDate'],$appointmentsConn);
    $appointmentTime = sanitize_input($_POST['appointmentTime'],$appointmentsConn);
    $appointmentDateTime = $appointmentDate." ".$appointmentTime;
    $appointmentReason = sanitize_input($_POST['appointmentReason'],$appointmentsConn);

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


    //patient information insert starts here

    // SQL query to insert patient information
    $qryInsertPatientInfo = "INSERT INTO `smilesync_patient_information`
                            (`patient_info_id`, `patient_first_name`, `patient_last_name`, `patient_middle_name`, `patient_sufix`, `patient_sex`, `patient_phone_number`, `patient_address`) 
                            VALUES (NULL, ?, ?, ?, ?, ?, ?, NULL)";

    // Prepare the statement
    $conInsertPatientInfo = mysqli_prepare($patientsConn, $qryInsertPatientInfo);

    // Bind the parameters to the prepared statement (6 parameters)
    mysqli_stmt_bind_param($conInsertPatientInfo, "ssssss", $firstName, $lastName, $middleName, $suffix, $sex, $phoneNumber);

    // Execute the prepared statement
    mysqli_stmt_execute($conInsertPatientInfo);



    //get the id of patient info that was inserted
    $patientInfoID = mysqli_insert_id($patientsConn);

    //here is where the patient account is inserted
    $qryInsertPatientAccount = "INSERT INTO `smilesync_patient_accounts`(`patient_account_id`,`patient_account_email`,`patient_id`,`patient_account_password`, `date_of_creation`, `patient_account_status`) VALUES (NULL,?,?,?,?,?)";
    $conInsertPatientAccount = mysqli_prepare($accountConn, $qryInsertPatientAccount);
    mysqli_stmt_bind_param($conInsertPatientAccount, 'sisss', $email,$patientInfoID, $password, $dateOfCreation, $status);
    mysqli_stmt_execute($conInsertPatientAccount);

    //get the id of patient info that was inserted
    $patientAccountID = mysqli_insert_id($accountConn);

    //here is where the covid form values are inserted
    $qryInsertCovidForm = "INSERT INTO `smilesync_covid_form`(`covid_form_id`,`patient_id`,`body_temp`,`question_one`, `question_two`, `question_three`, `question_four`, `question_five`, `question_six`, `question_seven`, `question_eight`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?)";
    $conInsertCovidForm = mysqli_prepare($appointmentsConn, $qryInsertCovidForm);
    mysqli_stmt_bind_param($conInsertCovidForm, 'iissssssss' , $patientAccountID, $bodyTemp, $answerOne, $answerTwo, $answerThree, $answerFour, $answerFive, $answerSix, $answerSeven, $answerEight);
    mysqli_stmt_execute($conInsertCovidForm);

    //get the id of patient info that was inserted
    $covidFormID = mysqli_insert_id($appointmentsConn);


    //$accountConn , $patientsConn, $appointmentsConn
    //here is where the covid form values are inserted
    $qryInsertAppointment = "INSERT INTO `smilesync_appointments`(`appointment_id`,`patient_id`,` staff_id`,`covid_form_id`, `appointment_status`, `appointment_Date_time`, `appointment_reason`) VALUES (NULL,?,NULL,?,?,?,?,?)";
    $conInsertAppointment = mysqli_prepare($appointmentsConn, $qryInsertAppointment);
    mysqli_stmt_bind_param($conInsertAppointment, 'iiisss', $patientInfoID, $covidFormID, $appointmentDateTime, $appointmentReason);
    mysqli_stmt_execute($conInsertCovidForm);

    mysqli_close($patientsConn);
    mysqli_close($accountConn);
    mysqli_close($appointmentsConn);
    unset($_POST['userRegister']);

  } 