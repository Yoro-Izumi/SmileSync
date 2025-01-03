<?php
include '../../admin_global_files/connect_database.php';
$currentDate = date('Y-m-d');
$conn = connect_inventory($servername, $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = isset($_POST['ProductType']) && $_POST['ProductType'] !== "NULL" ? $_POST['ProductType'] : NULL;
    $item_name = isset($_POST['ProductName']) ? $_POST['ProductName'] : "";
    $item_description = isset($_POST['ProductBrand']) ? $_POST['ProductBrand'] : "";
    $item_quantity = isset($_POST['ProductQuantity']) ? $_POST['ProductQuantity'] : 0;
    $item_reorder_level = $item_quantity > 0 ? intval($item_quantity * .2) : 0;
    $item_unit_price = isset($_POST['BuyingPrice']) ? $_POST['BuyingPrice'] : 0.0;
    $batch_date = isset($_POST['BatchDate']) ? date('Y-m-d', strtotime($_POST['BatchDate'])) : $currentDate;
    $expiry_date = isset($_POST['ExpiryDate']) ? date('Y-m-d', strtotime($_POST['ExpiryDate'])) : $currentDate;
    $item_status = "Available";

//            INSERT INTO `smilesync_inventory_items`(`item_id`, `category_id`, `item_name`, `item_description`, `item_quantity`, `item_reorder_level`, `item_unit_price`, `batch_date`, `expiry_date`, `item_status`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]')
    $query = "INSERT INTO smilesync_inventory_items (`item_id`, `category_id`, `item_name`, `item_description`, `item_quantity`, `item_reorder_level`, `item_unit_price`, `batch_date`, `expiry_date`, `item_status`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        'issiidsss',
        $category_id,
        $item_name,
        $item_description,
        $item_quantity,
        $item_reorder_level,
        $item_unit_price,
        $batch_date,
        $expiry_date,
        $item_status
    );

    // Debug parameters
    var_dump($category_id, $item_name, $item_description, $item_quantity, $item_reorder_level, $item_unit_price, $batch_date, $expiry_date, $item_status);

    echo $stmt->execute() ? "success" : "error: " . $stmt->error;
    $stmt->close();
}
