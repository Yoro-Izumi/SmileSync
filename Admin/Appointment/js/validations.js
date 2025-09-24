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
  

  // Birthday Input Validation

const validateBirthdatePicker = document.getElementById('birthdate-picker');

// Prevent manual input (optional, can be removed if manual input is allowed)
validateBirthdatePicker.addEventListener('keydown', (e) => {
  e.preventDefault(); // Prevent typing
});

// Prevent pasting
validateBirthdatePicker.addEventListener('paste', (e) => {
  e.preventDefault(); // Prevent pasting
});

// Set min and max dates dynamically
const validateCurrentDate = new Date();
const validateMinDate = new Date();
validateMinDate.setFullYear(validateCurrentDate.getFullYear() - 5); // 5 years ago
const validateMaxDate = new Date();
validateMaxDate.setFullYear(validateCurrentDate.getFullYear() - 110); // 110 years ago

// Format date as YYYY-MM-DD (local time, not UTC)
const validateFormatDate = (date) => {
  const validateYear = date.getFullYear();
  const validateMonth = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
  const validateDay = String(date.getDate()).padStart(2, '0');
  return `${validateYear}-${validateMonth}-${validateDay}`;
};

// Set min and max attributes correctly
validateBirthdatePicker.setAttribute('max', validateFormatDate(validateMinDate)); // 5 years ago
validateBirthdatePicker.setAttribute('min', validateFormatDate(validateMaxDate)); // 110 years ago


// Phone Number Input Validation
function validatePhoneNumberInput(inputId) {
  const inputField = document.getElementById(inputId);

  if (!inputField) {
    console.error(`Input field with ID "${inputId}" not found.`);
    return;
  }

  // Validate and sanitize input on the fly
  inputField.addEventListener('input', function (event) {
    const validateInputValue = event.target.value;
    const validateSanitizedValue = validateInputValue.replace(/[^0-9]/g, '');

    if (!validateSanitizedValue.startsWith('63')) {
      event.target.value = '63' + validateSanitizedValue;
    } else {
      event.target.value = validateSanitizedValue;
    }
  });

  // Prevent deleting or modifying the "63" prefix
  inputField.addEventListener('keydown', function (event) {
    const validateInputValue = event.target.value;

    // Allow deleting the entire input
    if (event.target.selectionStart === 0 && event.target.selectionEnd === validateInputValue.length && (event.key === 'Backspace' || event.key === 'Delete')) {
      return;
    }

    // Prevent deleting or modifying the "63" prefix
    if (event.target.selectionStart < 2 && (event.key === 'Backspace' || event.key === 'Delete')) {
      event.preventDefault();
    }
  });

  inputField.addEventListener('blur', function (event) {
    const validateInputValue = event.target.value;

    if (validateInputValue && !validateInputValue.startsWith('63')) {
      event.target.value = '63' + validateInputValue.replace(/[^0-9]/g, '');
    }
  });
}


