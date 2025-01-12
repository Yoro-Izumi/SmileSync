
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../client_global_files/js/jquery-3.6.0.min.js"></script>


    <h1 class="form-title">Add New Appointment</h1>

    <div class="steps">
      <div class="step active">
        <span class="step-icon">👤</span>
        <span class="step-label">Cancelation</span>
      </div>
      <div class="step">
        <span class="step-icon">📅</span>
        <span class="step-label">Change Appointment</span>
      </div>
      <div class="step">
        <span class="step-icon">🔒</span>
        <span class="step-label">Account</span>
      </div>
    </div>




    <form id="multiStepForm" name="multiStepForm" method="POST">
      <!-- Step 1: Personal Information and Reason -->
    <div class="form-section active">
        <table class="modal-table">
          <tr>
            <td><strong>Name</strong></td>
            <td>Maggi</td>
          </tr>
          <tr>
            <td><strong>Patient ID</strong></td>
            <td>456567</td>
          </tr>
          <tr>
            <div class="input-wrap">
              <input class="modal-input" type="text" maxlength="50" autocomplete="off" name="MedicalHistory" required />
          <label>Relevant Dental History<indicator>*</indicator></label>
          </div>
          </tr>
    </table>    
    <p>
      Oh no! We're sorry if there were any inconvenience on our part. 
      Please select reasons why you need to reschedule your appointment:
    </p>
    <form>
      <label>
        <input type="radio" name="reason" value="busy" required />
        Too busy, my schedule does not align with appointment.
      </label>
      <label>
        <input type="radio" name="reason" value="emergency" />
        Family emergency
      </label>
      <label>
        <input type="radio" name="reason" value="other" />
        Other Reasons
      </label>
      <div class="other-reason" id="otherReasonContainer">
        <label for="otherReason">Please specify the reason: *</label>
        <input type="text" id="otherReason" name="otherReason" />
      </div>
    </form>
      </div>

      
      <!-- Step 2: Appointmet -->
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
                </select>
          </div>         
        </div>
 
      </div>


      <!-- Form Navigation -->
      <div class="form-navigation">
        <button type="button" class="prev-btn" style="display: none;">Previous</button>
        <button type="button" class="next-btn">Next</button> 
        <button type="submit" class="next-btn" id="submitButton" name="submitButton">Submit</button>
      </div>
   </form>
