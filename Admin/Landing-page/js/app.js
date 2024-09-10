document.addEventListener('DOMContentLoaded', function() {
    const loginFailedModal = document.getElementById('loginFailedModal');
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    const successModal = document.getElementById('successModal');

    const showLoginFailedBtn = document.getElementById('loginBtn');
    const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtn');
    const resetPasswordLink = document.getElementById('resetPasswordLink');
    const closeResetPasswordBtn = document.getElementById('cancelButton');
    const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    // Show the login failed modal
    showLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.add('show');
    });

    // Close the login failed modal
    closeLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.remove('show');
    });

    // Show the reset password modal when clicking the reset password link
    resetPasswordLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        loginFailedModal.classList.remove('show');
        resetPasswordModal.classList.add('show');
    });

    // Close the reset password modal (Cancel button)
    closeResetPasswordBtn.addEventListener('click', function() {
        resetPasswordModal.classList.remove('show');
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
