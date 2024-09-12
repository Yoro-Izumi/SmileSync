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
      <h2>Service Listing </h2>

      <div>
          <label for="sort">Sort By</label>
          <select id="sort">
            <option>All</option>
            <option>Description</option>
            <option>Price</option>
            <option>Duration</option>
          </select>
        </div>

      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>

      <div class="actions">
        <div class="dropdown">
          <button>⋮</button>
          <div class="dropdown-content">
          <a href="#" >Delete Service</a>
          <a href="#">Edit Service</a>
          </div>
        </div>
      </div>

    </div>
    
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>Description</th>
            <th>ID</th>
            <th>Price</th>
            <th>Duration</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="Description">X-ray</td>
            <td data-label="ID">00-00-001</td>
            <td data-label="Price">10.00</td>
            <td data-label="Duration">10 hours</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#" >Delete Service</a>
                    <a href="#">Edit Service</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td><input type="checkbox"></td>
            <td data-label="Description">Prothodontics</td>
            <td data-label="ID">00-00-002</td>
            <td data-label="Price">10000.00</td>
            <td data-label="Duration">2 hours</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#" >Delete Service</a>
                    <a href="#">Edit Service</a>
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

  
</body>
</html>
