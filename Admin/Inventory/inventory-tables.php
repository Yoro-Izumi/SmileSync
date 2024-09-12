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
      <h2>Product Listing </h2>

      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>

      <div class="actions">
        <div class="dropdown">
          <button>⋮</button>
          <div class="dropdown-content">
            <a href="#">View Details</a>
            <a href="#">Download</a>
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
                    <a href="#" >View Details</a>
                    <a href="#">Download</a>
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
                    <a href="#" >View Details</a>
                    <a href="#">Download</a>
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



    <div class="container">
      <div class="header">
        <h2>Product History </h2>
  
        <div class="search-bar">
          <input type="text" placeholder="Search...">
        </div>
  
        <div class="actions">
          <div class="dropdown">
            <button>⋮</button>
            <div class="dropdown-content">
              <a href="#">View Details</a>
              <a href="#">Download</a>
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
              <th>Quantity</th>
              <th>Date Used</th>
              <th>Released By</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td data-label="Product Name">Analgesics</td>
              <td data-label="Product ID">00-001</td>
              <td data-label="Quantity">10</td>
              <td data-label="Date Used">08-10-2024</td>
              <td data-label="Released By">Doc Oli, Jonas</td>
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
              <td data-label="Product Name">Anesthetic</td>
              <td data-label="Product ID">001-00-2</td>
              <td data-label="Quantity">10</td>
              <td data-label="Date Used">08-10-2024</td>
              <td data-label="Released By">Doc Oli, Jonas</td>
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
