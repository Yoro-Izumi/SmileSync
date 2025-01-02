<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/table.css">
</head>
<body>

  <div class="container">
    
    <div class="header">
      <h2>Ongoing Dental Appointments:</h2>

     <a href="../Appointments/Appointments-page.php"> <button class="btn">View History</button></a>
    </div>



    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Service</th>
            <th>Date</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>

    </div>


    </div>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    function fetchAppointments() {
      $.ajax({
        url: 'get_appointments.php', // The PHP file that fetches the data
        type: 'GET',
        success: function (response) {
          // Parse the JSON response and populate the table
          const appointments = JSON.parse(response);
          let tableBody = '';
          appointments.forEach(appointment => {
            tableBody += `
              <tr>
                <td data-label="Name">${appointment.patient_name}</td>
                <td data-label="Service">${appointment.appointment_reason}</td>
                <td data-label="Date">${appointment.appointment_date}</td>
                <td data-label="Time">${appointment.appointment_time}</td>
              </tr>
            `;
          });
          $('tbody').html(tableBody);
        },
        error: function (xhr) {
          alert('Error fetching appointments: ' + xhr.responseText);
        }
      });
    }

    // Fetch appointments when the page loads
    fetchAppointments();
  });
</script>

</html>
