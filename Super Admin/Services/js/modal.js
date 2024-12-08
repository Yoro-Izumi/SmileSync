document.addEventListener('DOMContentLoaded', function() {
    //Modal
    const viewDetailsModal = document.getElementById('viewServiceModal');
    const deleteProgressModal = document.getElementById('deleteProgressModal');
    const addServiceModal = document.getElementById('addServiceModal');
    const editModal = document.getElementById('editModal');
    const confirmEditModal = document.getElementById('confirmEditModal'); 
    const deleteServicesModal = document.getElementById('removeServicesModal'); 
    //Buttons
    const viewDetailsBtn = document.getElementById('viewServices'); 
    const okViewBtn = document.getElementById('okView');

    const addServicesBtn = document.getElementById('addServices');
    const addServiceBtn = document.getElementById('addServiceBtn');
    const cancelAddServiceBtn = document.getElementById('cancelAddServiceBtn');

    const deleteProgressBtn = document.getElementById('deleteNewProgressBtn');
    const cancelDeleteProgressBtn = document.getElementById('cancelNewDeleteBtn');

    const editServiceBtn = document.getElementById('editServicesTable');
    const editBtn = document.getElementById('editBtn');
    const cancelEditBtn = document.getElementById('cancelEditServiceBtn');

    const confirmEditBtn = document.getElementById('confirmEditBtn');
    const cancelConfirmEditBtn = document.getElementById('cancelConfirmEditBtn');

    const deleteServicesBtn = document.getElementById('deleteServicesTable');
    const removeServiceBtn = document.getElementById('removeServiceBtn');
    const cancelDeleteServicesBtn = document.getElementById('cancelRemoveServiceBtn');

    // Show View Details of Service and Service History
    viewDetailsBtn.addEventListener('click', function(){
        viewDetailsModal.classList.add('show');
    });

    // Close View Details Modal
    okViewBtn.addEventListener('click', function(){
        viewDetailsModal.classList.remove('show');
    });

    // Add New Service Modal
    addServicesBtn.addEventListener('click', function(){
        addServiceModal.classList.add('show');
    });

    addServiceBtn.addEventListener('click', function(){
        addServiceModal.classList.remove('show');
    });
    // Show if progress must continue modal   
    cancelAddServiceBtn.addEventListener('click', function(){
        deleteProgressModal.classList.add('show');
    });
    
    cancelDeleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
    });

    deleteProgressBtn.addEventListener('click', function(){
        deleteProgressModal.classList.remove('show');
        addServiceModal.classList.remove('show');
    });

    // Show Edit Service Modal
    editServiceBtn.addEventListener('click', function(){
        editModal.classList.add('show');
        viewDetailsModal.classList.remove('show');
    });

    cancelEditBtn.addEventListener('click', function(){
        editModal.classList.remove('show');
    });
    
    // Confirm to edit Service Modal-------
    editBtn.addEventListener('click', function(){
        confirmEditModal.classList.add('show');
    });

    confirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
        editModal.classList.remove('show');
    });

    cancelConfirmEditBtn.addEventListener('click', function(){
        confirmEditModal.classList.remove('show');
    });
       

    // Show Delete Services modal----------
    deleteServicesBtn.addEventListener('click', function() {
        deleteServicesModal.classList.add('show');
    }); 

    cancelDeleteServicesBtn.addEventListener('click', function() {
        deleteServicesModal.classList.remove('show');
    });

    // Close/Discard Delete Services Modal
    removeServiceBtn.addEventListener('click', function() {
        deleteServicesModal.classList.remove('show');
    });

});
