<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard-ADMIN</title>
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .home-section {
        display: grid;
        grid-template-columns: 2fr 1fr; /* Adjust the ratio as needed */
        gap: 20px; /* Space between content and calendar */
      }
      .content-section {
        /* You can style the content section here */
      }
      .calendar-section {
        /* You can add additional styles for the calendar section */
      }
    </style>
    <style>
      .statistics-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
      }

      .stat-box {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 30%; /* Each box takes 30% of the container width */
        text-align: center;
      }

      .stat-box h2 {
        font-size: 18px;
        color: #333;
      }

      .stat-box p {
        font-size: 36px;
        color: #333; /* #4CAF50; Use green or your desired color */
        margin-top: 10px;
      }

    </style>
  </head>
<<<<<<< Updated upstream
<body>
<?php include "sidebar-admin.php"; ?>
<?php include "notif.php"; ?>
<?php include "chatbot.php"; ?>
 
  <section class="home-section">

  <?php include "appointment-table.php"; ?>

  </section>
  
 <script src="js/app.js"></script>
 <script src="js/notif.js"></script>
</body>
=======
  <body>
    <div class="overlay"></div>
    <?php include "sidebar-super-admin.php"; ?>
    <?php include "notif.php"; ?>
    <?php include "chatbot.php"; ?>

    <section class="home-section">
      <div class="content-section">
        <h1>Welcome back!</h1>
        <div class="statistics-container">
          <div class="stat-box">
            <h2>Total Patients</h2>
            <p>47</p>
          </div>
          <div class="stat-box">
            <h2>Cancelled</h2>
            <p>19</p>
          </div>
          <div class="stat-box">
            <h2>Rescheduled</h2>
            <p>20</p>
          </div>
        </div>
        <?php include "smartChart.php"; ?>
      </div>
      <div class="calendar-section">
        <?php include "calendar-appointments.php"; ?>
      </div>
    </section>

    <script src="js/app.js"></script>
    <script src="js/notif.js"></script>
  </body>
>>>>>>> Stashed changes
</html>
