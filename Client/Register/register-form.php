<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <header>
    <div class="topbar">
      <div class="logo"><img src="img/logo.png" alt="Logo">SmileSync</div>
      <div class="return-link"><a href="../LogIn-Page/Login-Page.php">Return to login</a></div>
    </div>
  </header>

  <div class="form-container">
    <h1 class="form-title">Add New Appointment</h1>

    <div class="steps">
      <div class="step active">
        <span class="step-icon">👤</span>
        <span class="step-label">Personal Information</span>
      </div>
      <div class="step">
        <span class="step-icon">📅</span>
        <span class="step-label">Appointment Detail</span>
      </div>
      <div class="step">
        <span class="step-icon">🔒</span>
        <span class="step-label">Account</span>
      </div>
    </div>

    <form id="multiStepForm" name="multiStepForm" action="Register-Page.php" method="POST">
      <!-- Step 1: Personal Information -->
      <div class="form-section active">
        <div class="wrap-2rows">

              <div class="input-wrap">
                  <input
                    type="text"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    name="firstName"
                    required
                  />
                  <label>First Name<indicator>*</indicator></label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    autocomplete="off"
                    name="lastName"
                    required
                  />
                  <label>Last Name<indicator>*</indicator></label>
                </div>
              </div>

              <div class="wrap-3rows">

<div class="input-wrap">
    <input
      type="text"
      minlength="1"
      maxlength="24"
      class="input-field"
      autocomplete="off"
      name="middleName"
    />
    <label>Middle Name</label>
  </div>

  <div class="input-wrap">
    <input
      type="text"
      minlength="1"
      maxlength="5"
      class="input-field"
      name="suffix"
      autocomplete="off"
    />
    <label>Suffix</label>
  </div>

  <div class="input-wrap">
  <input
      type="date"
      id="birthdate-picker"
      class="input-field"
      name="birthday"
      autocomplete="off"
      required
    />
    <label>Select Birthdate<indicator>*</indicator></label>
  </div>

</div>
<div class="input-wrap">
                  <input
                    type="text"
                    minlength="11"
                    maxlength="13"
                    class="input-field"
                    name="phoneNumber"
                    autocomplete="off"
                    required
                  />
                  <label>Phone Number<indicator>*</indicator></label>
                </div>
                <div class="valid-feedback">
                  <!-- Looks good! -->
                </div>

                <div class="question-form">
          <div class="titles">
            <span>Health Form</span>
          </div>
          <div class="question-row">
            <label for="questionInput">Have you visited any infected areas within the last 30 days prior to your scheduled appointments?</label>
            <div class="answer-options">
              <input type="radio" id="visited-yes" name="visited" value="yes" onclick="toggleAddressField()">
              <label for="visited-yes">Yes</label>
              <input type="radio" id="visited-no" name="visited" value="no" onclick="toggleAddressField()">
              <label for="visited-no">No</label>
            </div>
          </div>
          <div id="address-field" style="display: none;">
            <div class="input-wrap">
              <input type="text" minlength="10" maxlength="50" class="input-field" id="infectedAddress" name="infectedAddress" autocomplete="off" />
              <label for="infectedAddress">Please enter the address of the infected area:</label>
            </div>
          </div>
          <script>
            function toggleAddressField() {
              const addressField = document.getElementById("address-field");
              const isYesSelected = document.getElementById("visited-yes").checked;
              addressField.style.display = isYesSelected ? "block" : "none";
            }
          </script>

          <div class="question-row">
            <label for="questionInput">Have you attended a mass gathering reunion with relatives/friends or parties within a month prior to visit?</label>
            <div class="answer-options">
              <input type="radio" id="attended-yes" name="gathering" value="yes">
              <label for="attended-yes">Yes</label>
              <input type="radio" id="attended-no" name="gathering" value="no">
              <label for="attended-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a COVID-19 positive patient?</label>
            <div class="answer-options">
              <input type="radio" id="contact-yes" name="contact" value="yes">
              <label for="contact-yes">Yes</label>
              <input type="radio" id="contact-no" name="contact" value="no">
              <label for="contact-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a person under monitor (PUI)?</label>
            <div class="answer-options">
              <input type="radio" id="pui-yes" name="pui" value="yes">
              <label for="pui-yes">Yes</label>
              <input type="radio" id="pui-no" name="pui" value="no">
              <label for="pui-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a person under monitoring (PUM)?</label>
            <div class="answer-options">
              <input type="radio" id="pum-yes" name="pum" value="yes">
              <label for="pum-yes">Yes</label>
              <input type="radio" id="pum-no" name="pum" value="no">
              <label for="pum-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you had any flu-like respiratory symptoms in the last 14 days such as: fever, cough, runny nose, sore throat, headache, short of breath, chills, diarrhea, loss of taste, body ache, loss of smell?</label>
            <div class="answer-options">
              <input type="radio" id="symptoms-yes" name="symptoms" value="yes">
              <label for="symptoms-yes">Yes</label>
              <input type="radio" id="symptoms-no" name="symptoms" value="no">
              <label for="symptoms-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Is there any medical health problem?</label>
            <div class="answer-options">
              <input type="radio" id="medical-yes" name="medical" value="yes">
              <label for="medical-yes">Yes</label>
              <input type="radio" id="medical-no" name="medical" value="no">
              <label for="medical-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Are you currently experiencing a DENTAL EMERGENCY?</label>
            <div class="answer-options">
              <input type="radio" id="emergency-yes" name="emergency" value="yes">
              <label for="emergency-yes">Yes</label>
              <input type="radio" id="emergency-no" name="emergency" value="no">
              <label for="emergency-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Will you be using an HMO Card?</label>
            <div class="answer-options">
              <input type="radio" id="hmo-yes" name="hmo" value="yes" onclick="toggleAddressField()">
              <label for="hmo-yes">Yes</label>
              <input type="radio" id="hmo-no" name="hmo" value="no" onclick="toggleAddressField()">
              <label for="hmo-no">No</label>
            </div>
          </div>
          <div id="address-field" style="display: none;">
            <div class="input-wrap">
              <input type="text" minlength="10" maxlength="50" class="input-field" id="hmoID" name="hmoID" autocomplete="off" />
              <label for="hmoID">Please the HMO ID No.</label>
            </div>
          </div>
          <script>
            function toggleAddressField() {
              const addressField = document.getElementById("hmoID");
              const isYesSelected = document.getElementById("hmo-yes").checked;
              addressField.style.display = isYesSelected ? "block" : "none";
            }
          </script>

           
        </div>

      </div>

      
      <!-- Step 2: Appointment Details -->
      <div class="form-section">
        <h2>Appointment Detail</h2>
        <div class="input-wrap">
          <select class="input-field" id="services" name="services">
            <option value="" disabled selected>Select a Service</option>
            <?php include "service_list.php";?>
          </select>
        </div>
        <div class="appointment-container">
          <!-- Calendar Section -->
          <div class="calendar-container">
            <div class="calendar-header">
              <span>Select Date<span class="required">*</span></span>
              <span class="calendar-legend">
                <span class="legend unavailable">Unavailable</span>
                <span class="legend choice">Available</span>
                <span class="legend recommended">Recommended</span>
              </span>
            </div>

            <div class="calendar-month" style="text-align: center;">
              <select id="month" name="month">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>

            <table class="calendar-table">
              <thead>
                <tr>
                  <th>Sun</th>
                  <th>Mon</th>
                  <th>Tue</th>
                  <th>Wed</th>
                  <th>Thu</th>
                  <th>Fri</th>
                  <th>Sat</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td><td></td><td></td><td class="unavailable">1</td><td class="unavailable">2</td><td class="choice">3</td><td class="recommended">4</td>
                </tr>
                <tr>
                  <td class="choice">5</td><td>6</td><td>7</td>
                  <td class="recommended">8</td><td>9</td><td class="unavailable">10</td><td class="choice">11</td>
                </tr>
                <tr>
                  <td>12</td><td>13</td><td>14</td>
                  <td class="choice">15</td><td>16</td><td class="recommended">17</td>
                  <td>18</td>
                </tr>
                <tr>
                  <td>19</td><td>20</td><td>21</td>
                  <td>22</td><td class="unavailable">23</td>
                  <td>24</td><td>25</td>
                </tr>
                <tr>
                  <td>26</td><td>27</td><td>28</td>
                  <td class="choice">29</td><td>30</td><td>31</td><td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <input type="hidden" id="cal-day" name="cal-day">
          <!-- Recommendation Section -->
          <div class="recommendation-container">
            <h3>Recommended Dates & Times</h3>
          </div>
          
      </div>

        <div class="select-time-container">
             <label for="time">Select a Time:</label>
              <div class="time-selection"> 
                <select id="time" name="time">
                  <option value="10:00:00">10:00 AM</option>
                  <option value="11:00:00">11:00 AM</option>
                  <option value="14:00:00">2:00 PM</option>
                  <option value="15:00:00">3:00 PM</option>
                </select>
          </div>         
        </div>
 
      </div>

      <!-- Step 3: Account -->
      <div class="form-section">
        <!-- Add account setup fields here -->
        <div class="input-wrap">
                  <input
                    type="email"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    name="email"
                    autocomplete="off"
                    required
                  />
                  <label>Email Address<indicator>*</indicator></label>
                </div>
         <div class="input-wrap">
                  <input
                    type="password"
                    minlength="1"
                    maxlength="24"
                    class="input-field"
                    name="password"
                    id="password"
                    autocomplete="off"
                    required
                    oninput="checkPasswordStrength(this)"
                  />
                  <label>Password<indicator>*</indicator></label>
                
                </div>
                <div id="password-strength-indicator"></div>
                  <div class="password-requirements" id="password-requirements" style="display: none;">
                    <p>Password must contain:</p>
                    <ul>
                      <li id="uppercase" class="invalid">1 uppercase letter</li>
                      <li id="number" class="invalid">1 number</li>
                      <li id="special" class="invalid">1 special character</li>
                      <li id="length" class="invalid">At least 8 characters</li>
                    </ul>
                  </div>
                  <!--div class="invalid-feedback">Password strength is weak. Please enter a stronger password.</div-->


                <div class="input-wrap">
                <input type="password" 
                  class="input-field"
                  name="confirmPassword"
                  id="confirmPassword"
                  autocomplete="off"
                required>
              <label>Confirm Password<indicator>*</indicator></label>
          
              </div>
      </div>

      <!-- Form Navigation -->
      <div class="form-navigation">
        <button type="button" class="prev-btn" style="display: none;">Previous</button>
        <button type="button" class="next-btn">Next</button>
      </div>
    </form>
  </div>

  <footer>
    <p>&copy; 2024 iMee Dental Clinic. All rights reserved.</p>
  </footer>

<script src="js/appointment_form.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#multiStepForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: 'register_code.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#multiStepForm')[0].reset(); // Clear the form
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
</script>
        
</body>
</html>
