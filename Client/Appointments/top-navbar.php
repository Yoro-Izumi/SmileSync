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
                <h4>SmileSync</h4>
              </div>
        </div>
        <ul class="nav-links">
            <li><a href="../Dashboard/Dashboard.php">Home</a></li>
            <li><a href="../DentalForm/DentalForm-page.php">Dental Form</a></li>
            <li><a href="Appointments-page.php"  class="active">Appointments</a></li>
        </ul>
        <div class="nav-icons">
        <i class="bx bx-message-alt" id="chatbotBtn"></i>
        <i class="bx bx-bell" id="notificationBtn"></i>
            <div class="dropdown">
                <i class="fa fa-user-circle dropdown-toggle"></i>
                <div class="dropdown-menu">
                    <a href="#">User Account</a>
                    <a href="../Settings/Settings-page.php">Settings</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <li>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/top-navbar.js"></script>
 
</body>
</html>
