<?php
include "../client_global_files/connect_database.php";
$connect_appointment = connect_appointment($servername,$username,$password);

$stmtServices = "SELECT services_name FROM smilesync_services";

?>