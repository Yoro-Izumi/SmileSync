document.addEventListener('DOMContentLoaded', function() {
    // Modal Elements
    const viewDetailsModal = document.getElementById('viewItemModal');
    const deleteInventoryModal = document.getElementById('removeItemModal'); 

    // Button Elements
    const viewDetailsHistoryBtn = document.getElementById('viewDetailsHistory'); 
    const okViewBtn = document.getElementById('okView');
    const removeItemTableBtn = document.getElementById('removeProductTable');
    const deleteInventoryBtn = document.getElementById('removeProduct');
    const removeItemBtn = document.getElementById('removeItemBtn');
    const cancelDeleteInventoryBtn = document.getElementById('cancelRemoveItemBtn');


    viewDetailsHistoryBtn.addEventListener('click', function(){
        viewDetailsModal.classList.add('show');
    });

    // Close View Details Modal
    okViewBtn.addEventListener('click', function(){
        viewDetailsModal.classList.remove('show');
    });


    // Show Delete Inventory modal
    removeItemTableBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.add('show');
    });

    deleteInventoryBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.add('show');
    });

    cancelDeleteInventoryBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.remove('show');
    });

    // Close/Discard Delete Inventory Modal
    removeItemBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.remove('show');
    });
});
