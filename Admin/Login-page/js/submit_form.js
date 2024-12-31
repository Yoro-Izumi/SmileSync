document.addEventListener('DOMContentLoaded', function() {
  const loginFailedModal = document.getElementById('loginFailedModal');
  const emailExistsModal = document.getElementById('emailExistsModal');
  const passwordMismatchModal = document.getElementById('passwordMismatchModal');
  const successModal = document.getElementById('successModal');
  const successRegisterModal = document.getElementById('successRegisterModal');
  const errorModal = document.getElementById('errorModal');
  
  const registerBtn = document.getElementById('registerBtn');
  const closeSuccessRegisterBtn = document.getElementById('closeSuccessRegisterBtn');
  const showLoginFailedBtn = document.getElementById('loginBtn');
  const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtn');
  
  const resetPasswordLink = document.getElementById('resetPasswordLink');
  const resetLink = document.getElementById('forgotLink');
  const closeResetPasswordBtn = document.getElementById('cancelButton');
  
  const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
  const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

  // Event listeners for handling modals and form submissions
  showLoginFailedBtn.addEventListener('click', function() {
      loginFailedModal.classList.add('show');
  });

  closeLoginFailedBtn.addEventListener('click', function() {
      loginFailedModal.classList.remove('show');
  });

  registerBtn.addEventListener('click', function() {
      successRegisterModal.classList.add('show');
  });

  closeSuccessRegisterBtn.addEventListener('click', function() {
      successRegisterModal.classList.remove('show');
  });

  closeSuccessModalBtn.addEventListener('click', function() {
      successModal.classList.remove('show');
  });

  // Handle registration form submission
  document.getElementById('registerBtn').addEventListener('click', function(e) {
      e.preventDefault();
      var form = document.getElementById('register_form');
      var formData = new FormData(form);

      if (form.checkValidity()) {
          this.disabled = true;  // Disable button to prevent further submissions during process

          $.ajax({
              type: "POST",
              url: "register_code.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                  form.reset();  // Reset the registration form
                  if (response.trim() === "error:Email already exists") {
                      emailExistsModal.classList.add('show');  // Show email exists modal
                  } else if (response.trim() === "error:Passwords do not match") {
                      passwordMismatchModal.classList.add('show');  // Show password mismatch modal
                  } else if (response.trim() === "success") {
                      successRegisterModal.classList.add('show');  // Show success modal
                      sessionStorage.setItem("registerFormSubmitted", "true");  // Mark as submitted
                  } else {
                      errorModal.classList.add('show');  // Show the generic error modal
                  }
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  errorModal.classList.add('show');  // Show the generic error modal on AJAX failure
              },
              complete: function() {
                  document.getElementById('registerBtn').disabled = false;  // Re-enable the register button
              }
          });
      } else {
          form.reportValidity();  // Trigger HTML5 form validation if the form is invalid
      }
  });

  // Handle login form submission
  document.getElementById('loginBtn').addEventListener('click', function(e) {
      e.preventDefault();
      var form = document.getElementById('login_form');
      var formData = new FormData(form);

      if (form.checkValidity()) {
          this.disabled = true;  // Disable button to prevent further submissions during process

          $.ajax({
              type: "POST",
              url: "login_code.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                  if (response.trim() === "error") {
                      loginFailedModal.classList.add('show');  // Show login failed modal
                  } else if (response.trim() === "success") {
                      successModal.classList.add('show');  // Show success modal
                  }
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  loginFailedModal.classList.add('show');  // Show login failed modal on error
              },
              complete: function() {
                  document.getElementById('loginBtn').disabled = false;  // Re-enable the login button
              }
          });
      } else {
          form.reportValidity();  // Trigger HTML5 form validation
      }
  });

  // Modal events for closing the modals
  document.getElementById('closeSuccessRegisterBtn').addEventListener('click', function() {
      successRegisterModal.classList.remove('show');
  });

  document.getElementById('closeLoginFailedBtn').addEventListener('click', function() {
      loginFailedModal.classList.remove('show');
  });

  document.getElementById('closeResetPasswordBtn').addEventListener('click', function() {
      resetPasswordModal.classList.remove('show');
  });

  // Reset password modal event
  resetPasswordLink.addEventListener('click', function() {
      loginFailedModal.classList.remove('show');
      resetPasswordModal.classList.add('show');
  });

  resetLink.addEventListener('click', function() {
      resetPasswordModal.classList.add('show');
  });

  submitResetPasswordBtn.addEventListener('click', function() {
      resetPasswordModal.classList.remove('show');
      successModal.classList.add('show');
  });

  closeSuccessModalBtn.addEventListener('click', function() {
      successModal.classList.remove('show');
  });
});
