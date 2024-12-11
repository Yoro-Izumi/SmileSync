<?php

include "../admin_global_files/connect_database.php";
include "../admin_global_files/input_sanitizing.php";

// Create a connection
$connect_appointment = connect_appointment($servername, $username, $password);
$patients_db = "smilesync_patient_management";
$approvers_db = "smilesync_accounts";
$user_id = 0; // $_SESSION['userID'];
$patient_id = "";
$_GET['entry_id'] = 0;

// Check connection
if ($connect_appointment->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Fetch the entry_id from the request
if (!isset($_GET['entry_id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing entry_id parameter"]);
    exit;
}

$entry_id = $connect_appointment->real_escape_string($_GET['entry_id']);

// SQL query to get the appointment data
$getAppointmentDetails = "
SELECT 
    ap.*,
    p.*,
    ar.*,
    sr.*
FROM 
    smilesync_invoice_services `is`
LEFT JOIN 
    smilesync_appointments ap ON `is`.appointment_id = ap.appointment_id
LEFT JOIN 
    {$patients_db}.smilesync_patient_information p ON ap.patient_info_id = p.patient_info_id
LEFT JOIN 
    {$approvers_db}.smilesync_admin_accounts ar ON ap.admin_id = ar.admin_account_id
LEFT JOIN 
    smilesync_services sr ON `is`.service_id = sr.service_id
WHERE 
    `is`.service_id = '$entry_id'
ORDER BY 
    ap.appointment_id ASC
";

$result = $connect_appointment->query($getAppointmentDetails);

// Process results
if ($result && $result->num_rows > 0) {
    $appointments = [];
    $seen_appointment_ids = []; // To track unique appointment IDs
    $service_hold = "";

    while ($row = $result->fetch_assoc()) {
        $appointment_id = $row['appointment_id'];

        // Skip duplicate appointment IDs
        if (!in_array($appointment_id, $seen_appointment_ids)) {
            // Mark appointment_id as seen
            $seen_appointment_ids[] = $appointment_id;

            // Collect appointment data
            $appointments[] = $row;
        }

        // Build the service list
        $service_name = $row['service_name'];
        $service_id = $row['service_id'];

        if (strpos($service_hold, $service_id) === false) {
            // Append unique services
            $service_hold .= ($service_hold ? "," : "") . "$service_id/$service_name";
        }
    }

    // Append services to the result for a cleaner output
    $response = [
        "appointments" => $appointments,
        "services" => $service_hold
    ];

    echo json_encode($response);
} else {
    http_response_code(404);
    echo json_encode(["error" => "No data found for the given entry_id"]);
}

// Close the connection
$connect_appointment->close();
?>
