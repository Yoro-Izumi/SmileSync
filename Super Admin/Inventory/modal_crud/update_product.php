<?php
include '../../admin_global_files/connect_database.php';
$currentDate = date('Y-m-d');
$conn = connect_inventory($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = isset($_POST['edit_item_id']) ? $_POST['edit_item_id'] : NULL;
    $category_id = isset($_POST['EditProductType']) && $_POST['EditProductType'] !== "NULL" ? $_POST['EditProductType'] : NULL;
    $item_name = isset($_POST['EditProductName']) ? $_POST['EditProductName'] : "";
    $item_description = isset($_POST['EditProductBrand']) ? $_POST['EditProductBrand'] : "";
    $item_quantity = isset($_POST['EditProductQuantity']) ? $_POST['EditProductQuantity'] : 0;
    $item_reorder_level = $item_quantity > 0 ? intval($item_quantity * .2) : 0;
    $item_unit_price = isset($_POST['EditBuyingPrice']) ? $_POST['EditBuyingPrice'] : 0.0;
    $batch_date = isset($_POST['EditBatchDate']) ? date('Y-m-d', strtotime($_POST['EditBatchDate'])) : $currentDate;
    $expiry_date = isset($_POST['EditExpiryDate']) ? date('Y-m-d', strtotime($_POST['EditExpiryDate'])) : $currentDate;
    $item_status = "Available"; // Assuming the status is always "Available" for new or updated items

    // If item_id is provided, update the record, else insert a new one
    if ($item_id) {
        // UPDATE query
        $query = "UPDATE smilesync_inventory_items SET 
                    category_id = ?, 
                    item_name = ?, 
                    item_description = ?, 
                    item_quantity = ?, 
                    item_reorder_level = ?, 
                    item_unit_price = ?, 
                    batch_date = ?, 
                    expiry_date = ?, 
                    item_status = ? 
                  WHERE item_id = ?";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            'issiidsssi',
            $category_id,
            $item_name,
            $item_description,
            $item_quantity,
            $item_reorder_level,
            $item_unit_price,
            $batch_date,
            $expiry_date,
            $item_status,
            $item_id
        );

        echo $stmt->execute() ? "update success" : "error: " . $stmt->error;
        $stmt->close();
    } 
}
?>
