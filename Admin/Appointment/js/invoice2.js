// Sample invoices for pagination
const invoices = [
    { id: 'KDKT-83DJ-7F', client: 'Dimaculangan, Chorlyn L.', date: '08-10-2024' },
    { id: 'KDYT-834J-4G', client: 'Dimaculangan, Chorlyn L.', date: '08-05-2024' },
    { id: 'H45T-8HGJ-YT', client: 'Dimaculangan, Chorlyn L.', date: '08-01-2024' },
    { id: 'A123-456B-CD', client: 'Smith, John', date: '07-20-2024' },
    { id: 'B789-101X-ZY', client: 'Doe, Jane', date: '07-15-2024' },
  ];
  
  // Pagination setup
  const rowsPerPage = 2;
  let currentPage = 1;
  
  // Function to populate the table
  function populateTable(filteredInvoices, page = 1) {
    const tbody = document.getElementById('invoice-body');
    tbody.innerHTML = ''; // Clear existing rows
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
  
    filteredInvoices.slice(start, end).forEach((invoice) => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td><input type="checkbox" value="${invoice.id}"></td>
        <td>${invoice.id}</td>
        <td>${invoice.client}</td>
        <td>${invoice.date}</td>
      `;
      row.addEventListener('click', () => fetchInvoiceDetails(invoice.id)); // Fetch details when a row is clicked
      tbody.appendChild(row);
    });
  
    renderPagination(filteredInvoices);
  }
  
  // Fetch invoice details from PHP backend
  async function fetchInvoiceDetails(entryId) {
    try {
      const response = await fetch(`tr-get-invoice-details.php?entry_id=${entryId}`);
      if (!response.ok) throw new Error('Failed to fetch details');
  
      const invoice = await response.json();
      displayDetails(invoice);
    } catch (error) {
      console.error('Error fetching details:', error);
      displayDetails({ error: 'Failed to fetch details from the database.' });
    }
  }
  
  // Display invoice details
  function displayDetails(invoice) {
    const detailsDiv = document.getElementById('invoice-details');
    if (invoice.error) {
      detailsDiv.innerHTML = `<p>${invoice.error}</p>`;
      return;
    }
  
    detailsDiv.innerHTML = `
      <h3>Invoice Details</h3>
      <p><strong>Invoice ID:</strong> ${invoice.id}</p>
      <p><strong>Client Name:</strong> ${invoice.client}</p>
      <p><strong>Date:</strong> ${invoice.date}</p>
      <p><strong>Details:</strong> ${invoice.details}</p>
    `;
  }
  
  // Render pagination
  function renderPagination(filteredInvoices) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Clear existing buttons
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
  
  // Initial population of table
  populateTable(invoices);
  