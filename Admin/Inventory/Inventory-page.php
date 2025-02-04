<?php
// Start session and set timezone
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";
// Check if user is already logged in
if (isset($_SESSION['userAdminID']) && !empty($_SESSION['csrf_token'])) {
  $connect_accounts = connect_accounts($servername,$username,$password); //connect to account database
  $userAdminID = sanitize_input($_SESSION['userAdminID'],$connect_accounts); //initialzing userAdminID with id in session variable
  //Query to get admin information based on admin id
  $qryGetAdminInfo = "SELECT * FROM smilesync_admin_accounts where admin_account_id = ?";
  $stmt = $connect_accounts->prepare($qryGetAdminInfo);
  $stmt->bind_param("s",$userAdminID);
  $stmt->execute();
  $result = $stmt->get_result();
  $adminInfo = $result->fetch_assoc();
  $stmt->close();
  $connect_accounts->close();
  
  //admin information initialization
  $adminID = $adminInfo['admin_account_id'];
  $adminEmail = $adminInfo['admin_email'];
  $adminEmail = decryptData($adminEmail,$key);
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
<?php
}
else{
  header('location: ../Login-page');
  exit();
}
?>