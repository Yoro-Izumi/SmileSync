<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<!-- View Items Modal -->
<div class="modal" id="viewServiceModal">
    <div class="modal-content">
        <div class="message-container">
            <div class="modal-description">
                --view details--
            </div>
        </div>
        <button id="okView" class="modal-button normal">OK</button>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal" id="addServiceModal">
    <div class="modal-content">
        <b class="modal-title normal-title">Add Item</b>

        <div class="message-container">
            <div class="modal-description">
                -Place Information-
            </div>
        </div>
        <button id="addServiceBtn" class="modal-button success">Add</button>
        <button class="modal-button secondary-button warning" id="cancelAddServicesBtn">Cancel</button>
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



<!-- Remove Account Warning Modal -->
<div class="modal" id="removeAccountModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Service Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) item. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="removeServicesBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelRemoveServicesBtn">Cancel</button>
    </div>
</div>


<div id="alertContainer"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/modal.js"></script>
<script src="js/alert.js"></script>

</body>
</html>