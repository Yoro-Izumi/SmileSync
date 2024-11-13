<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/table.css">
  <style>
    .hidden {
      display: none; /* This class hides the rows */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Client Schedule</h2>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
    </div>

    <div class="top-controls">
      <div class="filters">
        <div>
          <!--label for="status">Case Status</label-->
          <select id="status">
            <option value="all">All</option>
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="done">Done</option>
          </select>
        </div>
        <div>
          <!--label for="sort">Sort By</label-->
          <select id="sort">
            <option value="all">All</option>
          </select>
        </div>
      </div>

      <div class="buttons">
        <button class="btn new" id="newAccount">+New Appointment</button>
        <button class="btn" id="existingAccount">+Existing Account</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>CLIENT ID</th>
            <th>CLIENT NAME</th>
            <th>APPROVER</th>
            <th>APPOINTMENT</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="CLIENT ID">00-00-001</td>
            <td data-label="CLIENT NAME">Valera, Arwen Grace C.</td>
            <td data-label="APPROVER">Dr. OLI, Jonas</td>
            <td data-label="APPOINTMENT">08-10-2024</td>
            <td data-label="STATUS" class="status">Ongoing</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="appointment-details.php">View Details</a>
                    <a href="#">Download</a>
                    <a href="#" id="appointmentStatus">Done Appointment</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="CLIENT ID">00-00-002</td>
            <td data-label="CLIENT NAME">Dimaculangan, Chorlyn L.</td>
            <td data-label="APPROVER">Dr. OLI, Jonas</td>
            <td data-label="APPOINTMENT">08-10-2024</td>
            <td data-label="STATUS" class="status">Upcoming</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="appointment-details.php">View Details</a>
                    <a href="#">Download</a>
                    <a href="#" id="Status">Done Appointment</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="pagination">
      <a href="#" class="previous">Previous</a>
      <a href="#" class="pagination-item pagination-child">1</a>
      <a href="#" class="pagination-item">2</a>
      <a href="#" class="pagination-item">3</a>
      <a href="#" class="next">Next</a>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the query parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const statusFilter = urlParams.get('status');  // This will be 'upcoming' if the button was clicked

        // Get references to all the table rows
        const rows = document.querySelectorAll('tbody tr');
        const statusDropdown = document.getElementById('status');

        // Set dropdown value based on the query parameter
        if (statusFilter === 'upcoming') {
            statusDropdown.value = 'upcoming';
        }

        // Function to filter rows based on the selected status
        function filterRowsByStatus() {
            const selectedStatus = statusDropdown.value;

            rows.forEach(row => {
                // Get the status from the data-label attribute
                const status = row.querySelector('td[data-label="STATUS"]').textContent;
                
                if (selectedStatus === 'all' || status.toLowerCase() === selectedStatus.toLowerCase()) {
                    row.classList.remove('hidden');  // Show the row
                } else {
                    row.classList.add('hidden');  // Hide the row
                }
            });
        }

        // Event listener for the status dropdown
        statusDropdown.addEventListener('change', filterRowsByStatus);

        // Initial filtering
        filterRowsByStatus();
    });
</script>

</body>
</html>
