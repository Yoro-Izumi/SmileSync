<?php 
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard-ADMIN</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Toggle -->
    <link rel="stylesheet" href="css/account-toggle.css" />
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
  <h2>Accounts</h2>
  
  <div class="account-toggle">
    <div class="toggle-item active" data-content="client-accounts">Client Accounts</div>
    <span class="separator">\</span>
    <div class="toggle-item" data-content="admin-accounts">Admin Accounts</div>
  </div>

  <div class="content-area">
    <div class="content active" id="client-accounts"><?php include "accountClient-table.php"; ?></div>
    <div class="content" id="admin-accounts" style="display: none;"><?php include "accountAdmin-table.php"; ?></div>
  </div>

  </section>
  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/account-toggle.js"></script>
</body>
</html>
