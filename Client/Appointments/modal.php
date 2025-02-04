<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/modal.css">
</head>
<body> 
 
 <!-- Modal -->
 <div class="modal" id="cancelAppointmentModal">
    <div class="modal-content">
      <span class="closebtn" id="closeCancelAppointmentModal">&times;</span>
      <div class="modal-title normal-title">Cancel Appointment</div>
      <div class="modal-description">
      <p>
        Oh no! We're sorry if there were any inconvenience on our part. 
        Please select reasons why you need to cancel your appointment:
      </p>
      <form>
        <label>
          <input type="radio" name="reason" value="busy" required>
          Too busy, my schedule does not align with appointment.
        </label>
        <label>
          <input type="radio" name="reason" value="emergency">
          Family emergency
        </label>
        <label>
          <input type="radio" name="reason" value="other">
          Other Reasons
        </label>
        <div class="other-reason" id="otherReasonContainer">
          <label for="otherReason">Please specify the reason: *</label>
          <input type="text" id="otherReason" name="otherReason">
        </div>
        <button type="submit" class="cancel-btn">Cancel Appointment</button>
      </form>
        </div>   
    </div>
  </div>



  <div class="modal" id="newAccountModal">
    <div class="modal-content">
    <button class="close-btn"  id="closeRescheduleButton">&times;</button>
        <div class="modal-title normal-title">Reschedule Appointment</div>
        <div class="modal-description">
        <?php include "reschedule-appointment.php"; ?>
        </div>
     </div>
</div>

  <script src="js/alert.js"></script>
  <script src="js/modal.js"></script>
  
  
  
  </body>
  </html>
  