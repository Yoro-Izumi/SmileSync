<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "../client_global_files/connect_database.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Register-SmileSync</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  </head>
<body>
<?php include "loader.php"; ?>
<?php include "register-form.php"; ?>
  
<script src="js/form.js"></script>
<script src="js/app.js"></script>
<script src="js/notif.js"></script>
</body>
</html>
