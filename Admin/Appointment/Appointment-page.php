<?php
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";

// Check if user is already logged in
if (isset($_SESSION['userAdminID']) && !empty($_SESSION['csrf_token'])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Appointment-ADMIN</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Toggle Tab -->
    <link rel="stylesheet" href="css/toggle-tabs.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--AJAX-->
    <script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>
   
  </head>
<body>
<div class="overlay"></div>
<?php include "sidebar-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "modal.php"; ?>
<?php include "loader.php"; ?>
 
  <section class="home-section">
  <h2>Appointments</h2>
  <?php include "appointment-table.php"; ?>

  </section>
  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/toggle-tabs.js"></script>
</body>
</html>
<?php
}
else{
  header('location: ../Login-page');
  exit();
}
?>