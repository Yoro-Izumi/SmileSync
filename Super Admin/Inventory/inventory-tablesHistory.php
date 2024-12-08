<!DOCTYPE html>
<html lang="en">

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
                  <button><i class="fas fa-ellipsis-v"></i></button>
                  <div class="dropdown-content">
                    <a href="#" id="removeProduct"><i class="fas fa-trash-alt"></i> Delete</a>
                    <a href="#" id="viewDetailsHistory"><i class="fas fa-eye"></i> View Details</a>
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
