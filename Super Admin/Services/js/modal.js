document.addEventListener('DOMContentLoaded', function() {
    //Modal
    const viewDetailsModal = document.getElementById('viewServiceModal');
    const deleteProgressModal = document.getElementById('deleteProgressModal');
    const addServiceModal = document.getElementById('addServiceModal');
    const editModal = document.getElementById('editModal');
    const confirmEditModal = document.getElementById('confirmEditModal'); 
    const deleteServicesModal = document.getElementById('removeServicesModal'); 
    //Buttons
    const viewDetailsBtn = document.getElementById('viewServices'); 
    const okViewBtn = document.getElementById('okView');

    const addServicesBtn = document.getElementById('addServices');
    const addServiceBtn = document.getElementById('addServiceBtn');
    const cancelAddServiceBtn = document.getElementById('cancelAddServiceBtn');

    const deleteProgressBtn = document.getElementById('deleteNewProgressBtn');
    const cancelDeleteProgressBtn = document.getElementById('cancelNewDeleteBtn');

    const editServiceBtn = document.getElementById('editServicesTable');
    const editBtn = document.getElementById('editBtn');
    const cancelEditBtn = document.getElementById('cancelEditServiceBtn');

    const confirmEditBtn = document.getElementById('confirmEditBtn');
    const cancelConfirmEditBtn = document.getElementById('cancelConfirmEditBtn');

    const deleteServicesBtn = document.getElementById('deleteServicesTable');
    const removeServiceBtn = document.getElementById('removeServiceBtn');
    const cancelDeleteServicesBtn = document.getElementById('cancelRemoveServiceBtn');

    // Show View Details of Service and Service History
    viewDetailsBtn.addEventListener('click', function(){
        viewDetailsModal.classList.add('show');
    });

    // Close View Details Modal
    okViewBtn.addEventListener('click', function(){
        viewDetailsModal.classList.remove('show');
    });

    // Add New Service Modal
    addServicesBtn.addEventListener('click', function(){
        addServiceModal.classList.add('show');
    });

    addServiceBtn.addEventListener('click', function(){
        addServiceModal.classList.remove('show');
    });
    // Show if progress must continue modal   
    cancelAddServiceBtn.addEventListener('click', function(){
        deleteProgressModal.classList.add('show');
    });
    
    cancelDeleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
    });

    deleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
        addServiceModal.classList.remove('show');
    });

    // Show Edit Service Modal
    editServiceBtn.addEventListener('click', function(){
        editModal.classList.add('show');
        viewDetailsModal.classList.remove('show');
    });

    cancelEditBtn.addEventListener('click', function(){
        editModal.classList.remove('show');
    });
    
    // Confirm to edit Service Modal-------
    editBtn.addEventListener('click', function(){
        confirmEditModal.classList.add('show');
    });

    confirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
        editModal.classList.remove('show');
    });

    cancelConfirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
    });
       

    // Show Delete Services modal----------
    deleteServicesBtn.addEventListener('click', function() {
        deleteServicesModal.classList.add('show');
    }); 

    cancelDeleteServicesBtn.addEventListener('click', function() {
        deleteServicesModal.classList.remove('show');
    });

    // Close/Discard Delete Services Modal
    removeServiceBtn.addEventListener('click', function() {
        deleteServicesModal.classList.remove('show');
    });

});


document.addEventListener('DOMContentLoaded', function () {

    // Function to open a modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
        }
    }

    // Function to close a modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Attach event listeners to elements with the 'data-modal' attribute
    document.querySelectorAll('[data-modal]').forEach(element => {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            const modalId = this.getAttribute('data-modal');
            openModal(modalId);
        });
    });

    // Attach event listeners to elements with the 'data-cancel-modal' attribute
    document.querySelectorAll('[data-cancel-modal]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-cancel-modal');
            closeModal(modalId);
        });
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});

$(document).ready(function() {
    $('#addServiceForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Serialize form data
        var formData = $(this).serialize();

        // Send the form data to Service-page.php using AJAX
        $.ajax({
            url: 'service_crud/add_service.php', // The PHP file to handle the submission
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle the response from the PHP file (success)
                // For example, you can display a success message
                alert('Service added successfully!');
                
                // Optionally, close the modal after successful submission
               // $('#addServiceModal').hide(); // Hide the modal (adjust with your modal ID)
            },
            error: function(xhr, status, error) {
                // Handle errors (e.g., display an error message)
                alert('There was an error adding the service. Please try again.');
            }
        });
    });

    // Cancel button functionality to close the modal
    $('#cancelAddServiceBtn').on('click', function() {
        $('#addServiceModal').hide(); // Hide the modal (adjust with your modal ID)
    });
});


$(document).ready(function() {
    $('#editServiceForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Serialize form data
        var formData = $(this).serialize();

        // Send the form data to Service-page.php using AJAX
        $.ajax({
            url: 'service_crud/edit_service.php', // The PHP file to handle the submission
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle the response from the PHP file (success)
                // For example, you can display a success message
                alert('Service added successfully!');
                
                // Optionally, close the modal after successful submission
               // $('#addServiceModal').hide(); // Hide the modal (adjust with your modal ID)
            },
            error: function(xhr, status, error) {
                // Handle errors (e.g., display an error message)
                alert('There was an error adding the service. Please try again.');
            }
        });
    });

    // Cancel button functionality to close the modal
    $('#cancelAddServiceBtn').on('click', function() {
        $('#addServiceModal').hide(); // Hide the modal (adjust with your modal ID)
    });
});
