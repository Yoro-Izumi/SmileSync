<?php
session_start();
date_default_timezone_set('Asia/Manila');

//include necessary file
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";

//set up database connection to inventory
$connect_inventory = connect_inventory($servername, $username, $password);

if(isset($_POST['adminUserID']) && isset($_POST['inventory_add_value'])){
    $adminUserID = sanitize_input($_POST['adminUserID'], $connect_inventory);
    $inventory_id = sanitize_input($_POST['inventory_id'], $connect_inventory);
    $inventory_name = sanitize_input($_POST['inventory_name'], $connect_inventory);
    $inventory_quantity = sanitize_input($_POST['inventory_quantity'], $connect_inventory);
    $inventory_price =  doubleval(sanitize_input($_POST['inventory_price'],$connect_inventory));
    $inventory_description = sanitize_input($_POST['inventory_description'],$connect_inventory);
    $inventory_category = sanitize_input($_POST['inventory_category'],$connect_inventory);
    $inventory_status = "Available";
    $inventory_batch_date = date("Y-m-d");
    $inventory_expiry_date = sanitize_input($_POST['expiry'],$connect_inventory);

}


if(isset($_POST['adminUserID']) && isset($_POST['inventory_edit_value'])){
    $adminUserID = sanitize_input($_POST['adminUserID'], $connect_inventory);
    $inventory_id = sanitize_input($_POST['inventory_id'], $connect_inventory);
    $inventory_name = sanitize_input($_POST['inventory_name'], $connect_inventory);
    $inventory_quantity = sanitize_input($_POST['inventory_quantity'], $connect_inventory);
    $inventory_price =  doubleval(sanitize_input($_POST['inventory_price'],$connect_inventory));
    $inventory_description = sanitize_input($_POST['inventory_description'],$connect_inventory);
    $inventory_category = sanitize_input($_POST['inventory_category'],$connect_inventory);
    $inventory_status = "Available";
    $inventory_batch_date = date("Y-m-d");
    $inventory_expiry_date = sanitize_input($_POST['expiry'],$connect_inventory);

}

if(isset($_POST['adminUserID']) && isset($_POST['inventory_delete_value'])){
    $adminUserID = sanitize_input($_POST['adminUserID'], $connect_inventory);
    $inventory_id = sanitize_input($_POST['inventory_id'], $connect_inventory);
    $inventory_status = "Deleted";

    $inventoryQuery = "UPDATE inventory SET inventory_status = ? WHERE inventory_id = ?";
    $inventoryPrepareQuery = mysqli_prepare($connect_inventory, $inventoryQuery);
    mysqli_stmt_bind_param($inventoryPrepareQuery, "si", $inventory_status, $inventory_id);
    mysqli_stmt_execute($inventoryPrepareQuery);
    mysqli_stmt_close($inventoryPrepareQuery);

}
?>