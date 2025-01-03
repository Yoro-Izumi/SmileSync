<?php
include '../../admin_global_files/connect_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'fetch_items') {
        $query = "SELECT * FROM smilesync_inventory_items";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($items);
        $stmt->close();
    } elseif ($action === 'add_item') {
        $query = "INSERT INTO smilesync_inventory_items 
                  (category_id, item_name, item_description, item_quantity, item_reorder_level, item_unit_price, batch_date, expiry_date, item_status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'issiidsss', 
            $_POST['category_id'], 
            $_POST['item_name'], 
            $_POST['item_description'], 
            $_POST['item_quantity'], 
            $_POST['item_reorder_level'], 
            $_POST['item_unit_price'], 
            $_POST['batch_date'], 
            $_POST['expiry_date'], 
            $_POST['item_status']
        );
        echo $stmt->execute() ? "success" : "error";
        $stmt->close();
    } elseif ($action === 'update_item') {
        $query = "UPDATE smilesync_inventory_items 
                  SET category_id=?, item_name=?, item_description=?, item_quantity=?, item_reorder_level=?, 
                      item_unit_price=?, batch_date=?, expiry_date=?, item_status=? 
                  WHERE item_id=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'issiidsssi', 
            $_POST['category_id'], 
            $_POST['item_name'], 
            $_POST['item_description'], 
            $_POST['item_quantity'], 
            $_POST['item_reorder_level'], 
            $_POST['item_unit_price'], 
            $_POST['batch_date'], 
            $_POST['expiry_date'], 
            $_POST['item_status'], 
            $_POST['item_id']
        );
        echo $stmt->execute() ? "success" : "error";
        $stmt->close();
    } elseif ($action === 'delete_item') {
        $query = "DELETE FROM smilesync_inventory_items WHERE item_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_POST['item_id']);
        echo $stmt->execute() ? "success" : "error";
        $stmt->close();
    }
}

$conn->close();
?>
