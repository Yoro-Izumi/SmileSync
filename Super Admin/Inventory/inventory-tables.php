<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/table.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Product Listing</h2>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
      <div class="actions">
        <div class="dropdown">
          <button><i class="fas fa-ellipsis-v"></i></button>
          <div class="dropdown-content">
            <a href="#" id="addProduct"><i class="fas fa-plus"></i> Add Product</a>
            <a href="#" id="removeProduct"><i class="fas fa-trash-alt"></i> Delete</a>
            <a href="#"><i class="fas fa-download"></i> Download</a>
            <div class="dropdown-content">
              <a href="#" class="dropdown-option"><i class="fas fa-file-excel"></i> Excel</a>
              <a href="#" class="dropdown-option"><i class="fas fa-file-pdf"></i> PDF</a>
              <a href="#" class="dropdown-option"><i class="fas fa-file-word"></i> Word</a>
            </div>
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
          <?php include "tr_inventory-tables_product_listing.php";?>
        </tbody>
      </table>
    </div>

  <div class="pagination">
  <a href="#" class="previous">Previous</a>
  <a href="#" class="next">Next</a>
</div>

  </div>
  <div class="container">
    <div class="header">
      <h2>Product History</h2>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
      <div class="actions">
        <div class="dropdown">
          <button><i class="fas fa-ellipsis-v"></i></button>
          <div class="dropdown-content">
            <a href="#" id="removeProduct"><i class="fas fa-trash-alt"></i> Delete</a>
            <a href="#"><i class="fas fa-download"></i> Download</a>
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
          <?php include "tr_inventory-tables_product_history.php";?>
        </tbody>
      </table>
    </div>

<div class="pagination">
  <a href="#" class="previous">Previous</a>
  <a href="#" class="next">Next</a>
</div>

  </div>

  <script>
  $(document).ready(function() {
    var rowsPerPage = 5;  // Number of rows per page
    var currentPage = 1;  // Current page number

    // Function to show only rows for the current page
    function paginateTable(table, page) {
      var rows = $(table).find('tbody tr');
      var totalRows = rows.length;
      var totalPages = Math.ceil(totalRows / rowsPerPage);

      // Hide all rows
      rows.hide();

      // Calculate start and end rows for the current page
      var startRow = (page - 1) * rowsPerPage;
      var endRow = page * rowsPerPage;

      // Show rows for the current page
      rows.slice(startRow, endRow).show();

      // Update pagination buttons visibility
      updatePaginationButtons(totalPages, page);
    }

    // Update Next/Previous buttons and hide/show based on page count
    function updatePaginationButtons(totalPages, currentPage) {
      // Enable or disable the Previous and Next buttons
      if (currentPage === 1) {
        $('.previous').prop('disabled', true);
      } else {
        $('.previous').prop('disabled', false);
      }

      if (currentPage === totalPages) {
        $('.next').prop('disabled', true);
      } else {
        $('.next').prop('disabled', false);
      }

      // Hide pagination controls if there's only one page
      if (totalPages <= 1) {
        $('.pagination').hide();
      } else {
        $('.pagination').show();
      }
    }

    // Handle Previous Button Click
    $('.previous').click(function() {
      if (currentPage > 1) {
        currentPage--;
        paginateTable('.table-container table', currentPage);
      }
    });

    // Handle Next Button Click
    $('.next').click(function() {
      var totalRows = $('.table-container table tbody tr').length;
      var totalPages = Math.ceil(totalRows / rowsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        paginateTable('.table-container table', currentPage);
      }
    });

    // Initial pagination setup
    paginateTable('.table-container table', currentPage);
  });
</script>



</body>
</html>
