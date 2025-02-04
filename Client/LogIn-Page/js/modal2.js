document.addEventListener('DOMContentLoaded', function() {
    // Modal References
    const loginFailedModal = document.getElementById('loginFailedModalClient');
    const resetPasswordModalClient = document.getElementById('resetPasswordModalClient');
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    const successModal = document.getElementById('resetSuccessModal');
    const noEmailModal = document.getElementById('noEmailModal');
    const emailExistsModal = document.getElementById('emailExistsModal');

    // Button References
    const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtnn');
    const resetPasswordLink = document.getElementById('resetPasswordLink');
    const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');
    const closeNoEmailModalBtn = document.getElementById('closeNoEmailModal');
    const closeEmailExistModalBtn = document.getElementById('close-emailExistModal');
    const cancelButton = document.getElementById('cancelButton');

    // Helper Functions
    const showModal = (modal) => modal.style.display = 'block';
    const hideModal = (modal) => modal.style.display = 'none';

    // Close Login Failed Modal
    closeLoginFailedBtn.addEventListener('click', function() {
        hideModal(loginFailedModal);
    });

    // Show Reset Password Modal from Login Failed Modal
    resetPasswordLink.addEventListener('click', function(event) {
        event.preventDefault();
        hideModal(loginFailedModal);
        showModal(resetPasswordModalClient);
    });

    // Close Reset Password Modal
    cancelButton.addEventListener('click', function() {
        hideModal(resetPasswordModalClient);
        hideModal(resetPasswordModal);
    });

    // Close Success Modal
    closeSuccessModalBtn.addEventListener('click', function() {
        hideModal(successModal);
    });

    // Close No Email Modal
    closeNoEmailModalBtn.addEventListener('click', function() {
        hideModal(noEmailModal);
    });

    // Close Email Exists Modal
    closeEmailExistModalBtn.addEventListener('click', function() {
        hideModal(emailExistsModal);
    });

    // Handle Reset Password Form Submission
    $('#resetPasswordForm').submit(function(e) {
        e.preventDefault();
        const email = $('#emailInputReset').val();

        $.ajax({
            url: 'check_email.php',
            type: 'POST',
            data: { email: email },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Send reset email
                    sendResetEmail(email);
                } else {
                    showModal(noEmailModal);
                }
            },
            error: function() {
                alert('Error checking email. Please try again.');
            }
        });
    });

    // Send Reset Email
    const sendResetEmail = (email) => {
        const SERVER_URL = "http://localhost:4000/send-email";
        const resetLink = `https://smilesync.site/SmileSync/Client/Forgot%20Password/forgotPassword-page.php?email=${encodeURIComponent(email)}`;
        const emailData = {
            to: email,
            subject: "Forget Password",
            html: `Click <a href='${resetLink}'>here</a> to reset your password.`
        };

        axios.post(SERVER_URL, emailData, {
            headers: { "Content-Type": "application/json" }
        })
        .then(response => {
            hideModal(resetPasswordModalClient);
            showModal(successModal);
        })
        .catch(error => {
            alert("Error sending email: " + error.message);
        });
    };

    // AJAX form submission (for login form)
    $("#login_form").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "login_code.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);

                if (response.status === 'success') {
                    location.reload();
                } else {
                    $('#loginFailedModalClient').addClass('show');
                    $('#loginFailedModalClient .modal-message').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#loginFailedModalClient').addClass('show');
                $('#loginFailedModalClient .modal-message').text('An error occurred. Please try again.');
            },
            complete: function() {
                $("#loginClientBtn").prop("disabled", false);
            }
        });
    });
});
