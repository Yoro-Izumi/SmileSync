<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/table.css">
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
  <div class="container">
    <h2>Service Listing</h2>

    <div class="header">
      <div>
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
            <a href="#" id="addServices" class="addServices" data-modal="addServiceModal"><i class="fas fa-plus"></i> Add New Service</a>
            <a href="#" id="deleteServices" class="deleteServices" data-modal="deleteProgressModal"><i class="fas fa-trash"></i> Delete Service</a>
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
          <?php include "tr-services-tables.php";?>
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
