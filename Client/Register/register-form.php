<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <div class="topbar">
      <img src="logo.png" alt="Logo" class="logo">
      <div class="return-link"><a href="#">Return to landing page</a></div>
    </div>
  </header>

  <div class="form-container">
    <h1 class="form-title">Add New Account</h1>

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

    <form id="multiStepForm">
      <!-- Step 1: Personal Information -->
      <div class="form-section active">
        <h2>Personal Information</h2>
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
      type="text"
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
                <div class="invalid-feedback">
                  Please provide a valid contact number.
                </div>
      </div>

      
      <!-- Step 2: Appointment Details -->
      <div class="form-section">
        <h2>Appointment Detail</h2>
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

        <div class="question-form">
  <div class="titles">
    <span>Question</span>
  </div>

  <div class="question-row">
    <div class="input-wrap">
      <label for="questionInput">Have you visited any infected areas?</label>
    </div>
    <div class="answer-options">
      <input type="radio" id="coffee-yes" name="coffee" value="yes">
      <label for="coffee-yes">Yes</label>
      <input type="radio" id="coffee-no" name="coffee" value="no">
      <label for="coffee-no">No</label>
    </div>
  </div>
</div>
 
      </div>

      <!-- Step 3: Account -->
      <div class="form-section">
        <h2>Account Setup</h2>
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
                  <div class="invalid-feedback">Password strength is weak. Please enter a stronger password.</div>


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
  </script>

  <script>
    // JavaScript to highlight selected date
document.querySelectorAll('.calendar-table td').forEach(cell => {
  cell.addEventListener('click', () => {
    document.querySelectorAll('.calendar-table td').forEach(td => td.classList.remove('selected-date'));
    cell.classList.add('selected-date');
  });
});

  </script>
</body>
</html>
