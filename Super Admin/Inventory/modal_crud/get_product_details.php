<?php
include "../../admin_global_files/connect_database.php";
$conn = connect_inventory($servername, $username, $password);

// Set response header for JSON
header('Content-Type: application/json');
//$_POST['id'] = 20;
// Assuming a successful connection to the database
if (isset($_POST['id'])) {
    $itemId = $_POST['id'];
    $query = "
        SELECT 
            `item_id`, 
            `category_id`, 
            `item_name`, 
            `item_description`, 
            `item_quantity`, 
            `item_reorder_level`, 
            `item_unit_price`, 
            `batch_date`, 
            `expiry_date`, 
            `item_status`
        FROM 
            `smilesync_inventory_items`
        WHERE 
            `item_id` = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    echo json_encode($product);
}