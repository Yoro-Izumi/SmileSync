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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Toggle Tab -->
    <link rel="stylesheet" href="css/toggle-tabs.css" />
    <!-- Table -->
    <link rel="stylesheet" href="css/table.css">
    <!-- Invoice Tab -->
    <link rel="stylesheet" href="css/invoice.css" />

    <!-- Chatbot -->
    <link rel="stylesheet" href="css/chatbot.css">
  </head>
<body>
<div class="overlay"></div>
<?php include "sidebar-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
<?php include "modal.php"; ?>
<?php include "loader.php"; ?>


  <section class="home-section">
  <h2>Appointment Details</h2>
  <div class="appointment-details">
      <div class="toggle-tabs">
          <div class="tab active" data-content="invoices"
              <p>Invoices</p>
          </div>
          <p>|</p>
          <div class="tab" data-content="canceled-appointments">
              <p>Canceled Appointments</p>
          </div>
          <p>|</p>
          <div class="tab" data-content="past-appointments">
              <p>Past Appointments</p>
          </div>
          <p>|</p>
          <div class="tab" data-content="upcoming-appointments">
              <p>Upcoming Appointments</p>
          </div>
      </div>
      <div class="content-area">
          <div class="content active" id="invoices"><?php include "invoice-table.php"; ?></div>
          <div class="content" id="canceled-appointments" style="display: none;"><?php include "cancelled-appointments.php"; ?></div>
          <div class="content" id="past-appointments" style="display: none;"><?php include "past-appointments.php"; ?></div>
          <div class="content" id="upcoming-appointments" style="display: none;"><?php include "upcoming-appointments.php"; ?></div>
      </div>
  </div>
  

  </section>
  
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab');

        if (tab) {
            // Find the corresponding tab using data-content attribute
            const activeTab = document.querySelector(`.tab[data-content="${tab}"]`);
            
            if (activeTab) {
                // Deactivate any other active tabs
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));

                // Activate the desired tab
                activeTab.classList.add('active');
            }
        }
    });
</script>


<!-- General styles -->
<script src="js/app.js"></script>
<!-- Chatbot -->
 <script src="js/chatbot.js"></script>
<!-- Chathead icons -->
 <script src="js/chathead-icon.js"></script>
<!-- Notifications -->
 <script src="js/notif.js"></script>
<!-- Appointment Tables -->
 <script src="js/appointment-table.js"></script>
<!-- Tabs in View Tables -->
 <script src="js/toggle-tabs.js"></script>
<!-- Invoice -->
 <script src="js/invoice.js"></script>
</body>
</html>
<?php
}
else{
  header('location: ../Login-page');
  exit();
}
?>