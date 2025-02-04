<?php
include "../../admin_global_files/connect_database.php";
$conn = connect_inventory($servername, $username, $password);

// Set response header for JSON
header('Content-Type: application/json');

// Check if 'id' is provided in the POST request
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['error' => 'No item ID provided.']);
    exit;
}

$itemId = intval($_POST['id']);

// Prepare the main query
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
if (!$stmt) {
    echo json_encode(['error' => 'Failed to prepare statement.']);
    exit;
}
$stmt->bind_param("i", $itemId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the item exists
if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Item not found.']);
    exit;
}

$product = $result->fetch_assoc();

// Get the remaining quantity
$qryGetRemainingQuantity = "SELECT SUM(quantity_used) AS total_used FROM smilesync_inventory_usage WHERE item_id = ?";
$stmtGetRemainingQuantity = $conn->prepare($qryGetRemainingQuantity);
if (!$stmtGetRemainingQuantity) {
    echo json_encode(['error' => 'Failed to prepare quantity query.']);
    exit;
}

$stmtGetRemainingQuantity->bind_param("i", $product['item_id']);
$stmtGetRemainingQuantity->execute();
$resultGetRemainingQuantity = $stmtGetRemainingQuantity->get_result();

// Calculate remaining quantity
$remainingQuantity = $resultGetRemainingQuantity->fetch_assoc();
$product['remaining_quantity'] = $product['item_quantity'] - ($remainingQuantity['total_used'] ?? 0);

// Output the product data as JSON
echo json_encode($product, JSON_PRETTY_PRINT);

exit;
?>
