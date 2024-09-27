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
   
  </head>
<body>
<div class="overlay"></div>
<?php include "sidebar-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
 
  <section class="home-section">
  <h2>Appointment Details</h2>
  <div class="appointment-details">
      <div class="toggle-tabs">
          <div class="tab active" data-content="invoices">
              <span class="icon">
              <img src="img/frame.png">
              </span> 
              <p>Invoices</p>
          </div>
          <div class="tab" data-content="canceled-appointments">
              <span class="icon" >
              <img src="img/frame.png">
              </span> 
              <p>Canceled Appointments</p>
          </div>
          <div class="tab" data-content="past-appointments">
              <span class="icon">
              <img src="img/frame.png">
              </span> 
              <p>Past Appointments</p>
          </div>
          <div class="tab" data-content="upcoming-appointments">
              <span class="icon">
              <img src="img/frame.png">
              </span> 
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


 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
 <script src="js/toggle-tabs.js"></script>
</body>
</html>
