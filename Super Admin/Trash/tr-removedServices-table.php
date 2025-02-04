<?php
$connect_appointment = connect_appointment($servername, $username, $password);

$status = "Unavailable";
//get all items alphabetically
$stmtServices = "SELECT * FROM smilesync_services WHERE service_status = ? ORDER BY service_id ASC";
$prepareServices = mysqli_prepare($connect_appointment, $stmtServices);
mysqli_stmt_bind_param($prepareServices, "i", $status);
mysqli_stmt_execute($prepareServices);
$resultServices = mysqli_stmt_get_result($prepareServices);

//print content to each row of table
if ($resultServices) {
    while ($service = mysqli_fetch_assoc($resultServices)) {
?>
         <tr>
            <td><input type="checkbox" value="<?php echo $service['service_id'];?>"></td>
            <td data-label="Service Name"><?php echo $service['service_name'];?></td>
            <td data-label="Service ID"><?php echo $service['service_id'];?></td>
            <td data-label="Service Price"><?php echo $service['service_price'];?></td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                  <a href="#">Restore</a>
                  <a href="#">Permanent Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>

<?php 
    }
}
mysqli_close($connect_appointment);
?>
