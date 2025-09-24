
    <div class="steps">
      <div class="step active">
        <span class="step-icon">👤</span>
        <span class="step-label">Personal Information</span>
      </div>
      <div class="step">
        <span class="step-icon">📅</span>
        <span class="step-label">Appointment Detail</span>
      </div>
    </div>

    <form id="multiStepForm" name="multiStepForm" action="DentalForm-page.php" method="POST">
      
<div class="form-section active">
  <!-- Step 1: Personal Information -->
        <h3>Personal Information</h3>

        <div class="input-wrap">
      <select class="input-field" name="patientNameList" id="patientNameList" required>
        <option value="" disabled selected>Select Name of Patient</option>
        <!-- Add more options as needed -->
    </select>
      <label>Name of Patient<indicator>*</indicator></label>
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
            function toggleInfectedField() {
              const addressField = document.getElementById("infectedAddressField");
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
            function toggleHmoField() {
              const hmoField = document.getElementById("hmoField");
              const isYesSelected = document.getElementById("hmo-yes").checked;
              hmoField.style.display = isYesSelected ? "block" : "none";
            }
          </script>

           
        </div>
      </div>

    
      <!-- Step 2: Appointment Details -->
      <div class="form-section">
      <div class="dropdown-checkbox">
          <button class="dropdown-toggle">Select Services <span class="arrow">▼</span></button>
          <div class="dropdown-content">
            <?php include "service_list.php"; ?>
          </div>
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
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
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
                  <option value = "10:00:00">10:00 AM</option>
                </select>
          </div>         
        </div>
 
      </div>
  
      
    <div class="form-navigation">
    <div class="form-navigation">
        <button type="button" class="prev-btn" style="display: none;">Previous</button>
        <button type="button" class="next-btn">Next</button> 
        <button type="submit" class="next-btn" id="submitButton" name="submitButton">Submit</button>
      </div>
    </div>
  </form>

  <!--<script src="js/appointment_form.js"></script>-->
  <script>
document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
  const formSections = document.querySelectorAll('.form-section');
  const nextButton = document.querySelector('.next-btn');
  const prevButton = document.querySelector('.prev-btn');
  const steps = document.querySelectorAll('.steps .step');
  const submitButton = document.getElementById('submitButton');
  let currentStep = 0;

  submitButton.style.display = 'none';

  nextButton.addEventListener('click', (e) => {
    if (currentStep < formSections.length - 1) {
      formSections[currentStep].classList.remove('active');
      steps[currentStep].classList.remove('active');
      currentStep++;
      formSections[currentStep].classList.add('active');
      steps[currentStep].classList.add('active');
      prevButton.style.display = 'block';
      submitButton.style.display = 'none';

      if (currentStep === formSections.length - 1) {
        nextButton.style.display = 'none';
        submitButton.style.display = 'block';
      } else {
        nextButton.textContent = 'Next';
        nextButton.type = 'button';
      }
    }
  });

  prevButton.addEventListener('click', () => {
    if (currentStep > 0) {
      formSections[currentStep].classList.remove('active');
      steps[currentStep].classList.remove('active');
      currentStep--;
      formSections[currentStep].classList.add('active');
      steps[currentStep].classList.add('active');

      if (currentStep === 0) {
        prevButton.style.display = 'none';
      }

      nextButton.textContent = 'Next';
      nextButton.type = 'button';
    }
  });

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
  const calendarTableBody = document.querySelector('.calendar-table tbody');
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
        class:
          recommendedDates[dateKey] ? 'recommended' :
          unavailableDates[dateKey] ? 'unavailable' : '',
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

    document.querySelectorAll('.calendar-table td').forEach((cell) => {
      cell.style.pointerEvents = isLoading ? 'none' : 'auto';

      cell.addEventListener('click', () => {
        if (!isLoading && !cell.classList.contains('unavailable') && cell.textContent) {
          document.querySelectorAll('.calendar-table td').forEach((td) =>
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
              fetch('pick_schedule_algo/get_appointment2.php')
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                  }
                  return response.json();
                })
                .then(data => {
                  if (data.status !== 'success') {
                    throw new Error('Failed to retrieve schedule data: ' + (data.message || 'Unknown error'));
                  }
                  updateRecommendationsAndDropdown(data);
                })
                .catch(error => {
                  console.error('Error fetching schedule:', error);
                })
                .finally(() => {
                  isLoading = false;
                  document.querySelectorAll('.calendar-table td').forEach((cell) => {
                    cell.style.pointerEvents = 'auto';
                  });
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

    // Clear recommendations and selected date when month changes
    clearRecommendations();
    clearSelectedDate();
  });

  generateCalendar(currentMonth, currentYear);

  // Service Checkbox Logic
  $(document).ready(function () {
    $('input[name="service[]"]').on('click', function () {
      const selectedServices = [];
      $('input[name="service[]"]:checked').each(function () {
        selectedServices.push($(this).val());
      });

      // Clear recommendations and selected date when services change
      clearRecommendations();
      clearSelectedDate();

      // Send selected services to PHP using AJAX
      $.ajax({
        url: 'set_session.php', // PHP script to handle saving
        type: 'POST',
        data: { services: selectedServices },
        success: function (response) {
          console.log('Services saved:', response);
        },
        error: function (error) {
          console.error('Error saving services:', error);
        }
      });
    });
  });

  // Function to clear recommendations
  function clearRecommendations() {
    const recommendationContainer = document.querySelector('.recommendation-container');
    recommendationContainer.innerHTML = ''; // Clear recommendations
    const timeDropdown = document.getElementById('time');
    timeDropdown.innerHTML = ''; // Clear available times dropdown
  }

  // Function to clear selected date
  function clearSelectedDate() {
    document.querySelectorAll('.calendar-table td').forEach((td) =>
      td.classList.remove('selected-date')
    );
    calDayInput.value = ''; // Clear the selected date input
  }

  // Function to update the recommended schedule and available times
  function updateRecommendationsAndDropdown(response) {
    if (response.status !== "success") {
      console.error("Error: " + (response.message || "Unknown error"));
      return;
    }

    const recommendations = response.recommended_schedule;
    const availableTimes = response.available_times;
    const predictedDurations = response.predicted_durations;

    const recommendationContainer = document.querySelector('.recommendation-container');
    let recommendationHTML = `<h3>Recommended Dates & Times (Predicted Duration: ${predictedDurations} minutes)</h3>`;
    recommendations.forEach((dateTime) => {
      const [date, time] = dateTime.split(' ');
      recommendationHTML += `<p>Date: ${formatDate(date)}<br>Time: ${formatTime(time)}</p>`;
    });
    recommendationContainer.innerHTML = recommendationHTML;

    const timeDropdown = document.getElementById('time');
    timeDropdown.innerHTML = '';
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

  // Form submission logic
  $(document).ready(function () {
    $('#multiStepForm').on('submit', function (event) {
      event.preventDefault(); // Prevent default form submission

      const formData = $(this).serialize(); // Serialize form data

      $.ajax({
        url: 'appointment_crud/appointment_add.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            alert(response.message);
            $('#multiStepForm')[0].reset(); // Clear the form
          } else {
            alert('Error: ' + response.message);
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', status, error);
        }
      });
    });
  });

  // Fetch patient names for dropdown
  $(document).ready(function () {
    const apiUrl = "appointment_crud/get_patient_info.php"; // Replace this with your actual API endpoint

    $.ajax({
      url: apiUrl,
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (data && Array.isArray(data)) {
          const selectElement = $("#patientNameList");
          data.forEach((patient) => {
            selectElement.append(
              $("<option>", {
                value: patient.id, // Assuming the patient object has an `id` property
                text: patient.name, // Assuming the patient object has a `name` property
              })
            );
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error fetching patient names:", error);
      },
    });
  });
});
  </script>