<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<!-- View Items Modal -->
<div class="modal" id="viewItemModal">
    <div class="modal-content">
        <div class="message-container">
            <div class="modal-description">
                --view details--
            </div>
        </div>
        <button id="okView" class="modal-button normal">OK</button>
    </div>
</div>

<div class="modal" id="deleteProgressModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">DELETE PROGRESS</div>
        <div class="message-container">
            <div class="modal-description">
                All progress will be removed.
            </div>
        </div>
        <button class="modal-button normal" id="deleteNewProgressBtn">Delete</button>
        <button class="modal-button secondary-button warning" id="cancelNewDeleteBtn">Cancel</button>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <b class="modal-title normal-title">Add Item</b>

        <div class="message-container">
            <div class="modal-description">
                -Place Information-
            </div>
        </div>
        <button id="AddItemBtn" class="modal-button success">Add</button>
        <button class="modal-button secondary-button warning" id="cancelAddItemBtn">Cancel</button>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Edit Item</b>

        <div class="message-container">
            <div class="modal-description">
                -Pleace Edit Information-
            </div>
        </div>
        <button id="EditBtn" class="modal-button normal">Edit</button>
        <button class="modal-button secondary-button warning" id="cancelEditItemBtn">Cancel</button>
    </div>
</div>


<!-- Confirm Edit Modal -->
<div class="modal" id="confirmEditModal" >
    <div class="modal-content">
        <b class="modal-title normal-title">Confirm Edit</b>

        <div class="message-container">
            <div class="modal-description">
                By clicking confirm, changes will be saved and can longer be reverted.
            </div>
        </div>
        <button id="confirmEditBtn" class="modal-button normal">Confirm</button>
        <button class="modal-button secondary-button warning" id="cancelConfirmEditBtn">Cancel</button>
    </div>
</div>


<!-- Success Edit Modal -->
<div class="modal" id="editSuccessModal">
    <div class="modal-content">
        <div class="modal-title success-title">Edit Successful!</div>
        <div class="message-container">
            <div class="modal-description">
                Item has been successfully  edited. You may view the  edited account in  Accounts page.
            </div>  
        </div>
        <button id="closeEditSuccessBtn" class="modal-button normal">OK</button>
    </div>
</div>

<!-- Remove Account Warning Modal -->
<div class="modal" id="removeItemModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Inventory Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) item. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="removeItemBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelRemoveItemBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Success Modal -->
<div class="modal" id="removeItemSuccessModal">
    <div class="modal-content">
        <div class="modal-title warning-title">Item Removed</div>
        <div class="message-container">
            <div class="modal-description">
                Item/s has been successfully removed. You may view the removed account in Trash.
            </div>
        </div>
        <button id="okRemoveItem" class="modal-button success">OK</button>
    </div>
</div>

<script src="js/modal.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
