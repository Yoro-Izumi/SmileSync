<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi-Form with Page Indicator</title>
  <link rel="stylesheet" href="styles.css">
</head>
    <style>
        * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }

        body {
          font-family: Arial, sans-serif;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: #f4f4f4;
        }

        .form-container {
          background-color: white;
          border-radius: 8px;
          padding: 20px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
          width: 400px;
          text-align: center;
        }

        .page-indicator {
          display: flex;
          justify-content: center;
          margin-bottom: 20px;
        }

        .toggle {
          width: 15px;
          height: 15px;
          margin: 0 5px;
          border-radius: 50%;
          background-color: #ddd;
          transition: background-color 0.3s ease;
        }

        .toggle.active {
          background-color: #007bff;
        }

        .form-step {
          display: none;
        }

        .form-step.active {
          display: block;
        }

        input {
          display: block;
          width: 100%;
          padding: 10px;
          margin: 10px 0;
          border: 1px solid #ddd;
          border-radius: 5px;
        }

        button {
          padding: 10px 20px;
          background-color: #007bff;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }

        button:disabled {
          background-color: #ccc;
        }

        button.next-btn {
          margin-top: 20px;
        }

        button.prev-btn {
          margin-right: 10px;
        }

        </style>
<body>
  <div class="form-container">
    <div class="page-indicator">
      <div class="toggle" id="toggle1"></div>
      <div class="toggle" id="toggle2"></div>
      <div class="toggle" id="toggle3"></div>
    </div>
    
    <form id="multiForm">
      <div class="form-step active" id="step1">
        <h2>Step 1</h2>
        <input type="text" placeholder="First Name" />
        <input type="text" placeholder="Last Name" />
        <button type="button" class="next-btn" onclick="nextStep()">Next</button>
      </div>
      <div class="form-step" id="step2">
        <h2>Step 2</h2>
        <input type="email" placeholder="Email" />
        <input type="tel" placeholder="Phone" />
        <button type="button" class="prev-btn" onclick="prevStep()">Previous</button>
        <button type="button" class="next-btn" onclick="nextStep()">Next</button>
      </div>
      <div class="form-step" id="step3">
        <h2>Step 3</h2>
        <input type="password" placeholder="Password" />
        <input type="password" placeholder="Confirm Password" />
        <button type="button" class="prev-btn" onclick="prevStep()">Previous</button>
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
  
  <script>
        let currentStep = 1;
        const totalSteps = 3;

        function updateFormStep() {
          document.querySelectorAll(".form-step").forEach((step, index) => {
            step.classList.remove("active");
            if (index === currentStep - 1) {
              step.classList.add("active");
            }
          });

          document.querySelectorAll(".toggle").forEach((toggle, index) => {
            toggle.classList.remove("active");
            if (index === currentStep - 1) {
              toggle.classList.add("active");
            }
          });
        }

        function nextStep() {
          if (currentStep < totalSteps) {
            currentStep++;
            updateFormStep();
          }
        }

        function prevStep() {
          if (currentStep > 1) {
            currentStep--;
            updateFormStep();
          }
        }

        updateFormStep(); // Initialize

  </script>
</body>
</html>
