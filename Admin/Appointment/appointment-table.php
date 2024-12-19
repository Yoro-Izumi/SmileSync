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
            <option value="pending">Pending</option>
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
          <?php include "tr-appointment-table.php";?>
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
  <script href="js/appointment-table.js"></script>

</body>
</html>
