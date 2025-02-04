<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Screen</title>
    <link rel="stylesheet" href="css/invoice.css">
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
<script src="js/invoice.js"></script>
</body>
</html>