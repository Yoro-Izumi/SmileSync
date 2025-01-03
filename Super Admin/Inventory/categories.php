<?php
session_start();
include '../../admin_global_files/connect_database.php';
$connect_inventory = connect_inventory($servername,$username,$password);

$qryGetItemCategories = "SELECT * FROM smilesync_inventory_categories";
$stmtGetItemCategories = $connect_inventory->prepare($qryGetItemCategories);
$stmtGetItemCategories->execute();
$resultGetItemCategories = $stmtGetItemCategories->get_result();

while($row = $resultGetItemCategories->fetch_assoc()) {
    echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
}
?>