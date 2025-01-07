document.addEventListener('DOMContentLoaded', function () {
    const existingAccountModal = document.getElementById('existingAccountModal');
    const newAccountModal = document.getElementById('newAccountModal');
    const proceedModal = document.getElementById('proceedModal');
    const deleteNewProgressModal = document.getElementById('deleteNewProgressModal');
    const deleteExistingProgressModal = document.getElementById('deleteExistingProgressModal');
    const appointmentDoneModal = document.getElementById('appointmentDoneModal');

    const closeDone = document.getElementById('closeDone');
 
    const newAccount = document.getElementById('newAccount');
    const cancelSubmitNewBtn = document.getElementById('cancelSubmitNewBtn');

    const deleteNewProgressBtn = document.getElementById('deleteNewProgressBtn');
    const cancelNewDeleteBtn = document.getElementById('cancelNewDeleteBtn');

    const existingAccount = document.getElementById('existingAccount');
    const cancelSubmitExistingBtn = document.getElementById('cancelSubmitExistingBtn');
    const deleteExistingProgressBtn = document.getElementById('deleteExistingProgressBtn');
    const cancelExistingDeleteBtn = document.getElementById('cancelExistingDeleteBtn');

    const submitExistingBtn = document.getElementById('submitExistingBtn');
    const submitNewBtn = document.getElementById('submitNewBtn');

    const getAppointmentBtn = document.getElementById('getAppointmentBtn');
    const cancelProceedBtn = document.getElementById('cancelProceedBtn');

    // For Proceed to registration modal
    getAppointmentBtn.addEventListener('click', function () {
        proceedModal.classList.add('show');
    });

    cancelProceedBtn.addEventListener('click', function () {
        proceedModal.classList.remove('show');
    });

    // Close the appointmentDoneModal
    closeDone.addEventListener('click', function () {
        appointmentDoneModal.classList.remove('show');
    });

    // Show the newAccountModal
    newAccount.addEventListener('click', function () {
        newAccountModal.classList.add('show');
    });

    // Close the newAccountModal
    cancelSubmitNewBtn.addEventListener('click', function () {
        newAccountModal.classList.remove('show');
        deleteNewProgressModal.classList.add('show');
    });

    // Show the existingAccountModal
    existingAccount.addEventListener('click', function () {
        existingAccountModal.classList.add('show');
    });

    // Close the existingAccountModal
    cancelSubmitExistingBtn.addEventListener('click', function () {
        existingAccountModal.classList.remove('show');
        deleteExistingProgressModal.classList.add('show');
    });

    // Show the appointmentSuccessModal when existingAccountModal is submitted
    submitExistingBtn.addEventListener('click', function () {
        existingAccountModal.classList.remove('show');
    });

    // Show the appointmentSuccessModal when newAccountModal is submitted
    submitNewBtn.addEventListener('click', function () {
        newAccountModal.classList.remove('show');
    });

    // Show the deleteProgressModal for existing account
    deleteExistingProgressBtn.addEventListener('click', function () {
        deleteExistingProgressModal.classList.add('show');
        existingAccountModal.classList.remove('show');
    });

    // Show the deleteProgressModal for new account
    deleteNewProgressBtn.addEventListener('click', function () {
        deleteNewProgressModal.classList.add('show');
        newAccountModal.classList.remove('show');
    });

    // Close the deleteProgressModal for new account
    cancelNewDeleteBtn.addEventListener('click', function () {
        deleteNewProgressModal.classList.remove('show');
        newAccountModal.classList.add('show');
    });

    // Close the deleteProgressModal for existing account
    cancelExistingDeleteBtn.addEventListener('click', function () {
        deleteExistingProgressModal.classList.remove('show');
        existingAccountModal.classList.add('show');
    });

    // Removed the duplicate event listeners for closing the deleteProgress modals
    // deleteNewProgressBtn.addEventListener('click', function () {
    //     deleteNewProgressModal.classList.remove('show');
    // });

    // deleteExistingProgressBtn.addEventListener('click', function () {
    //     deleteExistingProgressModal.classList.remove('show');
    // });
});
