<?php
include "../../admin_global_files/connect_database.php";
include "../../admin_global_files/input_sanitizing.php";

$connect_appointment = connect_appointment($servername, $username, $password);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $serviceName = isset($_POST['serviceName']) ? sanitize_input($_POST['serviceName'],$connect_appointment) : "";
    $serviceDescription = isset($_POST['serviceDescription']) ?sanitize_input($_POST['serviceDescription'],$connect_appointment) : "";
    $servicePrice = isset($_POST['servicePrice']) ? doubleval(sanitize_input($_POST['servicePrice'],$connect_appointment)) : 0.00;
    $serviceDuration = isset($_POST['serviceTime']) ? intval(sanitize_input($_POST['serviceTime'],$connect_appointment)) : "";
    $serviceStatus = "Available";

                //     INSERT INTO `smilesync_services`(`service_id`, `service_name`, `service_description`, `service_duration`, `service_price`, `service_status`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
    $stmtAddService = "INSERT INTO `smilesync_services`(`service_id`, `service_name`, `service_description`, `service_duration`, `service_price`, `service_status`) VALUES (NULL,?,?,?,?,?)";
    $prepareAddService = mysqli_prepare($connect_appointment, $stmtAddService);
    mysqli_stmt_bind_param($prepareAddService, "ssids", $serviceName, $serviceDescription, $serviceDuration, $servicePrice, $serviceStatus);
    mysqli_stmt_execute($prepareAddService);
    if(mysqli_stmt_affected_rows($prepareAddService) > 0){
        echo "Service added successfully!";
    }
    else{
        echo "Failed to add service!";
    }
    mysqli_stmt_close($prepareAddService);
}
?>