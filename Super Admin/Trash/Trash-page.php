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

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Trash</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Toggle Tab -->
    <link rel="stylesheet" href="css/trash-toggle.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  </head>
<body>
<div class="overlay"></div>
<?php include "sidebar-super-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "loader.php"; ?>
 
  <section class="home-section">
  <h2>Trash</h2>
  
  <div class="account-toggle">
    <div class="toggle-item active" data-content="client-accounts">Client Accounts</div>
    <div class="toggle-item" data-content="admin-accounts">Admin Accounts</div>
    <div class="toggle-item" data-content="inventory">Inventory</div>
    <div class="toggle-item" data-content="services">Services</div>
  </div>
  <div class="content-area">
    <div class="content active" id="client-accounts"><?php include "removedClient-table.php"; ?></div>
    <div class="content" id="admin-accounts" style="display: none;"><?php include "removedAdmin-table.php"; ?></div>
    <div class="content" id="inventory" style="display: none;"><?php include "removedInventory-table.php"; ?></div>
    <div class="content" id="services" style="display: none;"><?php include "removedServices-table.php"; ?></div>
  </div>

  </section>
  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/trash-toggle.js"></script>
</body>
</html>
<?php
}
else{
  header("location: ../../Admin/Login-page/Login_Register-Page.php");
  exit();
}
?>