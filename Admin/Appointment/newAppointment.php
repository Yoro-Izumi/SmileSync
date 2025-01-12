<style>
    .new-calendar-table td.selected-date {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    border-radius: 10px;
    transform: scale(1.1);
}


</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../admin_global_files/js/jquery-3.6.0.min.js"></script>


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

    <form id="newMultiStepForm" name="newMultiStepForm" action="appointment_crud/appointment_add_new.php" method="POST">
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
              <input type="radio" id="new-visited-yes" name="visited" value="yes" onclick="toggleAddressField()">
              <label for="new-visited-yes">Yes</label>
              <input type="radio" id="new-visited-no" name="visited" value="no" onclick="toggleAddressField()">
              <label for="new-visited-no">No</label>
            </div>
          </div>
          <div id="address-field" style="display: none;">
            <div class="input-wrap">
              <input type="text" minlength="10" maxlength="50" class="input-field" id="new-infectedAddress" name="infectedAddress" autocomplete="off" />
              <label for="new-infectedAddress">Please enter the address of the infected area:</label>
            </div>
          </div>
          <script>
            function toggleAddressField() {
              const addressField = document.getElementById("new-infectedAddress");
              const isYesSelected = document.getElementById("new-visited-yes").checked;
              addressField.style.display = isYesSelected ? "block" : "none";
            }
          </script>

          <div class="question-row">
            <label for="questionInput">Have you attended a mass gathering reunion with relatives/friends or parties within a month prior to visit?</label>
            <div class="answer-options">
              <input type="radio" id="new-attended-yes" name="gathering" value="yes">
              <label for="new-attended-yes">Yes</label>
              <input type="radio" id="new-attended-no" name="gathering" value="no">
              <label for="new-attended-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a COVID-19 positive patient?</label>
            <div class="answer-options">
              <input type="radio" id="new-contact-yes" name="contact" value="yes">
              <label for="new-contact-yes">Yes</label>
              <input type="radio" id="new-contact-no" name="contact" value="no">
              <label for="new-contact-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a person under monitor (PUI)?</label>
            <div class="answer-options">
              <input type="radio" id="new-pui-yes" name="pui" value="yes">
              <label for="new-pui-yes">Yes</label>
              <input type="radio" id="new-pui-no" name="pui" value="no">
              <label for="pui-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you been in close contact with a person under monitoring (PUM)?</label>
            <div class="answer-options">
              <input type="radio" id="new-pum-yes" name="pum" value="yes">
              <label for="new-pum-yes">Yes</label>
              <input type="radio" id="new-pum-no" name="pum" value="no">
              <label for="new-pum-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Have you had any flu-like respiratory symptoms in the last 14 days such as: fever, cough, runny nose, sore throat, headache, short of breath, chills, diarrhea, loss of taste, body ache, loss of smell?</label>
            <div class="answer-options">
              <input type="radio" id="new-symptoms-yes" name="symptoms" value="yes">
              <label for="new-symptoms-yes">Yes</label>
              <input type="radio" id="new-symptoms-no" name="symptoms" value="no">
              <label for="new-symptoms-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Is there any medical health problem?</label>
            <div class="answer-options">
              <input type="radio" id="new-medical-yes" name="medical" value="yes">
              <label for="new-medical-yes">Yes</label>
              <input type="radio" id="new-medical-no" name="medical" value="no">
              <label for="new-medical-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Are you currently experiencing a DENTAL EMERGENCY?</label>
            <div class="answer-options">
              <input type="radio" id="new-emergency-yes" name="emergency" value="yes">
              <label for="new-emergency-yes">Yes</label>
              <input type="radio" id="new-emergency-no" name="emergency" value="no">
              <label for="new-emergency-no">No</label>
            </div>
          </div>

          <div class="question-row">
            <label for="questionInput">Will you be using an HMO Card?</label>
            <div class="answer-options">
              <input type="radio" id="new-hmo-yes" name="hmo" value="yes" onclick="toggleAddressField()">
              <label for="new-hmo-yes">Yes</label>
              <input type="radio" id="new-hmo-no" name="hmo" value="no" onclick="toggleAddressField()">
              <label for="new-hmo-no">No</label>
            </div>
          </div>
          <div id="address-field" style="display: none;">
            <div class="input-wrap">
              <input type="text" minlength="10" maxlength="50" class="input-field" id="new-hmoID" name="hmoID" autocomplete="off" />
              <label for="new-hmoID">Please the HMO ID No.</label>
            </div>
          </div>
          <script>
            function toggleAddressField() {
              const addressField = document.getElementById("new-hmoID");
              const isYesSelected = document.getElementById("new-hmo-yes").checked;
              addressField.style.display = isYesSelected ? "block" : "none";
            }
          </script>

           
        </div>

      </div>
      <!-- Step 2: Appointment Details -->
      <div class="new-form-section">
        <h2>Appointment Detail</h2>
        <div class="input-wrap">
          <select class="input-field" id="new-services" name="services">
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

            <div class="new-calendar-month" style="text-align: center;">
              <select id="new-month" name="month">
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

            <table class="new-calendar-table">
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
          <input type="hidden" id="new-cal-day" name="cal-day">
          <!-- Recommendation Section -->
          <div class="new-recommendation-container">
            <h3>Recommended Dates & Times</h3>
          </div>
          
      </div>

        <div class="select-time-container">
             <label for="time">Select a Time:</label>
              <div class="time-selection"> 
                <select id="new-time" name="time">
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
                    id="emailNewAppointment"
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
  // Multi-Step Form Logic
  const newForm = document.getElementById('newMultiStepForm');
  const newFormSections = document.querySelectorAll('.new-form-section');
  const newNextButton = document.getElementById('new-next-btn');
  const newPrevButton = document.getElementById('new-prev-btn');
  const newSubmitButton = document.getElementById('newSubmitButton');
  let newCurrentStep = 0;

  function newShowStep(newStep) {
    newFormSections.forEach((newSection, newIndex) => {
      newSection.classList.toggle('active', newIndex === newStep);
    });

    newPrevButton.style.display = newStep === 0 ? 'none' : 'inline-block';
    newNextButton.style.display = newStep === newFormSections.length - 1 ? 'none' : 'inline-block';
    newSubmitButton.style.display = newStep === newFormSections.length - 1 ? 'inline-block' : 'none';
  }

  function newHandleNext() {
    if (newCurrentStep < newFormSections.length - 1) {
      newCurrentStep++;
      newShowStep(newCurrentStep);
    }
  }

  function newHandlePrev() {
    if (newCurrentStep > 0) {
      newCurrentStep--;
      newShowStep(newCurrentStep);
    }
  }

  newNextButton.addEventListener('click', newHandleNext);
  newPrevButton.addEventListener('click', newHandlePrev);
  newShowStep(newCurrentStep);

  // Calendar Logic
  const newRecommendedDates = {
    '2024-8-3': true,
    '2024-8-14': true,
  };

  const newUnavailableDates = {
    '2024-8-7': true,
    '2024-8-20': true,
  };

  const newCurrentDate = new Date();
  let newCurrentMonth = newCurrentDate.getMonth();
  let newCurrentYear = newCurrentDate.getFullYear();

  const newMonthSelect = document.getElementById('new-month');
  const newCalendarTableBody = document.querySelector('.new-calendar-table tbody');
  const newCalDayInput = document.getElementById('new-cal-day');
  let newIsLoading = false;

  function newGenerateCalendar(newMonth, newYear) {
    newCalendarTableBody.innerHTML = '';

    const newDaysInMonth = new Date(newYear, newMonth + 1, 0).getDate();
    const newFirstDayOfMonth = new Date(newYear, newMonth, 1).getDay();
    let newDayCounter = 1;
    let newWeek = [];

    for (let i = 0; i < newFirstDayOfMonth; i++) {
      newWeek.push('');
    }

    while (newDayCounter <= newDaysInMonth) {
      const newDateKey = `${newYear}-${newMonth + 1}-${newDayCounter}`;

      const newCellData = {
        day: newDayCounter,
        class:
          newRecommendedDates[newDateKey] ? 'recommended' :
          newUnavailableDates[newDateKey] ? 'unavailable' : '',
      };

      newWeek.push(newCellData);

      if (newWeek.length === 7 || newDayCounter === newDaysInMonth) {
        while (newWeek.length < 7) {
          newWeek.push('');
        }

        const newRow = document.createElement('tr');
        newWeek.forEach((newCell) => {
          const newCellElement = document.createElement('td');
          if (newCell) {
            newCellElement.textContent = newCell.day;
            if (newCell.class) {
              newCellElement.classList.add(newCell.class);
            }
          }
          newRow.appendChild(newCellElement);
        });

        newCalendarTableBody.appendChild(newRow);
        newWeek = [];
      }

      newDayCounter++;
    }

    document.querySelectorAll('.new-calendar-table td').forEach((newCell) => {
      newCell.style.pointerEvents = newIsLoading ? 'none' : 'auto';

      newCell.addEventListener('click', () => {
        if (!newIsLoading && !newCell.classList.contains('unavailable') && newCell.textContent) {
          document.querySelectorAll('.new-calendar-table td').forEach((newTd) =>
            newTd.classList.remove('selected-date')
          );
          newCell.classList.add('selected-date');
          const newSelectedDate = `${newYear}-${(newMonth + 1).toString().padStart(2, '0')}-${newCell.textContent.padStart(2, '0')}`;
          newCalDayInput.value = newSelectedDate;

          $.ajax({
            url: 'save_session_date.php',
            type: 'POST',
            data: { selected_date: newSelectedDate },
            success: function (newResponse) {
              console.log('Session updated:', newResponse);

              newIsLoading = true;
              fetch('pick_schedule_algo/get_appointment.php')
                .then(newResponse => {
                  if (!newResponse.ok) {
                    throw new Error('Network response was not ok: ' + newResponse.statusText);
                  }
                  return newResponse.json();
                })
                .then(newData => {
                  if (newData.status !== 'success') {
                    throw new Error('Failed to retrieve schedule data: ' + (newData.message || 'Unknown error'));
                  }
                  newUpdateRecommendationsAndDropdown(newData);
                })
                .catch(newError => {
                  console.error('Error fetching schedule:', newError);
                })
                .finally(() => {
                  newIsLoading = false;
                  document.querySelectorAll('.new-calendar-table td').forEach((newCell) => {
                    newCell.style.pointerEvents = 'auto';
                  });
                });
            },
            error: function (newXhr, newStatus, newError) {
              console.error('Error setting session:', newError);
            },
          });
        }
      });
    });
  }

  if (newMonthSelect) {
    newMonthSelect.value = newCurrentMonth + 1;
    newMonthSelect.addEventListener('change', function () {
      newCurrentMonth = parseInt(this.value, 10) - 1;
      newGenerateCalendar(newCurrentMonth, newCurrentYear);
    });
  }

  newGenerateCalendar(newCurrentMonth, newCurrentYear);

  function newUpdateRecommendationsAndDropdown(response) {
    if (response.status !== "success") {
      console.error("Error: " + (response.message || "Unknown error"));
      return;
    }

    const newRecommendations = response.recommended_schedule;
    const newAvailableTimes = response.available_times;
    const newPredictedDurations = response.predicted_durations;

    const newRecommendationContainer = document.querySelector('.new-recommendation-container');
    let newRecommendationHTML = `<h3>Recommended Dates & Times (Predicted Duration: ${newPredictedDurations} minutes)</h3>`;
    newRecommendations.forEach((dateTime) => {
      const [date, time] = dateTime.split(' ');
      newRecommendationHTML += `<p>Date: ${formatDate(date)}<br>Time: ${formatTime(time)}</p>`;
    });
    newRecommendationContainer.innerHTML = newRecommendationHTML;

    const newTimeDropdown = document.getElementById('new-time');
    newTimeDropdown.innerHTML = '';
    newAvailableTimes.forEach((dateTime) => {
      const [, time] = dateTime.split(' ');
      newTimeDropdown.innerHTML += `<option value="${time}">${formatTime(time)}</option>`;
    });
  }

  function formatDate(dateStr) {
    const newOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const newDate = new Date(dateStr);
    return newDate.toLocaleDateString(undefined, newOptions);
  }

  function formatTime(timeStr) {
    const [hour, minute] = timeStr.split(':').map(Number);
    const newAmPm = hour >= 12 ? 'PM' : 'AM';
    const newFormattedHour = hour % 12 || 12;
    return `${newFormattedHour}:${minute.toString().padStart(2, '0')} ${newAmPm}`;
  }

  $(document).ready(function () {
    $("#newSubmitButton").on("click", function (e) {
      e.preventDefault();
      const newFormData = $("#newMultiStepForm").serialize();

      $.ajax({
        url: "appointment_crud/appointment_add_new.php",
        type: "POST",
        data: newFormData,
        success: function (response) {
          $("#newMultiStepForm")[0].reset();
        },
        error: function () {
          console.error("Error submitting appointment.");
        },
      });
    });
  });
});

</script>
