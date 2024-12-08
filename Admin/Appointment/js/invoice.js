// Sample invoices for testing
  const invoices = [
    { id: 'KDKT-83DJ-7F', client: 'Dimaculangan, Chorlyn L.', date: '08-10-2024', details: 'Details for 08-10-2024' },
    { id: 'KDYT-834J-4G', client: 'Dimaculangan, Chorlyn L.', date: '08-05-2024', details: 'Details for 08-05-2024' },
    { id: 'H45T-8HGJ-YT', client: 'Dimaculangan, Chorlyn L.', date: '08-01-2024', details: 'Details for 08-01-2024' },
    { id: 'A123-456B-CD', client: 'Smith, John', date: '07-20-2024', details: 'Details for 07-20-2024' },
    { id: 'B789-101X-ZY', client: 'Doe, Jane', date: '07-15-2024', details: 'Details for 07-15-2024' },
  ];

  // Pagination
  const rowsPerPage = 2;
  let currentPage = 1;

  // Function to populate the table with filtered and paginated data
  function populateTable(filteredInvoices, page = 1) {
    const tbody = document.getElementById('invoice-body');
    tbody.innerHTML = ''; // Clear existing content
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    filteredInvoices.slice(start, end).forEach((invoice, index) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td><input type="checkbox"></td>
        <td>${invoice.id}</td>
        <td>${invoice.client}</td>
        <td>${invoice.date}</td>
      `;
      row.addEventListener('click', () => displayDetails(start + index));
      tbody.appendChild(row);
    });

    renderPagination(filteredInvoices);
  }

  // Function to display invoice details when clicked
  function displayDetails(index) {
    const detailsDiv = document.getElementById('invoice-details');
    const invoice = invoices[index];
    detailsDiv.innerHTML = `
      <h3>
      Invoice Details
            <div class="dropdown">
          <button class="btn" style="align-items: right;"><i class="fas fa-download"></i> Download</button>
          <div class="dropdown-content">
            <a href="#" class="dropdown-option" id="exportExcel"><i class="fas fa-file-excel"></i>Excel</a>
            <a href="#" class="dropdown-option" id="exportPDF"><i class="fas fa-file-pdf"></i>PDF</a>
            <a href="#" class="dropdown-option" id="exportWord"><i class="fas fa-file-word"></i>Word</a>
          </div>
        </div>
      </h3>
      <p><strong>Invoice ID:</strong> ${invoice.id}</p>
      <p><strong>Client Name:</strong> ${invoice.client}</p>
      <p><strong>Date:</strong> ${invoice.date}</p>
      <p><strong>Details:</strong> ${invoice.details}</p>
    `;
  }

  // Render pagination buttons based on filtered results
  function renderPagination(filteredInvoices) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Clear existing pagination
    const totalPages = Math.ceil(filteredInvoices.length / rowsPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.textContent = i;
      button.classList.toggle('active', i === currentPage);
      button.addEventListener('click', () => {
        currentPage = i;
        populateTable(filteredInvoices, i);
      });
      pagination.appendChild(button);
    }
  }

  // Filter function based on search input, date range, and sort
  function filterInvoices() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const dateRange = document.getElementById('date-range').value;
    const sortBy = document.getElementById('sort-by').value;

    // Filter by search term (ID or client name)
    let filteredInvoices = invoices.filter(invoice =>
      invoice.id.toLowerCase().includes(searchTerm) ||
      invoice.client.toLowerCase().includes(searchTerm)
    );

    // Filter by date range (e.g., last 90 days, last 30 days)
    const currentDate = new Date();
    if (dateRange === '90 Days') {
      filteredInvoices = filteredInvoices.filter(invoice => {
        const invoiceDate = new Date(invoice.date);
        const date90DaysAgo = new Date(currentDate);
        date90DaysAgo.setDate(currentDate.getDate() - 90);
        return invoiceDate >= date90DaysAgo;
      });
    } else if (dateRange === '30 Days') {
      filteredInvoices = filteredInvoices.filter(invoice => {
        const invoiceDate = new Date(invoice.date);
        const date30DaysAgo = new Date(currentDate);
        date30DaysAgo.setDate(currentDate.getDate() - 30);
        return invoiceDate >= date30DaysAgo;
      });
    }

    // Sort based on the sort-by dropdown (date or invoice ID)
    if (sortBy === 'Date') {
      filteredInvoices.sort((a, b) => new Date(b.date) - new Date(a.date));
    } else if (sortBy === 'Invoice ID') {
      filteredInvoices.sort((a, b) => a.id.localeCompare(b.id));
    }

    // Update the table with filtered and sorted results
    populateTable(filteredInvoices, 1); // Reset to page 1 when filtering
  }

  // Event listeners for search and filter changes
  document.getElementById('search').addEventListener('input', filterInvoices);
  document.getElementById('date-range').addEventListener('change', filterInvoices);
  document.getElementById('sort-by').addEventListener('change', filterInvoices);

  // Initial population of table with default data
  populateTable(invoices);

  const table = document.querySelector('.invoice-table');

  table.addEventListener('click', (event) => {
      // Remove 'selected' class from all rows
      const rows = table.querySelectorAll('tr');
      rows.forEach(row => row.classList.remove('selected'));

      // Add 'selected' class to the clicked row
      const clickedRow = event.target.closest('tr');
      if (clickedRow) {
          clickedRow.classList.add('selected');
      }
  });