<!DOCTYPE html>
<html lang="en">
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">SmileSync</div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li class="nav-title">Home</li> 

      <li>
      <a href="../Dashboard/Dashboard.php">
          <i class='bx bx-bar-chart-square'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="../Appointment/Appointment-page.php">
          <i class='bx bx-calendar' ></i>
          <span class="links_name">Appointment</span>
        </a>
        <span class="tooltip">Appointment</span>
      </li>
      <li>
        <a href="../Inventory/Inventory-page.php">
          <i class='bx bx-package' ></i>
          <span class="links_name">Inventory</span>
        </a>
        <span class="tooltip">Inventory</span>
      </li>
      <li class="active">
        <a href="ReportAndAnalytics-page.php">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="links_name">Reports and Analytics</span>
        </a>
        <span class="tooltip">Reports and Analytics</span>
      </li>
      <li>
        <a href="../Settings/Settings-page.php">
          <i class='bx bxs-cog' ></i>
          <span class="links_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
      </li>

      <li class="nav-title">Others</li> 

      <li>
        <a href="#" id="chatbotBtn">
          <i class='bx bx-message-alt' ></i>
          <span class="links_name">Chat</span>
        </a>
        <span class="tooltip">Chat</span>
      </li>


      <li>
  <a href="#" id="notificationBtn">
    <i class='bx bx-bell'></i>
    <span class="links_name">Notifications</span>
  </a>
  <span class="tooltip">Notifications</span>
</li>

      <li class="profile">
        <div class="profile-details">
          <img src="img/login.png"  alt="profile">
          <div class="name_job">
            <div class="name">kazumiyoro@emailcom</div>
            <div class="job">Admin</div>
          </div>
          <a href="../admin_global_files/log_out.php">
            <i class='bx bx-log-out' id="log_out" ></i>
            <span class="tooltip">Logout</span>
        </div>
      </li>  
        
    </ul>
  </div>


</body>
</html>
