<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

include "../admin_global_files/connect_database.php";
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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  </head>
<body>
<div class="overlay"></div>
<?php include "modal.php"; ?>
<?php include "sidebar-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "loader.php"; ?>
 
  <section class="home-section">
  <h2>Inventory</h2>
  <?php include "inventory-tables.php"; ?>
  </section>
  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>
</html>
