// Event listeners go here
document.querySelectorAll(".number-input").forEach((input) => {
    input.addEventListener("blur", function () {
      validateNumberInput(this);
    });
  });
document.getElementById('emailNewAppointment').addEventListener('blur', function () {
    validateGmailInput(this);
});



// Functions go here
function validateGmailInput(inputElement) {
    const email = inputElement.value.trim();
  
    // Define a regex for strict Gmail validation
    const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
  
    if (!gmailRegex.test(email)) {
      alert("Please enter a valid Gmail address.");
      inputElement.value = ""; // Clear invalid input
      return false;
    }
  
    return true;
  }
  

function validateNumberInput(inputElement) { //function for validation of number inputs (does not allow negative numbers or non-numeric characters)
    const value = inputElement.value.trim();
  
    // Check if the value is a valid number
    if (isNaN(value) || value === "") {
      alert("Please enter a valid number.");
      inputElement.value = ""; // Clear invalid input
      return false;
    }
  
    // Check if the value is below 0
    if (Number(value) < 0) {
      alert("Number cannot be below 0.");
      inputElement.value = ""; // Clear invalid input
      return false;
    }
  
    return true;
  }
  