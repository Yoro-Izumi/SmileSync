
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
        <button class="btn" id="existingAccount">+Existing Account</button>
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
  document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('status');
    const searchInput = document.querySelector('.search-bar input');
    const checkAllCheckbox = document.querySelector('th input[type="checkbox"]');
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    const rows = document.querySelectorAll('tbody tr');
    const paginationLinks = document.querySelectorAll('.pagination-item');
    const rowsPerPage = 5; // Number of rows per page
    let currentPage = 1;

    // Function to filter rows based on the status
    function filterRows() {
  const status = statusFilter.value.toLowerCase(); // Get the selected status
  const searchText = searchInput.value.toLowerCase().trim(); // Get the search input

  console.log("Filtering with status:", status); // Debugging: Check status filter value
  console.log("Filtering with search text:", searchText); // Debugging: Check search input value

  rows.forEach((row, index) => {
    const statusText = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
    const clientName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
    const clientId = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

    console.log(`Row ${index} - Status: ${statusText}, Client Name: ${clientName}, Client ID: ${clientId}`); // Debugging

    // Match all rows if "all" is selected or match specific status
    const matchesStatus = status === "all" || statusText === status;
    const matchesSearch = 
      searchText === "" || 
      clientName.includes(searchText) || 
      clientId.includes(searchText);

    // Debugging: Check if the row matches status and search conditions
    console.log(`Row ${index} - Matches Status: ${matchesStatus}, Matches Search: ${matchesSearch}`);

    if (matchesStatus && matchesSearch) {
      row.classList.remove('hidden'); // Show matching rows
    } else {
      row.classList.add('hidden'); // Hide non-matching rows
    }
  });

  currentPage = 1; // Reset to the first page when filters change
  updatePagination(); // Update pagination
}


    // Search functionality
    searchInput.addEventListener('input', filterRows);

    // Status filter functionality
    statusFilter.addEventListener('change', filterRows);

    // Checkbox "select all" functionality
    checkAllCheckbox.addEventListener('change', function() {
      checkboxes.forEach(checkbox => {
        checkbox.checked = checkAllCheckbox.checked;
      });
    });

    // Individual checkbox functionality
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        checkAllCheckbox.checked = Array.from(checkboxes).every(checkbox => checkbox.checked);
      });
    });

    // Sorting functionality
    const thElements = document.querySelectorAll('th.sortable');
    thElements.forEach(th => {
      th.addEventListener('click', function() {
        const columnIndex = th.getAttribute('data-column') - 1;
        const rowsArray = Array.from(rows);

        // Determine the sorting order
        const currentOrder = th.classList.contains('ascending') ? 'ascending' : 'descending';
        const newOrder = currentOrder === 'ascending' ? 'descending' : 'ascending';

        rowsArray.sort((rowA, rowB) => {
          const cellA = rowA.querySelectorAll('td')[columnIndex].textContent.trim();
          const cellB = rowB.querySelectorAll('td')[columnIndex].textContent.trim();

          return currentOrder === 'ascending'
            ? cellA > cellB ? 1 : -1
            : cellA < cellB ? 1 : -1;
        });

        // Reorder the rows in the table
        rowsArray.forEach(row => row.parentElement.appendChild(row));

        // Toggle class to indicate sorting order
        th.classList.toggle('ascending', newOrder === 'ascending');
        th.classList.toggle('descending', newOrder === 'descending');
      });
    });

    // Initial filter application on page load
    filterRows();
  });
</script>


