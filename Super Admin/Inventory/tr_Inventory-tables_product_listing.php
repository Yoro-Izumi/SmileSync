<?php
$connect_inventory = connect_inventory($servername, $username, $password);

$item_no = 0;
$item_status = "Available";
//get all items alphabetically
$stmtInventoryContent = "SELECT * FROM smilesync_inventory_items WHERE item_quantity >= ? AND item_status = ? ORDER BY item_name ASC";
$prepareInventoryContent = mysqli_prepare($connect_inventory, $stmtInventoryContent);
mysqli_stmt_bind_param($prepareInventoryContent, "is", $item_no, $item_status);
mysqli_stmt_execute($prepareInventoryContent);
$resultInventoryContent = mysqli_stmt_get_result($prepareInventoryContent);

//print content to each row of table
if ($resultInventoryContent) {
    while ($inventoryContent = mysqli_fetch_assoc($resultInventoryContent)) {
?>

        <tr>
            <td><input type="checkbox" value="<?php echo $inventoryContent['item_id']; ?>"></td>
            <td data-label="Product Name"><?php echo $inventoryContent['item_name']; ?></td>
            <td data-label="Product ID"><?php echo $inventoryContent['item_id']; ?></td>
            <td data-label="Price Sold"><?php echo $inventoryContent['item_unit_price']; ?></td>
            <td data-label="Batch Date"><?php echo $inventoryContent['batch_date']; ?></td>
            <td data-label="Expiry Date"><?php echo $inventoryContent['expiry_date']; ?></td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button><i class="fas fa-ellipsis-v"></i></button>
                  <div class="dropdown-content">
                  <a href="#" class="removeProductTable" data-id="<?php echo $inventoryContent['item_id']; ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                  <a href="#" class="viewDetails" data-id="<?php echo $inventoryContent['item_id']; ?>"><i class="fas fa-eye"></i> View Details</a>

                  </div>
                </div>
              </div>
            </td>
        </tr>


<?php 
    }
}
mysqli_close($connect_inventory);
?>
