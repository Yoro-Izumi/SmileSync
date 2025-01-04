
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../client_global_files/js/jquery-3.6.0.min.js"></script>


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

    <form id="newMultiStepForm" name="newMultiStepForm" action="register_code.php" method="POST">
      <!-- Step 1: Personal Information -->
      <div class="new-form-section active">
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
              const addressField = document.getElementById("infectedAddress");
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
      <div class="new-form-section">
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

            <table class="newCalendar-table">
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
                </select>
          </div>         
        </div>
 
      </div>
      <!-- Step 3: Account -->
      <div class="new-form-section">
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
        <button type="button" class="prev-btn" id="new-prev-btn" style="display: none;">Previous</button>
        <button type="button" class="next-btn" id="new-next-btn">Next</button> 
        <button type="submit" id="newSubmitButton" name="submitButton">Submit</button>
      </div>
   </form>



<!--<script src="js/appointment_form2.js"></script>-->
<script>
  document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
    const newFormSections = document.querySelectorAll('.new-form-section');
    const newNextButton = document.getElementById('new-next-btn');
    const newPrevButton = document.getElementById('new-prev-btn');
    const newSteps = document.querySelectorAll('.steps .step');
    const newSubmitButton = document.getElementById('newSubmitButton');
    let currentStep = 0;
  
    submitButton.style.display = 'none';
  
    // Show the first section
    newFormSections[currentStep].classList.add('active');
    newSteps[currentStep].classList.add('active');
  
    // Event listener for next button
    newNextButton.addEventListener('click', (e) => {
      // Prevent form submission on intermediate steps
      if (currentStep < newFormSections.length - 1) {
        newFormSections[currentStep].classList.remove('active');
        newSteps[currentStep].classList.remove('active');
        currentStep++;
        newFormSections[currentStep].classList.add('active');
        newSteps[currentStep].classList.add('active');
        newPrevButton.style.display = 'block';
        newSubmitButton.style.display = 'none';
  
        // Update the button for the final step
        if (currentStep === newFormSections.length - 1) {
          newNextButton.style.display = 'none';
          newSubmitButton.style.display = 'block';
        } else {
          newNextButton.textContent = 'Next';
          newNextButton.type = 'button'; // Reset type to button for non-final steps
        }
      }
    });
  
    // Event listener for previous button
    newPrevButton.addEventListener('click', () => {
      if (currentStep > 0) {
        newFormSections[currentStep].classList.remove('active');
        newSteps[currentStep].classList.remove('active');
        currentStep--;
        newFormSections[currentStep].classList.add('active');
        newSteps[currentStep].classList.add('active');
  
        if (currentStep === 0) {
          newPrevButton.style.display = 'none';
        }
  
        newNextButton.textContent = 'Next';
        newNextButton.type = 'button'; // Reset type to button for non-final steps
      }
    });
  
    // Hide previous button on first step
    if (currentStep === 0) {
      newPrevButton.style.display = 'none';
    }
  
  

  // Generalized function to toggle address fields based on user selection
  function toggleAddressField(fieldId, conditionId) {
    const addressField = document.getElementById(fieldId);
    const isYesSelected = document.getElementById(conditionId).checked;
    addressField.style.display = isYesSelected ? "block" : "none";
  }

  // Calendar logic
  const recommendedDates = {
    '2024-8-3': true,
    '2024-8-14': true,
  };

  const unavailableDates = {
    '2024-8-7': true,
    '2024-8-20': true,
  };

  const currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  const monthSelect = document.getElementById('month');
  const calendarTableBody = document.querySelector('.newCalendar-table tbody');
  const calDayInput = document.getElementById('cal-day');
  let isLoading = false;

  function generateCalendar(month, year) {
    calendarTableBody.innerHTML = '';
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    let dayCounter = 1;
    let week = [];

    for (let i = 0; i < firstDayOfMonth; i++) {
      week.push('');
    }

    while (dayCounter <= daysInMonth) {
      const dateKey = `${year}-${month + 1}-${dayCounter}`;
      const cellData = {
        day: dayCounter,
        class: recommendedDates[dateKey] ? 'recommended' : unavailableDates[dateKey] ? 'unavailable' : '',
      };
      week.push(cellData);

      if (week.length === 7 || dayCounter === daysInMonth) {
        while (week.length < 7) {
          week.push('');
        }

        const row = document.createElement('tr');
        week.forEach((cell) => {
          const cellElement = document.createElement('td');
          if (cell) {
            cellElement.textContent = cell.day;
            if (cell.class) {
              cellElement.classList.add(cell.class);
            }
          }
          row.appendChild(cellElement);
        });

        calendarTableBody.appendChild(row);
        week = [];
      }
      dayCounter++;
    }

    document.querySelectorAll('.newCalendar-table td').forEach((cell) => {
      if (isLoading) {
        cell.style.pointerEvents = 'none';
      } else {
        cell.style.pointerEvents = 'auto';
      }

      cell.addEventListener('click', () => {
        if (!isLoading && !cell.classList.contains('unavailable') && cell.textContent) {
          document.querySelectorAll('.newCalendar-table td').forEach((td) =>
            td.classList.remove('selected-date')
          );
          cell.classList.add('selected-date');
          const selected_date = `${year}-${(month + 1).toString().padStart(2, '0')}-${cell.textContent.padStart(2, '0')}`;
          calDayInput.value = selected_date;

          $.ajax({
            url: 'save_session_date.php',
            type: 'POST',
            data: { selected_date: selected_date },
            success: function (response) {
              console.log('Session updated:', response);
              isLoading = true;
              fetch('pick_schedule_algo/get_appointment.php')
                .then(response => response.json())
                .then(data => {
                  if (data.status === 'success') {
                    updateRecommendationsAndDropdown(data);
                  }
                })
                .catch(error => console.error('Error fetching schedule:', error))
                .finally(() => {
                  isLoading = false;
                });
            },
            error: function (xhr, status, error) {
              console.error('Error setting session:', error);
            },
          });
        }
      });
    });
  }

  monthSelect.addEventListener('change', function () {
    currentMonth = parseInt(this.value, 10) - 1;
    generateCalendar(currentMonth, currentYear);
  });

  generateCalendar(currentMonth, currentYear);
});


// Function to update the recommended schedule and available times
function updateRecommendationsAndDropdown(response) {
  // Check for success status
  if (response.status !== "success") {
    console.error("Error: " + (response.message || "Unknown error"));
    return;
  }

  // Parse the recommended schedule and available times
  const recommendations = response.recommended_schedule;
  const availableTimes = response.available_times;
  const predictedDurations = response.predicted_durations;

  // Update the recommendation container
  const recommendationContainer = document.querySelector('.recommendation-container');
  let recommendationHTML = `<h3>Recommended Dates & Times (Predicted Duration: ${predictedDurations} minutes)</h3>`;
  recommendations.forEach((dateTime) => {
    const [date, time] = dateTime.split(' ');
    recommendationHTML += `<p>Date: ${formatDate(date)}<br>Time: ${formatTime(time)}</p>`;
  });
  recommendationContainer.innerHTML = recommendationHTML;

  // Update the dropdown options for available times
  const timeDropdown = document.getElementById('time');
  timeDropdown.innerHTML = ''; // Clear existing options
  availableTimes.forEach((dateTime) => {
    const [, time] = dateTime.split(' ');
    timeDropdown.innerHTML += `<option value="${time}">${formatTime(time)}</option>`;
  });
}

// Utility function to format the date
function formatDate(dateStr) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const date = new Date(dateStr);
  return date.toLocaleDateString(undefined, options);
}

// Utility function to format the time
function formatTime(timeStr) {
  const [hour, minute] = timeStr.split(':').map(Number);
  const amPm = hour >= 12 ? 'PM' : 'AM';
  const formattedHour = hour % 12 || 12;
  return `${formattedHour}:${minute.toString().padStart(2, '0')} ${amPm}`;
}

$(document).ready(function () {
  // Trigger form submission when the Submit button is clicked
  $("#newSubmitButton").on("click", function (e) {
    e.preventDefault(); // Prevent the default button behavior

    const form = $("#newMultiStepForm"); // Target the form
    const formData = form.serialize(); // Serialize all form data

    $.ajax({
      url: "appointment_crud/appointment_add_new.php", // PHP file to handle insertion
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle success response
        //alert("Appointment successfully added: " + response);
        form[0].reset(); // Reset the form
      },
      error: function (xhr, status, error) {
        // Handle error response
        //console.error("Error: " + error);
        //alert("An error occurred while adding the appointment.");
      },
    });
  });
});

</script>