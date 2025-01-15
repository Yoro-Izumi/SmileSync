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

  // Show the login failed modal
  //showLoginFailedBtnn.addEventListener('click', function() {
  //    loginFailedModal.classList.add('show');
  //});


  // Close the terms and services modal
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

// Submit the reset password form and show the success modal
document.getElementById('submitResetPasswordBtn').addEventListener('submit', (e) => {
  e.preventDefault(); // Prevent default form submission

  const email = document.getElementById('emailInputReset').value;

  // Simulate AJAX request for sending the email
  $.ajax({
    url: 'js/forgetPasswordEmail.js', // Your server endpoint
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({ email }),
    success: function () {
      // Hide the reset password modal and show the success modal
      document.getElementById('resetPasswordModal').style.display = 'none';
      document.getElementById('successModal').style.display = 'flex';
    },
    error: function (error) {
      alert('Error sending email: ' + (error.responseJSON?.message || error.statusText));
    },
  });
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


});


