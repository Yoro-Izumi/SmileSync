<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css" />
</head>

<body>


<!-- Login Failed Modal -->
<div class="modal" id="loginFailedModalClient" >
    <div class="modal-content">
        <b class="modal-title normal-title">Login Failed</b>

        <div class="image-container">
            <img class="image" src="img/security.png" alt="security">
        </div>
        
        <div class="message-container">
            <span class="modal-description">The email or password is incorrect. Please try again or </span>
            <a href="#" id="resetPasswordLink" class="reset-password">Reset Password</a>
        </div>
        <button id="closeLoginFailedBtnn" class="modal-button normal">OK</button>
    </div>
</div>


<div class="modal" id="resetPasswordModalClient">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>

        <div class="modal-title warning-title">Reset Password</div>
        <form id="resetPasswordForm" name="resetPasswordForm" method="POST">
            <div class="message-container">
                <div class="modal-description">To reset your password, enter your email address.</div>
                <div class="input-wrap">
                    <input
                        type="text"
                        id="emailInput"
                        name="emailInputPassword"
                        minlength="4"
                        class="modal-input"
                        autocomplete="off"
                        required
                    />
                    <label for="emailInputReset">Email<indicator>*</indicator></label>
                </div>
            </div>
            <button type="button" class="modal-button warning" id="submitResetPasswordBtn">Submit</button>    
            <button class="modal-button secondary-button" id="cancelButton">Cancel</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("resetPasswordForm");
  const submitButton = document.getElementById("submitResetPasswordBtn");
  const cancelButton = document.getElementById("cancelButton");

  // Prevent default form submission
  form.addEventListener("submit", (e) => e.preventDefault());

  // Handle Submit button click
  submitButton.addEventListener("click", () => {
    const emailInput = document.getElementById("emailInput");

    // Validate email input
    if (emailInput.value.trim() === "") {
      alert("Please enter your email address.");
      return;
    }

    // AJAX submission
    const formData = new FormData();
    formData.append("email", emailInput.value.trim());

    fetch("forgetPassword.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((responseText) => {
        console.log("Server Response:", responseText);

        // Parse server response
        if (responseText.includes("success:Email sent successfully!")) {
          $('#resetSuccessModal').show();
        } else {
          alert("Error: Unable to send email. " + responseText);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while sending the email. Please try again later.");
      });
  });

  // Optional: Cancel button behavior
  cancelButton.addEventListener("click", () => {
    form.reset(); // Clears the form
    $('#resetPasswordModalClient').hide();
  });
});

</script>



<!-- Success Modal -->
<div class="modal" id="resetSuccessModal">
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

<!-- Email Already Exists Modal -->
<div id="emailExistsModal" class="modal">
  <div class="modal-content">
    <h4>Email Already Exists</h4>
    <p>The email you entered is already registered. Please use a different email.</p>
    <div class="modal-footer">
    <button class="modal-close btn" id="close-emailExistModal">Close</button>
  </div>
  </div>
</div>


    <!--script src="js/modal.js"></script-->
</body>
</html>
