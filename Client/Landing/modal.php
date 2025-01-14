<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="css/modal.css" />
</head>

<body>


<!-- Modal -->
<div id="registerModal" class="modal" style="display: none;">
  <div class="modal-content">
    <h2>Register New Account</h2>
    <p>
      Upon registering for a new account, user must be informed of the information needed in order to register:
    </p>
    <ul>
      <li><strong>Personal Information:</strong>
        <ul>
          <li>First Name</li>
          <li>Last Name</li>
          <li>Birth Date</li>
          <li>Phone Number</li>
          <li>Email Address</li>
        </ul>
      </li>
      <li><strong>Medical Information:</strong>
        <ul>
          <li>Health Form</li>
          <li>Recent Travel (Yes/No)</li>
          <li>Symptoms (e.g., fever, cough, etc.)</li>
          <li>Dental History</li>
        </ul>
      </li>
    </ul>
    <p>If user agrees to the terms, you may now proceed to Registration.</p>
    <div class="modal-buttons">
      <button class="btn proceed">Proceed</button>
      <button class="btn cancel">Cancel</button>
    </div>
  </div>
</div>



  <script src="js/modal.js"></script>
</body>
</html>
