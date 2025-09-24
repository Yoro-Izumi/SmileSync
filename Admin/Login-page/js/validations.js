document.addEventListener('DOMContentLoaded', function () {

  // ---------------- Bootstrap validation ----------------
  (() => {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();


  // ---------------- Helper Functions ----------------

  // Trim whitespace on input
  function handleInput(event) {
    event.target.value = event.target.value.trim();
  }

  // Allow only letters and spaces
  function validateName(event) {
    event.target.value = event.target.value.replace(/[^A-Za-z\s]/g, '');
  }

  // Allow letters, numbers, and ._%+-
  function validateUsername(event) {
    event.target.value = event.target.value.replace(/[^a-zA-Z0-9._%+-]/g, '');
  }

  // Contact number (must be 11 digits and start with 09)
  function validateContactNumber(event) {
    const input = event.target;
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length === 11 && input.value.startsWith('09')) {
      input.setCustomValidity('');
    } else {
      input.setCustomValidity('Please provide a valid contact number (11 digits, starts with 09).');
    }
  }

  // Email validation
  function validateEmail(event) {
    let emailInput = event.target.value.replace(/\s+/g, '').trim();
    event.target.value = emailInput;

    const isValid = /^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(emailInput);

    if (!isValid) {
      document.getElementById("emailError").style.display = "block";
      event.target.setCustomValidity("Please enter a valid email address.");
    } else {
      document.getElementById("emailError").style.display = "none";
      event.target.setCustomValidity("");
    }
  }

  function isValidEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
  }

  // ---------------- Form Validation ----------------
  function validateForm(form) {
    let isValid = true;

    const fields = [
      { name: "firstName", label: "First Name", min: 1, max: 24, required: true },
      { name: "lastName", label: "Last Name", min: 1, max: 24, required: true },
      { name: "middleName", label: "Middle Name", min: 1, max: 24, required: false },
      { name: "suffix", label: "Suffix", min: 1, max: 5, required: false },
      { name: "birthday", label: "Birthdate", required: true },
      { name: "phoneNumber", label: "Phone Number", min: 11, max: 13, required: true },
      { name: "emailRegister", label: "Email Address", required: true },
      { name: "passwordRegister", label: "Password", min: 8, max: 24, required: true },
      { name: "confirmPasswordRegister", label: "Confirm Password", required: true }
    ];

    // Clear old errors
    document.querySelectorAll('.error-message').forEach(error => {
      error.textContent = '';
    });

    fields.forEach(field => {
      const input = form.querySelector(`[name=${field.name}]`);
      const error = document.getElementById(`${field.name}Error`);
      const value = input.value.trim();

      if (field.required && !value) {
        error.textContent = `${field.label} is required.`;
        isValid = false;
      } else if (field.min && value.length < field.min) {
        error.textContent = `${field.label} must be at least ${field.min} characters long.`;
        isValid = false;
      } else if (field.max && value.length > field.max) {
        error.textContent = `${field.label} cannot exceed ${field.max} characters.`;
        isValid = false;
      }

      if (field.name === "emailRegister" && value && !isValidEmail(value)) {
        error.textContent = "Please enter a valid email address.";
        isValid = false;
      }

      if (field.name === "passwordRegister" && value && form.passwordRegister.value !== form.confirmPasswordRegister.value) {
        document.getElementById("confirmPasswordRegisterError").textContent = "Passwords do not match.";
        isValid = false;
      }
    });

    return isValid;
  }

  // ---------------- Password Toggle ----------------
  const togglePassword1 = document.querySelector("#password-toggle-1");
  const passwordInput1 = document.querySelector("#password");
  if (togglePassword1 && passwordInput1) {
    const eyeIcon1 = togglePassword1.querySelector("i");
    togglePassword1.addEventListener("click", function () {
      const type = passwordInput1.type === "password" ? "text" : "password";
      passwordInput1.type = type;
      eyeIcon1.classList.toggle("fa-eye-slash");
      eyeIcon1.classList.toggle("fa-eye");
    });
  }

  // ---------------- Registration Form ----------------
  const registerForm = document.getElementById('register_form');
  if (registerForm) {
    registerForm.addEventListener('submit', function (event) {
      event.preventDefault();
      if (validateForm(registerForm)) {
        registerForm.submit();
      }
    });
  }

  // ---------------- Show/Hide Password for Signup ----------------
  const showPasswordButton = document.getElementById('signup-show-password');
  const passwordField = document.getElementById('signup-password');
  if (showPasswordButton && passwordField) {
    showPasswordButton.addEventListener('click', function () {
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;
      showPasswordButton.classList.toggle('fa-eye-slash');
    });
  }

  // ---------------- Toggle Forms ----------------
  const toggleLinks = document.querySelectorAll('.toggle');
  toggleLinks.forEach(link => {
    link.addEventListener('click', function () {
      document.querySelector('.sign-up-form').classList.toggle('active');
      document.querySelector('.sign-in-form').classList.toggle('active');
    });
  });

  // ---------------- Attach input listeners ----------------
  document.getElementById("email")?.addEventListener("input", validateEmail);
  document.getElementById("emailRegister")?.addEventListener("input", validateEmail);

});
