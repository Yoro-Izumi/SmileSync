document.addEventListener('DOMContentLoaded', function () {
    // Modal Manager for dynamic modal handling
    const ModalManager = {
        toggle: (modalId, action = 'open') => {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList[action === 'open' ? 'add' : 'remove']('show');
        },
    };

    // Centralized AJAX Request Handler
    const ajaxRequest = (url, method, data, successCallback, errorCallback) => {
        $.ajax({
            url,
            method,
            data,
            dataType: 'json',
            success: successCallback,
            error: (xhr, status, error) => {
                console.error('AJAX Error:', status, error);
                if (errorCallback) errorCallback(xhr, status, error);
            },
        });
    };

    // Handle Dynamic Button Actions
    const setupDynamicActions = () => {
        document.body.addEventListener('click', function (event) {
            // View Details
            if (event.target.closest('.viewDetails')) {
                const itemId = event.target.closest('.viewDetails').dataset.id;
                document.getElementById('edit_item_id').value = itemId;
            
                // Function to fetch and populate product details
                const fetchProductDetails = (url, data, callback) => {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (!response.error) {
                                callback(response);
                            } else {
                                alert(response.error); // Show error message from PHP
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', status, error); // Log AJAX errors for debugging
                            alert('An error occurred while fetching product details.');
                        }
                    });
                };
            
                // Show the modal for viewing product details
                const showViewDetailsModal = (data) => {
                    const modal = $('#viewItemModal');
                    modal.find('td:nth-child(2)').eq(0).text(data.item_name || 'N/A'); // Product Name
                    modal.find('td:nth-child(2)').eq(1).text(data.item_id || 'N/A'); // Product ID
                    modal.find('td:nth-child(2)').eq(2).text(data.category_id || 'N/A'); // Product Category
                    modal.find('td:nth-child(2)').eq(3).text(data.expiry_date || 'N/A'); // Expiry Date
                    modal.find('td:nth-child(2)').eq(4).text(data.item_reorder_level || 'N/A'); // Threshold Value
                    modal.find('td:nth-child(2)').eq(5).text(data.item_quantity || 'N/A'); // Opening Stock
                    modal.find('td:nth-child(2)').eq(6).text(data.remaining_quantity || 'N/A'); // Remaining Stock
                    modal.fadeIn();
                };
            
                // Show the modal for editing product details
                const showEditDetailsModal = (data) => {
                    $('#edit_item_id').val(data.item_id || '');
                    $('[name="EditProductName"]').val(data.item_name || '');
                    $('[name="EditProductType"]').val(data.category_id || '');
                    $('[name="EditProductQuantity"]').val(data.item_quantity || '');
                    $('[name="EditBatchDate"]').val(data.batch_date || '');
                    $('[name="EditOrderValue"]').val(data.item_unit_price || '');
                    $('[name="EditBuyingPrice"]').val(data.buying_price || '');
                    $('[name="EditProductBrand"]').val(data.item_description || '');
                    $('[name="EditExpiryDate"]').val(data.expiry_date || '');
                    $('#editModal').fadeIn();
                };
            
                // Attach event listener to edit button dynamically
                $('#editProduct').off('click').on('click', function () {
                    fetchProductDetails('modal_crud/get_product_details.php', { id: itemId }, showEditDetailsModal);
                });
            
                // Trigger fetch immediately after click for view details
                fetchProductDetails('modal_crud/get_product_details_view.php', { id: itemId }, showViewDetailsModal);
            
                // Open the view item modal
                ModalManager.toggle('viewItemModal', 'open');
            }
            
            
            // Remove Product
            if (event.target.closest('.removeProductTable')) {
                const itemId = event.target.closest('.removeProductTable').dataset.id;
                ModalManager.toggle('removeItemModalSolo', 'open');

                document.getElementById('removeItemBtnSolo').addEventListener('click', () => {
                    ajaxRequest(
                        'modal_crud/delete_indiv_product.php',
                        'POST',
                        { id: itemId },
                        (response) => {
                            if (response === 'success') {
                                location.reload();
                            } else {
                                //alert('Error deleting item!');
                            }
                        }
                    );
                });
            }
        });
    };

    // Setup Modal Button Events
    const setupModalEvents = () => {
        const buttons = {
            okViewBtn: document.getElementById('okView'),
            addProductBtn: document.getElementById('addProduct'),
            addItemBtn: document.getElementById('addItemBtn'),
            cancelAddItemBtn: document.getElementById('cancelAddItemBtn'),
            editProductBtn: document.getElementById('editProduct'),
            cancelEditBtn: document.getElementById('cancelEditItemBtn'),
            cancelConfirmEditBtn: document.getElementById('cancelConfirmEditBtn'),
            cancelDeleteInventoryBtn: document.getElementById('cancelRemoveItemBtn'),
        };

        buttons.okViewBtn?.addEventListener('click', () => ModalManager.toggle('viewItemModal', 'close'));
        buttons.addProductBtn?.addEventListener('click', () => ModalManager.toggle('addModal', 'open'));
        buttons.addItemBtn?.addEventListener('click', () => ModalManager.toggle('addModal', 'close'));
        buttons.cancelAddItemBtn?.addEventListener('click', () => ModalManager.toggle('addModal', 'close'));
        buttons.editProductBtn?.addEventListener('click', () => {
            ModalManager.toggle('viewItemModal', 'close');
            ModalManager.toggle('editModal', 'open');
        });
        buttons.cancelEditBtn?.addEventListener('click', () => ModalManager.toggle('editModal', 'close'));
        buttons.cancelConfirmEditBtn?.addEventListener('click', () => ModalManager.toggle('confirmEditModal', 'close'));
        buttons.cancelDeleteInventoryBtn?.addEventListener('click', () => ModalManager.toggle('removeItemModal', 'close'));
    };

    // Export Functionality
    const exportToFile = (type) => {
        const productTable = document.querySelector('table');

        if (!productTable) {
            alert('No table found to export!');
            return;
        }

        if (type === 'excel') {
            const wb = XLSX.utils.table_to_book(productTable, { sheet: "Product Overview" });
            const wbout = XLSX.write(wb, { bookType: "xlsx", type: "array" });
            const blob = new Blob([wbout], { type: "application/octet-stream" });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = "product_overview.xlsx";
            link.click();
        } else if (type === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.autoTable({ html: productTable });
            doc.save('product_overview.pdf');
        } else if (type === 'word') {
            const pptx = new PptxGenJS();
            const slide = pptx.addSlide();
            const rows = Array.from(productTable.rows).map(row =>
                Array.from(row.cells).map(cell => cell.innerText)
            );
            slide.addTable(rows, { x: 1, y: 1, w: '90%', h: '80%' });
            pptx.save("product_overview");
        }
    };

    // Export Buttons
    document.getElementById('exportExcel')?.addEventListener('click', () => exportToFile('excel'));
    document.getElementById('exportPDF')?.addEventListener('click', () => exportToFile('pdf'));
    document.getElementById('exportWord')?.addEventListener('click', () => exportToFile('word'));

    // Form Submission: Add Item
    $('#addItemForm').on('submit', function (event) {
        event.preventDefault();
        const formData = $(this).serialize();

        ajaxRequest(
            'modal_crud/inventory_add.php',
            'POST',
            formData,
            (response) => {
                if (response.success) {
                    //alert(response.message);
                    $('#addItemForm')[0].reset();
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            }
        );
    });

    // Form Submission: Edit Item
    $('#editItemForm').on('submit', function (event) {
        event.preventDefault();
        const formData = $(this).serialize();

        ajaxRequest(
            'modal_crud/update_product.php',
            'POST',
            formData,
            (response) => {
                if (response === 'success') {
                    alert('Item updated successfully!');
                    ModalManager.toggle('confirmEditModal', 'close');
                    ModalManager.toggle('editModal', 'close');
                    location.reload();
                } else {
                    alert('Error updating item!');
                }
            }
        );
    });

    // Bubble Design Styles
    const bubbleDesignStyles = `
        .bubble {
            border-radius: 12px;
            background: #f2f2f2;
            padding: 8px 16px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
    `;

    const style = document.createElement('style');
    style.innerHTML = bubbleDesignStyles;
    document.head.appendChild(style);

    // Initialize Events
    setupDynamicActions();
    setupModalEvents();
});



