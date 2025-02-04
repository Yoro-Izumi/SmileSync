<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Payment Slip</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    .invoice-slip-payment-slip {
      width: 400px;
      border: 2px solid black;
      padding: 20px;
      box-sizing: border-box;
    }

    .invoice-slip-header {
      text-align: center;
      font-weight: bold;
    }

    .invoice-slip-clinic-info {
      text-align: center;
      font-size: 14px;
    }

    .invoice-slip-section {
      margin-top: 15px;
    }

    .invoice-slip-label {
      display: inline-block;
      width: 100px;
    }

    .invoice-slip-field {
      border: 1px solid black;
      padding: 5px;
      display: inline-block;
      width: calc(100% - 110px);
      box-sizing: border-box;
    }

    .invoice-slip-table {
      margin-top: 10px;
      width: 100%;
      border-collapse: collapse;
    }

    .invoice-slip-table th,
    .invoice-slip-table td {
      border: 1px solid black;
      padding: 5px;
      text-align: left;
    }

    .invoice-slip-remarks {
      border: 1px solid black;
      min-height: 60px;
      padding: 5px;
    }

    .invoice-slip-footer {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="invoice-slip-payment-slip">
    <div class="invoice-slip-header">IMEE TOGA DENTAL CLINIC</div>
    <div class="invoice-slip-clinic-info">General Dentistry and Orthodontics<br>#53 National Highway, Banlic, Cabuyao, Laguna<br>0917 587 4263 / (049) 254 4603</div>
    <div class="invoice-slip-header invoice-slip-section">PAYMENT SLIP</div>

    <div class="invoice-slip-section">
      <span class="invoice-slip-label">Date:</span> <span class="invoice-slip-field"></span><br>
      <span class="invoice-slip-label">Name:</span> <span class="invoice-slip-field"></span><br>
      <span class="invoice-slip-label">HMO verification:</span> <span class="invoice-slip-field"></span><br>
      <span class="invoice-slip-label">No.:</span> <span class="invoice-slip-field"></span>
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
      <span class="invoice-slip-label">TOTAL:</span> <span class="invoice-slip-field"></span><br>
      <span class="invoice-slip-label">REQUEST:</span> <span class="invoice-slip-field"></span><br>
    </div>

    <div class="invoice-slip-section invoice-slip-footer">
      <span class="invoice-slip-label">AMOUNT PAID:</span> <span class="invoice-slip-field"></span><br>
      <span class="invoice-slip-label">BALANCE:</span> <span class="invoice-slip-field"></span>
    </div>

    <div class="invoice-slip-section">
      <span class="invoice-slip-label">REMARKS:</span>
      <div class="invoice-slip-remarks"></div>
    </div>
  </div>
</body>
</html>
