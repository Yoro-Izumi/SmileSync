<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    $query = "SELECT * FROM smilesync_inventory_items WHERE item_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode(['product' => $product]);
    } else {
        echo json_encode(['message' => 'Product not found.']);
    }
    
    $stmt->close();
}

mysqli_close($conn);
?>
