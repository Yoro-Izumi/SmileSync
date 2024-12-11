<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Schedule</title>
  <link rel="stylesheet" href="css/table.css">
</head>
<body>
  <div class="container">

  <div class="top-controls">
      <div class="filters">
        <div>
          <label for="status">Date Range</label>
          <select id="status">
            <option>All</option>
          </select>
        </div>
        <div>
          <label for="sort">Sort By</label>
          <select id="sort">
            <option>All</option>
          </select>
        </div>
      </div>
   <!-- -->

   <div class="search-bar">
      <input type="text" placeholder="Search...">
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
          <?php include "tr-upcoming-appointments.php";?>
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
  </div>
</body>
</html>
