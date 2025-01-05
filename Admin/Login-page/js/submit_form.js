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
      showModal(successModal);
    });
  
// Registration form submission
const registerForm = document.getElementById('register_form');

registerForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const formData = new FormData(registerForm);

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
            showModal(successRegisterModal);
            registerForm.reset();
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
  
