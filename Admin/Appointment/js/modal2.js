document.addEventListener('DOMContentLoaded', function () {
    // For Item Inventory Dropdown
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
        const isExpanded = dropdownButton.getAttribute('aria-expanded') === 'true';
        dropdownButton.setAttribute('aria-expanded', !isExpanded);
        dropdownMenu.style.display = isExpanded ? 'none' : 'block';
        loadDropdownProducts();
    });

    function loadDropdownProducts() {
        $.ajax({
            url: 'appointment_crud/get_products2.php',
            type: 'GET',
            success: function (response) {
                $('.dropdown-menu-appointment').html(response);
            },
            error: function () {
                console.error('Failed to load consumed products.');
            }
        });
    }

    // Handle dynamic checkbox and quantity changes for items
    $('body').on('change', '.checkBoxItems', function () {
        const checkbox = $(this);
        const productName = checkbox.data('name');
        const quantityInput = checkbox.closest('div').find('.number-input');
        const quantity = parseInt(quantityInput.val(), 10);

        if (checkbox.is(':checked')) {
            if (!quantity || quantity <= 0) {
                alert('Please enter a valid quantity.');
                checkbox.prop('checked', false);
                return;
            }
            addItemToSelectedItem(productName, quantity);
        } else {
            removeItem(productName);
        }
        updateHiddenFieldItems();
    });

    function addItemToSelectedItem(productName, quantity) {
        $('.selected-items').append(`
            <div class="selected-item-box" data-product="${productName}">
                <button class="remove-item" onclick="removeItem('${productName}')">X</button>
                ${productName} (Quantity: ${quantity})
            </div>
        `);
    }

    function removeItem(productName) {
        $(`.selected-item-box[data-product="${productName}"]`).remove();
        updateHiddenFieldItems();
    }

    function updateHiddenFieldItems() {
        const selectedProducts = [];
        $('.selected-item-box').each(function () {
            const product = $(this).data('product');
            const quantity = parseInt($(this).text().match(/\d+/)[0], 10);
            selectedProducts.push({ product, quantity });
        });
        $('#selected-products').val(JSON.stringify(selectedProducts));
    }

    // For Procedure Dropdown
    const dropdownButtonProcedure = document.getElementById('dropdownButtonProcedure');
    const dropdownMenuProcedure = document.getElementById('dropdownMenuProcedure');

    dropdownButtonProcedure.addEventListener('click', function () {
        const isExpanded = dropdownButtonProcedure.getAttribute('aria-expanded') === 'true';
        dropdownButtonProcedure.setAttribute('aria-expanded', !isExpanded);
        dropdownMenuProcedure.style.display = isExpanded ? 'none' : 'block';
        loadDropdownProcedures();
    });

    function loadDropdownProcedures() {
        $.ajax({
            url: 'appointment_crud/get_procedures.php',
            type: 'GET',
            success: function (response) {
                $('#dropdownMenuProcedure').html(response);
            },
            error: function () {
                console.error('Failed to load procedures.');
            }
        });
    }

    $('body').on('change', '.checkBoxProcedure', function () {
        const checkbox = $(this);
        const procedureName = checkbox.data('name');

        if (checkbox.is(':checked')) {
            addItemToSelectedProcedure(procedureName);
        } else {
            removeProcedure(procedureName);
        }
        updateHiddenFieldProcedures();
    });

    function addItemToSelectedProcedure(procedureName) {
        $('.selected-items').append(`
            <div class="selected-item-box" data-procedure="${procedureName}">
                <button class="remove-item" onclick="removeProcedure('${procedureName}')">X</button>
                ${procedureName}
            </div>
        `);
    }

    function removeProcedure(procedureName) {
        $(`.selected-item-box[data-procedure="${procedureName}"]`).remove();
        updateHiddenFieldProcedures();
    }

    function updateHiddenFieldProcedures() {
        const selectedProcedures = [];
        $('.selected-item-box[data-procedure]').each(function () {
            selectedProcedures.push($(this).data('procedure'));
        });
        $('#selected-procedures').val(JSON.stringify(selectedProcedures));
    }
});
