document.addEventListener('DOMContentLoaded', function() {
    const existingAccountModal = document.getElementById('existingAccountModal');
    const newAccountModal = document.getElementById('newAccountModal');
    const successModal = document.getElementById('successModal');
    const deleteProgressModal = document.getElementById('deleteProgressModal');
    
    const newAccountBtn = document.getElementById('newAccount');
    const cancelBtnn = document.getElementById('cancelBtnn');

    const existingAccountBtn = document.getElementById('existingAccount');
    const cancelBtn = document.getElementById('cancelBtn');

    const submitBtn = document.getElementById('submitBtn');
    const submitNewBtn = document.getElementById('submitNewBtn');
    const closeSuccessBtn = document.getElementById('closeSuccessModalBtn');

    const deleteProgressBtn = document.getElementById('deleteProgressBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    // Show the new Account modal
    newAccountBtn.addEventListener('click', function() {
        newAccountModal.classList.add('show');
    });

    // Close the new Account modal
    /*cancelBtnn.addEventListener('click', function() {
        newAccountModal.classList.remove('show');
    });*/

       // Show the existingModal modal
       existingAccountBtn.addEventListener('click', function() {
        existingAccountModal.classList.add('show');
    });

     // Close the existing account modal
    /* cancelBtn.addEventListener('click', function() {
        existingAccountModal.classList.remove('show');
    });*/

     // Show the success modal
     submitBtn.addEventListener('click', function() {
        existingAccountModal.classList.remove('show');
        successModal.classList.add('show');
    });

     // Show the success modal
     submitNewBtn.addEventListener('click', function() {
        newAccountModal.classList.remove('show')
        successModal.classList.add('show');
    });

    // Close the success modal
    closeSuccessBtn.addEventListener('click', function() {
        successModal.classList.remove('show');
    });

    // Show the delete progress modal
    cancelBtn.addEventListener('click', function() {
        deleteProgressModal.classList.add('show');
    });
    
    // Show the delete progress modal
    cancelBtnn.addEventListener('click', function() {
        deleteProgressModal.classList.add('show');
    });


    // Close the delete progress modal
    cancelDeleteBtn.addEventListener('click', function() {
        deleteProgressModal.classList.remove('show');
    });

    // Close all progress modal
    deleteProgressBtn.addEventListener('click', function() {
        deleteProgressModal.classList.remove('show');
        newAccountModal.classList.remove('show')
        existingAccountModal.classList.remove('show');
    });
 
});
