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

<?php include "loader.php"; ?>

  
<div class="body-container" id="body-container">
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "top-navbar.php"; ?>  
  <div class="Container">
      <?php include "settings-form.php"; ?>
    </div></div>

  

 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>
</html>
