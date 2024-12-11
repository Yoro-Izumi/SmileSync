<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
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
    </div>

    <form id="multiStepForm">
      <!-- Step 1: Personal Information -->
      <div class="form-section active">
        <h3>Personal Information</h3>
        
          <div class="input-wrap">
            <input type="text" maxlength="24" class="input-field" autocomplete="off" name="firstName" required />
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
              <input type="radio" id="hmo-yes" name="visited" value="yes" onclick="toggleAddressField()">
              <label for="hmo-yes">Yes</label>
              <input type="radio" id="hmo-no" name="visited" value="no" onclick="toggleAddressField()">
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
        <div class="input-wrap">
  <select class="input-field" id="services">
    <option value="" disabled selected>Select a Service</option>
    <option value="consultation">Consultation</option>
    <option value="therapy">Therapy</option>
    <option value="diagnostics">Diagnostics</option>
    <option value="surgery">Surgery</option>
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

          <!-- Recommendation Section -->
          <div class="recommendation-container">
            <h3>Available Times</h3>
            <p>10:00 AM</p>
            <p>11:00 AM</p>
            <p>2:00 PM</p>
            <p>3:00 PM</p>

            <h3>Recommended Dates & Times</h3>
            <p>Date: 3rd August 2024</p>
            <p>Time: 10:00 AM - 11:00 AM</p>
            <p>Date: 14th August 2024</p>
            <p>Time: 2:00 PM - 3:00 PM</p>
          </div>
          
      </div>

        <div class="select-time-container">
             <label for="time">Select a Time:</label>
              <div class="time-selection"> 
                <select id="time" name="time">
                  <option value="10:00 AM">10:00 AM</option>
                  <option value="11:00 AM">11:00 AM</option>
                  <option value="2:00 PM">2:00 PM</option>
                  <option value="3:00 PM">3:00 PM</option>
                </select>
          </div>         
        </div>
 
      </div>

      
    </form>
    <div class="form-navigation">
      <button type="button" class="prev-btn" style="display: none;">Previous</button>
      <button type="button" class="next-btn">Next</button>
    </div>
  </div>

  <footer>
    <p>&copy; 2024 iMee Dental Clinic. All rights reserved.</p>
  </footer>

  <script>
    const formSections = document.querySelectorAll('.form-section');
    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');
    const steps = document.querySelectorAll('.steps .step');
    let currentStep = 0;

    nextButton.addEventListener('click', () => {
      if (currentStep < formSections.length - 1) {
        formSections[currentStep].classList.remove('active');
        steps[currentStep].classList.remove('active');
        currentStep++;
        formSections[currentStep].classList.add('active');
        steps[currentStep].classList.add('active');
        prevButton.style.display = 'block';
      }
      if (currentStep === formSections.length - 1) {
        nextButton.textContent = 'Submit';
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
      }
      nextButton.textContent = 'Next';
    });

    document.querySelectorAll('.calendar-table td').forEach(cell => {
      cell.addEventListener('click', () => {
        document.querySelectorAll('.calendar-table td').forEach(td => td.classList.remove('selected-date'));
        if (!cell.classList.contains('unavailable')) {
          cell.classList.add('selected-date');
        }
      });
    });
  </script>
</body>

</html>
