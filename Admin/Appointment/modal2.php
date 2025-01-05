<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<div class="modal" id="appointmentDoneModal">
<form id="doneAppointmentForm" name="doneAppointmentForm" method="POST" action="appointment_crud/done_appointment.php">
    <div class="done-modal">
   <div class="modal-done">
    <div class="modal-header">
                <div class="content">
                    <h2>iMee-Toga Oli Dental Clinic</h2>
                    <p>788 Rizal Blvd. Poblacion Brgy. Market Area, Santa Rosa Laguna</p>
                </div>
                <button class="close-btn"><a href="#" id="closeDone">&times;</a></button>
            </div>

        <!-- Personal Information -->
        <div class="section-title">Personal Information</div>
        
        <div class="personal-info2">
            <div class="form-group2">
                <label>Patient Name:</label>
                <span>Dimaculangan, Chorlyn L.</span>
            </div>
            <div class="form-group2">
                <label>Phone Number:</label>
                <span>0912345678</span>
            </div>
        </div>
        <div class="personal-info2">
            <div class="form-group2">
                <label>Age:</label>
                <span>22</span>
            </div>
            <div class="form-group2">
                <label>Sex:</label>
                <span>Female</span>
            </div>
            <div class="form-group2">
                <label>Birth Date:</label>
                <span>01/03/2024</span>
            </div>
        </div>

        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="Brgy. Sinalhan, Purok 7" />
            </div>
            <div class="form-group">
                <label>City:</label>
                <input type="text" readonly value="Santa Rosa City" />
            </div>
            <div class="form-group">
                <label>Province:</label>
                <input type="text" readonly value="Laguna" />
            </div>
        </div>
        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="Brgy. Sinalhan, Purok 7" />
            </div>
            <div class="form-group">
                <label>Relationship:</label>
                <input type="text" readonly value="Grandmother" />
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" readonly value="09876543210" />
            </div>
        </div>
        <!-- Treatment Record -->
        <div class="treatment-record">
            <div class="section-title">Treatment Record</div>
            <div class="personal-info2">
                <div class="form-group">
                    <label>Date of Appointment:</label>
                    <input type="text" readonly value="29/03/2024" />
                </div>
                <div class="form-group">
                    <label>Procedure/s:</label>
                    <input type="text" readonly value="Prosthodontics" />
                </div>
                <div class="form-group">
                    <label>Dentist/s:</label>
                    <input type="text" readonly value="Dr.Oli, Jonas" />
                </div>
                <div class="form-group">
                    <label>No. of Tooth:</label>
                    <input type="text" readonly value="3" />
                </div>

            </div>
    <div class="form-group">
    <label for="dropdownButton">Consumed Products:</label>
    <input name="done_appointment_id" id="done_appointment_id" type="hidden" >
    <div class="dropdown-container">
       
        <button id="dropdownButton" type="button" onclick="toggleDropdown()" aria-expanded="false" aria-controls="dropdownMenu">
            Select Products
        </button>
        <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
            <div>
                <input type="checkbox" class="checkBoxItems" value="Product A" data-name="Product A" name="itemCheck[]">
                Product A
                <input type="number" value="1" min="1" max="99" class="number-input" data-id="1" aria-label="Quantity for Product A">
            </div>
            <div>
                <input type="checkbox" class="checkBoxItems" value="Product B" data-name="Product B" name="itemCheck[]">
                Product B
                <input type="number" value="1" min="1" max="99" class="number-input" data-id="2" aria-label="Quantity for Product B">
            </div>
        </div>
    </div>
</div>


            <div class="selected-items"></div>
            <input type="hidden" id="selected-products" class="hidden-input" name="selected-products">
            <div class="form-group">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Left Side: Amount Charged, Amount Paid, Balance -->
                <div style="display: grid; grid-template-rows: auto auto auto; gap: 10px;">
                    <div class="form-group">
                        <label>Amount Charged:</label>
                        <input type="text" readonly value="3000" />
                    </div>

                    <div class="form-group">
                        <label>Amount Paid:</label>
                        <input type="text" readonly value="3000" />
                    </div>

                    <div class="form-group">
                        <label>Balance:</label>
                        <input type="text" readonly value="0" />
                    </div>
                </div>

                <!-- Right Side: Doctor's Remarks -->
                <div class="remarks-container">
                    <label for="remarks">Doctor's Remarks:</label>
                    <textarea id="remarks" style="width: 100%; height: 100%;"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="button-container">
                    <button class="action-btn">Cancel</button>
                    <button type="submit" class="action-btn" id="doneAppointmentBtn">Mark as Done</button>
                </div>

            </div></div>
        </div></div>
</div>
</form>
</div>

<script>

    
</script>


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

<!-- Remove Account Warning Modal 
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
</div>-->

<!-- Success Modal 
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
</div> -->

<div id="alertContainer"></div>
<script src="js/alert.js"></script>
<script src="js/modal.js"></script>


<script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Dropdown toggle
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
      const isExpanded = dropdownButton.getAttribute('aria-expanded') === 'true';
      dropdownButton.setAttribute('aria-expanded', !isExpanded);
      dropdownMenu.style.display = isExpanded ? 'none' : 'block';
    });

    // Add item to selected list
    function addItemToSelected(productName, quantity) {
      $('.selected-items').append(`
        <div class="selected-item-box" data-product="${productName}">
          <button class="remove-item" onclick="removeItem('${productName}')">X</button>
          ${productName} (Quantity: ${quantity})
        </div>
      `);
    }

    // Remove selected item
    window.removeItem = function (productName) {
      const checkbox = $(`input[data-name="${productName}"]`);
      checkbox.prop('checked', false);
      $(`.selected-item-box[data-product="${productName}"]`).remove();
      updateHiddenField();
    };

    // Update item quantity
    function updateItemQuantity(productName, newQuantity) {
      $(`.selected-item-box[data-product="${productName}"]`).html(`
        <button class="remove-item" onclick="removeItem('${productName}')">X</button>
        ${productName} (Quantity: ${newQuantity})
      `);
    }

    // Update hidden field
    function updateHiddenField() {
      const selectedProducts = [];
      $('.selected-item-box').each(function () {
        const product = $(this).data('product');
        const quantity = parseInt($(this).text().match(/\d+/)[0], 10);
        selectedProducts.push({ product, quantity });
      });
      $('#selected-products').val(JSON.stringify(selectedProducts));
    }

    // Handle checkbox and quantity changes
    $('body').on('change', 'input[type="checkbox"]', function () {
      const checkbox = $(this);
      const productName = checkbox.data('name');
      const quantity = checkbox.siblings('.number-input').val();

      if (checkbox.is(':checked')) {
        if (!quantity || quantity <= 0) {
          alert('Please enter a valid quantity.');
          checkbox.prop('checked', false);
          return;
        }
        addItemToSelected(productName, quantity);
      } else {
        removeItem(productName);
      }
      updateHiddenField();
    });

    $('body').on('change', '.number-input', function () {
      const input = $(this);
      const newQuantity = input.val();
      const productName = input.siblings('input[type="checkbox"]').data('name');

      if (newQuantity <= 0) {
        alert('Quantity must be greater than 0.');
        return;
      }

      updateItemQuantity(productName, newQuantity);
      updateHiddenField();
    });

    // Fetch products and populate dropdown
    function fetchProducts() {
      const appointmentID = $('#done_appointment_id').val();

      $.ajax({
        url: 'appointment_crud/get_products.php',
        method: 'GET',
        data: { action: 'getProducts' },
        dataType: 'json',
        success: function (products) {
          dropdownMenu.innerHTML = ''; // Clear existing dropdown content

          products.forEach(product => {
            dropdownMenu.innerHTML += `
              <div>
                <input 
                  type="checkbox" 
                  class="checkBoxItems" 
                  data-name="${product.name}" 
                  data-id="${product.id}">
                ${product.name}
                <input 
                  type="number" 
                  class="number-input" 
                  value="1" 
                  min="1" 
                  max="99" 
                  data-id="${product.id}">
              </div>`;
          });

          if (appointmentID) {
            markConsumedProducts(appointmentID);
          }
        },
        error: function () {
          alert('Failed to fetch products.');
        }
      });
    }

    // Mark consumed products
    function markConsumedProducts(appointmentID) {
      $.ajax({
        url: 'appointment_crud/get_products.php',
        method: 'GET',
        data: { action: 'getConsumedProducts', appointmentID },
        dataType: 'json',
        success: function (consumedProducts) {
          consumedProducts.forEach(consumed => {
            const checkbox = $(`input[data-id="${consumed.product_id}"]`);
            const numberInput = $(`input.number-input[data-id="${consumed.product_id}"]`);

            if (checkbox.length) {
              checkbox.prop('checked', true);
              numberInput.val(consumed.quantity);
            }
          });
        },
        error: function () {
          alert('Failed to fetch consumed products.');
        }
      });
    }

    // Initialize product fetching
    fetchProducts();
  });
</script>



</body>
</html>
