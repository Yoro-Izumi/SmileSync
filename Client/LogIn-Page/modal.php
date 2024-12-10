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

        <div class="message-container">
        <div class="modal-description">To reset your password, enter your email address.</div>
        <div class="input-wrap">
            <input
                type="text"
                id="emailInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="emailInputReset">Email<indicator>*</indicator></label>
        </div></div>
        <button class="modal-button warning" id="submitResetPasswordBtn">Submit</button>
        <button class="modal-button secondary-button" id="cancelButton">Cancel</button>
    </div>
</div>


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




    <script src="js/modal.js"></script>
</body>
</html>
