<!DOCTYPE html>
<html lang="en">
<body>

  <!-- Right Panel for Notifications -->
  <div id="rightPanel" class="right-panel">
    <div class="panel-header">
      <h2>Notifications</h2>
      <div class="header-icons">
        <!-- Minimize Icon (shown only when maximized) -->
        <i class='bx bx-exit-fullscreen' id="minimizePanel" title="Minimize Panel" style="display: none;"></i>
        <!-- Maximize Icon (shown initially) -->
        <i class='bx bx-fullscreen' id="maximizePanel" title="Maximize Panel"></i>
        <!-- Shrink Icon (hidden by default) -->
        <i class='bx bx-compress' id="shrinkPanel" title="Shrink Panel" style="display: none;"></i>
        <!-- Close Icon -->
        <i class='bx bx-x' id="closeRightPanel" title="Close Panel"></i>
      </div>
    </div>
    
    <div class="panel-content">
      
      <div class="notification-item">
        <img src="img/login.png"  alt="User Profile">
        <div class="notification-content">
          <p><strong>You</strong> uploaded a patient file.</p>
          <p class="notification-time">2 minutes ago</p>
        </div>
      </div>
      
      <div class="notification-item">
        <img src="img/login.png"  alt="User Profile">
        <div class="notification-content">
          <p><strong>You</strong> rescheduled an appointment.</p>
          <p class="notification-time">5 minutes ago</p>
        </div>
      </div>
      
    </div>

    <div class="panel-footer">
   <!--   <button id="view-more-btn">View More...</button>-->
    </div>

    
  </div>
</body>
</html>
