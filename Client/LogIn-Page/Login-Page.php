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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Axios CDN -->

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
  <label for="signup-password">Password <span class="indicator">*</span></label> <!-- Corrected label usage -->

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
          </div></div>

        </div>
      </div>

    </main>

    <!-- Javascript file -->
    <script src="js/app.js"></script>
<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../client_global_files/js/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
 // Modal Elements
const loginFailedModal = document.getElementById('loginFailedModalClient');
const resetPasswordModal = document.getElementById('resetPasswordModalClient');
const successModal = document.getElementById('resetSuccessModal');
const registerModal = document.getElementById('registerModal');

// Buttons
const loginClientBtn = document.getElementById('loginClientBtn');
const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtnn');
const resetPasswordLink = document.getElementById('resetPasswordLink');
const forgotPasswordLink = document.getElementById('forgotPassword');
const closeResetPasswordBtn = document.getElementById('cancelButton');
const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
const getAppointmentBtn = document.getElementById('getAppointmentBtn');
const cancelRegisterBtn = document.querySelector('.btn.cancel');
const proceedRegisterBtn = document.querySelector('.btn.proceed');

// Utility Functions
function showModal(modal) {
    modal.classList.add('show');
}

function hideModal(modal) {
    modal.classList.remove('show');
}

// Handle Login Failed Modal
closeLoginFailedBtn.addEventListener('click', () => hideModal(loginFailedModal));

// Show Reset Password Modal from Login Failed Modal
resetPasswordLink.addEventListener('click', () => {
    hideModal(loginFailedModal);
    showModal(resetPasswordModal);
});

// Show Reset Password Modal from Forgot Password Link
forgotPasswordLink.addEventListener('click', (e) => {
    e.preventDefault();
    showModal(resetPasswordModal);
});

// Close Reset Password Modal
closeResetPasswordBtn.addEventListener('click', () => hideModal(resetPasswordModal));

// Show Success Modal after Reset Submission
submitResetPasswordBtn.addEventListener('click', () => {
    hideModal(resetPasswordModal);
    showModal(successModal);
});

// Close Success Modal
closeSuccessModalBtn.addEventListener('click', () => hideModal(successModal));

// Open Register Modal
getAppointmentBtn.addEventListener('click', () => {
    registerModal.style.display = 'flex';
});

// Close Register Modal
cancelRegisterBtn.addEventListener('click', () => {
    registerModal.style.display = 'none';
});

// Redirect on Proceed Button Click
proceedRegisterBtn.addEventListener('click', () => {
    window.location.href = 'https://smilesync.site/SmileSync/Client/Register/Register-Page.php';
});

// Close Modal When Clicking Outside
window.addEventListener('click', (e) => {
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
    }
});




 // Open the modal when "Reset Password" is clicked
 document.getElementById('forgotPassword').addEventListener('click', () => {
  document.getElementById('resetPasswordModal').style.display = 'flex';
});

// Close the modal when "Cancel" is clicked
document.getElementById('cancelButton').addEventListener('click', () => {
  document.getElementById('resetPasswordModal').style.display = 'none';
});

// Close the success modal when "OK" is clicked
document.getElementById('closeSuccessModalBtn').addEventListener('click', () => {
  document.getElementById('successModal').style.display = 'none';
});


    // Open the modal when "Set Appointment" is clicked
    document.getElementById('getAppointmentBtn').addEventListener('click', () => {
        document.getElementById('registerModal').style.display = 'flex';
      });
      
      // Close the modal when "Cancel" is clicked
      document.querySelector('.btn.cancel').addEventListener('click', () => {
        document.getElementById('registerModal').style.display = 'none';
      });
      
      // Redirect to a URL when "Proceed" is clicked
      document.querySelector('.btn.proceed').addEventListener('click', () => {
        const targetUrl = 'https://smilesync.site/SmileSync/Client/Register/Register-Page.php'; // Replace with your desired URL
        window.location.href = targetUrl;
      });
      
      // Optional: Close the modal if clicked outside the modal content
      window.addEventListener('click', (e) => {
        const modal = document.getElementById('registerModal');
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });
      
    });




// Prevent form submission by pressing Enter or other means
$("#login_form").on("submit", function (e) {
    e.preventDefault();
});

// Handle form submission when #loginClientBtn is clicked
$("#loginClientBtn").on("click", function (e) {
    e.preventDefault();

    var formData = new FormData($("#login_form")[0]);

    // Disable the button to prevent multiple clicks
    $("#loginClientBtn").prop("disabled", false);

    $.ajax({
        type: "POST",
        url: "login_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            //response = JSON.parse(response); // Parse the JSON response
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




$(document).ready(function () {
    $('#resetPasswordForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting traditionally

        const email = document.getElementById('emailInputReset').value; 
        const SERVER_URL = "http://localhost:4000/send-email"; // Replace with your server's URL
        const resetLink = `https://smilesync.site/SmileSync/Client/Forgot%20Password/forgotPassword-page.php?email=${encodeURIComponent(email)}`;

        // Function to check if email exists
        const checkEmail = async () => {
            try {
                const response = await $.ajax({
                    url: 'check_email.php',
                    type: 'POST',
                    data: { email },
                    dataType: 'json',
                });

                if (response.status === 'success') {
                    // Email exists, proceed to send reset email
                    sendEmail();
                } else {
                    alert(response.message); // Show error if email not found
                }
            } catch (error) {
                alert('An error occurred while verifying email');
            }
        };

        // Function to send email
        const sendEmail = async () => {
            const emailData = {
                to: email,
                subject: "Forget Password",
                html:  `
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Reset Your Password</title>
                </head>
                <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #6A5ACD, #4682B4); text-align: center; color: white; padding: 20px;">
                        <tr>
                            <td>
                                <h1 style="font-size: 24px; margin: 0;">Reset Your Password</h1>
                                <p style="font-size: 16px; margin: 10px 0;">We received a request to reset your SmileSync password. Click the button below to set a new password:</p>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; padding: 20px;">
                        <tr>
                            <td align="center">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                    <tr>
                                        <td align="center" style="padding: 20px;">
                                            <table width="100" height="100" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 50%; margin: 0 auto; border: 2px solid #6A5ACD;">
                                                <tr>
                                                    <td align="center" style="font-size: 24px; color: #6A5ACD; line-height: 100px;">🔒</td>
                                                </tr>
                                            </table>
                                            <h2 style="font-size: 20px; color: #4682B4; margin: 20px 0 10px;">Set a New Password</h2>
                                            <p style="font-size: 14px; color: #333333; margin: 0 0 20px;">Click the button below to reset your password. If you didn't request this, please ignore this email.</p>
                                            <a href="${resetLink}" style="display: inline-block; padding: 12px 20px; background-color: #4682B4; color: #ffffff; text-decoration: none; border-radius: 25px; font-size: 16px; font-weight: bold;">Reset Password</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="text-align: center; padding: 20px; background-color: #f0f8ff; color: #777777;">
                        <tr>
                            <td>
                                <p style="font-size: 12px; margin: 0;">&copy; 2024 SmileSync. All rights reserved.</p>
                                <p style="font-size: 12px; margin: 0;"><a href="#" style="color: #4682B4; text-decoration: none;">Privacy Policy</a> | <a href="#" style="color: #4682B4; text-decoration: none;">Terms of Service</a></p>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
              `,
            };

            try {
                const response = await axios.post(SERVER_URL, emailData, {
                    headers: { "Content-Type": "application/json" },
                });
                alert("Email sent successfully: " + response.data.message);
                //resetPasswordModal.remove('show'); // Hide the modal after sending email
                //successModal.classlist.add('show'); //Show modal after sending email
                document.getElementById('resetPasswordForm').reset();
            } catch (error) {
                alert("Error sending email: " + (error.response?.data?.message || error.message));
            }
        };

        // Check email existence first
        checkEmail();
    });
});


</script>
<!--script src="js/email/forgetPasswordEmail.js"></script-->

</body>
</html>
