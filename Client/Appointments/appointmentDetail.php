
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic - Treatment Record</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            font-size: 12px;
        }

        .modal {
            max-width: 700px;
            margin: 20px auto;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: center; /* Horizontally center */
            align-items: center;     /* Vertically center */
            position: relative;
        }

        .modal-header .content {
            text-align: center; /* Center text within the content div */
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }


        .modal-header h2 {
            color: #D32F2F;
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .modal-header p {
            margin: 0;
            font-size: 10px;
            color: #888;
        }

        .close-btn {
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
            color: #333;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0D6EFD;
            margin-bottom: 5px;
            border-top: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 12px;
            color: #333;
            display: block;
        }

        .form-group input[readonly] {
            font-size: 12px;
            padding: 6px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 3px;
            width: 100%;
        }

        .personal-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 8px;
        }

        .form-group {
            margin-bottom: 10px;
            margin-left: 10px;
            margin-right:10px;
            border-radius: 4px;
        }

        .personal-info2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Creates a 2-column grid */
            grid-gap: 8px;
        }

        .form-group2 {
            display: flex;
            margin-bottom: 10px;
        }

        label {
            width: 150px; /* Set a fixed width for the label */
            font-weight: bold;
        }

        span {
            flex-grow: 1; /* Allows the span to take up the remaining space */
            padding-left: 10px; /* Adds space between the label and text */
        }


        .treatment-record {
            margin-top: 10px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
            font-size: 12px;
        }

        .button-container {
            display: flex; /* Change display to flex */
            justify-content: center; /* Center the buttons horizontally */
            margin-top: 10px;
        }

        .button-container .action-btn {
            padding: 8px 15px;
            font-size: 14px;
            border: none;
            border-top: 20px;
            color: white;
            background-color: #0D6EFD;
            border-radius: 20px;
            cursor: pointer;
        }

        .button-container .action-btn:hover {
            background-color: #0056b3;
        }


        .form-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 8px;
        }

        .doctor-remarks {
            grid-column: span 2;
        }

        .doctor-remarks textarea {
            height: 50px;
        }

        .dropdown-container {
            position: relative;
            width: 100%;
        }

        .dropdown-container button {
            width: 100%;
            padding: 8px;
            background-color: white;
            color: black;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            text-align: left;
            font-size: 12px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
            z-index: 1;
            border-radius: 4px;
            margin-top: 3px;
        }

        .dropdown-menu label {
            padding: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .dropdown-menu label:last-child {
            border-bottom: none;
        }

        .selected-items {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .selected-item-box {
            display: flex;
            align-items: center;
            padding: 6px;
            background-color: #eaf4fe;
            border-radius: 4px;
            position: relative;
            border: 1px solid #ddd;
            padding-left: 20px;
            font-size: 12px;
        }

        .remove-item {
            position: absolute;
            left: 5px;
            background-color: transparent;
            color: black;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .remarks-container {
            margin-top: 0px;
            grid-column: 2 / 3;
        }

        .remarks-container textarea {
            width: 100%;
            height: 80px;
            padding: 0px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="modal">
        <div class="modal-header">
                <div class="content">
                    <h2>iMee-Toga Oli Dental Clinic</h2>
                    <p>788 Rizal Blvd. Poblacion Brgy. Market Area, Santa Rosa Laguna</p>
                </div>
                <button class="close-btn">&times;</button>
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
                <label>Consumed Products:</label>
                <div class="dropdown-container">
                    <button onclick="toggleDropdown()">Select Products</button>
                    <div class="dropdown-menu">
                        <label>
                            <input type="checkbox" value="Product A" data-name="Product A">
                            Product A
                            <input type="number" value="1" min="1" max="99" class="number-input">
                        </label>
                        <label>
                            <input type="checkbox" value="Product B" data-name="Product B">
                            Product B
                            <input type="number" value="1" min="1" max="99" class="number-input">
                        </label>
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
                    <button class="action-btn">Mark as Done</button>
                </div>

            </div></div>
        </div>
    </div>

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
                    $(.selected-item-box[data-product="${productName}"]).remove();
                }
                updateHiddenField();
            });

            $('.number-input').on('change', function() {
                const productName = $(this).siblings('input[type="checkbox"]').data('name');
                const newQuantity = $(this).val();

                $(.selected-item-box[data-product="${productName}"]).html(`
                    <button class="remove-item" onclick="removeItem('${productName}')">X</button>
                    ${productName} (Quantity: ${newQuantity})
                `);
                updateHiddenField();
            });

            function removeItem(productName) {
                $(input[data-name="${productName}"]).prop('checked', false);
                $(.selected-item-box[data-product="${productName}"]).remove();
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