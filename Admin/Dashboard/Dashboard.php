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
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="overlay"></div>
    <?php include "sidebar-super-admin.php"; ?>
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
                        <p>47</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <h2>Cancelled</h2>
                        <p>19</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <h2>Rescheduled</h2>
                        <p>20</p>
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
