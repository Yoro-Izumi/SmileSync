document.addEventListener('DOMContentLoaded', function () {
  const loginFailedModal = document.getElementById('loginFailedModal');
  const emailExistsModal = document.getElementById('emailExistsModal');
  const passwordMismatchModal = document.getElementById('passwordMismatchModal');
  const successModal = document.getElementById('successModal');
  const successRegisterModal = document.getElementById('successRegisterModal');
  const resetPasswordModal = document.getElementById('resetPasswordModal');
  const noEmailModal = document.getElementById('noEmailModal');
  const privacyPolicyModal = document.getElementById('privacyPolicyModal');
  const termServicesModal = document.getElementById('termServicesModal');

  const registerBtn = document.getElementById('registerBtn');
  const closeSuccessRegisterBtn = document.getElementById('closeSuccessRegisterBtn');
  const showLoginFailedBtn = document.getElementById('loginBtn');
  const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtn');
  const closeResetPasswordBtn = document.getElementById('cancelButton');
  const resetPasswordLink = document.getElementById('resetPasswordLink');
  const resetLink = document.getElementById('forgotLink');
  const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
  const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
  const closeExistEmailModalBtn = document.getElementById('close-emailExistModal');

  // Helper function to show modals
  function showModal(modal) {
    if (modal) modal.classList.add('show');
  }

  // Helper function to hide modals
  function hideModal(modal) {
    if (modal) modal.classList.remove('show');
  }

  // Close modal events
  closeLoginFailedBtn.addEventListener('click', function () {
    hideModal(loginFailedModal);
  });

  closeSuccessRegisterBtn.addEventListener('click', function () {
    hideModal(successRegisterModal);
    const form = document.getElementById('register_form');
    if (form) form.reset(); // Reset the form after successful registration
  });

  closeSuccessModalBtn.addEventListener('click', function () {
    hideModal(successModal);
  });

  closeExistEmailModalBtn.addEventListener('click', function () {
    hideModal(emailExistsModal);
  });

  closeResetPasswordBtn.addEventListener('click', function () {
    hideModal(resetPasswordModal);
  });

  // Handle reset password link click
  resetPasswordLink.addEventListener('click', function () {
    hideModal(loginFailedModal);
    showModal(resetPasswordModal);
  });

  resetLink?.addEventListener('click', function () {
    showModal(resetPasswordModal);
  });

  submitResetPasswordBtn.addEventListener('click', function () {
    hideModal(resetPasswordModal);
    //showModal(successModal);
  });

  // Handle privacy policy and terms of service link clicks
  document.querySelectorAll("a[href='privacyPolicy']").forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      showModal(privacyPolicyModal);
    });
  });

  document.querySelectorAll("a[href='termServices']").forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      showModal(termServicesModal);
    });
  });



  // Login form submission
  showLoginFailedBtn.addEventListener('click', function (e) {
    e.preventDefault();
    const form = document.getElementById('login_form');
    const formData = new FormData(form);

    if (form.checkValidity()) {
      $.ajax({
        type: 'POST',
        url: 'login_code.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.trim() === 'error') {
            showModal(loginFailedModal);
          } else if (response.trim() === 'success') {
            location.reload(); // Reload the page on successful login
          }
        },
        error: function (xhr) {
          console.error(xhr.responseText);
          showModal(loginFailedModal);
        },
        complete: function () {
          showLoginFailedBtn.disabled = false; // Re-enable the button
        },
      });
    } else {
      form.reportValidity(); // Trigger HTML5 form validation
    }
  });
});



  // Registration form submission
  const registerForm = document.getElementById('register_form');
  registerForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(registerForm);
    const email = document.getElementById('emailRegister').value.trim();

    // Debug: Log form data before submission
    for (const [key, value] of formData.entries()) {
      console.log(`${key}: ${value}`);
    }

    if (registerForm.checkValidity()) {
      $.ajax({
        type: 'POST',
        url: 'register_code.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log(response); // Debug server response
          switch (response.trim()) {
            case 'error:Email already exists':
              showModal(emailExistsModal);
              break;
            case 'error:Passwords do not match':
              showModal(passwordMismatchModal);
              break;
            case 'success':
              //showModal(successRegisterModal);
              registerForm.reset();

              
              const SERVER_URL = "http://localhost:4000/send-email"; // Replace with your server's URL
          
              // Email details
              const emailData = {
                to: email, 
                subject: "Welcome to SmileSync!",
                html:`
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center;">
            <!-- Landing Page Background -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #89CFF0; text-align: center; color: white; padding: 20px;">
                <tr>
                    <td>
                        <h1 style="font-size: 24px; margin: 0;">Welcome to SmileSync!</h1>
                        <p style="font-size: 16px; margin: 10px 0;">Say goodbye to scheduling stress and hello to effortless dental care! 🦷✨
        
        With Smile Sync, booking your dental appointments has never been easier.</p>
                    </td>
                </tr>
            </table>
            <!-- Floating Email Container -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto; padding: 20px;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 10px; margin: -40px auto 20px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                            <tr>
                                <td align="center" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                                    <!-- Teeth Icon -->
                                    <table width="100" height="100" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 50%; margin: 0 auto; border: 2px solid #89CFF0;">
                                        <tr>
                                            <td align="center" style="font-size: 24px; color: #89CFF0; line-height: 100px;">🦷</td>
                                        </tr>
                                    </table>
                                    <h2 style="font-size: 20px; color: #4682B4; margin: 20px 0 10px;">See your dental appointment now with Smile Sync</h2>
                                    <p style="font-size: 14px; color: #333333; margin: 0 0 20px;">Be the first to book an appointment early. Click below to dive into action now!</p>
                                    <a href="http://localhost/SmileSync/Admin/Login-page" style="display: inline-block; padding: 12px 20px; background-color: #4682B4; color: #ffffff; text-decoration: none; border-radius: 25px; font-size: 16px; font-weight: bold;">Visit SmileSync</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Footer Section -->
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
          
              // Function to send email
              const sendEmail = async () => {
                try {
                  const response = await axios.post(SERVER_URL, emailData, {
                    headers: {
                      "Content-Type": "application/json",
                    },
                  });
                  alert("Email sent successfully: " + response.data.message);
                } catch (error) {
                  alert("Error sending email: " + (error.response?.data?.message || error.message));
                }
              };
          
              // Call sendEmail when form is submitted
              sendEmail();
              break;
            case 'error:Problem with form submission':
              console.error('Problem with form submission');
              break;
            default:
              console.error('Unexpected response:', response);
          }
        },
        error: function (xhr) {
          console.error(xhr.responseText); // Debug server error
        },
      });
    } else {
      registerForm.reportValidity();
    }
  });
