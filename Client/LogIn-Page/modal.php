<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css" />
</head>

<body>

<!-- Success Modal -->
<div class="modal" style="display: none;" id="successModal">
    <div class="modal-content">
    <div class="image-container">
            <img class="image" src="img/check.png" alt="security">
        </div>

        <div class="modal-title success-title"">Success!</div>
        <div class="message-container">
        <div class="modal-description">
            We have sent a link to your email.
            Please click on the link to reset your password.
        </div></div>
        <button id="closeSuccessModalBtn" class="modal-button success">OK</button>
    </div>
</div>

 
<div class="modal" style="display: none;" id="resetPasswordModal">
    <form id="resetPasswordForm" name="resetPasswordForm">
    <div class="modal-content">

    <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>

        <div class="modal-title warning-title">Reset Password</div>

        <div class="message-container">
        <div class="modal-description">To reset your password, enter your email address.</div>
        <div class="input-wrap">
            <input
                type="text"
                id="emailInputReset"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="emailInput">Email<indicator>*</indicator></label>
        </div></div>
        <button class="modal-button warning" type="submit" id="submitResetPasswordBtn">Submit</button>
        <button class="modal-button secondary-button" id="cancelButton">Cancel</button>
    </div>
    </form>



    <div class="modal" style="display: none;" id="noEmailModal">
    <div class="modal-content">

        <div class="modal-title warning-title">EMAIL NOT FOUND</div>

        <div class="message-container">
        <div class="modal-description">We are sorry but the email address you entered was not found.
            Please try entering an existing SmileSync account or
            <a href='https://smilesync.site/SmileSync/Client/Register/Register-Page.php'>Register</a>
        </div></div>
        <button class="modal-button warning" id="closeNoEmailModal">Ok</button>
    </div>
</div>

    <script>
    $(document).ready(function () {
      $('#resetPasswordForm').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting traditionally

        const to = $('#emailInputReset').val();

        $.ajax({
          url: 'js/forgetPasswordEmail.js', // Your Node.js server endpoint
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({ to, subject, text }),
          success: function (response) {
            alert(response.message);
          },
          error: function (error) {
            alert('Error sending email: ' + error.responseJSON.message);
          },
        });
      });
    });
  </script>
</div>


<!-- Modal -->
<div id="registerModal" class="modal" style="display: none;">
  <div class="modal-content">
    <h2>Register New Account</h2>
    <p>
      Upon registering for a new account, user must be informed of the information needed in order to register:
    </p>
    <ul>
      <li><strong>Personal Information:</strong>
        <ul>
          <li>First Name</li>
          <li>Last Name</li>
          <li>Birth Date</li>
          <li>Phone Number</li>
          <li>Email Address</li>
        </ul>
      </li>
      <li><strong>Medical Information:</strong>
        <ul>
          <li>Health Form</li>
          <li>Recent Travel (Yes/No)</li>
          <li>Symptoms (e.g., fever, cough, etc.)</li>
          <li>Dental History</li>
        </ul>
      </li>
    </ul>
    <p>If user agrees to the terms, you may now proceed to Registration.</p>
    <div class="modal-buttons">
      <button class="btn proceed">Proceed</button>
      <button class="btn cancel">Cancel</button>
    </div>
  </div>
</div>



  <script src="js/modal.js"></script>
</body>
</html>
