document.addEventListener('DOMContentLoaded', function () {
    const existingAccountModal = document.getElementById('existingAccountModal');
    const newAccountModal = document.getElementById('newAccountModal');
    const deleteNewProgressModal = document.getElementById('deleteNewProgressModal');
    const deleteExistingProgressModal = document.getElementById('deleteExistingProgressModal');
    const appointmentDoneModal = document.getElementById('appointmentDoneModal');
    const approvalAppointmentModal = document.getElementById('approvalAppointmentModal');
    const cancelAppointmentModal = document.getElementById('cancelAppointmentModal');
    const reschedAccountModal = document.getElementById('reschedAccountModal');
    const closeDone = document.getElementById('closeDone');
    const closeRescheduleButton = document.getElementById('closeRescheduleButton');
    const closeCancelAppointmentBtn = document.getElementById('closeCancelAppointmentModal');
    const newAccount = document.getElementById('newAccount');
    const cancelSubmitNewBtn = document.getElementById('cancelSubmitNewBtn');
    const deleteNewProgressBtn = document.getElementById('deleteNewProgressBtn');
    const cancelNewDeleteBtn = document.getElementById('cancelNewDeleteBtn');
    const existingAccount = document.getElementById('existingAccount');
    const cancelSubmitExistingBtn = document.getElementById('cancelSubmitExistingBtn');
    const deleteExistingProgressBtn = document.getElementById('deleteExistingProgressBtn');
    const cancelExistingDeleteBtn = document.getElementById('cancelExistingDeleteBtn');
    const submitExistingBtn = document.getElementById('submitExistingBtn');
    const statusBtns = document.querySelectorAll('.appointmentStatus');
    const approveBtns = document.querySelectorAll('.appointmentApprove');
    const openCancelAppointmentBtns = document.querySelectorAll('.openCancelAppointmentModal');
    const openReschedAppointmentBtns = document.querySelectorAll('.openReschedAppointmentModal');
    const closeButtons = document.querySelectorAll(".close-btn, .closebtn");
    
    // Show the appointmentDoneModal
    statusBtns.forEach((statusBtn) => {
        statusBtn.addEventListener('click', function () {
            appointmentDoneModal.classList.add('show');
        });
    });

    // Close modals using close buttons
    closeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const modal = button.closest(".modal");
            modal.classList.remove("show");
        });
    });

    // Show and close the approvalAppointmentModal
    approveBtns.forEach((approveBtn) => {
        approveBtn.addEventListener('click', function () {
            approvalAppointmentModal.classList.add('show');
        });
    });

    closeDone.addEventListener('click', function () {
        approvalAppointmentModal.classList.remove('show');
    });

    // Show the newAccountModal
    newAccount.addEventListener('click', function () {
        newAccountModal.classList.add('show');
    });

    // Close the newAccountModal and open the deleteNewProgressModal
    cancelSubmitNewBtn.addEventListener('click', function () {
        newAccountModal.classList.remove('show');
        deleteNewProgressModal.classList.add('show');
    });

    // Show the existingAccountModal
    existingAccount.addEventListener('click', function () {
        existingAccountModal.classList.add('show');
    });

    // Close the existingAccountModal and open the deleteExistingProgressModal
    cancelSubmitExistingBtn.addEventListener('click', function () {
        existingAccountModal.classList.remove('show');
        deleteExistingProgressModal.classList.add('show');
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

    // Close the deleteProgressModal for new account and return to newAccountModal
    cancelNewDeleteBtn.addEventListener('click', function () {
        deleteNewProgressModal.classList.remove('show');
        newAccountModal.classList.add('show');
    });

    // Close the deleteProgressModal for existing account and return to existingAccountModal
    cancelExistingDeleteBtn.addEventListener('click', function () {
        deleteExistingProgressModal.classList.remove('show');
        existingAccountModal.classList.add('show');
    });

    // Open the cancelAppointmentModal
    openCancelAppointmentBtns.forEach((btn) => {
        btn.addEventListener('click', function () {
            cancelAppointmentModal.classList.add('show');
        });
    });

    // Close the cancelAppointmentModal
    closeCancelAppointmentBtn.addEventListener('click', function () {
        cancelAppointmentModal.classList.remove('show');
    });

    // Show the reschedAccountModal
    openReschedAppointmentBtns.forEach((btn) => {
        btn.addEventListener('click', function () {
            reschedAccountModal.classList.add('show');
        });
    });

    // Close the reschedAccountModal
    closeRescheduleButton.addEventListener('click', function () {
        reschedAccountModal.classList.remove('show');
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll(".modal");
    const closeButtons = document.querySelectorAll(".close-btn, .closebtn");

    // Hide modals when close buttons are clicked
    closeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const modal = button.closest(".modal");
            modal.classList.remove("show");
        });
    });

    const deleteBtn = document.getElementById("deleteExistingProgressBtn");
    const deleteModal = document.getElementById("deleteExistingProgressModal");

    deleteBtn.addEventListener("click", function () {
        console.log("Delete button clicked!");
        deleteModal.classList.remove("show");
    });
});



//disableCheckbox


// Handle Dynamic Button Actions for Done Appointment
const setupDynamicActions = () => {
    document.body.addEventListener("click", (event) => {
        // Handle Appointment Status Click
        if (event.target.closest(".appointmentStatus")) {
            const itemElement = event.target.closest(".appointmentStatus");
            const itemId = itemElement.dataset.id;

            // Set the appointment ID in the hidden input
            document.getElementById("done_appointment_id").value = itemId;


            //Save appointmentID as session
            $.ajax({
                url: 'save_session_appointment.php', // PHP script to handle the request
                type: 'POST',
                data: { session_appointment_id: itemId }, // Data to send to the server
                success: function (response) {
                    // Display success message
                    console.log(response);
                },
                error: function () {
                    $('#response').text('Error saving the value.');
                }
            });


              
            // Function to fetch and populate appointment details
// Fetch and display appointment details
const fetchAppointmentDetails = (url, itemId, onSuccess) => {
    $.ajax({
        url: url,
        type: "POST",
        data: JSON.stringify({ id: itemId }), // Ensure proper data format
        contentType: "application/json", // Specify JSON content type
        dataType: "json",
        success: (response) => {
            if (response && !response.error) {
                onSuccess(response[0]);
            } else {
                alert(response.error || "Unknown error occurred");
            }
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error:", xhr.responseText, status, error);
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

                modal.find(".personal-info .form-group input").eq(3).val(data.emergency_contact_name || "N/A");
                modal.find(".personal-info .form-group input").eq(4).val(data.emergency_relationship || "N/A");
                modal.find("#phoneNumberDone").val(data.emergency_phone || "N/A");

                modal.find(".treatment-record input").eq(0).val(data.appointment_date_time || "N/A");
                modal.find(".treatment-record input").eq(1).val(data.procedure || "N/A");
                modal.find(".treatment-record input").eq(2).val(data.dentist || "N/A");
                modal.find(".treatment-record input").eq(3).val(data.tooth_count || "N/A");
            
                modal.fadeIn();
            };
            // Fetch and display appointment details
            fetchAppointmentDetails("appointment_crud/appointment_get.php", { id: itemId }, populateAppointmentModal);
        }
        
    });
};

// Initialize the dynamic button actions
setupDynamicActions();

// Handle Dynamic Button Actions for approve appointment
const setupDynamicActionsApprove = () => {
    document.body.addEventListener("click", (event) => {
        // Handle Appointment Approve Button Click
        if (event.target.closest(".appointmentApprove")) {
            const itemElement = event.target.closest(".appointmentApprove");
            const itemId = itemElement.dataset.id;

            // Set the appointment ID in the hidden input
            document.getElementById("approval_appointment_id").value = itemId;

            // Save appointmentID as a session variable
            $.ajax({
                url: 'save_session_appointment.php', // PHP script to handle the request
                type: 'POST',
                data: { session_appointment_id: itemId }, // Data to send to the server
                success: function (response) {
                    console.log("Session saved:", response);
                },
                error: function () {
                    $('#response').text('Error saving the value.');
                }
            });

            // Fetch and display appointment details
            const fetchAppointmentDetails = (url, itemId, onSuccess) => {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: JSON.stringify({ id: itemId }), // Ensure proper data format
                    contentType: "application/json", // Specify JSON content type
                    dataType: "json",
                    success: (response) => {
                        if (response && !response.error) {
                            onSuccess(response[0]);
                        } else {
                            alert(response.error || "Unknown error occurred");
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error("AJAX Error:", xhr.responseText, status, error);
                        alert("An error occurred while fetching appointment details.");
                    },
                });
            };

            // Populate and display the appointment approval modal
            const populateAppointmentModal = (data) => {
                const modal = $("#approvalAppointmentModal");
                
                modal.find(".personal-info2 .form-group2 span").eq(0).text(data.patient_name || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(1).text(data.patient_phone_number || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(2).text(data.patient_age || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(3).text(data.patient_sex || "N/A");
                modal.find(".personal-info2 .form-group2 span").eq(4).text(data.birth_date || "N/A");
                
                modal.find(".personal-info input").eq(0).val(data.address || "N/A");
                modal.find(".personal-info input").eq(1).val(data.city || "N/A");
                modal.find(".personal-info input").eq(2).val(data.province || "N/A");

                modal.find(".personal-info .form-group input").eq(3).val(data.emergency_contact_name || "N/A");
                modal.find(".personal-info .form-group input").eq(4).val(data.emergency_relationship || "N/A");
                modal.find("#phoneNumberDone").val(data.emergency_phone || "N/A");

                modal.find(".treatment-record input").eq(0).val(data.appointment_date_time || "N/A");
                modal.find(".treatment-record input").eq(1).val(data.procedure || "N/A");
                modal.find(".treatment-record input").eq(2).val(data.dentist || "N/A");
                modal.find(".treatment-record input").eq(3).val(data.tooth_count || "N/A");
                
                modal.fadeIn();
            };

            // Fetch and display appointment details in the approval modal
            fetchAppointmentDetails("appointment_crud/appointment_get.php", itemId, populateAppointmentModal);
        }
    });
};

// Initialize the dynamic button actions
setupDynamicActionsApprove();

//set up dynamics for for cancel appointment
// Handle Dynamic Button Actions for cancel appointment
const setupDynamicActionsCancel = () => {
    document.body.addEventListener("click", (event) => {
        // Handle Appointment Approve Button Click
        if (event.target.closest(".openCancelAppointmentModal")) {
            const itemElement = event.target.closest(".openCancelAppointmentModal");
            const itemId = itemElement.dataset.id;

            // Set the appointment ID in the hidden input
            document.getElementById("approval_appointment_id").value = itemId;

            // Save appointmentID as a session variable
            $.ajax({
                url: 'save_session_appointment.php', // PHP script to handle the request
                type: 'POST',
                data: { session_appointment_id: itemId }, // Data to send to the server
                success: function (response) {
                    console.log("Session saved:", response);
                },
                error: function () {
                    $('#response').text('Error saving the value.');
                }
            });
        }
    });
};

// Initialize the dynamic button actions
setupDynamicActionsCancel();


// Handle Dynamic Button Actions for cancel appointment
const setupDynamicActionsResched = () => {
    document.body.addEventListener("click", (event) => {
        // Handle Appointment Approve Button Click
        if (event.target.closest(".openReschedAppointmentModal")) {
            const itemElement = event.target.closest(".openReschedAppointmentModal");
            const itemId = itemElement.dataset.id;

            // Set the appointment ID in the hidden input
            document.getElementById("approval_appointment_id").value = itemId;

            // Save appointmentID as a session variable
            $.ajax({
                url: 'save_session_appointment.php', // PHP script to handle the request
                type: 'POST',
                data: { session_appointment_id: itemId }, // Data to send to the server
                success: function (response) {
                    console.log("Session saved:", response);
                },
                error: function () {
                    $('#response').text('Error saving the value.');
                }
            });
// Fetch and display appointment details
const fetchAppointmentDetailsResched = (url, itemId, onSuccess) => {
    $.ajax({
        url: url,
        type: "POST",
        data: JSON.stringify({ id: itemId }), // Ensure proper data format
        contentType: "application/json", // Specify JSON content type
        dataType: "json",
        success: (response) => {
            if (response && !response.error) {
                onSuccess(response[0]);
            } else {
                alert(response.error || "Unknown error occurred");
            }
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error:", xhr.responseText, status, error);
            alert("An error occurred while fetching appointment details.");
        },
    });
};
            // Populate and display the appointment done modal
            const populateAppointmentModalResched = (data) => {
                const modal = $("#reschedAccountModal");
            
                document.getElementById('nameResched').value(data.patient_name || "N/A");
                document.getElementById('patientIDResched').value(data.patient_info_id || "N/A");
                document.getElementById('MedicalHistory').value(data.service_name || "N/A");
            
                modal.fadeIn();
            };
            // Fetch and display appointment details
            fetchAppointmentDetailsResched("appointment_crud/appointment_get.php", { id: itemId }, populateAppointmentModalResched);


        }
    });
};

// Initialize the dynamic button actions
setupDynamicActionsResched();




document.addEventListener('DOMContentLoaded', function () {
    const doneForm = document.getElementById('doneAppointmentForm');
    const doneButton = document.getElementById('doneAppointmentBtn');
    
    if (doneForm && doneButton) {
        doneButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Enable corresponding input fields for checked checkboxes
            const checkboxes = document.querySelectorAll('.checkBoxItems');
            checkboxes.forEach(checkbox => {
                const input = document.querySelector(`.number-input[data-id="${checkbox.value}"]`);
                if (checkbox.checked && input) {
                    input.disabled = false;
                } else if (input) {
                    input.disabled = true;
                }
            });

            if (doneForm.checkValidity()) {
                const formData = new FormData(doneForm);

                // Log formData for debugging
                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                $.ajax({
                    type: 'POST',
                    url: 'appointment_crud/done_appointment.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response.trim());
                        switch (response.trim()) {
                            case 'success':
                                doneForm.reset();
                                location.reload();
                                break;
                            case 'error:Problem with form submission':
                                console.error('Problem with form submission');
                                break;
                            default:
                                console.error('Unexpected response:', response);
                        }
                    },
                    error: function (xhr) {
                        console.error('Server error:', xhr.responseText);
                    },
                });
            } else {
                doneForm.reportValidity();
            }
        });
    }
});



//Approve appointment

document.addEventListener('DOMContentLoaded', function () {
    const doneForm = document.getElementById('approveAppointmentForm');
    const doneButton = document.getElementById('approveAppointmentBtn');
    
    if (doneForm && doneButton) {
        doneButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Enable corresponding input fields for checked checkboxes
            const checkboxes = document.querySelectorAll('.checkBoxItems');
            checkboxes.forEach(checkbox => {
                const input = document.querySelector(`.number-input[data-id="${checkbox.value}"]`);
                if (checkbox.checked && input) {
                    input.disabled = false;
                } else if (input) {
                    input.disabled = true;
                }
            });

            if (doneForm.checkValidity()) {
                const formData = new FormData(doneForm);

                // Log formData for debugging
                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                $.ajax({
                    type: 'POST',
                    url: 'appointment_crud/approve_appointment.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response.trim());
                        switch (response.trim()) {
                            case 'success':
                                doneForm.reset();
                                location.reload();
                                break;
                            case 'error:Problem with form submission':
                                console.error('Problem with form submission');
                                break;
                            default:
                                console.error('Unexpected response:', response);
                        }
                    },
                    error: function (xhr) {
                        console.error('Server error:', xhr.responseText);
                    },
                });
            } else {
                doneForm.reportValidity();
            }
        });
    }
});





// Get products for drop downn
document.addEventListener('DOMContentLoaded', function () {
//disableCheckbox
    let selectedItems = {}; // Store selected items and their quantities
    let selectedProcedures = [];

    // Dropdown toggle for Item Inventory
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    
    // Toggle dropdown visibility
    dropdownButton.addEventListener('click', function () {
        const isExpanded = dropdownButton.getAttribute('aria-expanded') === 'true';
        dropdownButton.setAttribute('aria-expanded', !isExpanded);
        dropdownMenu.style.display = isExpanded ? 'none' : 'block';
    
        if (!isExpanded) {
            loadDropdownProducts();
        }
    });
    
    // Load dropdown products dynamically
    function loadDropdownProducts() {
        $.ajax({
            url: 'appointment_crud/get_products2.php',
            type: 'GET',
            success: function (response) {
                $('.dropdown-menu-appointment').html(response);
    
                // Restore checkbox and quantity states
                for (const [productId, quantity] of Object.entries(selectedItems)) {
                    const checkbox = $(`.checkBoxItems[value="${productId}"]`);
                    if (checkbox.length) {
                        checkbox.prop('checked', true);
                        checkbox.closest('div').find('.number-input').val(quantity);
                    }
                }
            },
            error: function () {
                console.error('Failed to load consumed products.');
            }
        });
    }
    
    // Handle checkbox changes dynamically
    $('body').on('change', '.checkBoxItems', function () {
        const checkbox = $(this);
        const productId = checkbox.val();
        const productName = checkbox.data('name');
        const quantityInput = checkbox.closest('div').find('.number-input');
        const quantity = parseInt(quantityInput.val(), 10);
    
        if (checkbox.is(':checked')) {
            if (!quantity || quantity <= 0) {
                alert('Please enter a valid quantity.');
                checkbox.prop('checked', false);
                return;
            }
            selectedItems[productId] = quantity;
            addItemToSelectedItem(productId, productName, quantity);
        } else {
            delete selectedItems[productId];
            removeItem(productId);
        }
        updateHiddenFieldItems();
    });
    
    // Add item box to the selected list
    function addItemToSelectedItem(productId, productName, quantity) {
        if (!$(`.selected-item-box[data-product="${productId}"]`).length) {
            $('.selected-items').append(`
                <div class="selected-item-box" data-product="${productId}">
                    <a class="remove-item" data-product-id="${productId}">X</a>
                    ${productName} (Quantity: ${quantity})
                </div>
            `);
    
            // Attach event handler to the remove button
            $(`.selected-item-box[data-product="${productId}"] .remove-item`).on('click', function () {
                removeItem(productId);
            });
        }
    }
    
    // Remove item from the selected list and uncheck checkbox
    function removeItem(productId) {
        // Remove item from state
        delete selectedItems[productId];
    
        // Uncheck the corresponding checkbox
        const checkbox = $(`.checkBoxItems[value="${productId}"]`);
        if (checkbox.length) {
            checkbox.prop('checked', false);
        }
    
        // Remove the displayed item
        $(`.selected-item-box[data-product="${productId}"]`).remove();
    
        // Update the hidden field
        updateHiddenFieldItems();
    }
    
    // Update the hidden field with the current state of selected items
    function updateHiddenFieldItems() {
        $('#selected-products').val(JSON.stringify(selectedItems));
    }
    
    // Ensure dropdown toggle does not affect item boxes
    dropdownButton.addEventListener('click', function () {
        // Keep item boxes visible
        $('.selected-items').css('display', 'block');
    });
    



// Dropdown toggle for Procedure
const dropdownButtonProcedure = document.getElementById('dropdownButtonProcedure');
const dropdownMenuProcedure = document.getElementById('dropdownMenuProcedure');

// Toggle dropdown visibility
dropdownButtonProcedure.addEventListener('click', function () {
    const isExpanded = dropdownButtonProcedure.getAttribute('aria-expanded') === 'true';
    dropdownButtonProcedure.setAttribute('aria-expanded', !isExpanded);
    dropdownMenuProcedure.style.display = isExpanded ? 'none' : 'block';

    if (!isExpanded) {
        loadDropdownProcedures();
    }
});

// Load dropdown procedures dynamically
function loadDropdownProcedures() {
    $.ajax({
        url: 'appointment_crud/get_procedures.php',
        type: 'GET',
        success: function (response) {
            $('#dropdownMenuProcedure').html(response);

            // Restore checkbox states
            selectedProcedures.forEach((procedureId) => {
                const checkbox = $(`.checkBoxProcedure[value="${procedureId}"]`);
                if (checkbox.length) {
                    checkbox.prop('checked', true);
                }
            });
        },
        error: function () {
            console.error('Failed to load procedures.');
        }
    });
}

// Handle checkbox changes dynamically
$('body').on('change', '.checkBoxProcedure', function () {
    const checkbox = $(this);
    const procedureId = checkbox.val();
    const procedureName = checkbox.data('name');

    if (checkbox.is(':checked')) {
        if (!selectedProcedures.includes(procedureId)) {
            selectedProcedures.push(procedureId);
            addItemToSelectedProcedure(procedureId, procedureName);
        }
    } else {
        selectedProcedures = selectedProcedures.filter((id) => id !== procedureId);
        removeProcedure(procedureId);
    }
    updateHiddenFieldProcedures();
});

// Add item box to the selected list
function addItemToSelectedProcedure(procedureId, procedureName) {
    if (!$(`.selected-item-box[data-procedure="${procedureId}"]`).length) {
        $('.selected-procedures').append(`
            <div class="selected-item-box" data-procedure="${procedureId}">
                <a class="remove-item" data-procedure-id="${procedureId}">X</a>
                ${procedureName}
            </div>
        `);
    }

    // Attach event handler to the remove button
    $(`.selected-item-box[data-procedure="${procedureId}"] .remove-item`).on('click', function () {
        removeProcedure(procedureId);
    });
}

// Remove procedure from the selected list and uncheck checkbox
function removeProcedure(procedureId) {
    // Uncheck the corresponding checkbox
    const checkbox = $(`.checkBoxProcedure[value="${procedureId}"]`);
    if (checkbox.length) {
        checkbox.prop('checked', false);
    }

    // Remove from internal state
    selectedProcedures = selectedProcedures.filter((id) => id !== procedureId);

    // Remove the displayed procedure
    $(`.selected-item-box[data-procedure="${procedureId}"]`).remove();

    // Update the hidden field
    updateHiddenFieldProcedures();
}

// Update the hidden field with the current state of selected procedures
function updateHiddenFieldProcedures() {
    const selectedIds = $('.selected-item-box').map(function () {
        return $(this).data('procedure');
    }).get();

    $('#selected-procedures').val(JSON.stringify(selectedIds));
}

// Ensure dropdown toggle does not affect item boxes
dropdownButtonProcedure.addEventListener('click', function () {
    // Keep item boxes visible
    $('.selected-procedures').css('display', 'block');
});


});


// get products for approval form

document.addEventListener('DOMContentLoaded', function () {
    let selectedProcedures = [];

    // Dropdown toggle for Procedure
    const dropdownButtonProcedure = document.getElementById('dropdownButtonProcedureApproval');
    const dropdownMenuProcedure = document.getElementById('dropdownMenuProcedureApproval'); // Corrected ID

    // Toggle dropdown visibility
    dropdownButtonProcedure.addEventListener('click', function () {
        const isExpanded = dropdownButtonProcedure.getAttribute('aria-expanded') === 'true';
        dropdownButtonProcedure.setAttribute('aria-expanded', !isExpanded);
        dropdownMenuProcedure.style.display = isExpanded ? 'none' : 'block';

        if (!isExpanded) {
            loadDropdownProcedures();
        }
    });

    // Load dropdown procedures dynamically
    function loadDropdownProcedures() {
        $.ajax({
            url: 'appointment_crud/get_procedures_approval.php',
            type: 'GET',
            success: function (response) {
                console.log('Dropdown procedures loaded:', response); // Debug log
                $('#dropdownMenuProcedureApproval').html(response);

                // Restore checkbox states
                selectedProcedures.forEach((procedureId) => {
                    const checkbox = $(`.checkBoxProcedureApproval[value="${procedureId}"]`);
                    if (checkbox.length) {
                        checkbox.prop('checked', true);
                    }
                });
            },
            error: function () {
                console.error('Failed to load procedures.');
            }
        });
    }

    // Handle checkbox changes dynamically
    $('body').on('change', '.checkBoxProcedureApproval', function () {
        const checkbox = $(this);
        const procedureId = checkbox.val();
        const procedureName = checkbox.data('name');

        if (checkbox.is(':checked')) {
            if (!selectedProcedures.includes(procedureId)) {
                selectedProcedures.push(procedureId);
                addItemToSelectedProcedure(procedureId, procedureName);
            }
        } else {
            selectedProcedures = selectedProcedures.filter((id) => id !== procedureId);
            removeProcedure(procedureId);
        }
        updateHiddenFieldProcedures();
    });

    // Add item box to the selected procedures list
    function addItemToSelectedProcedure(procedureId, procedureName) {
        console.log('Adding procedure:', procedureId, procedureName); // Debug log

        if (!$(`.selected-item-box[data-procedure="${procedureId}"]`).length) {
            $('.selected-procedures-approval').append(`
                <div class="selected-item-box" data-procedure="${procedureId}">
                    <a class="remove-item" data-procedure-id="${procedureId}">X</a>
                    ${procedureName}
                </div>
            `);
        } else {
            console.warn(`Procedure ${procedureId} already exists.`);
        }

        // Attach event handler to the remove button
        $(`.selected-item-box[data-procedure="${procedureId}"] .remove-item`)
            .off('click') // Prevent duplicate handlers
            .on('click', function () {
                removeProcedure(procedureId);
            });
    }

    // Remove procedure from the selected list and uncheck checkbox
    function removeProcedure(procedureId) {
        console.log('Removing procedure:', procedureId); // Debug log

        // Uncheck the corresponding checkbox
        const checkbox = $(`.checkBoxProcedureApproval[value="${procedureId}"]`);
        if (checkbox.length) {
            checkbox.prop('checked', false);
        }

        // Remove from internal state
        selectedProcedures = selectedProcedures.filter((id) => id !== procedureId);

        // Remove the displayed procedure
        $(`.selected-item-box[data-procedure="${procedureId}"]`).remove();

        // Update the hidden field
        updateHiddenFieldProcedures();
    }

    // Update the hidden field with the current state of selected procedures
    function updateHiddenFieldProcedures() {
        const selectedIds = $('.selected-item-box').map(function () {
            return $(this).data('procedure');
        }).get();

        const hiddenField = $('#selected-procedures-approval'); // Updated ID
        if (hiddenField.length) {
            hiddenField.val(JSON.stringify(selectedIds));
        } else {
            console.warn('#selected-procedures-approval hidden field is missing.');
        }
    }

    // Ensure dropdown toggle does not affect procedure boxes
    dropdownButtonProcedure.addEventListener('click', function () {
        $('.selected-procedures-approval').css('display', 'block');
    });
});


// cancel appointment ajax
$(document).ready(function () {
    const otherReasonContainer = $("#otherReasonContainer");
    const otherReasonInput = $("#otherReason");

    // Hide the "Other Reason" input field initially
    otherReasonContainer.hide();

    // Toggle the visibility of the "Other Reason" input field based on selected radio button
    $('input[name="reasonCancel"]').change(function () {
      if ($(this).val() === "other") {
        otherReasonContainer.show();
        otherReasonInput.attr("required", "required");
      } else {
        otherReasonContainer.hide();
        otherReasonInput.removeAttr("required").val("");
      }
    });

    // Handle form submission with AJAX
    $("#cancelForm").on("submit", function (e) {
      e.preventDefault(); // Prevent default form submission

      // Serialize form data
      const formData = $(this).serialize();

      // AJAX request
      $.ajax({
        url: "appointment_crud/cancel_appointment.php",
        type: "POST",
        data: formData,
        dataType: "json", // Expect JSON response
        success: function (response) {
            if (response.success) {
                console.log("Your appointment has been successfully canceled.");
                $("#cancelAppointmentModal").hide();
                $("#cancelForm")[0].reset();
                otherReasonContainer.hide();
            } else {
                console.log(response.message || "Failed to cancel the appointment. Please try again.");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error canceling the appointment:", xhr.responseText || error);
            console.log("An error occurred while canceling your appointment. Please try again.");
        },
    });
    

    });
  });

// Reschedule appointment AJAX
$(document).ready(function () {
    const otherReasonContainer = $("#resched-otherReasonContainer");
    const otherReasonInput = $("#resched-otherReason");

    // Hide the "Other Reason" input field initially
    otherReasonContainer.hide();

    // Toggle the visibility of the "Other Reason" input field based on selected radio button
    $('input[name="reasonResched"]').change(function () {
        if ($(this).val() === "other") {
            otherReasonContainer.show();
            otherReasonInput.attr("required", "required");
        } else {
            otherReasonContainer.hide();
            otherReasonInput.removeAttr("required").val(""); // Clear the input field
        }
    });

    // Prevent form submission by pressing Enter or other triggers
    $("#resched-newMultiStepFormResched").on("submit", function (e) {
        e.preventDefault();
    });

    // Handle form submission ONLY when the submit button is clicked
    $("#resched-submitButton").on("click", function (e) {
        e.preventDefault(); // Prevent default button action

        // Serialize form data
        const formData = $("#resched-newMultiStepFormResched").serialize();

        // AJAX request
        $.ajax({
            url: "appointment_crud/resched_appointment.php",
            type: "POST",
            data: formData,
            dataType: "json", // Expect JSON response
            success: function (response) {
                if (response.success) {
                    console.log("Your appointment has been successfully rescheduled.");
                    $("#reschedAccountModal").hide(); // Close the modal
                    $("#resched-newMultiStepFormResched")[0].reset(); // Reset the form
                    otherReasonContainer.hide(); // Hide the "Other Reason" container
                    otherReasonInput.removeAttr("required").val(""); // Clear the input field for other reason
                } else {
                    console.log(response.message || "Failed to reschedule the appointment. Please try again.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error rescheduling the appointment:", xhr.responseText || error);
                alert("An error occurred while rescheduling your appointment. Please try again.");
            },
        });
    });
});


