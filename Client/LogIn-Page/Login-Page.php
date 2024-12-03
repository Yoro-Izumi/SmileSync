<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');
// Check if user is already logged in

if (isset($_SESSION['userID'])) {
    header('location:Dashboard.php');
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

</head>


<body>
<?php include "modal.php"; ?>
<?php include "loader.php"; ?>

    <main> 
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            
          <form name="login_form" id="login_form" action="Login_Register-Page.php" autocomplete="off" class="sign-in-form">
          <div class="logo">
                <img src="img/logo.png" alt="SmileSync" />
                SmileSync
              </div>
    
          <div class="heading">
                <h2>Welcome,</h2>
                <h2>Log in to your account.</h2>
                <h4>Don't have an account?
                <a href="../Register/Register-Page.php">Sign up</a></h4>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="24"
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
                    minlength="24"
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
                  <a href="#" id="forgotLink"> Forgotten your password?</a>
                </p>
                </div >

                <input type="submit" value="Sign In" class="sign-btn" id="loginBtn"/>

                
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
    <script src="js/eye-toggle.js"></script>


   
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

//code to post data using ajax
$("#login_form").on("submit", function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    // Disable the button to prevent multiple clicks
    $("#loginBtn").prop("disabled", true);
    
    $.ajax({
      type: "POST",
      url: "login_code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        //console.log(response); // Handle success response
        // Redirect or show success message
        window.location.href = "../Dashboard/Dashboard.php";
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
      complete: function() {
        // Enable the button after request completes
        $("#loginBtn").prop("disabled", false);
      }
    });
  });
</script>

</body>
</html>
