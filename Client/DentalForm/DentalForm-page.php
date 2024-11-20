<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

include "../client_global_files/connect_database.php";
include "pick_schedule_algo/stime_etime_procdur_leeway.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dental Form</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    
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
    <?php include "appointment-form.php"; ?>
    </div>

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>

</html>
