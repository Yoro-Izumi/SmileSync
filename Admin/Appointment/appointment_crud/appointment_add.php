<?php
// Start session and set timezone
include "../../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../../admin_global_files/connect_database.php';
include '../../admin_global_files/encrypt_decrypt.php';
include '../../admin_global_files/input_sanitizing.php';

// Connect to the database
$appointmentsConn = connect_appointment($servername, $username, $password);
if (!$appointmentsConn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$accountsConn = connect_accounts($servername,$username,$password);
if (!$accountsConn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $bodyTemp = sanitize_input($_POST['bodyTemp'] ?? 0, $appointmentsConn);
    $answerOne = sanitize_input(
        isset($_POST['visited']) && $_POST['visited'] === "no" 
        ? $_POST['visited'] 
        : ($_POST['infectedAddress'] ?? ""),
        $appointmentsConn
    );
    $answerTwo = sanitize_input($_POST['gathering'] ?? "", $appointmentsConn);
    $answerThree = sanitize_input($_POST['contact'] ?? "", $appointmentsConn);
    $answerFour = sanitize_input($_POST['pui'] ?? "", $appointmentsConn);
    $answerFive = sanitize_input($_POST['pum'] ?? "", $appointmentsConn);
    $answerSix = sanitize_input($_POST['symptoms'] ?? "", $appointmentsConn);
    $answerSeven = sanitize_input($_POST['medical'] ?? "", $appointmentsConn);
    $answerEight = sanitize_input($_POST['emergency'] ?? "", $appointmentsConn);
    $answerNine = sanitize_input(
        isset($_POST['hmo']) && $_POST['hmo'] === "no" 
        ? $_POST['hmo'] 
        : ($_POST['hmoID'] ?? ""),
        $appointmentsConn
    );

    $status = 'Pending';
    $dateTimeOfCreation = date('Y-m-d H:i:s');
    $calDay = isset($_POST['cal-day']) && !empty($_POST['cal-day']) 
        ? sanitize_input($_POST['cal-day'], $appointmentsConn) 
        : date('Y-m-d');
    $time = isset($_POST['time']) && !empty($_POST['time']) 
        ? sanitize_input($_POST['time'], $appointmentsConn) 
        : date('H:i:s');

    $appointmentDateTime = $calDay . " " . $time;
    $appointmentReason = sanitize_input($_POST['services'] ?? "", $appointmentsConn);

    // Determine patientInfoID based on session
    $patientID = isset($_POST['patientName']) ? $_SESSION['patientName'] : null;

    if ($patientID !== null) {
        $qryGetPatientInfoID = "SELECT patient_info_id FROM `smilesync_patient_accounts` WHERE patient_account_id = ?";
        $stmt = mysqli_prepare($accountsConn, $qryGetPatientInfoID);
        mysqli_stmt_bind_param($stmt, 'i', $patientID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $patientInfoID);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        handleError($appointmentsConn, "Session expired or user not logged in.");
    }

    $patientInfoID = $patientInfoID ?? null;

    // Insert COVID form
    $qryInsertCovidForm = "INSERT INTO `smilesync_covid_form`(`covid_form_id`, `patient_info_id`, `body_temp`, `question_one`, `question_two`, `question_three`, `question_four`, `question_five`, `question_six`, `question_seven`, `question_eight`, `question_nine`, `covid_form_datetime`)
                          VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($appointmentsConn, $qryInsertCovidForm);
    mysqli_stmt_bind_param($stmt, 'idssssssssss', $patientInfoID, $bodyTemp, $answerOne, $answerTwo, $answerThree, $answerFour, $answerFive, $answerSix, $answerSeven, $answerEight, $answerNine, $dateTimeOfCreation);

    if (!mysqli_stmt_execute($stmt)) {
        logError($appointmentsConn, $qryInsertCovidForm);
        handleError($appointmentsConn, "Error inserting COVID form.");
    }
    $covidFormID = mysqli_insert_id($appointmentsConn);

    // Insert appointment
    $qryInsertAppointment = "INSERT INTO `smilesync_appointments`(`appointment_id`, `patient_info_id`, `admin_id`, `covid_form_id`, `appointment_status`, `appointment_date_time`, `appointment_reason`, `emergency_contact_id`)
                             VALUES (NULL, ?, NULL, ?, ?, ?, ?, NULL)";
    $stmt = mysqli_prepare($appointmentsConn, $qryInsertAppointment);
    mysqli_stmt_bind_param($stmt, 'iisss', $patientInfoID, $covidFormID, $status, $appointmentDateTime, $appointmentReason);

    if (!mysqli_stmt_execute($stmt)) {
        logError($appointmentsConn, $qryInsertAppointment);
        handleError($appointmentsConn, "Error inserting appointment.");
    }

    // Close connections
    mysqli_close($appointmentsConn);

    echo '<script>alert("Appointment successfully created!")</script>';
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

/**
 * Logs detailed error information to a log file
 * @param mysqli $connection
 * @param string $query
 */
function logError($connection, $query) {
    error_log("SQL Error: " . mysqli_error($connection));
    error_log("Query: " . $query);
}
?>
