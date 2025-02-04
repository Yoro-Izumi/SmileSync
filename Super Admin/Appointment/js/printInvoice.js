document.getElementById("downloadPaymentSlip").addEventListener("click", function () { //add id for button id="downloadPaymentSlip"
    const content = `
      <html>
        <head>
          <style>
            body {
              font-family: Arial, sans-serif;
              padding: 10px;
              margin: 0;
              width: 4cm; /* Receipt width */
              background-color: white;
              font-size: 8px;
            }
            .header {
              text-align: center;
              margin-bottom: 10px;
            }
            .header h2 {
              font-size: 12px;
              margin: 0;
            }
            .header p {
              font-size: 8px;
              margin: 2px 0;
            }
            table {
              width: 100%;
              border-collapse: collapse;
              margin-top: 10px;
            }
            table td {
              font-size: 8px;
              padding: 2px;
              border: 1px solid #ddd;
              text-align: left;
            }
            .remarks {
              margin-top: 10px;
              font-size: 8px;
            }
            .remarks h6 {
              margin: 0 0 5px;
            }
          </style>
        </head>
        <body>
          <div class="header">
            <h2>IMEE TOGA DENTAL CLINIC</h2>
            <p>General Dentistry and Orthodontics</p>
            <p>#53 National Highway, Banlic, Cabuyao, Laguna</p>
            <p>0917 587 4263 / (049) 254 4603</p>
          </div>
          <h6>Payment Slip</h6>
          <p><strong>Date:</strong> 08-10-2024</p>
          <p><strong>Invoice ID:</strong> KDKT-83DJDJ-7F</p>
          <p><strong>Name:</strong> Chorlyn L. Dimaculangan</p>
          <p><strong>HMO Verification:</strong> __________________</p>
          <table>
            <tr>
              <td>Oral Prophylaxis</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Restoration LC/TF</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Extraction</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Prosthodontic</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Surgery</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Endodontic</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Orthodontic</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>X-ray</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
            <tr>
              <td>Others</td>
              <td>________ Php.</td>
              <td>________ Php.</td>
            </tr>
          </table>
          <p><strong>Total:</strong> __________</p>
          <p><strong>Amount Paid:</strong> __________</p>
          <p><strong>Balance:</strong> __________</p>
          <div class="remarks">
            <h6>Remarks</h6>
            <p>___________________________</p>
          </div>
        </body>
      </html>
    `;

    const blob = htmlDocx.asBlob(content);
    saveAs(blob, "Payment_Slipaasddzies.docx");
  });