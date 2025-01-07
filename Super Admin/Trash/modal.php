<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<!-- View Account of Admin Modal -->
<div class="modal" id="viewAdminModal">
    <div class="modal-content medium">
     <div class="modal-header">
     <button class="close-btn"><a href="#" id="closeViewAdminAccount">&times;</a></button>
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
      <button class="modal-button success" id="">Restore</button>
      <button class="modal-button secondary-button warning" id="permanentDeleteAccount">Deactivate</button>
    </div>
    </div>
</div>

<!-- View Account of User Modal -->
<div class="modal" id="viewUserModal">
    <div class="modal-content medium">
     <div class="modal-header">
     <button class="close-btn"><a href="#" id="closeViewService">&times;</a></button>
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
      <button class="modal-button success" id="">Restore</button>
      <button class="modal-button secondary-button warning" id="permanentDeleteAccount">Deactivate</button>
    </div>
    </div>
</div>

<!-- View Items Modal -->
<div class="modal" id="viewItemModal">
    <div class="modal-content medium">
       <button class="close-btn"><a href="#" id="closeViewItem">&times;</a></button>
       
     <div class="modal-header">
       <h3>Product Overview</h3>
    </div>
    <div class="modal-body">
      <h3>Primary Details</h3>
      <table class="modal-table">
        <tr>
          <td><strong>Product Name</strong></td>
          <td>Maggi</td>
        </tr>
        <tr>
          <td><strong>Product ID</strong></td>
          <td>456567</td>
        </tr>
        <tr>
          <td><strong>Product Category</strong></td>
          <td>Instant food</td>
        </tr>
        <tr>
          <td><strong>Expiry Date</strong></td>
          <td>13/4/23</td>
        </tr>
        <tr>
          <td><strong>Threshold Value</strong></td>
          <td>12</td>
        </tr>
        <tr>
          <td><strong>Opening Stock</strong></td>
          <td>40</td>
        </tr>
        <tr>
          <td><strong>Remaining Stock</strong></td>
          <td>34</td>
        </tr>
      </table>
    </div>

        <button id="okView" class="modal-button normal">OK</button>
    </div>
</div>

<!-- View Items Modal -->
<div class="modal" id="viewServiceModal">
<div class="modal-content medium">
    <button class="close-btn"><a href="#" id="closeViewService">&times;</a></button>    
     <div class="modal-header">
       <h3>Product Overview</h3>
    </div>
    <div class="modal-body">
      <h3>Primary Details</h3>
      <table class="modal-table">
        <tr>
          <td><strong>Service Name</strong></td>
          <td>Maggi</td>
        </tr>
        <tr>
          <td><strong>Product ID</strong></td>
          <td>456567</td>
        </tr>
        <tr>
          <td><strong>Product Category</strong></td>
          <td>Instant food</td>
        </tr>
      </table>
    </div>
      <button class="modal-button success" id="">Restore</button>
      <button class="modal-button secondary-button warning" id="permanentDeleteService">Deactivate</button>
    </div>
</div>


<!--permanent delete of one account modal-->
<div class="modal" id="deleteAccountModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Account</div>
        <div class="message-container">
            <div class="modal-description">
              By removing this account you will permanently remove the User’s information.
            <br>
              If yes, please type “Delete Account” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="permanentDeleteBtn">Permanent Delete</button>
        <button class="modal-button secondary-button normal" id="cancelPermanentDeleteBtn">Cancel</button>
    </div>
</div>


<!--mass delete of accounts-->
<div class="modal" id="massDeleteAccountModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Account</div>
        <div class="message-container">
            <div class="modal-description">
            You are removing 1 account.By removing this account you will permanently remove the User’s information.
            <br>
              If yes, please type “Delete Account” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="massDeleteBtn">Permanent Delete</button>
        <button class="modal-button secondary-button normal" id="cancelMassDeleteBtn">Cancel</button>
    </div>
</div>




<!--permanent delete of one Inventory modal-->
<div class="modal" id="deleteInventoryModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Item</div>
        <div class="message-container">
            <div class="modal-description">
              By removing this item you will permanently remove the item information.
            <br>
              If yes, please type “Delete Item” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="permanentDeleteInventoryBtn">Permanent Delete</button>
        <button class="modal-button secondary-button normal" id="cancelPermanentDeleteInventoryBtn">Cancel</button>
    </div>
</div>


<!--mass delete of Inventory-->
<div class="modal" id="massDeleteInventoryModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Item</div>
        <div class="message-container">
            <div class="modal-description">
            You are removing 1 item.By removing this item you will permanently remove the information.
            <br>
              If yes, please type “Delete Item” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button normal" id="massDeleteInventoryBtn">Permanent Delete</button>
        <button class="modal-button secondary-button warning" id="cancelMassDeleteInventoryBtn">Cancel</button>
    </div>
</div>



<!--permanent delete of one Service modal-->
<div class="modal" id="deleteServiceModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Service</div>
        <div class="message-container">
            <div class="modal-description">
              By removing this service you will permanently remove the item information.
            <br>
              If yes, please type “Delete Item” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="permanentDeleteServiceBtn">Permanent Delete</button>
        <button class="modal-button secondary-button normal" id="cancelPermanentDeleteServiceBtn">Cancel</button>
    </div>
</div>


<!--mass delete of Service-->
<div class="modal" id="massDeleteServiceModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/warning.png" alt="security">
        </div>
        <div class="modal-title warning-title">Permanent Delete Service</div>
        <div class="message-container">
            <div class="modal-description">
            You are removing 1 service.By removing this service you will permanently remove the information.
            <br>
              If yes, please type “Delete Service” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button normal" id="massDeleteServicesBtn">Permanent Delete</button>
        <button class="modal-button secondary-button warning" id="cancelMassDeleteServicesBtn">Cancel</button>
    </div>
</div>


<!--///////////////////////////////////Restore/////////////////////////////////////-->


<!--restore of one account modal-->
<div class="modal" id="restoreAccountModal">
    <div class="modal-content">
        <div class="modal-title warning-title">Restore Account</div>
        <div class="message-container">
            <div class="modal-description">
              By restoring this account you will recover the user and its information-- back to the website.
            <br>
              If yes, please type “Restore Account” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="restoreInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button success" id="restoreBtn">Restore</button>
        <button class="modal-button secondary-button normal" id="cancelRestoreBtn">Cancel</button>
    </div>
</div>


<!--mass recover of accounts-->
<div class="modal" id="massRecoverAccountModal">
    <div class="modal-content">
        <div class="modal-title success-title">Restore Account</div>
        <div class="message-container">
            <div class="modal-description">
            You are recovering 1 account(s).By restoring this account you will recover the User’s information back to SmileSync.
            <br>
              If yes, please type “Restore Account” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="massRestoreBtn"></button>
        <button class="modal-button secondary-button normal" id="cancelMass RestoreBtn">Cancel</button>
    </div>
</div>




<!--permanent delete of one Inventory modal-->
<div class="modal" id="restoreInventoryModal">
    <div class="modal-content">
        <div class="modal-title success-title">Permanent Delete Item</div>
        <div class="message-container">
            <div class="modal-description">
              By restoring this item you will move the item information back to SmileSync.
            <br>
              If yes, please type “Restore Item” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="restoreInventoryBtn">Restore</button>
        <button class="modal-button secondary-button normal" id="cancelRestoreInventoryBtn">Cancel</button>
    </div>
</div>


<!--mass delete of Inventory-->
<div class="modal" id="massRestoreInventoryModal">
    <div class="modal-content">
        <div class="modal-title success-title">Restore Item</div>
        <div class="message-container">
            <div class="modal-description">
            You are recovering 1 item.By restoring this item you will move the item information back to SmileSync.
            <br>
              If yes, please type “Restore Item” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button normal" id="massRestoreInventoryBtn">Restore</button>
        <button class="modal-button secondary-button warning" id="cancelMassRestoreInventoryBtn">Cancel</button>
    </div>
</div>



<!--permanent delete of one Service modal-->
<div class="modal" id="restoreServiceModal">
    <div class="modal-content">
        <div class="modal-title success-title">Restore Service</div>
        <div class="message-container">
            <div class="modal-description">
              By restoring this service you will move the item information back to SmileSync.
            <br>
              If yes, please type “Restore Service” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button warning" id="restoreServiceBtn">Restore</button>
        <button class="modal-button secondary-button normal" id="cancelRestoreServiceBtn">Cancel</button>
    </div>
</div>


<!--mass delete of Service-->
<div class="modal" id="massDeleteServiceModal">
    <div class="modal-content">
        <div class="modal-title success-title">Restore Service</div>
        <div class="message-container">
            <div class="modal-description">
            You are recovering 1 service.By restoring this item you will move the item information back to SmileSync.
            <br>
              If yes, please type “Restore Service” in the input box below.
            <div class="input-wrap">
            <input
                type="text"
                id="resetPasswordInput"
                minlength="4"
                class="modal-input"
                autocomplete="off"
                required
            />
            <label for="resetInput">Type Here<indicator>*</indicator></label>
        </div>
            </div>
        </div>
        <button class="modal-button normal" id="massRestoreServicesBtn">Restore</button>
        <button class="modal-button secondary-button warning" id="cancelMassRestoreServicesBtn">Cancel</button>
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