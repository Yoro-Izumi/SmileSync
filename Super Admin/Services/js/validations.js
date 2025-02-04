// Event listeners for validating number inputs
document.getElementById('servicePrice').addEventListener('input', function () {
  validateNumberInput(this);
});

document.getElementById('serviceTime').addEventListener('input', function () {
  validateNumberInput(this);
});

/**
* Validates a number input field, ensuring only non-negative numbers are allowed.
* @param {HTMLInputElement} inputElement - The input field to validate.
*/
function validateNumberInput(inputElement) {
  const value = inputElement.value;

  // Allow only digits and optional decimal point, but remove invalid characters
  const sanitizedValue = value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters

  // Prevent multiple decimal points
  const parts = sanitizedValue.split('.');
  if (parts.length > 2) {
      inputElement.value = parts[0] + '.' + parts[1]; // Keep only the first two parts
  } else {
      inputElement.value = sanitizedValue;
  }

  // Prevent negative numbers (clear input if negative)
  if (Number(inputElement.value) < 0) {
      inputElement.value = '';
  }
}
