<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sidebar -->
    <link rel="stylesheet" href="css/top-navbar.css"/>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-logo">
            <div class="logo">
                SmileSync
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="Dashboard.php" class="active"><i class="fas fa-home"></i><span>Home</span></a></li>
            <li><a href="../DentalForm/DentalForm-page.php"><i class="fas fa-tooth"></i><span>Dental Form</span></a></li>
            <li><a href="../Appointments/Appointments-page.php"><i class="fas fa-calendar-alt"></i><span>Appointments</span></a></li>
        </ul>
        <div class="nav-icons">
            <i class="bx bx-message-alt" id="chatbotBtn"></i>
            <i class="bx bx-bell" id="notificationBtn"></i>
            <div class="dropdown">
                <i class="fa fa-user-circle dropdown-toggle"></i>
                <div class="dropdown-content">
                    <a href="#"><i class="fa fa-user-circle"></i><?php echo $patientEmail;?></a>
                    <a href="../Settings/Settings-page.php"><i class='bx bxs-cog'></i>Settings</a>
                    <a href="../client_global_files/logout.php"><i class='bx bx-log-out' id="log_out"></i>Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/top-navbar.js"></script>

</body>
</html>
