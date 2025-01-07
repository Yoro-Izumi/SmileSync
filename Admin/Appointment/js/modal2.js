document.addEventListener('DOMContentLoaded', function () {
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
