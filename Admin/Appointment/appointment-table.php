
  <div class="container">
    <div class="header">
      <h2>Client Schedule</h2>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
    </div>

    <div class="top-controls">
      <div class="filters">
        <div>
          <select id="status">
            <option value="all">All</option>
            <option value="approved">Approved</option>
            <option value="ongoing">Ongoing</option>
            <option value="done">Done</option>
            <option value="pending">Pending</option>
          </select>
        </div>
        <div>
          <select id="sort">
            <option value="all">All</option>
            <option value="ascending">Ascending</option>
            <option value="descending">Descending</option>
          </select>
        </div>
      </div>
      <div class="buttons">
        <button class="btn new" id="newAccount">+New Appointment</button>
        <button class="btn new" id="existingAccount">+Existing Account</button>
      </div>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><input type="checkbox"></th>
            <th class="sortable" data-column="1">CLIENT ID</th>
            <th class="sortable" data-column="2">CLIENT NAME</th>
            <th class="sortable" data-column="3">APPROVER</th>
            <th class="sortable" data-column="4">APPOINTMENT</th>
            <th class="sortable" data-column="5">STATUS</th>
            <th data-label="ACTIONS">
              <div class="actions">
                  <div class="dropdown">
                      <button>⋮</button>
                      <div class="dropdown-content">
                          <a href="#">Download</a>
                      </div>
                  </div>
              </div>
          </th>
          </tr>
        </thead>
        <tbody>
          <?php include "tr-appointment-table.php";?>
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
  <script>
  /*document.addEventListener('DOMContentLoaded', function () {
    const statusFilter = document.getElementById('status');
    const searchInput = document.querySelector('.search-bar input');
    const checkAllCheckbox = document.querySelector('th input[type="checkbox"]');
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    const rows = document.querySelectorAll('tbody tr');
    const rowsPerPage = 5; // Number of rows per page
    let currentPage = 1;

    // Function to filter rows based on the status and search input
    function filterRows() {
      const status = statusFilter.value.toLowerCase(); // Selected status
      const searchText = searchInput.value.toLowerCase().trim(); // Search text

      rows.forEach((row) => {
        const statusText = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
        const clientName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const clientId = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

        // Match rows based on status and search text
        const matchesStatus = status === 'all' || statusText === status;
        const matchesSearch =
          !searchText || // Show all rows if search text is empty
          clientName.includes(searchText) ||
          clientId.includes(searchText);

        if (matchesStatus && matchesSearch) {
          row.classList.remove('hidden'); // Show matching rows
        } else {
          row.classList.add('hidden'); // Hide non-matching rows
        }
      });

      currentPage = 1; // Reset to the first page
      updatePagination(); // Update pagination
    }

    // Pagination logic
    function updatePagination() {
      const visibleRows = Array.from(rows).filter((row) => !row.classList.contains('hidden'));
      const totalPages = Math.ceil(visibleRows.length / rowsPerPage);

      visibleRows.forEach((row, index) => {
        row.style.display =
          Math.ceil((index + 1) / rowsPerPage) === currentPage ? '' : 'none';
      });

      // Update pagination display (if you have pagination buttons, implement their logic here)
    }

    // Show all rows initially
    function showAllRowsOnPageLoad() {
      rows.forEach((row) => {
        row.classList.remove('hidden'); // Make all rows visible
        row.style.display = ''; // Reset display property
      });

      updatePagination(); // Apply pagination to visible rows
    }

    // Trigger filtering logic only when the dropdown value changes
    statusFilter.addEventListener('change', filterRows);

    // Trigger filtering logic only when search input value changes
    searchInput.addEventListener('input', function () {
      if (searchInput.value.trim()) {
        filterRows();
      }
    });

    // Checkbox "select all" functionality
    checkAllCheckbox.addEventListener('change', function () {
      checkboxes.forEach((checkbox) => {
        checkbox.checked = checkAllCheckbox.checked;
      });
    });

    // Individual checkbox functionality
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', function () {
        checkAllCheckbox.checked = Array.from(checkboxes).every((checkbox) => checkbox.checked);
      });
    });

    // Show all rows on page load
    showAllRowsOnPageLoad();
  }); */
</script>



