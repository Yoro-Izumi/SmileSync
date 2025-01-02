// jQuery is required for this script to work
$(document).ready(function() {
    // Select all functionality
    $(document).on('change', 'thead input[type=checkbox]', function() {
        const isChecked = $(this).prop('checked');
        $('tbody input[type=checkbox]').prop('checked', isChecked);
    });

    // Delete selected items
    $('#removeProduct').on('click', function() {
        const selectedIds = [];
        $('tbody input[type=checkbox]:checked').each(function() {
            const row = $(this).closest('tr');
            selectedIds.push(row.find('[data-label="Product ID"]').text().trim());
        });

        if (selectedIds.length === 0) {
            alert('Please select at least one product to delete.');
            return;
        }

        if (confirm('Are you sure you want to delete the selected products?')) {
            $.ajax({
                url: 'modal_crud/delete_products.php',
                method: 'POST',
                data: { ids: selectedIds },
                success: function(response) {
                    alert(response.message);
                    location.reload(); // Refresh page
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('An error occurred.');
                }
            });
        }
    });

    // Update product details
    $('#editProduct').on('click', function() {
        const productId = $(this).closest('tr').find('[data-label="Product ID"]').text().trim();
        $.ajax({
            url: 'modal_crud/get_product_details.php',
            method: 'GET',
            data: { id: productId },
            success: function(data) {
                // Populate edit form
                const product = data.product;
                $('#editModal input[name="ProductName"]').val(product.name);
                $('#editModal input[name="ProductType"]').val(product.type);
                $('#editModal input[name="ProductQuantity"]').val(product.quantity);
                $('#editModal input[name="BatchDate"]').val(product.batch_date);
                $('#editModal input[name="OrderValue"]').val(product.order_value);
                $('#editModal input[name="BuyingPrice"]').val(product.buying_price);
                $('#editModal input[name="ProductBrand"]').val(product.brand);
                $('#editModal input[name="ExpiryDate"]').val(product.expiry_date);
                $('#editModal').addClass('show');
            },
            error: function(xhr) {
                console.error(xhr);
                alert('Unable to fetch product details.');
            }
        });
    });

    $('#EditBtn').on('click', function() {
        const updatedProduct = {
            id: $('#editModal input[name="ProductID"]').val(),
            name: $('#editModal input[name="ProductName"]').val(),
            type: $('#editModal input[name="ProductType"]').val(),
            quantity: $('#editModal input[name="ProductQuantity"]').val(),
            batch_date: $('#editModal input[name="BatchDate"]').val(),
            order_value: $('#editModal input[name="OrderValue"]').val(),
            buying_price: $('#editModal input[name="BuyingPrice"]').val(),
            brand: $('#editModal input[name="ProductBrand"]').val(),
            expiry_date: $('#editModal input[name="ExpiryDate"]').val()
        };

        $.ajax({
            url: 'modal_crud/update_product.php',
            method: 'POST',
            data: updatedProduct,
            success: function(response) {
                alert(response.message);
                $('#editModal').removeClass('show');
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr);
                alert('Failed to update product details.');
            }
        });
    });

    // View product details
    $('#viewDetails').on('click', function() {
        const productId = $(this).closest('tr').find('[data-label="Product ID"]').text().trim();
        $.ajax({
            url: 'modal_crud/get_product_details.php',
            method: 'GET',
            data: { id: productId },
            success: function(data) {
                const product = data.product;
                const modal = $('#viewItemModal');
                modal.find('td:contains("Product Name") + td').text(product.name);
                modal.find('td:contains("Product ID") + td').text(product.id);
                modal.find('td:contains("Product Category") + td').text(product.category);
                modal.find('td:contains("Expiry Date") + td').text(product.expiry_date);
                modal.find('td:contains("Threshold Value") + td').text(product.threshold);
                modal.find('td:contains("Opening Stock") + td').text(product.opening_stock);
                modal.find('td:contains("Remaining Stock") + td').text(product.remaining_stock);
                modal.find('td:contains("Store Name") + td').text(product.store_name);
                modal.addClass('show');
            },
            error: function(xhr) {
                console.error(xhr);
                alert('Failed to fetch product details.');
            }
        });
    });
});
