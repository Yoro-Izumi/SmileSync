<?php
include "../../admin_global_files/connect_database.php";
header('Content-Type: application/json');

// Sample database connection
$mysqli = connect_inventory($servername, $username, $password);

if ($mysqli->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $mysqli->real_escape_string($_POST['id']);
    
    $query = "UPDATE smilesync_inventory_items SET item_status = 'Deleted' WHERE item_id = '$id'";
    if ($mysqli->query($query)) {
        echo json_encode(["success" => true, "message" => "Product deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete product."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$mysqli->close();
?>
