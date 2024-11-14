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
          <a href="#" id="addServices">Add Service</a>
          <a href="#" id="deleteServices">Delete Service</a>
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

          <?php include "tr_services-tables.php";?>
          
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
