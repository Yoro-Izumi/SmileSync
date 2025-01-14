document.addEventListener('DOMContentLoaded', () => {
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