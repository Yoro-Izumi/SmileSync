<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/modal.css">
    <style>
      .readonly-input {
        font-size: 12px;
        padding: 6px;
        background-color:rgb(255, 255, 255);
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-top: 3px;
        width: 100%;
      }

      /* Styling for individual dropdown items */
.dropDownItem {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 5px 10px;
  border-bottom: 1px solid #e0e0e0;
  font-size: 14px;
}

.dropDownItem:last-child {
  border-bottom: none;
}

.checkBoxItems {
  flex: 0 0 5%; /* Ensure a small but fixed space for the checkbox */
  margin-right: 10px;
}

.number-input {
  flex: 0 0 20%; /* Ensure a fixed width for the number input */
  margin-left: 10px;
  text-align: center;
}

.dropDownItem span {
  flex: 1; /* Ensures the text takes up the remaining space */
  text-align: center;
}

/* Add hover effect for dropdown items */
.dropDownItem:hover {
  background-color: #f9f9f9;
}

/* Responsive styling */
@media (max-width: 600px) {
  .dropDownItem {
    font-size: 12px;
    padding: 5px;
  }
  .checkBoxItems {
    flex: 0 0 10%;
  }
  .number-input {
    flex: 0 0 30%;
  }
}
    </style>
</head>
<body>

<div class="modal" id="appointmentDoneModal">
<form id="doneAppointmentForm" name="doneAppointmentForm" method="POST" action="appointment_crud/done_appointment.php">
    <div class="done-modal">
   <div class="modal-done">
    <div class="modal-header">
                <div class="content">
                    <h2>iMee-Toga Oli Dental Clinic</h2>
                    <p>788 Rizal Blvd. Poblacion Brgy. Market Area, Santa Rosa Laguna</p>
                </div>
                <button class="close-btn"><a href="#" id="closeDone">&times;</a></button>
            </div>

        <!-- Personal Information -->
        <div class="section-title">Personal Information</div>
        <input name="done_appointment_id" id="done_appointment_id" type="hidden" >
        <div class="personal-info2">
            <div class="form-group2">
                <label>Patient Name:</label>
                <span></span>
            </div>
            <div class="form-group2">
                <label>Phone Number:</label>
                <span></span>
            </div>
        </div>
        <div class="personal-info2">
            <div class="form-group2">
                <label>Age:</label>
                <span></span>
            </div>
            <div class="form-group2">
                <label>Sex:</label>
                <span></span>
            </div>
            <div class="form-group2">
                <label>Birth Date:</label>
                <span></span>
            </div>
        </div>

        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="" />
            </div>
            <div class="form-group">
                <label>City:</label>
                <input type="text" readonly value="" />
            </div>
            <div class="form-group">
                <label>Province:</label>
                <input type="text" readonly value="" />
            </div>
        </div>
        <div class="section-title">Emergency Contact</div>
        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="" />
            </div>
            <div class="form-group">
                <label>Relationship:</label>
                <input type="text" readonly value="" />
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" id="phoneNumberDone" name="phoneNumberDone" readonly value="" />
            </div>
        </div>

        <!-- Treatment Record -->
        <div class="treatment-record">
            <div class="section-title">Treatment Record</div>
            <div class="personal-info2">
                <div class="form-group">
                    <label>Date of Appointment:</label>
                    <input type="text" readonly value="" />
                </div>

                <div class="form-group">
                <label for="dropdownButtonProcedure">Procedure/s:</label>
                  <div class="dropdown-container">
       
                  <button id="dropdownButtonProcedure" type="button" "aria-expanded="false" aria-controls="dropdownMenuProcedure">
                  Select Products
                  </button>
                    <div id="dropdownMenuProcedure" class="dropdown-menu-procedure" style="display: none;">
                      <!--Dynamicaly updates-->
                    </div>
                  </div>
                </div>

                <div class="form-group">
                    <label>Dentist/s:</label>
                    <?php
                        $connect_appointment = connect_appointment($servername, $username, $password);
                        $getDentistName = "SELECT `doctor_name_id` FROM smilesync_invoice";
                        $result = $connect_appointment->query($getDentistName);

                        echo "<select id='dentist_select' name='dentist_select'>";
                        echo "<option selected='true' disabled='disabled'>Select a Dentist</option>";
                        echo "<option value='new_name'>Input New Name</option>";

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $dentistName = $row['doctor_name_id'];
                                echo "<option value='" . htmlspecialchars($dentistName) . "'>$dentistName</option>";
                            }
                        }
                        echo "</select>";

                        echo "<input type='text' id='dentist_name' name='dentist_name' class='readonly-input' style='display: none;' placeholder='Enter new dentist name' />";
                    ?>
                    <script>
                      document.addEventListener("DOMContentLoaded", function () {
                          const dentistSelect = document.getElementById("dentist_select");
                          const dentistNameInput = document.getElementById("dentist_name");

                          dentistSelect.addEventListener("change", function () {
                              if (dentistSelect.value === "new_name") {
                                  dentistNameInput.style.display = "block"; // Show input field
                              } else {
                                  dentistNameInput.style.display = "none"; // Hide input field
                              }
                          });
                      });
                    </script>

                </div>

                <div class="form-group">
                    <label>No. of Tooth:</label>
                    <input type="text" id="number_of_tooth" name="number_of_tooth" class="readonly-input" value=" " />
                </div>

            </div>


            
<div class="form-group">
    <label for="dropdownButton">Consumed Products:</label>
    <div class="dropdown-container">
       
        <button id="dropdownButton" type="button" aria-expanded="false" aria-controls="dropdownMenu">
            Select Products
        </button>
        <div id="dropdownMenu" class="dropdown-menu-appointment" style="display: none;">
          <!--Dynamicaly updates-->
        </div>
    </div>
</div>

            <div class="form-group">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Left Side: Amount Charged, Amount Paid, Balance -->
                <div style="display: grid; grid-template-rows: auto auto auto; gap: 10px;">
                    <div class="form-group">
                        <label>Amount Charged:</label>
                        <input type="text" class="readonly-input" id="invoice_amount_charged" name="invoice_amount_charged" value="0" />
                    </div>

                    <div class="form-group">
                        <label>Amount Paid:</label>
                        <input type="text" class="readonly-input" id="invoice_paid_amount" name="invoice_paid_amount"  value="0" />
                    </div>

                    <div class="form-group">
                        <label>Balance:</label>
                        <input type="text"  class="readonly-input" id="invoice_balance" name="invoice_balance" value="0" />
                    </div>
                </div>

                <!-- Right Side: Doctor's Remarks -->
                <div class="remarks-container">
                    <label for="remarks">Doctor's Remarks:</label>
                    <textarea id="doctor_remarks" name="doctor_remarks" style="width: 100%; height: 100%;"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="button-container">
                    <button class="action-btn">Cancel</button>
                    <button type="submit" class="action-btn" id="doneAppointmentBtn">Mark as Done</button>
                </div>

            </div></div>
        </div></div>
</div>
</form>
</div>

<script>

    
</script>


<div class="modal" id="existingAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="cancelSubmitExistingBtn">&times;</button>
        <div class="modal-title normal-title">Add Existing Account</div>
        <div class="modal-description">
        <?php include "existingAppointment.php"; ?>
        </div>
     </div>
</div>



<div class="modal" id="newAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="cancelSubmitNewBtn">&times;</button>
        <div class="modal-title normal-title">Add New Account</div>
        <div class="modal-description">
        <?php include "newAppointment.php"; ?>
        </div>
     </div>
</div>


<div class="modal" id="deleteNewProgressModal">

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

<div class="modal" id="deleteExistingProgressModal">
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
        <button class="modal-button normal" id="deleteExistingProgressBtn">Delete</button>
        <button class="modal-button secondary-button warning" id="cancelExistingDeleteBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Warning Modal 
<div class="modal" id="cancelAppointmentModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Appointment Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) appointment. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="cancelAppointmentBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelBtn">Cancel</button>
    </div>
</div>-->

<!-- Success Modal 
<div class="modal" id="appointmentSuccessModal">
    <div class="modal-content">
        <div class="modal-title success-title">Appointment Added Successfully!</div>
        <div class="message-container">
            <div class="modal-description">
                Appointment was successfully added to the account. Please check your email for confirmation.
            </div>
        </div>
        <button id="closeAppointmentSuccessBtn" class="modal-button success">OK</button>
    </div>
</div> -->

<div id="alertContainer"></div>
<script src="js/alert.js"></script>
<script src="js/modal.js"></script>
<script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>
<script src="js/modal2.js"></script>


</body>
</html>
