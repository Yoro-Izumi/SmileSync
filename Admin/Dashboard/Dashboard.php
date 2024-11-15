<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files for dashboard
include '../admin_global_files/connect_database.php';
include "total_patients_per_day.php";
include "total_cancelled_appointments.php";
include "total_rescheduled_appointments.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-ADMIN</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
     
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/sidebar-nav.css"/>
    <!-- Page -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- chatbot -->
    <link rel="stylesheet" href="css/chatbot.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="overlay"></div>
    <?php include "sidebar-admin.php"; ?>
    <?php include "notif.php"; ?>
    <?php include "chatbot.php"; ?>
    <?php include "loader.php"; ?>

    <section class="home-section">
    <div class="row">
      <div class="col-md-8">
        <div class="content-section">
            <h1 class="welcome-message">Welcome <span class="highlight">Super Admin!</span></h1>
                <div class="side-title">Overview</div>
            <!-- Statistics Grid -->
            <div class="row">
            
                <div class="col-md-4">
                    <div class="stat-box">
                        <h2>Total Patients</h2>
                        <p><?php echo $totalPatients;?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <h2>Cancelled</h2>
                        <p><?php echo $totalCancelledAppointments;?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <h2>Rescheduled</h2>
                        <p><?php echo $totalRescheduledAppointments;?></p>
                    </div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="side-title">Statistics</div>
                    <div class="calendar-container">
                    
                        <?php include "smartChart.php"; ?>
                    </div>
                </div>
          
            </div>

            <!-- SmartChart Section -->
                <div class="col-md-4">
                    <div class="smartchart-container">
                      <?php include "calendar-appointments.php"; ?>  
                    </div>
                </div>
     
        </div></div>
    </section>

    <script src="js/app.js"></script>
    <script src="js/notif.js"></script>

    
</body>
</html>
