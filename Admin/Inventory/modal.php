<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>


<div class="modal" id="newInventoryModal">
    <div class="modal-content">
        <div class="modal-title normal-title">Add Existing Account</div>
        <div class="modal-description">
            --Input data for new account--
        </div>
        <button class="modal-button secondary-button" id="cancelSubmitExistingBtn">Cancel</button>
        <button class="modal-button normal" id="submitExistingBtn">Submit</button>
    </div>
</div>



<div class="modal" id="deleteProgressModal">
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


<!-- Success Approved Account Modal -->
<div class="modal" id="appointmentSuccessModal">
    <div class="modal-content">
        <div class="modal-title success-title">Account Approved!</div>
        <div class="message-container">
            <div class="modal-description">
                Account has been successfully  approved. You may view the  approved account in  Accounts.
            </div>
        </div>
        <button id="closeEditSuccessBtn" class="modal-button success">OK</button>
    </div>
</div>

<!-- Login Failed Modal -->
<div class="modal" id="confirmEditModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Confirm Edit</b>

        <div class="message-container">
            <div class="modal-description">
                By clicking confirm, changes will be saved and can longer be reverted.
            </div>
        </div>
        <button id="Btn" class="modal-button normal">Confirm</button>
    </div>
</div>


<!-- Success Edit Modal -->
<div class="modal" id="appointmentSuccessModal">
    <div class="modal-content">
        <div class="modal-title success-title">Edit Successful!</div>
        <div class="message-container">
            <div class="modal-description">
                Account has been successfully  edited. You may view the  edited account in  Accounts page.
            </div>
        </div>
        <button id="closeEditSuccessBtn" class="modal-button normal">OK</button>
        <button class="modal-button secondary-button warning" id="removeAccountBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Warning Modal -->
<div class="modal" id="deleteProgressModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Account Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) account. The user will no longer be able to access their account. 
            </div>
        </div>
        <button class="modal-button normal" id="removeAccountBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelRemoveAccountBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Success Modal -->
<div class="modal" id="deleteProgressModal">
    <div class="modal-content">
        <div class="modal-title warning-title">Account Removed</div>
        <div class="message-container">
            <div class="modal-description">
                Account has been successfully removed. You may view the removed account in Archive.
            </div>
        </div>
        <button id="okRemoveAccount" class="modal-button success">OK</button>
    </div>
</div>

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
