<div class="modal-content">
    <form id="addServiceForm" name="addServiceForm" action="Service-page.php" method="POST">
        <b class="modal-title normal-title">Add New Services</b>
        <div class="message-container">
            <div class="modal-description">
            <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="serviceName" required />
                <label>Name<indicator>*</indicator></label>
                </div>
            <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="serviceDescription" required />
                <label>Description<indicator>*</indicator></label>
                </div>
            </div>
            <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="servicePrice" required />
                <label>Price<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                    <input class="modal-input" type="number" maxlength="4" autocomplete="off" name="serviceTime" required />
                <label>Duration<indicator>*</indicator></label>
                </div>
        </div>
        <button id="addServiceBtn" class="modal-button success">Add</button>
        </form>
        <button class="modal-button secondary-button warning" id="cancelAddServiceBtn">Cancel</button>
    </div>


    <div class="modal-content">
        <b class="modal-title normal-title">Edit Item</b>
        <form id="editServiceForm" name="editServiceForm" action="Service-page.php" method="POST">
        <div class="message-container">
            <div class="modal-description">
            <div class="input-wrap">
                <input type="hidden" id="editServiceId" name="editServiceId" value="1"/>
                <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="editServiceName" required />
                <label>Name<indicator>*</indicator></label>
                </div>
            <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="editServiceDescription" required />
                <label>Description<indicator>*</indicator></label>
                </div>
            </div>
            <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="editServicePrice" required />
                <label>Price<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                    <input class="modal-input" maxlength="4" autocomplete="off" name="editServiceTime" required />
                <label>Duration<indicator>*</indicator></label>
                </div>
        </div>
        
        <button id="editBtn" class="modal-button normal">Edit</button>
        </form>
        <button class="modal-button secondary-button warning" id="cancelEditServiceBtn">Cancel</button>
    </div>


    <script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>
    <script>
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

</script>