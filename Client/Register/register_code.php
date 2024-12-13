<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../client_global_files/connect_database.php';
include '../client_global_files/encrypt_decrypt.php';
include '../client_global_files/input_sanitizing.php';

// Encryption key (update to a secure key management system in production)
$key = "TheGreatestNumberIs73";

// Connect to the databases
$accountConn = connect_accounts($servername, $username, $password);
$patientsConn = connect_patient($servername, $username, $password);
$appointmentsConn = connect_appointment($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and encrypt input data
    $firstName = encryptData(sanitize_input($_POST['firstName'] ?? "", $patientsConn), $key);
    $lastName = encryptData(sanitize_input($_POST['lastName'] ?? "", $patientsConn), $key);
    $middleName = encryptData(sanitize_input($_POST['middleName'] ?? "", $patientsConn), $key);
    $suffix = encryptData(sanitize_input($_POST['suffix'] ?? "", $patientsConn), $key);
    $sex = encryptData(sanitize_input($_POST['sex'] ?? "", $patientsConn), $key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'] ?? "", $patientsConn), $key);
    $birthday = sanitize_input($_POST['birthday'] ?? date("Y-m-d"), $patientsConn);

    $bodyTemp = sanitize_input($_POST['bodyTemp'] ?? 0, $appointmentsConn);
    $answerOne = sanitize_input($_POST['visited'] === "no" ? $_POST['visited'] : ($_POST['infectedAddress'] ?? ""), $appointmentsConn);
    $answerTwo = sanitize_input($_POST['gathering'] ?? "", $appointmentsConn);
    $answerThree = sanitize_input($_POST['contact'] ?? "", $appointmentsConn);
    $answerFour = sanitize_input($_POST['pui'] ?? "", $appointmentsConn);
    $answerFive = sanitize_input($_POST['pum'] ?? "", $appointmentsConn);
    $answerSix = sanitize_input($_POST['symptoms'] ?? "", $appointmentsConn);
    $answerSeven = sanitize_input($_POST['medical'] ?? "", $appointmentsConn);
    $answerEight = sanitize_input($_POST['emergency'] ?? "", $appointmentsConn);
    $answerNine = sanitize_input($_POST['hmo'] === "no" ? $_POST['hmo'] : ($_POST['hmoID'] ?? ""), $appointmentsConn);

    $email = encryptData(sanitize_input($_POST['email'] ?? "", $accountConn), $key);
    $password = sanitize_input($_POST['password'] ?? "", $accountConn);
    $confirmPassword = sanitize_input($_POST['confirmPassword'] ?? "", $accountConn);
    $status = 'Pending';
    $dateOfCreation = date('Y-m-d');
    $dateTimeOfCreation = date('Y-m-d H:i:s');

    $appointmentDateTime = isset($_POST['time'], $_POST['cal-day']) ?
        sanitize_input($_POST['cal-day'], $appointmentsConn) . " " . sanitize_input($_POST['time'], $appointmentsConn) :
        date('Y-m-d H:i:s');
    $appointmentReason = sanitize_input($_POST['appointmentReason'] ?? "", $appointmentsConn);

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
    $qryInsertPatientInfo = "INSERT INTO `smilesync_patient_information`(`patient_info_id`, `patient_first_name`, `patient_last_name`, `patient_middle_name`, `patient_sufix`, `patient_sex`, `patient_phone_number`, `patient_address`, `patient_birthday`)
                             VALUES (NULL, ?, ?, ?, ?, ?, ?, NULL, ?)";
    $stmt = mysqli_prepare($patientsConn, $qryInsertPatientInfo);
    mysqli_stmt_bind_param($stmt, 'sssssss', $firstName, $lastName, $middleName, $suffix, $sex, $phoneNumber, $birthday);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($patientsConn, "Error inserting patient info");
    }
    $patientInfoID = mysqli_insert_id($patientsConn);

    // Insert patient account
    $qryInsertPatientAccount = "INSERT INTO `smilesync_patient_accounts`(`patient_account_id`, `patient_info_id`, `patient_account_email`, `patient_account_password`, `date_of_creation`, `patient_account_status`)
                               VALUES (NULL, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($accountConn, $qryInsertPatientAccount);
    mysqli_stmt_bind_param($stmt, 'issss', $patientInfoID,$email, $hashedPassword, $dateOfCreation, $status);

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
                             VALUES (NULL, ?, NULL, ?, ?, ?, ?, NULL)";
    $stmt = mysqli_prepare($appointmentsConn, $qryInsertAppointment);
    mysqli_stmt_bind_param($stmt, 'iisss', $patientInfoID, $covidFormID, $status, $appointmentDateTime, $appointmentReason);

    if (!mysqli_stmt_execute($stmt)) {
        handleError($appointmentsConn, "Error inserting appointment");
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
