<?php
$connect_appointment = connect_appointment($servername,$username,$password);

$serviceQuery = "SELECT service_name, service_id FROM smilesync_services";
$servicePrepare  = mysqli_prepare($connect_appointment,$serviceQuery);
mysqli_stmt_execute($servicePrepare);
$arrayService = mysqli_stmt_get_result($servicePrepare);

foreach($arrayService as $services){
$service_id = $services['service_id'] ?? " ";
$service_name = $services['service_name'] ?? " ";
?> 
    <option value="<?php echo $service_id;?>"><?php echo $service_name;?></option>

<?php }?>