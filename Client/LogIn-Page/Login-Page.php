<?php
// Start session and set timezone
include "../client_global_files/set_sesssion_dir.php";
session_start();
date_default_timezone_set('Asia/Manila');
// Generate a CSRF token if it's not already set
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// Check if user is already logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['csrf_token'])) {
    header('location: ../Dashboard/index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmileSync</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!--style.css-->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>


<body>
  <?php include "chatbot.php"; ?>
  <?php include "modal.php"; ?>
  <?php include "loader.php"; ?>

    <main> 
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            
          <form name="login_form" id="login_form" action="Login-Page.php" autocomplete="off" class="sign-in-form">
          <div class="logo">
                <img src="img/logo.png" alt="SmileSync" />
                SmileSync
              </div>
    
          <div class="heading">
                <h2>Welcome,</h2>
                <h2>Log in to your account.</h2>
                <h4>New Patient?
                <a href="#" id="getAppointmentBtn">Get Appointment</a></h4>
              </div>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="1"
                    class="input-field"
                    name="email"
                    autocomplete="off"
                    required
                  />
                  <label>Email<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="1"
                    class="input-field"
                    id="signup-password"
                    name="password"
                    autocomplete="off"
                    required
                  />
                  <label>Password<indicator>*</indicator></label>
                  <div class="fa fa-eye icon" id="signup-show-password"></div>
                  
                </div>


             <div class="text-wrap">
                <div class="remember-me-wrap">
                    <input type="checkbox" id="rememberMe" class="remember-me-checkbox">
                    <p for="rememberMe">Remember Me</p>
                </div>

                  <p class="text">
                  <a href="#" id="forgotPassword"> Forgotten your password?</a>
                </p>
                </div >

                <input type="submit" value="Sign In" class="sign-btn" id="loginClientBtn"/>

                
              </div>
            </form>


          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="img/signup.png" alt="image">
          </div></div

        </div>
      </div>

    </main>

    <!-- Javascript file -->
    <script src="js/app.js"></script>
<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$('.icon').click(function () {
  if ($('#password').attr('type') == 'text') {
    $('#password').attr('type', 'password');
    $('#show-password').removeClass('fa-eye-slash').addClass('fa-eye');
  } else {
    $('#password').attr('type', 'text');
    $('#show-password').removeClass('fa-eye').addClass('fa-eye-slash');
  }
});

document.addEventListener('DOMContentLoaded', function() {
    const loginFailedModal = document.getElementById('loginFailedModalClient');
    const resetPasswordModal = document.getElementById('resetPasswordModalClient');
    const successModal = document.getElementById('resetSuccessModal');

    const showLoginFailedBtnn = document.getElementById('loginClientBtn');
    const closeLoginFailedBtnn = document.getElementById('closeLoginFailedBtnn');

    const resetPasswordLinkk = document.getElementById('resetPasswordLink');
    const resetLink = document.getElementById('forgotPassword');
    const closeResetPasswordBtn = document.getElementById('cancelButton');

    const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    // Show the login failed modal (triggered by AJAX error)
    closeLoginFailedBtnn.addEventListener('click', function() {
        loginFailedModal.classList.remove('show');
    });

    // Show the reset password modal when clicking the reset password link
    resetPasswordLinkk.addEventListener('click', function(event) {
        loginFailedModal.classList.remove('show');
        resetPasswordModal.classList.add('show');
    });

    // Close the reset password modal (Cancel button)
    closeResetPasswordBtn.addEventListener('click', function() {
        resetPasswordModal.classList.remove('show');
    });

    // Show the reset password modal when clicking the reset password link
    resetLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        resetPasswordModal.classList.add('show');
    });

    // Handle submit action
    submitResetPasswordBtn.addEventListener('click', function() {
        resetPasswordModal.classList.remove('show');
        successModal.classList.add('show'); // Show success modal after submitting
    });

    // Close the success modal
    closeSuccessModalBtn.addEventListener('click', function() {
        successModal.classList.remove('show');
    });

    // AJAX form submission (for login form)
    $("#login_form").on("submit", function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    // Disable the button to prevent multiple clicks
    //$("#loginClientBtn").prop("disabled", true);
    
    $.ajax({
        type: "POST",
        url: "login_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            response = JSON.parse(response); // Parse the JSON response

            if (response.status === 'success') {
                location.reload();
            } else {
                // Show the error message in the login failed modal
                $('#loginFailedModalClient').addClass('show');
                $('#loginFailedModalClient .modal-message').text(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            $('#loginFailedModalClient').addClass('show');
            $('#loginFailedModalClient .modal-message').text('An error occurred. Please try again.');
        },
        complete: function() {
            // Enable the button after request completes
            $("#loginClientBtn").prop("disabled", false);
        }
    });
});

});

</script>

</body>
</html>
