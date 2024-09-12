<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Reports and Analytics</title>
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
<?php include "sidebar-super-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
 
  <section class="home-section">
  <h2>Reports and Analytics</h2>
  <?php include "smartChart.php"; ?>
  </section>
  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>
</html>
