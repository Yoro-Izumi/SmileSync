<?php
// Start session and set timezone
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";
// Check if user is already logged in
if (isset($_SESSION['userSuperAdminID']) && !empty($_SESSION['csrf_token'])) {
$connect_inventory = connect_inventory($servername,$username,$password);

$qryGetItemCategories = "SELECT * FROM smilesync_inventory_categories";
$stmtGetItemCategories = $connect_inventory->prepare($qryGetItemCategories);
$stmtGetItemCategories->execute();
$resultGetItemCategories = $stmtGetItemCategories->get_result();

$currentDate = date('Y-m-d');
$conn = connect_inventory($servername, $username, $password);
$categories = [];
while ($row = $resultGetItemCategories->fetch_assoc()) {
    $categories[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Inventory</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/inventoryToggle.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <!--AJAX-->
    <script src="../admin_global_files/jquery-3.6.0.min.js"></script>
   
  </head>
<body>
<div class="overlay"></div>
<?php include "modal.php"; ?>
<?php include "sidebar-super-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "loader.php"; ?>
 
  <section class="home-section">
  <h2>Inventory</h2>

  <div class="account-toggle">
    <div class="toggle-item active" data-content="list">Inventory List</div>
    <div class="toggle-item" data-content="history">History</div>

  </div>
  <div class="content-area">
    <div class="content active" id="list"><?php include "inventory-tables.php"; ?></div>
    <div class="content" id="history" style="display: none;"><?php include "inventory-tablesHistory.php"; ?></div>
  </div>
  </section>
  
 <script src="js/inventoryToggle.js"></script>
 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/modal2.js"></script>
 <script src="js/crud.js"></script>

</body>
</html>
<?php
}
else{
  header("location: ../../Admin/Login-page/Login_Register-Page.php");
  exit();
}
?>