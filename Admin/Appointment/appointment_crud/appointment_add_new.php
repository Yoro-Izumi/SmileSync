<?php
include "../../admin_global_files/set_sesssion_dir.php";
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../../admin_global_files/connect_database.php';
include '../../admin_global_files/encrypt_decrypt.php';
include '../../admin_global_files/input_sanitizing.php';

$adminID = $_SESSION['userAdminID'];

// Connect to the databases
$accountConn = connect_accounts($servername, $username, $password);
$patientsConn = connect_patient($servername, $username, $password);
$appointmentsConn = connect_appointment($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Sanitize and encrypt input data
$firstName = isset($_POST['firstName']) ? encryptData(sanitize_input($_POST['firstName'], $patientsConn), $key) : "";
$lastName = isset($_POST['lastName']) ? encryptData(sanitize_input($_POST['lastName'], $patientsConn), $key) : "";
$middleName = isset($_POST['middleName']) ? encryptData(sanitize_input($_POST['middleName'], $patientsConn), $key) : "";
$suffix = isset($_POST['suffix']) ? encryptData(sanitize_input($_POST['suffix'], $patientsConn), $key) : "";
$sex = isset($_POST['sex']) ? encryptData(sanitize_input($_POST['sex'], $patientsConn), $key) : "";
$phoneNumber = isset($_POST['phoneNumber']) ? encryptData(sanitize_input($_POST['phoneNumber'], $patientsConn), $key) : "";
$birthday = isset($_POST['birthday']) ? encryptData(sanitize_input($_POST['birthday'], $patientsConn),$key) : encryptData(date("Y-m-d"),$key);

$bodyTemp = isset($_POST['bodyTemp']) ? sanitize_input($_POST['bodyTemp'], $appointmentsConn) : 0;
$answerOne = isset($_POST['visited']) && $_POST['visited'] === "no" ? sanitize_input($_POST['visited'], $appointmentsConn) : (isset($_POST['infectedAddress']) ? sanitize_input($_POST['infectedAddress'], $appointmentsConn) : "");
$answerTwo = isset($_POST['gathering']) ? sanitize_input($_POST['gathering'], $appointmentsConn) : "";
$answerThree = isset($_POST['contact']) ? sanitize_input($_POST['contact'], $appointmentsConn) : "";
$answerFour = isset($_POST['pui']) ? sanitize_input($_POST['pui'], $appointmentsConn) : "";
$answerFive = isset($_POST['pum']) ? sanitize_input($_POST['pum'], $appointmentsConn) : "";
$answerSix = isset($_POST['symptoms']) ? sanitize_input($_POST['symptoms'], $appointmentsConn) : "";
$answerSeven = isset($_POST['medical']) ? sanitize_input($_POST['medical'], $appointmentsConn) : "";
$answerEight = isset($_POST['emergency']) ? sanitize_input($_POST['emergency'], $appointmentsConn) : "";
$answerNine = isset($_POST['hmo']) && $_POST['hmo'] === "no" ? sanitize_input($_POST['hmo'], $appointmentsConn) : (isset($_POST['hmoID']) ? sanitize_input($_POST['hmoID'], $appointmentsConn) : "");

$email = isset($_POST['email']) ? encryptData(sanitize_input($_POST['email'], $accountConn), $key) : "";
$password = isset($_POST['password']) ? sanitize_input($_POST['password'], $accountConn) : "";
$confirmPassword = isset($_POST['confirmPassword']) ? sanitize_input($_POST['confirmPassword'], $accountConn) : "";
$status = 'Approved';
$dateOfCreation = date('Y-m-d');
$dateTimeOfCreation = date('Y-m-d H:i:s');

$appointmentDateTime = isset($_POST['time'], $_POST['cal-day']) ? 
    sanitize_input($_POST['cal-day'], $appointmentsConn) . " " . sanitize_input($_POST['time'], $appointmentsConn) : 
    date('Y-m-d H:i:s');
$appointmentReason = isset($_POST['services']) ? sanitize_input($_POST['services'], $appointmentsConn) : "";


    // Password confirmation validation
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!")</script>';
        exit();
    }

    // Password hashing with Argon2i
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $hashedPassword = password_hash($password, PASSWORD_ARGON2I, $options);

    // Insert patient information
    $qryInsertPatientInfo = "INSERT INTO `smilesync_patient_information`(`patient_info_id`, `patient_first_name`, `patient_last_name`, `patient_middle_name`, `patient_suffix`, `patient_sex`, `patient_phone_number`, `patient_address`, `patient_birthday`)
                             VALUES (NULL, ?, ?, ?, ?, ?, ?, NULL, ?)";
    $stmt = mysqli_prepare($patientsConn, $qryInsertPatientInfo);
    mysqli_stmt_bind_param($stmt, 'sssssss', $firstName, $lastName, $middleName, $suffix, $sex, $phoneNumber, $birthday);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($patientsConn, "Error inserting patient info");
    }
    $patientInfoID = mysqli_insert_id($patientsConn);

    // Insert patient account
    $qryInsertPatientAccount = "INSERT INTO `smilesync_patient_accounts`(`patient_account_id`, `patient_info_id`,`admin_account_id`, `patient_account_email`, `patient_account_password`, `date_time_of_creation`,  `patient_account_status`)
                               VALUES (NULL, ?,?, ?, ?,current_timestamp(), ?)";
    $stmt = mysqli_prepare($accountConn, $qryInsertPatientAccount);
    mysqli_stmt_bind_param($stmt, 'iisss', $patientInfoID,$adminID,$email, $hashedPassword, $status);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($accountConn, "Error inserting patient account");
    }

    $patientAccountID = mysqli_insert_id($accountConn);

    // Insert COVID form
    $qryInsertCovidForm = "INSERT INTO `smilesync_covid_form`(`covid_form_id`, `patient_info_id`, `body_temp`, `question_one`, `question_two`, `question_three`, `question_four`, `question_five`, `question_six`, `question_seven`, `question_eight`, `question_nine`, `covid_form_datetime`)
                          VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($appointmentsConn, $qryInsertCovidForm);
    mysqli_stmt_bind_param($stmt, 'idssssssssss', $patientInfoID, $bodyTemp, $answerOne, $answerTwo, $answerThree, $answerFour, $answerFive, $answerSix, $answerSeven, $answerEight, $answerNine, $dateTimeOfCreation);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($appointmentsConn, "Error inserting COVID form");
    }
    $covidFormID = mysqli_insert_id($appointmentsConn);

    // Insert appointment
    $qryInsertAppointment = "INSERT INTO `smilesync_appointments`(`appointment_id`, `patient_info_id`, `admin_id`, `covid_form_id`, `appointment_status`, `appointment_date_time`, `appointment_reason`, `emergency_contact_id`)
                             VALUES (NULL, ?, ?, ?, ?, ?, ?, NULL)";
    $stmt = mysqli_prepare($appointmentsConn, $qryInsertAppointment);
    mysqli_stmt_bind_param($stmt, 'iiisss', $patientInfoID, $adminID,$covidFormID, $status, $appointmentDateTime, $appointmentReason);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($appointmentsConn, "Error inserting appointment");
    }

    $appointmentID = mysqli_insert_id($appointmentsConn);

    //INSERT INTO `smilesync_invoice_services`(`invoice_services_id`, `invoice_id`, `service_id`, `appointment_id`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
    $qryInsertInvoiceService = "INSERT INTO `smilesync_invoice_services`(`invoice_services_id`, `invoice_id`, `service_id`, `appointment_id`) VALUES (NULL,NULL,?,?)";
    $stmt = mysqli_prepare($appointmentsConn,$qryInsertInvoiceService);
    mysqli_stmt_bind_param($stmt, 'ii' , $appointmentReason,$appointmentID);
    
    if (!mysqli_stmt_execute($stmt)) {
        handleError($appointmentsConn, "Error inserting invoice service");
    }


    // Close connections
    mysqli_close($patientsConn);
    mysqli_close($accountConn);
    mysqli_close($appointmentsConn);

    echo '<script>alert("Registration successful!")</script>';
}

/**
 * Handles errors by outputting a message and exiting the script
 * @param mysqli $connection
 * @param string $message
 */
function handleError($connection, $message) {
    echo $message . ": " . mysqli_error($connection);
    mysqli_close($connection);
    exit();
}
?>
