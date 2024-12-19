<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";
include "../client_global_files/encrypt_decrypt.php";
include "../client_global_files/input_sanitizing.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/toggles.css" />
    <link rel="stylesheet" href="css/table.css" />
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

  <div class="appointment-details">
  <div class="toggle-tabs">
          <div class="tab active" data-content="invoices">
              <p>Appointment Details</p>
          </div>
          <div class="tab" data-content="canceled-appointments">
              <p>Invoice</p>
          </div>
      </div>
      <div class="content-area">
          <div class="content active" id="invoices"><?php include "appointment-table.php"; ?></div>
          <div class="content" id="canceled-appointments" style="display: none;"><?php include "invoice-table.php"; ?></div>
      </div>







  </div>
    </div>

  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/toggles.js"></script>
</body>
</html>
