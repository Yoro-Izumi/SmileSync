document.addEventListener('DOMContentLoaded', function() {
    const loginFailedModal = document.getElementById('loginFailedModal');
    const resetPasswordModal = document.getElementById('resetPasswordModal');
    const successModal = document.getElementById('successModal');
    const privacyPolicyModal = document.getElementById('privacyPolicyModal');
    const termServicesModal = document.getElementById('termServicesModal');
    const successRegisterModal = document.getElementById('successRegisterModal');
    
    
    const registerBtn = document.getElementById('registerBtn');
    const closeSuccessRegisterBtn = document.getElementById('closeSuccessRegisterBtn');

    const showLoginFailedBtn = document.getElementById('loginBtn');
    const closeLoginFailedBtn = document.getElementById('closeLoginFailedBtn');

    const termServices = document.getElementById('termServices');
    const closetermServicesBtn = document.getElementById('closetermServicesBtn');

    const privacyPolicy = document.getElementById('privacyPolicy');
    const closePrivacyPolicyBtn = document.getElementById('closePrivacyPolicyBtn');

    const resetPasswordLink = document.getElementById('resetPasswordLink');
    const resetLink = document.getElementById('forgotLink');
    const closeResetPasswordBtn = document.getElementById('cancelButton');

    const submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    // Show the login failed modal
    showLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.add('show');
    });

    // Close the terms failed modal
    closetermServicesBtn.addEventListener('click', function() {
        termServicesModal.classList.remove('show');
    });

       // Show the register modal
       registerBtn.addEventListener('click', function() {
        successRegisterModal.classList.add('show');
    });

     // Close the closeSuccessRegisterBtn modal
     closeSuccessRegisterBtn.addEventListener('click', function() {
        successRegisterModal.classList.remove('show');
    });

     // Show the terms and services modal
     termServices.addEventListener('click', function() {
        termServicesModal.classList.add('show');
    });

    // Close the terms and services modal
    closeLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.remove('show');
    });

    // Show the privacy policy modal
    privacyPolicy.addEventListener('click', function() {
        privacyPolicyModal.classList.add('show');
    });

    // Close the privacy policy  modal
    closePrivacyPolicyBtn.addEventListener('click', function() {
        privacyPolicyModal.classList.remove('show');
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
