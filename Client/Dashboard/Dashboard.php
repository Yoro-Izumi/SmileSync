<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";
if (isset($_SESSION['userID']) && !empty($_SESSION['csrf_token'])) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  </head>
<body>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "top-navbar.php"; ?>
<?php include "loader.php"; ?>

  
  <div class="body-container">
      <h1>Welcome dear <span>Patient!</span>
      <p>
            Explore our user-friendly platform to book, manage, and track your appointments easily. 
            Thank you for choosing SmileSync as your dental care partner!
        </p></h1>
      <?php include "dashboard-table.php"; ?>
    </div>

  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>
</html>
<?php
}
else{
  header('location: ../LogIn-Page/Login-Page.php');
  die();
}
?>