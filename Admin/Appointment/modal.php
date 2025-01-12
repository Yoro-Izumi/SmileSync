<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<div class="modal" id="appointmentDoneModal">
    <div class="done-modal">
   <div class="modal-done">

    <div class="modal-header"> 
            </div>
            <?php include "done-appointment.php"; ?>
</div>

</div></div>


<div class="modal" id="existingAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="cancelSubmitExistingBtn">&times;</button>
        <div class="modal-title normal-title">Add Existing Account</div>
        <div class="modal-description">
        <?php include "existingAppointment.php"; ?>
        </div>
     </div>
</div>



<div class="modal" id="newAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="cancelSubmitNewBtn">&times;</button>
        <div class="modal-title normal-title">Add New Account</div>
        <div class="modal-description">
        <?php include "newAppointment.php"; ?>
        </div>
     </div>
</div>



<div class="modal" id="deleteNewProgressModal">

    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">DELETE PROGRESS</div>
        <div class="message-container">
            <div class="modal-description">
                All progress will be removed.
            </div>
        </div>

        <button class="modal-button normal" id="deleteNewProgressBtn">Delete</button>
        <button class="modal-button secondary-button warning" id="cancelNewDeleteBtn">Cancel</button>
    </div>
</div>

<div class="modal" id="deleteExistingProgressModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">DELETE PROGRESS</div>
        <div class="message-container">
            <div class="modal-description">
                All progress will be removed.
            </div>
        </div>
        <button class="modal-button normal" id="deleteExistingProgressBtn">Delete</button>
        <button class="modal-button secondary-button warning" id="cancelExistingDeleteBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Warning Modal -->
<div class="modal" id="cancelAppointmentModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Appointment Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) appointment. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="cancelAppointmentBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelBtn">Cancel</button>
    </div>
</div>

<!-- Success Modal -->
<div class="modal" id="appointmentSuccessModal">
    <div class="modal-content">
        <div class="modal-title success-title">Appointment Added Successfully!</div>
        <div class="message-container">
            <div class="modal-description">
                Appointment was successfully added to the account. Please check your email for confirmation.
            </div>
        </div>
        <button id="closeAppointmentSuccessBtn" class="modal-button success">OK</button>
    </div>
</div> 



 <!-- Modal -->
 <div class="modal" id="cancelAppointmentModal">
    <div class="modal-content">
      <span class="closebtn" id="closeCancelAppointmentModal">&times;</span>
      <div class="modal-title normal-title">Cancel Appointment</div>
      <div class="modal-description">
      <p>
        Oh no! We're sorry if there were any inconvenience on our part. 
        Please select reasons why you need to cancel your appointment:
      </p>
      <form>
        <label>
          <input type="radio" name="reason" value="busy" required>
          Too busy, my schedule does not align with appointment.
        </label>
        <label>
          <input type="radio" name="reason" value="emergency">
          Family emergency
        </label>
        <label>
          <input type="radio" name="reason" value="other">
          Other Reasons
        </label>
        <div class="other-reason" id="otherReasonContainer">
          <label for="otherReason">Please specify the reason: *</label>
          <input type="text" id="otherReason" name="otherReason">
        </div>
        <button type="submit" class="cancel-btn">Cancel Appointment</button>
      </form>
        </div>   
    </div>
  </div>



  <div class="modal" id="newAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="closeRescheduleButton">&times;</button>
        <div class="modal-title normal-title">Reschedule Appointment</div>
        <div class="modal-description">
        <?php include "reschedule-appointment.php"; ?>
        </div>
     </div>
</div>


<div id="alertContainer"></div>
<script src="js/alert.js"></script>
<script src="js/modal.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            function toggleDropdown() {
              const dropdownMenu = document.querySelector('.dropdown-menu');
              dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            }

            $('input[type="checkbox"]').on('change', function() {
                const isChecked = $(this).is(':checked');
                const productName = $(this).data('name');
                const quantity = $(this).siblings('.number-input').val();

                if (isChecked) {
                    $('.selected-items').append(`
                        <div class="selected-item-box" data-product="${productName}">
                            <button class="remove-item" onclick="removeItem('${productName}')">X</button>
                            ${productName} (Quantity: ${quantity})
                        </div>
                    `);
                } else {
                    $('.selected-item-box[data-product="${productName}"]').remove();
                }
                updateHiddenField();
            });

            $('.number-input').on('change', function() {
                const productName = $(this).siblings('input[type="checkbox"]').data('name');
                const newQuantity = $(this).val();

                $('.selected-item-box[data-product="${productName}"]').html(`
                    <button class="remove-item" onclick="removeItem('${productName}')">X</button>
                    ${productName} (Quantity: ${newQuantity})
                `);
                updateHiddenField();
            });

            function removeItem(productName) {
                $('input[data-name="${productName}"]').prop('checked', false);
                $('.selected-item-box[data-product="${productName}"]').remove();
                updateHiddenField();
            }

            function updateHiddenField() {
                const selectedProducts = [];
                $('.selected-item-box').each(function() {
                    const product = $(this).data('product');
                    const quantity = $(this).text().match(/\d+/)[0];
                    selectedProducts.push({ product, quantity });
                });
                $('#selected-products').val(JSON.stringify(selectedProducts));
            }

          document.querySelector('.close-btn').addEventListener('click', function () {
              alert('Modal closed');
              // Add functionality to close modal here
          });
      </script>


</body>
</html>
