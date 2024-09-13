<?php
// Start session and set timezone
session_start();
date_default_timezone_set('Asia/Manila');
// Check if user is already logged in
if (isset($_SESSION['userSuperAdminID'])) {
    header('location:superadmin_Dashboard.php');
    die();
}
if (isset($_SESSION['userAdminID'])) {
    header('location:Dashboard.php');
    die();
}

// Include necessary files
include '../admin_global_files/connect_database.php';
include '../admin_global_files/encrypt_decrypt.php';
include '../admin_global_files/input_sanitizing.php';

// Encryption key (to be changed later)
$key = "TheGreatestNumberIs73";

// Connect to the accounts database
$connect_db = mysqli_connect('localhost', 'root', '', "smilesync_accounts");

if (isset($_POST['email'])) {
    // Format of input sanitization
    $firstName = encryptData(sanitize_input($_POST['firstName'], $connect_db), $key);
    $lastName = encryptData(sanitize_input($_POST['lastName'], $connect_db), $key);
    $middleName = encryptData(sanitize_input($_POST['middleName'], $connect_db), $key);
    $suffix = encryptData(sanitize_input($_POST['suffix'], $connect_db), $key);
    $email = encryptData(sanitize_input($_POST['email'], $connect_db), $key);
    $password = sanitize_input($_POST['password'], $connect_db);
    $confirmPassword = sanitize_input($_POST['confirmPassword'], $connect_db);
    $dateOfCreation = date('Y-m-d');
    $accountStatus = 'Pending';
    $birthday = encryptData(sanitize_input($_POST['birthday'], $connect_db), $key);
    $phoneNumber = encryptData(sanitize_input($_POST['phoneNumber'], $connect_db), $key);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match!")';
        echo '</script>';
        exit();
    }

    // Hash the password using Argon2
    $options = [
        'memory_cost' => 1 << 17,
        'time_cost' => 4,
        'threads' => 3,
    ];
    $password = password_hash($password, PASSWORD_ARGON2I, $options);

    // Insert admin account data
    //INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, `admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`, `date_of_creation`, `account_status`, `admin_birthdate`, `admin_phone`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')
    $qryInsertAdminAccount = "INSERT INTO `smilesync_admin_accounts`(`admin_account_id`, `admin_first_name`, `admin_last_name`, `admin_middle_name`, `admin_suffix`, `admin_email`, `admin_password`, `date_of_creation`, `account_status`, `admin_birthdate`, `admin_phone`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $conInsertAdminAccount = mysqli_prepare($connect_db, $qryInsertAdminAccount);
    mysqli_stmt_bind_param($conInsertAdminAccount, 'ssssssssss', $firstName, $lastName, $middleName, $suffix, $email, $password, $dateOfCreation, $accountStatus, $birthday, $phoneNumber);
    mysqli_stmt_execute($conInsertAdminAccount);
    // Execute and handle errors
    if (!mysqli_stmt_execute($conInsertAdminAccount)) {
        echo 'Error: ' . mysqli_stmt_error($conInsertAdminAccount);
    }

    unset($_POST['email']);
    mysqli_close($connect_db);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmileSync-ADMIN</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <!--style.css-->
    <link rel="stylesheet" href="css/style.css" />

</head>


<body>
 

    <main>
       <?php include "modal.php"; ?>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
           <form id="register_form" name="register_form" autocomplete="off" class="sign-up-form">
           <div class="logo">
                <img src="img/logo.png" alt="SmileSync" />
                SmileSync
              </div>   
           <div class="heading">
                <h2>To get started, please register.</h2>
                <h4>Already have an account?
                <a href="#" class="toggle">Log In</a></h4>
              </div>

              <div class="actual-form">

            <div class="wrap-2rows">

              <div class="input-wrap">
                  <input
                    type="text"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    name="firstName"
                    required
                  />
                  <label>First Name<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    name="lastName"
                    required
                  />
                  <label>Last Name<indicator>*</indicator></label>
                </div>
              </div>


              <div class="wrap-3rows">

              <div class="input-wrap">
                  <input
                    type="text"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    name="middleName"
                  />
                  <label>Middle Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="1"
                    maxlength="5"
                    class="input-field"
                    name="suffix"
                    autocomplete="off"
                  />
                  <label>Suffix</label>
                </div>

                <!--<div class="input-wrap">
                <select class="input-field">
                <option value="" disabled selected>Brithdate</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
                </div>-->
                

                <!--<input type="text" class="input-field" placeholder="Field 4">-->
       
                <div class="input-wrap">
                <input
                    type="text"
                    id="birthdate-picker"
                    class="input-field"
                    name="birthday"
                    autocomplete="off"
                    required
                  />
                  <label>Select Birthdate<indicator>*</indicator></label>
                </div>

              </div>


                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="11"
                    class="input-field"
                    name="phoneNumber"
                    autocomplete="off"
                    required
                  />
                  <label>Phone Number<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    name="email"
                    autocomplete="off"
                    required
                  />
                  <label>Email Address<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    name="password"
                    autocomplete="off"
                    required
                  />
                  <label>Password<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                <input type="password" 
                  class="input-field"
                  name="confirmPassword"
                  autocomplete="off"
                required></diuv>
            <label>Confirm Password<indicator>*</indicator></label>
        </div>

                <input type="submit" value="Sign Up" class="sign-btn" id="registerBtn" name="registerBtn"/>
         <!-- #region -->

         <div class="text-wrap">
                <p class="text">
                  By signing up, I agree to the
                  <a href="#" id="termServices">Terms of Services</a> and
                  <a href="#" id="privacyPolicy">Privacy Policy</a>
                </p>
              </div>
            </div>

            </form>

            
          <form name="login_form" id="login_form" autocomplete="off" class="sign-in-form">
          <div class="logo">
                <img src="img/logo.png" alt="SmileSync" />
                SmileSync
              </div>
    
          <div class="heading">
                <h2>Welcome,</h2>
                <h2>Log in to your account.</h2>
                <h4>Don't have an account?
                <a href="#" class="toggle">Sign up</a></h4>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    maxlength="24"
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
                    maxlength="24"
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
              <img src="img/it.png" alt="image">
          </div></div>

        </div>
      </div>

    </main>

    <!-- Javascript file -->
    <script src="js/app.js"></script>
    <script src="js/eye-toggle.js"></script>



    <script>
      document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#birthdate-picker", {
        minDate: "1975-01-01",
        maxDate: "2015-12-31",
        dateFormat: "Y-m-d", // Format as Year-Month-Day
    });
});

    </script>
   
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script> //ajax code for form submission
$(document).ready(function () {
  $("#register_form").on("submit", function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    // Disable the button to prevent multiple clicks
    $("#registerBtn").prop("disabled", true);
    
    $.ajax({
      type: "POST",
      url: "register_code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response); // Handle success response
        // Redirect or show success message
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
      complete: function() {
        // Enable the button after request completes
        $("#registerBtn").prop("disabled", false);
      }
    });
  });

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
        console.log(response); // Handle success response
        // Redirect or show success message
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
}); 

    
  </script>


</body>
</html>
