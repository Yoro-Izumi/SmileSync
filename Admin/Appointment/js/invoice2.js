// Updated invoices array
const invoices = [
  {
    id: 'KDKT-83DJ-7F',
    client: 'Dimaculangan, Chorlyn L.',
    date: '08-10-2024',
    details: 'Dental Cleaning',
    hmoVerification: 'Pending',
    total: '2000',
    request: 'None',
    amountPaid: '1000',
    balance: '1000',
  },
  {
    id: 'KDYT-834J-4G',
    client: 'Dimaculangan, Chorlyn L.',
    date: '08-05-2024',
    details: 'Tooth Filling',
    hmoVerification: 'Approved',
    total: '1500',
    request: 'Follow-up',
    amountPaid: '1500',
    balance: '0',
  },
  {
    id: 'H45T-8HGJ-YT',
    client: 'Dimaculangan, Chorlyn L.',
    date: '08-01-2024',
    details: 'Root Canal',
    hmoVerification: 'Rejected',
    total: '8000',
    request: 'None',
    amountPaid: '5000',
    balance: '3000',
  },
  {
    id: 'A123-456B-CD',
    client: 'Smith, John',
    date: '07-20-2024',
    details: 'Orthodontic Consultation',
    hmoVerification: 'Pending',
    total: '1000',
    request: 'Braces Inquiry',
    amountPaid: '500',
    balance: '500',
  },
  {
    id: 'B789-101X-ZY',
    client: 'Doe, Jane',
    date: '07-15-2024',
    details: 'Teeth Whitening',
    hmoVerification: 'Approved',
    total: '5000',
    request: 'Follow-up Session',
    amountPaid: '5000',
    balance: '0',
  },
];


// Pagination
const rowsPerPage = 5;
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
    row.addEventListener('click', () => displayDetails(start + index, filteredInvoices));
    tbody.appendChild(row);
  });

  renderPagination(filteredInvoices);
}

  // Function to display invoice details when clicked
  function displayDetails(index) {
    const detailsDiv = document.getElementById('invoice-details');
    const invoice = invoices[index]; // Retrieve the invoice based on the index
    detailsDiv.innerHTML = `
      <div class="invoice-slip-payment-slip">
        <div class="invoice-slip-header">IMEE TOGA DENTAL CLINIC</div>
        <div class="invoice-slip-clinic-info">
          General Dentistry and Orthodontics<br>
          #53 National Highway, Banlic, Cabuyao, Laguna<br>
          0917 587 4263 / (049) 254 4603
        </div>
        <div class="invoice-slip-header invoice-slip-section">PAYMENT SLIP</div>
  
        <div class="invoice-slip-section">
          <span class="invoice-slip-label">Date:</span> <span class="invoice-slip-field">${invoice.date}</span><br>
          <span class="invoice-slip-label">Name:</span> <span class="invoice-slip-field">${invoice.client}</span><br>
          <span class="invoice-slip-label">HMO verification:</span> <span class="invoice-slip-field">${invoice.hmoVerification}</span><br>
          <span class="invoice-slip-label">No.:</span> <span class="invoice-slip-field">${invoice.id}</span>
        </div>
  
        <div class="invoice-slip-section">
          <table class="invoice-slip-table">
            <tr>
              <th>Service</th>
              <th>PHP</th>
            </tr>
            <tr>
              <td>Oral Prophylaxis</td>
              <td></td>
            </tr>
            <tr>
              <td>Restoration LC/TF</td>
              <td></td>
            </tr>
            <tr>
              <td>Extraction</td>
              <td></td>
            </tr>
            <tr>
              <td>Prosthodontic</td>
              <td></td>
            </tr>
            <tr>
              <td>Surgery</td>
              <td></td>
            </tr>
            <tr>
              <td>Endodontic</td>
              <td></td>
            </tr>
            <tr>
              <td>Orthodontic</td>
              <td></td>
            </tr>
            <tr>
              <td>X-ray</td>
              <td></td>
            </tr>
            <tr>
              <td>Others</td>
              <td></td>
            </tr>
          </table>
        </div>
  
        <div class="invoice-slip-section">
          <span class="invoice-slip-label">TOTAL:</span> <span class="invoice-slip-field">Php ${invoice.total}</span><br>
          <span class="invoice-slip-label">REQUEST:</span> <span class="invoice-slip-field">${invoice.request}</span><br>
        </div>
  
        <div class="invoice-slip-section invoice-slip-footer">
          <span class="invoice-slip-label">AMOUNT PAID:</span> <span class="invoice-slip-field">Php ${invoice.amountPaid}</span><br>
          <span class="invoice-slip-label">BALANCE:</span> <span class="invoice-slip-field">Php ${invoice.balance}</span>
        </div>
  
        <div class="invoice-slip-section">
          <span class="invoice-slip-label">REMARKS:</span>
          <div class="invoice-slip-remarks"></div>
        </div>
      </div>
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

// Improved row selection handling
const table = document.querySelector('.invoice-table');

table.addEventListener('click', (event) => {
  const clickedRow = event.target.closest('tr');
  if (!clickedRow) return; // Ensure we clicked on a row

  // Remove 'selected' class from all rows
  table.querySelectorAll('tr').forEach(row => row.classList.remove('selected'));

  // Add 'selected' class to the clicked row
  clickedRow.classList.add('selected');
});
