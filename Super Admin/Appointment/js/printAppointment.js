document.getElementById('downloadWord').addEventListener('click', function () {   //get the the id= "downloadWord"
    // Dynamic content and styles for the form
    const content = `
      <html>
        <head>
          <meta charset="UTF-8">
          <title>Dental Record</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              padding: 20px;
            }
            .container {
              background: white;
              padding: 20px;
              border-radius: 8px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .header {
              text-align: center;
              margin-bottom: 20px;
            }
            .header img {
              width: 60px;
              height: 60px;
            }
            .header h1 {
              font-size: 24px;
              color: #e63946;
              margin: 10px 0 5px;
            }
            .header p {
              font-size: 14px;
              color: #555;
            }
            .section h2 {
              font-size: 18px;
              color: #007bff;
              border-bottom: 2px solid #ddd;
              padding-bottom: 5px;
              margin-bottom: 15px;
            }
            .details div {
              font-size: 14px;
              margin-bottom: 10px;
            }
            .details label {
              font-weight: bold;
            }
            .remarks textarea {
              width: 100%;
              padding: 10px;
              border: 1px solid #ddd;
              border-radius: 8px;
              font-size: 14px;
              background: #f9f9f9;
              height: 100px;
              resize: none;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="header">
              <img src="../img/logo.png" alt="Clinic Logo">
              <h1>iMee-Toga Oli Dental Clinic</h1>
              <p>788 Rizal Blvd. Poblacion Brgy. Market Area, City of Santa Rosa Laguna</p>
            </div>

            <div class="section">
              <h2>Personal Information</h2>
              <div class="details">
                <div><label>Patient Name:</label> Dimaculangan, Chorlyn L.</div>
                <div><label>Phone Number:</label> 09123456789</div>
                <div><label>Age:</label> 22</div>
                <div><label>Birth Date:</label> 01/03/2024</div>
                <div><label>Sex:</label> Female</div>
                <div><label>Weight:</label> 1kg</div>
                <div><label>Address:</label> Brgy. Sinalhan, Purok 7</div>
                <div><label>City:</label> Santa Rosa</div>
                <div><label>Province:</label> Laguna</div>
                <div><label>In case of emergency, notify:</label> Valera, Arwen Grace C.</div>
                <div><label>Relationship:</label> Grandmother</div>
                <div><label>Phone Number:</label> 09123456789</div>
              </div>
            </div>

            <div class="section">
              <h2>Treatment Record</h2>
              <div class="details">
                <div><label>Date of Appointment:</label> 29/03/2024</div>
                <div><label>Procedure/s:</label> Prothodontics</div>
                <div><label>Dentist/s:</label> Dr. Oli, Jonas</div>
                <div><label>No. of Tooth:</label> 4</div>
                <div><label>Amount Charge:</label> 17,000.00</div>
                <div><label>Amount Paid:</label> 17,000.00</div>
                <div><label>Balance:</label> 0</div>
              </div>
              <div class="remarks">
                <h3>Doctor Remarks</h3>
                <textarea readonly>Patient has a pretty smile.</textarea>
              </div>
            </div>
          </div>
        </body>
      </html>
    `;
    // Convert to Word document
    const converted = htmlDocx.asBlob(content);
    saveAs(converted, 'Dental_Record.docx');
  });