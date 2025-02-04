<?php
include "../../../client_global_files/set_sesssion_dir.php";
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files
include '../../../client_global_files/connect_database.php';
include '../../../client_global_files/encrypt_decrypt.php';
include '../../../client_global_files/input_sanitizing.php';

// Database connections
$connect_appointment = connect_appointment($servername, $username, $password);

$appointmentID = isset($_SESSION['session_appointment_id']) ? $_SESSION['session_appointment_id'] : 2;

// Fetch all products
$query = "SELECT `service_id`, `service_name`, `service_description`, `service_duration`, `service_price`, `service_status` FROM `smilesync_services`";

$result = $connect_appointment->query($query);

$procedures = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $procedures[] = [
            'id' => $row['service_id'],
            'service_name' => htmlspecialchars($row['service_name']), // Escape HTML entities
            'service_duration' => htmlspecialchars($row['service_duration']), // Escape HTML entities
            'service_price' => htmlspecialchars($row['service_price']), // Escape HTML entities
        ];
    }
}

// Generate HTML
foreach ($procedures as $procedure) {
    $id = $procedure['id'];
    $service_name = $procedure['service_name'];
    $selected_service_id = getSelectedService($connect_appointment, $appointmentID);
    $service_duration = $procedure['service_duration'];
    $service_price = $procedure['service_price'];

if ($id === $selected_service_id) {
    echo '<div class="dropDownItem">
        <input type="checkbox" class="checkBoxProcedureApproval" value="' . $id . '" data-name="' . $service_name . '" name="procedureApprovalCheck[]" checked onclick="disableCheckbox()">
        ' . $service_name . '
    </div>';
} else {
    echo '<div class="dropDownItem">
        <input type="checkbox" class="checkBoxProcedureApproval" value="' . $id . '" data-name="' . $service_name . '" name="procedureApprovalCheck[]">
        ' . $service_name . '
    </div>';
}
}

// Close connections
$connect_appointment->close();

// Fetch consumed products for a specific appointment
function getSelectedService($connect_appointment, $appointmentID) {
    $query = "SELECT sv.service_id FROM `smilesync_invoice_services` sis INNER JOIN smilesync_services sv ON sis.service_id = sv.service_id WHERE appointment_id = ?";


    $stmt = $connect_appointment->prepare($query);
    if (!$stmt) {
        return 0; // Return 0 if statement preparation fails
    }

    $stmt->bind_param("i", $appointmentID);
    $stmt->execute();
    $result = $stmt->get_result();

    $quantity = 0;
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['service_id'];
        }
    }

    $stmt->close(); // Close the statement
    return $id;
}
?>

