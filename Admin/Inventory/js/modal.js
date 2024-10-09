document.addEventListener('DOMContentLoaded', function() {
   //Modal
    const deleteInventoryModal = document.getElementById('removeItemModal');

    
    //Buttons
    const deleteInventory  = document.getElementById('removeProduct');
    const cancelDeleteInventory = document.getElementById('cancelRemoveItemBtn');


    // Show Delete Inventory modal
    deleteInventory.addEventListener('click', function() {
        deleteInventoryModal.classList.add('show');
    });

    // Close/Discard Delete Invntory Modal
    cancelDeleteInventory.addEventListener('click', function() {
        deleteInventoryModal.classList.remove('show');
    });


});
