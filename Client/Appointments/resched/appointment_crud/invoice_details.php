<?php
include "../../../client_global_files/set_sesssion_dir.php";
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../../../client_global_files/connect_database.php';
include '../../../client_global_files/encrypt_decrypt.php';
include '../../../client_global_files/input_sanitizing.php';

// fetch_invoices.php
header('Content-Type: application/json');

$conn = connect_appointment($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query with LEFT JOIN
$sql = "
    SELECT 
        i.invoice_id AS id,
        p.patient_last_name AS lastName,
        p.patient_first_name AS firstName,
        p.patient_middle_name AS middleName,
        p.patient_suffix AS suffix,
        DATE_FORMAT(i.invoice_date_time, '%m-%d-%Y') AS date,
        i.invoice_unique_id AS uniqueId,
        i.hmo_verification AS hmoVerification,
        i.amount_due AS amountDue,
        i.amount_paid AS amountPaid,
        i.balance AS balance,
        i.invoice_remarks AS remarks,
        i.request AS request,
        i.invoice_status AS status,
        i.number_of_tooth AS toothCount,
        i.dentist_name_id AS dentistId,
        p.patient_sex AS gender,
        p.patient_phone_number AS phoneNumber,
        p.patient_address AS address,
        p.patient_birthday AS birthday
    FROM smilesync_invoice i
    LEFT JOIN smilesync_patient_management.smilesync_patient_information p
    ON i.patient_info_id = p.patient_info_id
";

$result = $conn->query($sql);

// Check if data is available
if ($result->num_rows > 0) {
    $invoices = [];
    while ($row = $result->fetch_assoc()) {
        // Decrypt patient details
        $lastName = decryptData($row["lastName"], $key);
        $firstName = decryptData($row["firstName"], $key);
        $middleName = !empty($row["middleName"]) ? decryptData($row["middleName"], $key) : '';
        $suffix = !empty($row["suffix"]) ? decryptData($row["suffix"], $key) : '';

        // Construct client name
        $client = $lastName . ', ' . $firstName;
        if ($middleName) {
            $client .= ' ' . $middleName;
        }
        if ($suffix) {
            $client .= ' ' . $suffix;
        }

        // Append invoice data
        $invoices[] = [
            "id" => $row["id"],                         // Invoice ID
            "client" => $client,                        // Decrypted Patient Name
            "date" => $row["date"],                     // Invoice Date
            "uniqueId" => $row["uniqueId"],             // Invoice Unique ID
            "hmoVerification" => $row["hmoVerification"], // HMO Verification
            "amountDue" => $row["amountDue"],           // Amount Due
            "amountPaid" => $row["amountPaid"],         // Amount Paid
            "balance" => $row["balance"],               // Balance
            "remarks" => $row["remarks"],               // Remarks
            "request" => $row["request"],               // Request
            "status" => $row["status"],                 // Invoice Status
            "toothCount" => $row["toothCount"],         // Number of Tooth
            "dentistId" => $row["dentistId"],           // Dentist Name ID
            "gender" => $row["gender"],                 // Patient Gender
            "phoneNumber" => $row["phoneNumber"],       // Patient Phone Number
            "address" => $row["address"],               // Patient Address
            "birthday" => decryptData($row["birthday"], $key), // Decrypted Patient Birthday
        ];
    }
    echo json_encode($invoices);
} else {
    echo json_encode(["message" => "No invoices found"]);
}

// Close the connection
$conn->close();
?>
