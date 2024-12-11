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

    resetPasswordLink.addEventListener('click', function() {
        loginFailedModal.classList.remove('show');
        resetPasswordModal.classList.add('show');
    });

    closeResetPasswordBtn.addEventListener('click', function() {
        resetPasswordModal.classList.remove('show');
    });

    resetLink.addEventListener('click', function() {
        resetPasswordModal.classList.add('show');
    });

    submitResetPasswordBtn.addEventListener('click', function() {
        resetPasswordModal.classList.remove('show');
        successModal.classList.add('show');
    });

    closeSuccessModalBtn.addEventListener('click', function() {
        successModal.classList.remove('show');
    });
});
