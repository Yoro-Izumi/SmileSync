<p>
      Oh no! We're sorry if there were any inconvenience on our part. 
      Please select reasons why you need to reschedule your appointment:
    </p>
<div class="steps">
  <div class="step active">
    <span class="step-icon">👤</span>
    <span class="step-label">Rescheduling Reason</span>
  </div>
  <div class="step">
    <span class="step-icon">📅</span>
    <span class="step-label">Change Appointment</span>
  </div>
</div>

<form id="resched-newMultiStepFormResched" name="resched-newMultiStepFormResched" method="POST">
  <!-- Step 1: Personal Information and Reason -->
  <div class="resched-form-section active">
    <table class="modal-table">
      <tr>
        <td><strong>Name</strong></td>
        <td><input class="input-as-a-text" name="nameResched" id="nameResched" disabled value="Maggi"></td>
      </tr>
      <tr>
        <td><strong>Patient ID</strong></td>
        <td><input class="input-as-a-text" name="patientIDResched" id="patientIDResched" disabled value="Maggi"></td>
      </tr>
      <tr>
        <div class="input-wrap">
          <input class="input-as-a-text" type="text" maxlength="50" autocomplete="off" name="MedicalHistory" id="MedicalHistory" disabled />
          <label>Relevant Dental History<indicator>*</indicator></label>
        </div>
      </tr>
    </table>    
      <div class="label">
        <input type="radio" name="reasonResched" value="busy" required />
        Too busy, my schedule does not align with appointment.
      </div>
      <div class="label">
        <input type="radio" name="reasonResched" value="emergency" />
        Family emergency
      </div>
      <div class="label">
        <input type="radio" name="reasonResched" value="other" />
        Other Reasons
      </div>
      <div class="resched-other-reason" id="resched-otherReasonContainer">
        <label for="resched-otherReason">Please specify the reason: *</label>
        <input type="text" id="resched-otherReason" name="otherReasonResched" />
      </div>
  </div>

  <!-- Step 2: Appointment -->
  <div class="resched-form-section">
    <h2>Appointment Detail</h2>

    <div class="input-wrap">
      <select class="input-field" id="resched-services" name="services">
        <option value="" disabled selected>Select a Service</option>
        <?php include "service_list.php";?>
      </select>
    </div>
    <div class="resched-appointment-container">
      <!-- Calendar Section -->
      <div class="resched-calendar-container">
        <div class="resched-calendar-header">
          <span>Select Date<span class="resched-required">*</span></span>
          <span class="resched-calendar-legend">
            <span class="resched-legend unavailable">Unavailable</span>
            <span class="resched-legend choice">Available</span>
            <span class="resched-legend recommended">Recommended</span>
          </span>
        </div>

        <div class="resched-calendar-month" style="text-align: center;">
          <select id="resched-month" name="month">
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

        <table class="resched-calendar-table">
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
              <td></td><td></td><td></td><td class="resched-unavailable">1</td><td class="resched-unavailable">2</td><td class="resched-choice">3</td><td class="resched-recommended">4</td>
            </tr>
            <tr>
              <td class="resched-choice">5</td><td>6</td><td>7</td>
              <td class="resched-recommended">8</td><td>9</td><td class="resched-unavailable">10</td><td class="resched-choice">11</td>
            </tr>
            <tr>
              <td>12</td><td>13</td><td>14</td>
              <td class="resched-choice">15</td><td>16</td><td class="resched-recommended">17</td>
              <td>18</td>
            </tr>
            <tr>
              <td>19</td><td>20</td><td>21</td>
              <td>22</td><td class="resched-unavailable">23</td>
              <td>24</td><td>25</td>
            </tr>
            <tr>
              <td>26</td><td>27</td><td>28</td>
              <td class="resched-choice">29</td><td>30</td><td>31</td><td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <input type="hidden"  id="resched-cal-day" name="cal-day">
      <!-- Recommendation Section -->
      <div class="resched-recommendation-container">
        <h3>Recommended Dates & Times</h3>
      </div>
    </div>

    <div class="resched-select-time-container">
      <label for="resched-time">Select a Time:</label>
      <div class="resched-time-selection"> 
        <select id="resched-time" name="time">
          <option value="10:00:00">10 AM</option>
        </select>
      </div>         
    </div>
  </div>

  <!-- Form Navigation -->
  <div class="form-navigation">
    <button type="button" class="resched-prev-btn" style="display: none;">Previous</button>
    <button type="button" class="resched-next-btn">Next</button> 
    <button type="submit" class="resched-next-btn" id="resched-submitButton" name="resched-submitButton">Submit</button>
  </div>
</form>

<script src="js/appointment_resched.js"></script>

