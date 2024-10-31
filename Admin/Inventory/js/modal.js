document.addEventListener('DOMContentLoaded', function() {
   //Modal
    const viewDetailsModal = document.getElementById('viewItemModal');
    const deleteProgressModal = document.getElementById('deleteProgressModal');
    const addItemModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const confirmEditModal = document.getElementById('confirmEditModal'); 
    const deleteInventoryModal = document.getElementById('removeItemModal'); 
    //Buttons
    const viewDetailsBtn = document.getElementById('viewDetails');
    const viewDetailsHistoryBtn = document.getElementById('viewDetailsHistory'); 
    const okViewBtn = document.getElementById('okView');

    const addProductBtn = document.getElementById('addProduct');
    const addItemBtn = document.getElementById('addItemBtn');
    const cancelAddItemBtn = document.getElementById('cancelAddItemBtn');

    const deleteProgressBtn = document.getElementById('deleteNewProgressBtn');
    const cancelDeleteProgressBtn = document.getElementById('cancelNewDeleteBtn');

    const editProductBtn = document.getElementById('editProduct');
    const editBtn = document.getElementById('EditBtn');
    const cancelEditBtn = document.getElementById('cancelEditItemBtn');


    const confirmEditBtn = document.getElementById('confirmEditBtn');
    const cancelConfirmEditBtn = document.getElementById('cancelConfirmEditBtn');


    const removeItemTableBtn = document.getElementById('removeProductTable');
    const deleteInventoryBtn  = document.getElementById('removeProduct');
    const removeItemBtn = document.getElementById('removeItemBtn');
    const cancelDeleteInventoryBtn = document.getElementById('cancelRemoveItemBtn');


    // Show View Detais of Product and Product History
    viewDetailsBtn.addEventListener('click', function(){
        viewDetailsModal.classList.add('show');
    });

    viewDetailsHistoryBtn.addEventListener('click', function(){
        viewDetailsModal.classList.add('show');
    });

    // Close View Details Modal
    okViewBtn.addEventListener('click', function(){
        viewDetailsModal.classList.remove('show');
    });

    // Add New Item Modal
    addProductBtn.addEventListener('click', function(){
        addItemModal.classList.add('show');
    });

    addItemBtn.addEventListener('click', function(){
        addItemModal.classList.remove('show');
    });
    // Show if progress muust continue modal   
    cancelAddItemBtn.addEventListener('click', function(){
        deleteProgressModal.classList.add('show');
    });
    
    cancelDeleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
    });

    deleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
        addItemModal.classList.remove('show');
    });

    // Show Edit Item Modal
    editProductBtn.addEventListener('click', function(){
        editModal.classList.add('show');
    });

    cancelEditBtn.addEventListener('click', function(){
        editModal.classList.remove('show');
    });
    
    // Confirm to edit item MOdal-------
    editBtn.addEventListener('click', function(){
        confirmEditModal.classList.add('show');
    });

    confirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
    });

    cancelConfirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
    });
      

    // Show Delete Inventory modal----------
    removeItemTableBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.add('show');
    }); 

    deleteInventoryBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.add('show');
    });

    cancelDeleteInventoryBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.remove('show');
    });


    // Close/Discard Delete Invntory Modal
    removeItemBtn.addEventListener('click', function() {
        deleteInventoryModal.classList.remove('show');
    });


});
