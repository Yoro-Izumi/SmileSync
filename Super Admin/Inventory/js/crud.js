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

});
