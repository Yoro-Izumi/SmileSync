$(document).ready(function () {
    function fetchItems() {
        $.post('inventory_crud.php', { action: 'fetch_items' }, function (data) {
            const items = JSON.parse(data);
            $('#itemTable tbody').empty();
            items.forEach(item => {
                $('#itemTable tbody').append(`
                    <tr>
                        <td>${item.item_id}</td>
                        <td>${item.item_name}</td>
                        <td>${item.item_quantity}</td>
                        <td>${item.item_unit_price}</td>
                        <td>
                            <button class="edit-btn" data-id="${item.item_id}">Edit</button>
                            <button class="delete-btn" data-id="${item.item_id}">Delete</button>
                        </td>
                    </tr>
                `);
            });
        });
    }

    // Add Item
    $('#addItemForm').submit(function (e) {
        e.preventDefault();
        const formData = $(this).serialize() + '&action=add_item';
        $.post('modal_crud/inventory_crud.php', formData, function (response) {
            if (response === 'success') {
                alert('Item added successfully!');
                fetchItems();
                $('#addItemModal').modal('hide');
            } else {
                alert('Failed to add item.');
            }
        });
    });

    // Edit Item
    $(document).on('click', '.edit-btn', function () {
        const itemId = $(this).data('id');
        // Fetch and populate modal for editing
    });

    // Delete Item
    $(document).on('click', '.delete-btn', function () {
        const itemId = $(this).data('id');
        if (confirm('Are you sure?')) {
            $.post('inventory_crud.php', { action: 'delete_item', item_id: itemId }, function (response) {
                if (response === 'success') {
                    alert('Item deleted successfully!');
                    fetchItems();
                } else {
                    alert('Failed to delete item.');
                }
            });
        }
    });

    fetchItems();
});
