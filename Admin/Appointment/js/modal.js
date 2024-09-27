document.addEventListener('DOMContentLoaded', function () {
    const existingAccountModal = document.getElementById('existingAccountModal');
    const newAccountModal = document.getElementById('newAccountModal');
    const appointmentSuccessModal = document.getElementById('appointmentSuccessModal');
    const deleteProgressModal = document.getElementById('deleteProgressModal');
    const appointmentDoneModal = document.getElementById('appointmentDoneModal');

    const statusBtn = document.getElementById('appointmentStatus'); // Renamed from status to statusBtn
    const closeDone = document.getElementById('closeDone');

    const newAccount = document.getElementById('newAccount');
    const cancelSubmitNewBtn = document.getElementById('cancelSubmitNewBtn');

    const existingAccount = document.getElementById('existingAccount');
    const cancelSubmitExistingBtn = document.getElementById('cancelSubmitExistingBtn');

    const submitExistingBtn = document.getElementById('submitExistingBtn');
    const submitNewBtn = document.getElementById('submitNewBtn');
    const closeAppointmentSuccessBtn = document.getElementById('closeAppointmentSuccessBtn');

    const deleteProgressBtn = document.getElementById('deleteProgressBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    // Show the appointmentDoneModal
    statusBtn.addEventListener('click', function () {
        appointmentDoneModal.classList.add('show');
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
    });

    // Show the existingAccountModal
    existingAccount.addEventListener('click', function () {
        existingAccountModal.classList.add('show');
    });

    // Close the existingAccountModal
    cancelSubmitExistingBtn.addEventListener('click', function () {
        existingAccountModal.classList.remove('show');
    });

    // Show the appointmentSuccessModal when existingAccountModal is submitted
    submitExistingBtn.addEventListener('click', function () {
        existingAccountModal.classList.remove('show');
        appointmentSuccessModal.classList.add('show');
    });

    // Show the appointmentSuccessModal when newAccountModal is submitted
    submitNewBtn.addEventListener('click', function () {
        newAccountModal.classList.remove('show');
        appointmentSuccessModal.classList.add('show');
    });

    // Close the appointmentSuccessModal
    closeAppointmentSuccessBtn.addEventListener('click', function () {
        appointmentSuccessModal.classList.remove('show');
    });

    // Show the deleteProgressModal
    cancelSubmitExistingBtn.addEventListener('click', function () {
        deleteProgressModal.classList.add('show');
    });

    // Show the deleteProgressModal when newAccountModal is canceled
    cancelSubmitNewBtn.addEventListener('click', function () {
        deleteProgressModal.classList.add('show');
    });

    // Close the deleteProgressModal
    cancelDeleteBtn.addEventListener('click', function () {
        deleteProgressModal.classList.remove('show');
    });

    // Close all progress modals
    deleteProgressBtn.addEventListener('click', function () {
        deleteProgressModal.classList.remove('show');
        newAccountModal.classList.remove('show');
        existingAccountModal.classList.remove('show');
    });
});
