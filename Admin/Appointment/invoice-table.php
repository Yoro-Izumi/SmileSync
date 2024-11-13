<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page -->
  <link rel="stylesheet" href="css/invoice.css" />

</head>
<body>
<div class="container">
  <div class="controls">
  <div class="filters">
    <label for="date-range">Date Range</label>
    <select id="date-range">
      <option>90 Days</option>
      <option>30 Days</option>
    </select>

    <label for="sort-by">Sort By</label>
    <select id="sort-by">
      <option>All</option>
      <option>Date</option>
      <option>Invoice ID</option>
    </select>
    </div>
    <div class="search-bar"><input type="text" id="search" placeholder="Search..." /></div>
    <button id="new-invoice">+ New Invoice</button>
  </div>

  <div class="table-and-details">
    <table class="invoice-table">
      <thead>
        <tr>
          <th><input type="checkbox" id="select-all"></th>
          <th>INVOICE ID</th>
          <th>CLIENT NAME</th>
          <th>DATE</th>
        </tr>
      </thead>
      <tbody id="invoice-body">
        <!-- Dynamic rows will be inserted here -->
      </tbody>
    </table>

    <div class="invoice-details" id="invoice-details">
      <h3>Invoice Details</h3>
      <p class="place">
            <img src="img/archive.png" alt="security">
        </p>
      <p class="place">Select an invoice to view details.</p>
    </div>
  </div>

  

  <div class="pagination">
      <a href="#" class="previous">Previous</a>
      <div class="pagination-item" id="pagination"><!-- Pagination buttons will be generated here --></div>
      <a href="#" class="next">Next</a>
    </div>






</div>
<script src="js/invoice.js"></script>
</body>
</html>