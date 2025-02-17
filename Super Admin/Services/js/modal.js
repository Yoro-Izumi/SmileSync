document.addEventListener('DOMContentLoaded', function () {
    // Helper functions to show and hide modals
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.add('show');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('show');
    }

    // Attach modal logic to buttons
    const buttons = [
        { triggerClass: 'viewServices', modal: 'viewServiceModal', action: 'show' },
        { trigger: 'okView', modal: 'viewServiceModal', action: 'hide' },
        { triggerClass: 'addServices', modal: 'addServiceModal', action: 'show' },
        { trigger: 'addServiceBtn', modal: 'addServiceModal', action: 'hide' },
        { trigger: 'cancelAddServiceBtn', modal: 'deleteProgressModal', action: 'show' },
        { trigger: 'cancelNewDeleteBtn', modal: 'deleteProgressModal', action: 'hide' },
        { trigger: 'deleteNewProgressBtn', modals: ['deleteProgressModal', 'addServiceModal'], action: 'hide' },
        { trigger: 'editServicesTable', modal: 'editModal', action: 'show' },
        { trigger: 'cancelEditServiceBtn', modal: 'editModal', action: 'hide' },
        { trigger: 'editBtn', modal: 'confirmEditModal', action: 'show' },
        { trigger: 'confirmEditBtn', modals: ['confirmEditModal', 'editModal'], action: 'hide' },
        { trigger: 'cancelConfirmEditBtn', modal: 'confirmEditModal', action: 'hide' },
        { triggerClass: 'removeServiceTable', modal: 'removeServiceModal', action: 'show' },
        { trigger: 'cancelRemoveServiceBtn', modal: 'removeServiceModal', action: 'hide' },
        { trigger: 'removeServiceBtn', modal: 'removeServiceModal', action: 'hide' },
        { triggerClass: 'deleteServices', modal: 'removeServicesModal', action: 'show' },
        { trigger: 'cancelRemoveServicesBtn', modal: 'removeServicesModal', action: 'hide' },
        { trigger: 'removeServicesBtn', modal: 'removeServicesModal', action: 'hide' },
    ];
    
    buttons.forEach(({ trigger, triggerClass, modal, modals, action }) => {
        const elements = trigger
            ? [document.getElementById(trigger)]
            : document.querySelectorAll(`.${triggerClass}`);
        elements.forEach(element => {
            if (!element) return;
    
            element.addEventListener('click', function () {
                if (modals) {
                    modals.forEach(id => {
                        if (action === 'show') showModal(id);
                        if (action === 'hide') hideModal(id);
                    });
                } else {
                    if (action === 'show') showModal(modal);
                    if (action === 'hide') hideModal(modal);
                    if (action === 'toggle') {
                        const modalElement = document.getElementById(modal);
                        if (modalElement) {
                            modalElement.classList.toggle('show');
                        }
                    }
                }
            });
        });
    });
    

    // Close modal when clicking outside
    window.addEventListener('click', function (event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        });
    });
});

// jQuery for AJAX and form submissions
$(document).ready(function () {
    // Add Service Form
    $('#addServiceForm').on('submit', function (event) {
        event.preventDefault(); // Prevent normal form submission
        const formData = $(this).serialize();

        $.ajax({
            url: 'service_crud/add_service.php',
            type: 'POST',
            data: formData,
            success: function () {
                //alert('Service added successfully!');
                $('#addServiceModal').removeClass('show');
                location.reload();
            },
            error: function () {
                alert('Error adding the service. Please try again.');
            }
        });
    });

// Prevent default form submission
$('#editServiceForm').on('submit', function (event) {
    event.preventDefault(); // Disable normal form submission
});

// Handle form submission only when #confirmEditBtn is clicked
$('#confirmEditBtn').on('click', function () {
    const formData = $('#editServiceForm').serialize(); // Collect form data

    $.ajax({
        url: 'service_crud/edit_service.php', // Endpoint for processing
        type: 'POST',
        data: formData,
        success: function () {
            //alert('Service edited successfully!');
            $('#editModal').removeClass('show'); // Close the modal on success
            location.reload();
        },
        error: function () {
            //alert('Error editing the service. Please try again.');
            console.log('Error editing the service. Please try again.');
        }
    });
});


});


$(document).ready(function () {
    // Listen for clicks on buttons with a specific class
    $('.viewServices').on('click', function () {
        // Get the data-id from the button
        const serviceId = $(this).data('id');
        document.getElementById('editServiceId').value = serviceId;

        // Check if serviceId is valid
        if (!serviceId) {
            alert('Invalid service ID.');
            return;
        }
        //Make an AJAX to save serviceId in session
        $.ajax({
            url: 'service_crud/save_session_service.php', // Replace with your PHP file path
            type: 'POST',
            data: { selected_service_edit: serviceId }, // Send the data-id as POST data
            success: function (response) {
                // Handle the response from the PHP file
                console.log('Success:', response);
            },
            error: function (xhr, status, error) {
                // Handle any errors
                console.error('Error:', error);
            }
        });

        // Make an AJAX request to retrieve service details
        $.ajax({
            url: 'service_crud/get_service_details.php', // Replace with your PHP file path
            type: 'GET',
            data: { id: serviceId }, // Send the service ID as a GET parameter
            dataType: 'json',
            success: function (response) {
                // Check if response contains valid data
                if (response.success) {
                    // Populate the modal with data
                    $('#viewServiceModal .modal-table').html(`
                        <tr>
                            <td><strong>Service ID</strong></td>
                            <td>${response.data.service_id}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Name</strong></td>
                            <td>${response.data.service_name}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Description</strong></td>
                            <td>${response.data.service_description}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Price</strong></td>
                            <td>${response.data.service_price}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Duration</strong></td>
                            <td>${response.data.service_duration}</td>
                    `);

                    //Populate the edit form
                    document.getElementById('editServiceName').value = response.data.service_name;
                    document.getElementById('editServiceDescription').value = response.data.service_description;
                    document.getElementById('editServicePrice').value = response.data.service_price;
                    document.getElementById('editServiceTime').value = response.data.service_duration;

                    // Show the modal
                    //$('#viewServiceModal').fadeIn();
                } else {
                    alert('Failed to retrieve service details.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching service details.');
            }
        });

    });

    // Hide the modal when clicking the OK button
    $('#okView').on('click', function () {
        $('#viewServiceModal').fadeOut();
    });
});

$(document).ready(function () {
    // Listen for clicks on buttons with a specific class
    $('.removeServiceTable').on('click', function () {
        // Get the data-id from the button
        const serviceId = $(this).data('id');
        document.getElementById('editServiceId').value = serviceId;

        // Check if serviceId is valid
        if (!serviceId) {
            alert('Invalid service ID.');
            return;
        }
        //Make an AJAX to save serviceId in session
        $.ajax({
            url: 'service_crud/save_session_service.php', // Replace with your PHP file path
            type: 'POST',
            data: { selected_service_edit: serviceId }, // Send the data-id as POST data
            success: function (response) {
                // Handle the response from the PHP file
                console.log('Success:', response);
            },
            error: function (xhr, status, error) {
                // Handle any errors
                console.error('Error:', error);
            }
        });

        // Make an AJAX request to retrieve service details
        $.ajax({
            url: 'service_crud/get_service_details.php', // Replace with your PHP file path
            type: 'GET',
            data: { id: serviceId }, // Send the service ID as a GET parameter
            dataType: 'json',
            success: function (response) {
                // Check if response contains valid data
                if (response.success) {
                    // Populate the modal with data
                    $('#viewServiceModal .modal-table').html(`
                        <tr>
                            <td><strong>Service ID</strong></td>
                            <td>${response.data.service_id}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Name</strong></td>
                            <td>${response.data.service_name}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Description</strong></td>
                            <td>${response.data.service_description}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Price</strong></td>
                            <td>${response.data.service_price}</td>
                        </tr>
                        <tr>
                            <td><strong>Service Duration</strong></td>
                            <td>${response.data.service_duration}</td>
                    `);

                    //Populate the edit form
                    document.getElementById('editServiceName').value = response.data.service_name;
                    document.getElementById('editServiceDescription').value = response.data.service_description;
                    document.getElementById('editServicePrice').value = response.data.service_price;
                    document.getElementById('editServiceTime').value = response.data.service_duration;

                    // Show the modal
                    //$('#viewServiceModal').fadeIn();
                } else {
                    alert('Failed to retrieve service details.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching service details.');
            }
        });

    });

    // Hide the modal when clicking the OK button
    $('#okView').on('click', function () {
        $('#viewServiceModal').fadeOut();
    });
});

//service deletions
$(document).ready(function () {
    // Handle single item deletion using event delegation
    $(document).ready(function () {
        let serviceID = null; // Store the service ID globally within this scope
    
        // Handle click on .removeServiceTable to set the serviceID
        $(document).on('click', '.removeServiceTable', function (event) {
            event.preventDefault();
            serviceID = $(this).data('id'); // Store the data-id of the clicked element
            $('#removeServiceBtn').data('id', serviceID); // Optionally pass it to the button
        });
    
        // Handle click on the confirmDelete button to perform the deletion
        $(document).on('click', '#removeServiceBtn', function () {
            if (!serviceID) {
                alert('No service selected for deletion.');
                return;
            }
    
            // Perform deletion via AJAX
            $.ajax({
                url: 'service_crud/delete_service.php',
                type: 'POST',
                data: { service_id: serviceID },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.success) {
                            alert('Service deleted successfully.');
                            // Remove the corresponding row from the table
                            $(`.removeServiceTable[data-id="${serviceID}"]`).closest('tr').remove();
                        } else {
                            alert(`Failed to delete service: ${data.error}`);
                        }
                    } catch (error) {
                        alert('Invalid response received from the server.');
                    }
                    $('#confirmModal').modal('hide'); // Hide the modal after action
                },
                error: function () {
                    alert('An error occurred while deleting the service.');
                    $('#confirmModal').modal('hide'); // Hide the modal even on error
                }
            });
        });
    });
    
    // Handle multiple items deletion
    $('#removeServicesBtn').on('click', function (event) {
        event.preventDefault();

        // Get all checked checkboxes with the class "serviceCheckbox"
        const selectedServices = $('.serviceCheckbox:checked')
            .map(function () {
                return $(this).val();
            })
            .get();

        if (selectedServices.length === 0) {
            alert('Please select at least one service to delete.');
            return;
        }

        // Confirm before deletion
        if (confirm(`Are you sure you want to delete ${selectedServices.length} services?`)) {
            $.ajax({
                url: 'service_crud/delete_service.php',
                type: 'POST',
                data: { service_ids: JSON.stringify(selectedServices) },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (data.success) {
                            alert(`${selectedServices.length} services deleted successfully.`);
                            // Remove the corresponding rows from the table
                            selectedServices.forEach(function (id) {
                                $(`.serviceCheckbox[value="${id}"]`).closest('tr').remove();
                            });
                        } else {
                            alert(`Failed to delete services: ${data.error}`);
                        }
                    } catch (error) {
                        alert('Invalid response received from the server.');
                    }
                },
                error: function () {
                    alert('An error occurred while deleting the services.');
                }
            });
        }
    });
});
