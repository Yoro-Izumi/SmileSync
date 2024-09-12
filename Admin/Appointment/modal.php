<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css" />
</head>

<body>


<div class="modal" id="existingAccountModal">
    <div class="modal-content">
        <div class="modal-title normal-title">Add Existing Account</div>
        <div class="modal-description">
            --Input data for new account--
        </div>
        <button class="modal-button secondary-button" id="cancelBtn">Cancel</button>
        <button class="modal-button normal" id="submitBtn">Submit</button>
    </div>
</div>


<div class="modal" id="newAccountModal">
    <div class="modal-content">
        <div class="modal-title normal-title">Add New Account</div>
        <div class="modal-description">
            --Input data for new account.--
        </div>
        <button class="modal-button secondary-button" id="cancelBtnn">Cancel</button>
        <button class="modal-button normal" id="submitNewBtn">Submit</button>
    </div>
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



<div class="modal" id="deleteProgressModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">DELETE PROGRESS</div>

        <div class="message-container">
        <div class="modal-description">
                All progress will be removed.
        </div>
        </div>
        <button class="modal-button normal" id="deleteProgressBtn">Delete</button>
        <button class="modal-button secondary-button warning" id="cancelDeleteBtn">Cancel</button>
    </div>
</div>


<!-- Success Modal -->
<div class="modal" id="successModal">
    <div class="modal-content">

        <div class="modal-title success-title">Appointment Added Successfully!</div>
        <div class="message-container">
        <div class="modal-description">
            Appointment was successflly added to the account. Please check email for confirmation.
        </div></div>
        <button id="closeSuccessBtn" class="modal-button success">OK</button>
    </div>
</div>


    <script src="js/modal.js"></script>
</body>
</html>
