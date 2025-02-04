<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="css/setting.css" />
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

<body>

<div class="container">
    
  <form id="personalInfoForm">
        <h3>Personal Information</h3>
     <div class="wrap-2rows">
        <div class="input-wrap">
                  <input
                    type="text"
                    minlength="24"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientFirstName;?>"
                    required
                  />
                  <label>First Name<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="5"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientLastName;?>"
                    required
                  />
                  <label>Last Name<indicator>*</indicator></label>
                </div>
              </div>


              <div class="wrap-3rows">

              <div class="input-wrap">
                  <input
                    type="text"
                    minlength="5"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientMiddleName;?>"
                  />
                  <label>Middle Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="5"
                    maxlength="5"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientSuffix;?>"
                  />
                  <label>Suffix</label>
                </div>

                <!--<div class="input-wrap">
                <select class="input-field">
                <option value="" disabled selected>Brithdate</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
                </div>-->
                

                <!--<input type="text" class="input-field" placeholder="Field 4">-->
       
                <div class="input-wrap">
                <input
                    type="date"
                    id="birthdate-picker"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientBirthdate;?>"
                    required
                  />
                  <label>Select Birthdate<indicator>*</indicator></label>
                </div>

              </div>


                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="11"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientPhoneNumber;?>"
                    required
                  />
                  <label>Phone Number<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    minlength="5"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    value="<?php echo $patientEmail;?>"
                    required
                  />
                  <label>Email Address<indicator>*</indicator></label>
                </div>

                <button type="submit" class="btn">Save Changes</button>
    </form>
    <form id="passwordForm">

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="5"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
            <input type="password" class="input-field"
                autocomplete="off"
                required></diuv>
            <label>Confirm Password<indicator>*</indicator></label>
        </div>

        <div class="footer-note">
            <p>You will be asked to log in again with your new password after you save your changes.</p>
        </div>
        <button type="submit" class="btn">Save Changes</button>
    </form>
        <h3>Deactivate Account</h3>
        <p class="footer-note">This will temporarily deactivate your account.
          You must not login for the next 30 days or it will activate automatically.
          If user attempts to login within the allocated days and cannot retrieve account. SmileSync has forced deleted your account.
        </p>
        <button  class="btn">Deactivate Account</button>
    </div>
   
    <script src="js/input-field.js"></script>
    <script>
      // Handle Personal Information Update
$('#personalInfoForm').on('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: 'update_personal_info.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert(response); // Display success or error message
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

// Handle Password Update
$('#passwordForm').on('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: 'update_password.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert(response); // Display success or error message
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

// Handle Account Deactivation
$('#deactivateAccountBtn').on('click', function () {
    if (confirm('Are you sure you want to deactivate your account?')) {
        $.ajax({
            url: 'deactivate_account.php',
            type: 'POST',
            success: function (response) {
                alert(response); // Display success or error message
                window.location.href = 'logout.php'; // Log out user
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});

    </script>
  
</body>
</html>