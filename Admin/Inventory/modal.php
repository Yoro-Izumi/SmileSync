<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>

<!-- View Items Modal -->
<div class="modal" id="viewItemModal">
    <div class="modal-content medium">
     <div class="modal-header">
       <h3>Product Overview</h3>
      <div class="modal-actions">
        <div class="dropdown">
          <button class="table-btn"><i class="fas fa-download"></i> Download</button>
          <div class="dropdown-content">
            <a href="#" class="dropdown-option" id="exportExcel"><i class="fas fa-file-excel"></i>Excel</a>
            <a href="#" class="dropdown-option" id="exportPDF"><i class="fas fa-file-pdf"></i>PDF</a>
            <a href="#" class="dropdown-option" id="exportWord"><i class="fas fa-file-word"></i>Word</a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-body">
      <h3>Primary Details</h3>
      <table class="modal-table">
        <tr>
          <td><strong>Product Name</strong></td>
          <td>Maggi</td>
        </tr>
        <tr>
          <td><strong>Product ID</strong></td>
          <td>456567</td>
        </tr>
        <tr>
          <td><strong>Product Category</strong></td>
          <td>Instant food</td>
        </tr>
        <tr>
          <td><strong>Expiry Date</strong></td>
          <td>13/4/23</td>
        </tr>
        <tr>
          <td><strong>Threshold Value</strong></td>
          <td>12</td>
        </tr>
        <tr>
          <td><strong>Opening Stock</strong></td>
          <td>40</td>
        </tr>
        <tr>
          <td><strong>Remaining Stock</strong></td>
          <td>34</td>
        </tr>
      </table>
      <h3>Stock Locations</h3>
      <table>
        <tr>
          <td><strong>Store Name</strong></td>
          <td>Cabuyao Branch</td>
        </tr>
      </table>
    </div>

        <button id="okView" class="modal-button normal">OK</button>
    </div>
</div>


<!-- Remove Account Warning Modal -->
<div class="modal" id="removeItemModal">
    <div class="modal-content">
        <div class="image-container">
            <img class="image" src="img/archive.png" alt="security">
        </div>
        <div class="modal-title warning-title">Inventory Removal</div>
        <div class="message-container">
            <div class="modal-description">
                You are trying to remove (1) item. The item will no longer be accessed by the admin. 
            </div>
        </div>
        <button class="modal-button normal" id="removeItemBtn">Remove</button>
        <button class="modal-button secondary-button warning" id="cancelRemoveItemBtn">Cancel</button>
    </div>
</div>

<!-- Remove Account Success Modal
<div class="modal" id="removeItemSuccessModal">
    <div class="modal-content">
        <div class="modal-title warning-title">Item Removed</div>
        <div class="message-container">
            <div class="modal-description">
                Item/s has been successfully removed. You may view the removed account in Trash.
            </div>
        </div>
        <button id="okRemoveItem" class="modal-button success">OK</button>
    </div>
</div> -->

<div id="alertContainer"></div>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const productTable = document.querySelector('table');
    const bubbleDesignStyles = `
        .bubble {
            border-radius: 12px;
            background: #f2f2f2;
            padding: 8px 16px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
    `;

    // Function to create the bubble design for each cell
    const applyBubbleDesign = (data) => {
        return `<span class="bubble">${data}</span>`;
    };

    // Export to Excel (XLSX)
    document.getElementById('exportExcel').addEventListener('click', function () {
        const wb = XLSX.utils.table_to_book(productTable, {sheet: "Product Overview"});
        const wbout = XLSX.write(wb, {bookType: "xlsx", type: "array"});

        // Create a Blob and trigger a download
        const blob = new Blob([wbout], {type: "application/octet-stream"});
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = "product_overview.xlsx";
        link.click();
    });

    // Export to PDF
    document.getElementById('exportPDF').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Add table to PDF
        doc.autoTable({ html: productTable });

        // Download PDF
        doc.save('product_overview.pdf');
    });

    // Export to Word (DOCX)
    document.getElementById('exportWord').addEventListener('click', function () {
        const pptx = new PptxGenJS();
        const slide = pptx.addSlide();

        // Set bubble design for text and add table to the slide
        const rows = Array.from(productTable.rows);
        const tableData = rows.map(row => {
            const cells = Array.from(row.cells).map(cell => applyBubbleDesign(cell.innerText));
            return cells;
        });

        slide.addTable(tableData, {x: 1, y: 1, w: '90%', h: '80%'});

        // Save the presentation as a Word doc
        pptx.save("product_overview");
    });

    // Optional: Add the bubble design styles to the page
    const style = document.createElement('style');
    style.innerHTML = bubbleDesignStyles;
    document.head.appendChild(style);
});


</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/modal.js"></script>
<script src="js/alert.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pptxgenjs/3.12.0/pptxgen.bundle.js"></script>

</body>
</html>