<?php
include '../../admin_global_files/connect_database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'fetch_items') {
        $query = "SELECT * FROM smilesync_inventory_items";
        $result = mysqli_query($conn, $query);
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($items);
    } elseif ($action === 'add_item') {
        $category_id = $_POST['category_id'];
        $item_name = $_POST['item_name'];
        $item_description = $_POST['item_description'];
        $item_quantity = $_POST['item_quantity'];
        $item_reorder_level = $_POST['item_reorder_level'];
        $item_unit_price = $_POST['item_unit_price'];
        $batch_date = $_POST['batch_date'];
        $expiry_date = $_POST['expiry_date'];
        $item_status = $_POST['item_status'];

        $query = "INSERT INTO smilesync_inventory_items 
                  (category_id, item_name, item_description, item_quantity, item_reorder_level, item_unit_price, batch_date, expiry_date, item_status) 
                  VALUES ('$category_id', '$item_name', '$item_description', '$item_quantity', '$item_reorder_level', '$item_unit_price', '$batch_date', '$expiry_date', '$item_status')";
        echo mysqli_query($conn, $query) ? "success" : "error";
    } elseif ($action === 'update_item') {
        $item_id = $_POST['item_id'];
        $category_id = $_POST['category_id'];
        $item_name = $_POST['item_name'];
        $item_description = $_POST['item_description'];
        $item_quantity = $_POST['item_quantity'];
        $item_reorder_level = $_POST['item_reorder_level'];
        $item_unit_price = $_POST['item_unit_price'];
        $batch_date = $_POST['batch_date'];
        $expiry_date = $_POST['expiry_date'];
        $item_status = $_POST['item_status'];

        $query = "UPDATE smilesync_inventory_items 
                  SET category_id='$category_id', item_name='$item_name', item_description='$item_description', 
                      item_quantity='$item_quantity', item_reorder_level='$item_reorder_level', 
                      item_unit_price='$item_unit_price', batch_date='$batch_date', 
                      expiry_date='$expiry_date', item_status='$item_status' 
                  WHERE item_id='$item_id'";
        echo mysqli_query($conn, $query) ? "success" : "error";
    } elseif ($action === 'delete_item') {
        $item_id = $_POST['item_id'];
        $query = "DELETE FROM smilesync_inventory_items WHERE item_id='$item_id'";
        echo mysqli_query($conn, $query) ? "success" : "error";
    }
}

mysqli_close($conn);
?>
