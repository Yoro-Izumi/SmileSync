<?php
include "../../admin_global_files/set_sesssion_dir.php";

session_start();
date_default_timezone_set('Asia/Manila');
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/encrypt_decrypt.php";
include "../../admin_global_files/input_sanitizing.php";

// Database connections
$connect_appointment = connect_appointment($servername, $username, $password);
if (!$connect_appointment) {
    die("Database connection failed.");
}

$appointmentID = isset($_SESSION['session_appointment_id']) ? intval($_SESSION['session_appointment_id']) : 2;

// Fetch all products
$query = "SELECT `service_id`, `service_name`, `service_description`, `service_duration`, `service_price`, `service_status` FROM `smilesync_services`";
$result = $connect_appointment->query($query);

$procedures = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $procedures[] = [
            'id' => $row['service_id'],
            'service_name' => htmlspecialchars($row['service_name'], ENT_QUOTES),
            'service_duration' => htmlspecialchars($row['service_duration'], ENT_QUOTES),
            'service_price' => htmlspecialchars($row['service_price'], ENT_QUOTES),
        ];
    }
    $result->free();
}

// Generate HTML
foreach ($procedures as $procedure) {
    $id = $procedure['id'];
    $service_name = $procedure['service_name'];
    $selected_service_id = getSelectedService($connect_appointment, $appointmentID);

    $checked = ($id === $selected_service_id) ? 'checked' : '';
    echo '<div class="dropDownItem">
        <input type="checkbox" class="checkBoxProcedure" value="' . $id . '" data-name="' . $service_name . '" name="procedureCheck[]" ' . $checked . ' onclick="disableCheckbox()">
        ' . $service_name . '
    </div>';
}

// Close connections
$connect_appointment->close();

// Fetch consumed products for a specific appointment
function getSelectedService($connect_appointment, $appointmentID) {
    $query = "SELECT sv.service_id FROM `smilesync_invoice_services` sis 
              INNER JOIN smilesync_services sv ON sis.service_id = sv.service_id 
              WHERE appointment_id = ? LIMIT 1";

    $stmt = $connect_appointment->prepare($query);
    if (!$stmt) {
        return 0; // Return 0 if statement preparation fails
    }

    $stmt->bind_param("i", $appointmentID);
    $stmt->execute();
    $result = $stmt->get_result();

    $id = 0; // Initialize the ID
    if ($result && $result->num_rows > 0) {
        $id = $result->fetch_assoc()['service_id'];
    }

    $stmt->close();
    return $id;
}
?>
