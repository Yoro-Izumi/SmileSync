<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<!-- View Account of User Modal -->
<div class="modal" id="viewAdminModal">
    <div class="modal-content medium">
     <div class="modal-header">
       <h3>Information Overview</h3></div>
    <div class="modal-body">
      <h3>Primary Details</h3>
      <table class="modal-table">
        <tr>
          <td><strong>Name</strong></td>
          <td>Maggi</td>
        </tr>
        <tr>
          <td><strong>Account ID</strong></td>
          <td>456567</td>
        </tr>
        <tr>
          <td><strong>Birthdate</strong></td>
          <td>02/02/2009</td>
        </tr>
        <tr>
          <td><strong>Phone Number</strong></td>
          <td>13/4/23</td>
        </tr>
        <tr>
          <td><strong>Email Address</strong></td>
          <td>12</td>
        </tr>
      </table>
      <button class="modal-button normal" id="closeViewUserAccount">Close</button>
      <button class="modal-button secondary-button warning" id="deactivateUserAccount">Deactivate</button>
    </div>
    </div>
</div>



<div class="modal" id="deactivateUserModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">DEACTIVATE ACCOUNT</div>
        <div class="message-container">
            <div class="modal-description">
                
            </div>
        </div>
        <button class="modal-button normal" id="deactivateUserBtn">Deactivate Now</button>
        <button class="modal-button secondary-button warning" id="cancelNewDeleteBtn">Cancel</button>
    </div>
</div>


<!-- Remove Account Warning Modal -->
<div class="modal" id="removeItemModalSolo">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Inventory Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove an item. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="removeItemBtnSolo">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelRemoveItemBtnSolo">Cancel</button>
    </div>
</div>

<div id="alertContainer"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/modal.js"></script>
<script src="js/alert.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pptxgenjs/3.12.0/pptxgen.bundle.js"></script>

</body>
</html>