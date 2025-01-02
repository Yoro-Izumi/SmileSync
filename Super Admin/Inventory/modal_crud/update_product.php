<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $productId = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $quantity = $_POST['quantity'];
        $batchDate = $_POST['batch_date'];
        $orderValue = $_POST['order_value'];
        $buyingPrice = $_POST['buying_price'];
        $brand = $_POST['brand'];
        $expiryDate = $_POST['expiry_date'];
        
        $query = "UPDATE smilesync_inventory_items SET 
                  item_name = ?, item_description = ?, item_quantity = ?, batch_date = ?, 
                  item_reorder_level = ?, item_unit_price = ?, item_status = ?, 
                  expiry_date = ? WHERE item_id = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssissdsii', $name, $type, $quantity, $batchDate, $orderValue, 
                         $buyingPrice, $brand, $expiryDate, $productId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Product updated successfully.']);
        } else {
            echo json_encode(['message' => 'Failed to update product.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'Product ID is missing.']);
    }
}

mysqli_close($conn);
?>
