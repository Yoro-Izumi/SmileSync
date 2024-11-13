document.addEventListener('DOMContentLoaded', function() {
    let loginFailedModal = document.getElementById('loginFailedModal');
    let resetPasswordModal = document.getElementById('resetPasswordModal');
    let successModal = document.getElementById('successModal');
    let privacyPolicyModal = document.getElementById('privacyPolicyModal');
    let termServicesModal = document.getElementById('termServicesModal');
    let successRegisterModal = document.getElementById('successRegisterModal');

    let registerBtn = document.getElementById('registerBtn');
    let closeSuccessRegisterBtn = document.getElementById('closeSuccessRegisterBtn');

    let showLoginFailedBtn = document.getElementById('loginBtn');
    let closeLoginFailedBtn = document.getElementById('closeLoginFailedBtn');

    let termServices = document.getElementById('termServices');
    let closetermServicesBtn = document.getElementById('closetermServicesBtn');

    let privacyPolicy = document.getElementById('privacyPolicy');
    let closePrivacyPolicyBtn = document.getElementById('closePrivacyPolicyBtn');

    let resetPasswordLink = document.getElementById('resetPasswordLink');
    let resetLink = document.getElementById('forgotLink');
    let closeResetPasswordBtn = document.getElementById('cancelButton');

    let submitResetPasswordBtn = document.getElementById('submitResetPasswordBtn');
    let closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    // Event listeners remain the same
    showLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.add('show');
    });

    closetermServicesBtn.addEventListener('click', function() {
        termServicesModal.classList.remove('show');
    });

    registerBtn.addEventListener('click', function() {
        successRegisterModal.classList.add('show');
    });

    closeSuccessRegisterBtn.addEventListener('click', function() {
        successRegisterModal.classList.remove('show');
    });

    termServices.addEventListener('click', function() {
        termServicesModal.classList.add('show');
    });

    closeLoginFailedBtn.addEventListener('click', function() {
        loginFailedModal.classList.remove('show');
    });

    privacyPolicy.addEventListener('click', function() {
        privacyPolicyModal.classList.add('show');
    });

    closePrivacyPolicyBtn.addEventListener('click', function() {
        privacyPolicyModal.classList.remove('show');
    });

    resetPasswordLink.addEventListener('click', function(event) {
        event.preventDefault();
        loginFailedModal.classList.remove('show');
        resetPasswordModal.classList.add('show');
    });

    closeResetPasswordBtn.addEventListener('click', function(event) {
        event.preventDefault();
        resetPasswordModal.classList.remove('show');
    });

    resetLink.addEventListener('click', function(event) {
        event.preventDefault();
        resetPasswordModal.classList.add('show');
    });

    submitResetPasswordBtn.addEventListener('click', function(event) {
        event.preventDefault();
        resetPasswordModal.classList.remove('show');
        successModal.classList.add('show');
    });

    closeSuccessModalBtn.addEventListener('click', function(event) {
        event.preventDefault();
        successModal.classList.remove('show');
    });
});
