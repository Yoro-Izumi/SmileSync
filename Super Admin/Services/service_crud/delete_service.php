<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = isset($_POST['id']) ? intval(sanitize_input($_POST['id'], $connect_appointment)) : null;
    $serviceName = isset($_POST['editServiceName']) ? sanitize_input($_POST['editServiceName'], $connect_appointment) : "";
    $serviceDescription = isset($_POST['editServiceDescription']) ? sanitize_input($_POST['editServiceDescription'], $connect_appointment) : "";
    $servicePrice = isset($_POST['editServicePrice']) ? doubleval(sanitize_input($_POST['editServicePrice'], $connect_appointment)) : 0.00;
    $serviceDuration = isset($_POST['editServiceTime']) ? intval(sanitize_input($_POST['editServiceTime'], $connect_appointment)) : "";
    $serviceStatus = "Unavailable";

        // Update an existing service
        $stmtUpdateService = "
            UPDATE `smilesync_services` 
            SET `service_status` = ? 
            WHERE `service_id` = ?";
        $prepareUpdateService = mysqli_prepare($connect_appointment, $stmtUpdateService);
        mysqli_stmt_bind_param($prepareUpdateService, "si", $serviceStatus, $serviceId);
        mysqli_stmt_execute($prepareUpdateService);

        if (mysqli_stmt_affected_rows($prepareUpdateService) > 0) {
            echo "Service updated successfully!";
        } else {
            echo "Failed to update service!";
        }
        mysqli_stmt_close($prepareUpdateService);

}
?>
