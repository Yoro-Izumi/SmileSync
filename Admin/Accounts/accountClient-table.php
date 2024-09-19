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
    <h2>Patient Account Details</h2>
    <div class="header">
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
    </div>

        <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Delete Account</a>
                    <a href="#">Approve Account</a>
                  </div>
                </div>
              </div>
      </div>

    
    <div class="top-controls">
      <div class="filters">
        <div>
          <label for="status">Case Status</label>
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
     </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>CLIENT ID</th>
            <th>CLIENT NAME</th>
            <th>APPROVER</th>
            <th>Date of Creation</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="ID">00-00-001</td>
            <td data-label="NAME">Valera, Arwen Grace C.</td>
            <td data-label="APPROVER">Dr. OLI, Jonas</td>
            <td data-label="Date of Creation">08-10-2024</td>
            <td data-label="STATUS" class="status">Active</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Delete Account</a>
                    <a href="#">Edit Account</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="ID">00-00-002</td>
            <td data-label="NAME">Dimaculangan, Chorlyn L.</td>
            <td data-label="APPROVER">-</td>
            <td data-label="Date of Creation">08-10-2024</td>
            <td data-label="STATUS" class="status">Pending</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Delete Account</a>
                    <a href="#">Edit Account</a>
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
  </div>
</body>
</html>
