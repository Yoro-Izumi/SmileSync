document.addEventListener('DOMContentLoaded', function() {
    const loginFailedModal = document.getElementById('loginFailedModal');
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    const successModal = document.getElementById('successModal');

    
    const showLoginFailedBtnn = document.getElementById('loginBtn');
    const closeLoginFailedBtnn = document.getElementById('closeLoginFailedBtnn');

    const resetPasswordLinkk = document.getElementById('resetPasswordLink');
    const resetLink = document.getElementById('forgotLink');
    const closeResetPasswordBtn = document.getElementById('cancelButton');

    const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    // Show the login failed modal
    showLoginFailedBtnn.addEventListener('click', function() {
        loginFailedModal.classList.add('show');
    });


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
});
