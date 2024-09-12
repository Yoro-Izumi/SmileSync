<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/table.css">
</head>
<body>

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
            <td data-label="STATUS" class="status">NEW</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#" >View Details</a>
                    <a href="#">Download</a>
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
            <td data-label="STATUS" class="status">Rescheduled</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="">View Details</a>
                    <a href="#">Download</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>

    
    </div>
  </div>
</body>
</html>
