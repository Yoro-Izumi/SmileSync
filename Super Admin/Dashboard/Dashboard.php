<?php
// Start session and set timezone
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files for dashboard
include '../admin_global_files/connect_database.php';
include '../admin_global_files/encrypt_decrypt.php';
include '../admin_global_files/input_sanitizing.php';
include "total_patients_per_day.php";
include "total_cancelled_appointments.php";
include "total_rescheduled_appointments.php";
// Check if user is already logged in
if (isset($_SESSION['userSuperAdminID']) && !empty($_SESSION['csrf_token'])) {
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

</head>

<body>
    <div class="overlay"></div>
    <?php include "sidebar-super-admin.php"; ?>
    <?php include "notif.php"; ?>
    <?php include "chatbot.php"; ?>
    <?php include "loader.php"; ?>

    <section class="home-section">
    <h1 class="welcome-message">Welcome <span class="highlight">
                Super Admin!
            </span>
            <p>
    As a superadmin, you have full control over the platform. Manage users, configure system settings, oversee data analytics, and maintain the integrity of SmileSync’s operations. 
    Your leadership ensures the platform remains reliable and scalable. Thank you for driving excellence in dental appointment management!
</p>
</h1>
    <div class="row">
      <div class="col-8">
        <div class="content-section">
                <div class="side-title">Overview</div>
            <!-- Statistics Grid -->
            <div class="row">
            
                <div class="col-4">
                    <div class="stat-box">
                        <h2>Total Patients</h2>
                        <p><!--?php echo $totalPatients;?-->0</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-box">
                        <h2>Cancelled</h2>
                        <p><!--?php echo $totalCancelledAppointments;?-->0</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-box">
                        <h2>Rescheduled</h2>
                        <p><!--?php echo $totalRescheduledAppointments;?-->0</p>
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
                <div class="col-4">
                <div class="side-title">Appointments</div>
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
<?php
}
else{
  header("location: ../../Admin/Login-page/Login_Register-Page.php");
  exit();
}
?>