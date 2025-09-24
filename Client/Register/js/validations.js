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


