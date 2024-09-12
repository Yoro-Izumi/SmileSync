<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/table.css">
</head>
<body>

  <div class="container">
    <h2>Removed Inventory List</h2>
    <div class="header">
      <div class="filters">
        <div>
          <label for="sort">Sort By</label>
          <select id="sort">
            <option>All</option>
          </select>
        </div>

      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
    </div>

        <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Restore</a>
                    <a href="#">Permanent Delete</a>
                  </div>
                </div>
              </div>
    </div>



    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th>Product Name</th>
            <th>Product ID</th>
            <th>Price Sold</th>
            <th>Batch Date</th>
            <th>Expiry Date</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="Product Name">Analgesics</td>
            <td data-label="Product ID">00-001</td>
            <td data-label="Price Sold">10.00</td>
            <td data-label="Batch Date">08-10-2024</td>
            <td data-label="Expiry Date">08-10-2027</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#">Restore</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td data-label="Product Name">Anesthetic</td>
            <td data-label="Product ID">001-00-2</td>
            <td data-label="Price Sold">50.00</td>
            <td data-label="Batch Date">08-10-2024</td>
            <td data-label="Expiry Date">08-10-2027</td>
            <td data-label="ACTIONS">
              <div class="actions">
                <div class="dropdown">
                  <button>⋮</button>
                  <div class="dropdown-content">
                    <a href="#" >Restore</a>
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
