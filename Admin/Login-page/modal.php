<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css" />
</head>

<body>


<!-- Login Failed Modal -->
<div class="modal" id="loginFailedModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Login Failed</b>

        <div class="image-container">
            <img class="image" src="img/security.png" alt="security">
        </div>
        
        <div class="message-container">
            <span class="modal-description">The email or password is incorrect. Please try again or </span>
            <a href="#" id="resetPasswordLink" class="reset-password">Reset Password</a>
        </div>
        <button id="closeLoginFailedBtn" class="modal-button normal">OK</button>
    </div>
</div>


 
<div class="modal" id="resetPasswordModal">
    <form id="resetPasswordForm" name="resetPasswordForm">
    <div class="modal-content">

    <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>

        <div class="modal-title normal-title">Reset Password</div>

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


<!-- Success Modal -->
<div class="modal" id="successModal">
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



<div class="modal" id="noEmailModal">
    <div class="modal-content">

        <div class="modal-title warning-title">EMAIL NOT FOUND</div>

        <div class="message-container">
        <div class="modal-description">We are sorry but the email address you entered was not found.
            Please try entering an existing SmileSync account or
            href="#" id="registerLink">Register</a>
        </div>
        <button class="modal-button normal" id="okNoEmailBtn">Submit</button>
    </div>
</div>


<!-- Success Modal -->
<div class="modal" id="successRegisterModal">
    <div class="modal-content">
    <div class="image-container">
            <img class="image" src="img/check.png" alt="security">
        </div>

        <div class="modal-title success-title">Registration Complete!</div>
        <div class="message-container">
        <div class="modal-description">
            .Your information was successfully saved and is now undergoing review from the admin.
            Please wait for a confirmation to be sent to your email address.
        </div></div>
        <button id="closeSuccessRegisterBtn" class="modal-button success">OK</button>
    </div>
</div>


<!-- Privacy Policy Modal -->
<div class="modal" id="privacyPolicyModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Privacy Policy</b>
        
        <div class="longMessage-container">
        
        <span class="longMessage-description">At SmileSync,
             we take the privacy of our users seriously and are committed to protecting the personal information you share with us. This Privacy Policy outlines the types of information we collect, how we use it, 
             and the measures we take to safeguard your data. By using SmileSync, a dental software solution, you agree to the terms of this Privacy Policy.</span>
        <br>
        <h4>Information we collect</h4>
        <span class="longMessage-description">We collect the following types of information:</span>
        <br>
        <h5>Employee Data:</h5>
        <span class="longMessage-description"> 
        Names, contact details, employment records, and schedules.</span>
        <br>
        <h5>Account Information:</h5>
        <span class="longMessage-description"> 
        Names, emails, usernames, and passwords of users accessing the system.</span>
        <br>
        <span class="longMessage-description">By using SmileSync, you acknowledge that you have read and understood this Privacy Policy and agree to the collection, use, and disclosure of your information as outlined above.</span>
        <br>
        </div>
        <button id="closePrivacyPolicyBtn" class="modal-button normal">OK</button>
    </div>
</div>


<!-- Terms and Services Modal -->
<div class="modal" id="termServicesModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Terms and Services Agreement for SmileSync</b>
        
        <div class="longMessage-container">
        
        <span class="longMessage-description">Welcome to SmileSync! By using our services, you agree to comply with and be bound by the following Terms and Conditions.
             Please review these carefully. If you do not agree to these terms, you should not use this site or our services.</span>
        <br>
        <h4>Information we collect</h4>
        <span class="longMessage-description">We collect the following types of information:</span>
        <br>
        <h5>Employee Data:</h5>
        <span class="longMessage-description"> 
        Names, contact details, employment records, and schedules.</span>
        <br>
        <h5>Data Privacy</h5>
        <span class="longMessage-description"> 
        SmileSync is committed to protecting your personal and business information. Our use of any 
        personal data you provide to us is governed by our Privacy Policy</span>
        <br>
        <h5>Intellectual Property</h5>
        <span class="longMessage-description">All content, features, and functionality (including but not limited to software, design, text, graphics, and logos) provided by SmileSync are owned by or licensed to SmileSync and are protected by intellectual property laws.
             You agree not to reproduce, distribute, or otherwise exploit this content without our prior written permission. 
        </span>
        <br>
        <h5>Changes to Terms</h5>
        <span class="longMessage-description"> SmileSync reserves the right to modify these Terms at any time. Changes will be posted on our website and will be effective upon posting.
             Continued use of our services following any changes indicates your acceptance of the new terms.
        </span>
        <br>
      .l  </div>
        <button id="closetermServicesBtn" class="modal-button normal">OK</button>
    </div>
</div>

<!-- Email Already Exists Modal
<div id="emailExistsModal" class="modal">
  <div class="modal-content">
    <h4>Email Already Exists</h4>
    <p>The email you entered is already registered. Please use a different email.</p>
    <div class="modal-footer">
    <button class="modal-close btn" id="close-emailExistModal">Close</button>
  </div>
  </div>
</div>
 -->
<!-- Proceed Modal -->
<div class="modal" id="proceedModal">
    <div class="modal-content">
        <div class="modal-title success-title"">Register New Acccount</div>
        <div class="message-container">
        <div class="modal-description">
        Upon registering for a new account , user<br> must be informed of the information needed in order to register:
        <br>
        Personal Information
        <br>
        Health Information
        <br>
        If user agrees to the terms, you may now proceed to Registration.</br>
        </div></div>
        <button id="cancelProceedBtn" class="modal-button warning">Cancel</button>
        <button class="modal-button warning"><a  href="../Register/Register-Page.php">Cancel</a></button>
    </div>
</div>

<script>
        document.getElementById('submitResetPasswordBtn').addEventListener('click', function() {
            // Create a new script element
            var script = document.createElement('script');
            script.src = 'js/forgetPasswordEmail.js';  // Replace with your actual JS file path
            script.type = 'text/javascript';
            script.async = true;

            // Append the script tag to the document body or head
            document.head.appendChild(script);
        });
    </script>



</body>
</html>


