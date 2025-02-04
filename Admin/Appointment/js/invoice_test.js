$(document).ready(function () {
    const rowsPerPage = 5;
    let currentPage = 1;
    let invoices = [];
  
    // Fetch data from the server
    function fetchInvoices() {
      $.ajax({
        url: 'appointment_crud/invoice_details.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          invoices = data;
          populateTable(invoices);
        },
        error: function (error) {
          console.error('Error fetching invoices:', error);
        }
      });
    }
  
    // Populate table
    function populateTable(filteredInvoices, page = 1) {
      const tbody = $('#invoice-body');
      tbody.empty(); // Clear existing rows
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;
  
      filteredInvoices.slice(start, end).forEach((invoice, index) => {
        const row = $(`
          <tr>
            <td><input type="checkbox"></td>
            <td>${invoice.id}</td>
            <td>${invoice.client}</td>
            <td>${invoice.date}</td>
          </tr>
        `);
        row.on('click', () => displayDetails(start + index, filteredInvoices));
        tbody.append(row);
      });
  
      renderPagination(filteredInvoices);
    }
  
    // Display invoice details
    function displayDetails(index, filteredInvoices) {
      const invoice = filteredInvoices[index];
      const detailsDiv = $('#invoice-details');
      detailsDiv.html(`
   <div class="invoice-container">
        <div class="dropdown">
          <button class="btn" style="align-items: right;"><i class="fas fa-download"></i> Download</button>
          <div class="dropdown-content">
            <a href="#" class="dropdown-option" id="exportExcel"><i class="fas fa-file-excel"></i>Excel</a>
            <a href="#" class="dropdown-option" id="exportPDF"><i class="fas fa-file-pdf"></i>PDF</a>
            <a href="#" class="dropdown-option" id="exportWord"><i class="fas fa-file-word"></i>Word</a>
          </div>
        </div>
    
    <div class="header">
      <h1>IMEE TOGA DENTAL CLINIC</h1>
      <p>General Dentistry an Orthodontics</p>
      <p>#53 National Highway, Banlic, Cabuyao, Laguna</p>
      <p>0917 587 4263 / (049) 254 4603</p>
      <h2>Payment Slip</h2>
    </div>

    <div class="info">
      <div class="row">
        <span>Date:</span> ${invoice.date}
      </div>
      <div class="row">
        <span>Invoice ID:</span> ${invoice.id}
      </div>
      <div class="row">
        <span>Name:</span> ${invoice.client}
      </div>
      <div class="row">
        <span>HMO verification:</span> ____________________
      </div>
    </div>

    <form>
      <div class="form-group">
        <label>
          <input type="checkbox" onchange="toggleInputs(this)"> ${invoice.details}:
        </label>
        <input type="text" placeholder="Php" disabled>
      </div>

      <div class="footer">
        <div class="row">
          <span>Total:</span>
          <input type="text" placeholder="Php" disabled>
        </div>
        <div class="row">
          <span>Request:</span>
          <input type="text" disabled>
        </div>
        <div class="row">
          <span>Amount Paid:</span>
          <input type="text" placeholder="Php" disabled>
        </div>
        <div class="row">
          <span>Balance:</span>
          <input type="text" placeholder="Php" disabled>
        </div>
      </div>

      <div class="actions">
        <button type="button" class="update">Update</button>
        <button type="button" class="delete">Delete</button>
      </div>
    </form>
</div>


    `);
    }
  
    // Render pagination
    function renderPagination(filteredInvoices) {
      const pagination = $('#pagination');
      pagination.empty(); // Clear existing buttons
      const totalPages = Math.ceil(filteredInvoices.length / rowsPerPage);
  
      for (let i = 1; i <= totalPages; i++) {
        const button = $(`<button>${i}</button>`);
        button.toggleClass('active', i === currentPage);
        button.on('click', () => {
          currentPage = i;
          populateTable(filteredInvoices, i);
        });
        pagination.append(button);
      }
    }
  
    // Filter function
    function filterInvoices() {
      const searchTerm = $('#search').val().toLowerCase();
      const filteredInvoices = invoices.filter(invoice =>
        invoice.id.toLowerCase().includes(searchTerm) ||
        invoice.client.toLowerCase().includes(searchTerm)
      );
      populateTable(filteredInvoices, 1); // Reset to page 1
    }
  
    // Event listeners
    $('#search').on('input', filterInvoices);
  
    // Fetch initial data
    fetchInvoices();
  });
  