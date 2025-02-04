<?php
$connect_inventory = connect_inventory($servername, $username, $password);

$item_no = 0;
//get all items alphabetically
$stmtInventoryHistory = "
        SELECT smilesync_inventory_usage.*, 
        smilesync_inventory_items.*, 
        smilesync_accounts.smilesync_admin_accounts.*
        FROM smilesync_inventory_usage
        LEFT JOIN smilesync_inventory_items 
        ON smilesync_inventory_usage.item_id = smilesync_inventory_items.item_id
        LEFT JOIN smilesync_accounts.smilesync_admin_accounts 
        ON smilesync_admin_accounts.admin_account_id = smilesync_inventory_usage.admin_account_id
        WHERE smilesync_inventory_items.item_quantity >= ? 
        ORDER BY smilesync_inventory_items.item_name ASC
";

$prepareInventoryHistory = mysqli_prepare($connect_inventory, $stmtInventoryHistory);
mysqli_stmt_bind_param($prepareInventoryHistory, "i", $item_no);
mysqli_stmt_execute($prepareInventoryHistory);
$resultInventoryHistory = mysqli_stmt_get_result($prepareInventoryHistory);

// Check if the result contains rows
if ($resultInventoryHistory) {
    while ($inventoryHistory = mysqli_fetch_assoc($resultInventoryHistory)) {
      if($inventoryHistory['admin_account_id'] == NULL){ 
        $adminFirstName = $inventoryHistory['admin_first_name'] = "";
        $adminMiddleName = $inventoryHistory['admin_middle_name'] = "";
        $adminLastName = $inventoryHistory['admin_last_name'] = "";

      }
      else{
        $adminFirstName = $inventoryHistory['admin_first_name']?? "";
        $adminFirstName = decryptData($adminFirstName, $key);
        $adminMiddleName = $inventoryHistory['admin_middle_name']?? "";
        $adminMiddleName = decryptData($adminMiddleName, $key);
        $adminLastName = $inventoryHistory['admin_last_name']?? "";
        $adminLastName = decryptData($adminLastName, $key);
      }
      $adminName = $adminFirstName . " " . $adminMiddleName . " " . $adminLastName;
?>

        <tr>
            <td><input type="checkbox" value="<?php echo $inventoryHistory['item_id']; ?>"></td>
            <td data-label="Product Name"><?php echo $inventoryHistory['item_name']; ?></td>
            <td data-label="Product ID"><?php echo $inventoryHistory['item_id']; ?></td>
            <td data-label="Quantity"><?php echo $inventoryHistory['quantity_used']; ?></td>
            <td data-label="Date Used"><?php echo $inventoryHistory['date_of_usage']; ?></td>
            <td data-label="Released By"><?php echo $adminName; ?></td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button><i class="fas fa-ellipsis-v"></i></button>
                  <div class="dropdown-content">
                    <a href="#" id="removeProduct"><i class="fas fa-trash-alt"></i> Delete</a>
                    <a href="#" id="viewDetailsHistory"><i class="fas fa-eye"></i> View Details</a>
                  </div>
                </div>
              </div>
            </td>
    </tr>
<?php 
    } // End of while loop
} // End of if block
mysqli_close($connect_inventory);
?>
