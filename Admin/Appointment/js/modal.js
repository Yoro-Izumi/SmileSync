document.addEventListener('DOMContentLoaded', function () {
    const existingAccountModal = document.getElementById('existingAccountModal');
    const newAccountModal = document.getElementById('newAccountModal');

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

// Show the appointmentDoneModal
const statusBtns = document.querySelectorAll('.appointmentStatus');
statusBtns.forEach((statusBtn) => {
    statusBtn.addEventListener('click', function () {
        appointmentDoneModal.classList.add('show');
    });
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
       existingAccountModal.classList.remove('show');
        deleteExistingProgressModal.classList.add('show');
    });

    // Show the deleteProgressModal for new account
    deleteNewProgressBtn.addEventListener('click', function () {
        newAccountModal.classList.remove('show');
        deleteNewProgressModal.classList.remove('show');
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

    // Close all progress modals
    deleteNewProgressBtn.addEventListener('click', function () {
        deleteNewProgressModal.classList.remove('show');
    });

    deleteExistingProgressBtn.addEventListener('click', function () {
        deleteExistingProgressModal.classList.remove('show');

    });
});






// Handle Dynamic Button Actions
const setupDynamicActions = () => {
    document.body.addEventListener("click", (event) => {
        // Handle Appointment Status Click
        if (event.target.closest(".appointmentStatus")) {
            const itemElement = event.target.closest(".appointmentStatus");
            const itemId = itemElement.dataset.id;

            // Set the appointment ID in the hidden input
            document.getElementById("done_appointment_id").value = itemId;

            // Function to fetch and populate appointment details
            const fetchAppointmentDetails = (url, itemId, onSuccess) => {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: { id: itemId }, // Use itemId directly in the data object
                    dataType: "json",
                    success: (response) => {
                        if (!response.error) {
                            onSuccess(response); // Handle success
                        } else {
                            alert(response.error); // Show error message from backend
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error("AJAX Error:", status, error); // Log AJAX errors
                        alert("An error occurred while fetching appointment details.");
                    },
                });
            };


            // Populate and display the appointment done modal
            const populateAppointmentModal = (data) => {
                const modal = $("#appointmentDoneModal");

                modal.find(".personal-info2 .form-group2 span").eq(0).text(data.patient_name || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(1).text(data.patient_phone_number || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(2).text(data.patient_age || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(3).text(data.patient_sex || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(4).text(data.birth_date || "N/A");

                modal.find(".personal-info input").eq(0).val(data.address || "N/A");
                modal.find(".personal-info input").eq(1).val(data.city || "N/A");
                modal.find(".personal-info input").eq(2).val(data.province || "N/A");
                modal.find(".treatment-record input").eq(0).val(data.appointment_date_time || "N/A");
                modal.find(".treatment-record input").eq(1).val(data.procedure || "N/A");
                modal.find(".treatment-record input").eq(2).val(data.dentist || " ");
                modal.find(".treatment-record input").eq(3).val(data.tooth_count || " ");

                modal.fadeIn();
            };

            // Fetch and display appointment details
            fetchAppointmentDetails("appointment_crud/appointment_get.php", { id: itemId }, populateAppointmentModal);
        }
    });
};

// Initialize the dynamic button actions
setupDynamicActions();
