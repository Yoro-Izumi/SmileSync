<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        $ids = $_POST['ids'];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        
        $query = "DELETE FROM smilesync_inventory_items WHERE item_id IN ($placeholders)";
        $stmt = $conn->prepare($query);
        
        // Bind the values to the placeholders
        $types = str_repeat('i', count($ids));  // 'i' is for integers (item_id)
        $stmt->bind_param($types, ...$ids);
        
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Selected products deleted successfully.']);
        } else {
            echo json_encode(['message' => 'Failed to delete selected products.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['message' => 'No products selected for deletion.']);
    }
}

mysqli_close($conn);
?>
