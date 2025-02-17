<?php
// Start session and set timezone
include "../admin_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Include necessary files for dashboard
include "../admin_global_files/connect_database.php";
include "../admin_global_files/encrypt_decrypt.php";
include "../admin_global_files/input_sanitizing.php";
include "total_patients_per_day.php";
include "total_cancelled_appointments.php";
include "total_rescheduled_appointments.php";
// Check if user is already logged in
if (isset($_SESSION['userAdminID']) && !empty($_SESSION['csrf_token'])) {
    $connect_accounts = connect_accounts($servername,$username,$password); //connect to account database
    $userAdminID = sanitize_input($_SESSION['userAdminID'],$connect_accounts); //initialzing userAdminID with id in session variable
    //Query to get admin information based on admin id
    $qryGetAdminInfo = "SELECT * FROM smilesync_admin_accounts where admin_account_id = ?";
    $stmt = $connect_accounts->prepare($qryGetAdminInfo);
    $stmt->bind_param("s",$userAdminID);
    $stmt->execute();
    $result = $stmt->get_result();
    $adminInfo = $result->fetch_assoc();
    $stmt->close();
    $connect_accounts->close();
    
    //admin information initialization
    $adminID = $adminInfo['admin_account_id'];
    $adminEmail = $adminInfo['admin_email'];
    $adminEmail = decryptData($adminEmail,$key);
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
    <link rel="stylesheet" href="css/smartChart.css">
  <link rel="stylesheet" href="css/table.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    <div class="overlay"></div>
    <?php include "sidebar-admin.php"; ?>
    <?php include "notif.php"; ?>
    <?php include "chatbot.php"; ?>
    <?php include "loader.php"; ?>

    <section class="home-section">
    <h1 class="welcome-message">Welcome <span class="highlight">
        Admin!
    </span>
    <p>
    As an administrator, you have the tools to manage appointments, monitor schedules, and ensure the smooth operation of our dental services.
    Thank you for helping us create easy dental care experiences!
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
                        <p><?php echo $totalPatients;?></p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat-box">
                        <h2>Cancelled</h2>
                        <p><?php echo $totalCancelledAppointments;?></p>
                    </div>
                </div>
                <div class="col-4">
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
    <script src="js/smartChart2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/calendar-appointments2.js"></script>
    <script>
    function redirectToUpcoming() {
        // Redirect to page2.html with a query parameter to show only "Upcoming" rows
        window.location.href = 'http://localhost/SmileSync/Admin/Appointment/Appointment-page.php?status=upcoming';
    }
    </script>

    
    
    
</body>
</html>
<?php 
}
else{
    header('location: ../Login-page');
    exit(); 
}
?>