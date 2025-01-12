document.addEventListener('DOMContentLoaded', function () {

  // Function to handle form validation
  function validateForm(form) {
    let isValid = true;

(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()
  
  
  //   For trimming whitespaces
  function handleInput(event) {
    const inputValue = event.target.value;
    event.target.value = inputValue.trim(); // Remove leading and trailing whitespaces
  }
  
  
  // For first names that it wont accept any numeric and special characters
  function validateName(event) {
    const regex = /^[A-Za-z\s]*$/; // Allow only alphabetic characters and spaces
    if (!regex.test(event.target.value)) {
      event.target.value = event.target.value.replace(/[^A-Za-z\s]/g, '');
    }
  }
  
  // For username
  function validateUsername(event) {
    const regex = /^[a-zA-Z0-9._%+-]*$/; // Allow only alphabetic characters and spaces
    if (!regex.test(event.target.value)) {
      event.target.value = event.target.value.replace(/[^a-zA-Z0-9._%+-]/g, '');
    }
  }
  
  
  //For Contact Number
  function validateContactNumber(event) {
    const input = event.target;
    const value = input.value;
  
    // Allow only numeric characters
    input.value = value.replace(/[^0-9]/g, '');
  
    // Check if the length is exactly 11 and starts with '09'
    if (input.value.length === 11 && input.value.startsWith('09')) {
      input.setCustomValidity(''); // Valid input
    } else {
      input.setCustomValidity('Please provide a valid contact number (11 digits, starts with 09).');
    }
  }
  
  //For Email 
  function validateEmail(event) {
    var emailInput = event.target.value;
  
    event.target.value = emailInput.replace(/\s+/g, '');
  
    emailInput = event.target.value.trim();
  
    var isValid = /^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(emailInput);
  
    if (!isValid) {
      document.getElementById("emailError").style.display = "block";
      event.target.setCustomValidity("Please enter a valid email address.");
    } else {
      document.getElementById("emailError").style.display = "none";
      event.target.setCustomValidity("");
    }
  }
  
  
  document.getElementById("email").addEventListener("input", validateEmail);
  document.getElementById("emailRegister").addEventListener("input", validateEmail);
  
  
    //   Updated script for password toggle
    document.addEventListener("DOMContentLoaded", function() {
      const togglePassword1 = document.querySelector("#password-toggle-1");
      const passwordInput1 = document.querySelector("#password");
      const eyeIcon1 = togglePassword1.querySelector("i");
    
      togglePassword1.addEventListener("click", function() {
        const type =
          passwordInput1.getAttribute("type") === "password" ?
          "text" :
          "password";
        passwordInput1.setAttribute("type", type);
    
        // Toggle eye icon classes
        eyeIcon1.classList.toggle("fa-eye-slash");
        eyeIcon1.classList.toggle("fa-eye");
      });

    
    // Input fields and their validation rules
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

    // Clear previous error messages
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function (error) {
      error.textContent = '';
    });

    // Loop through each field and validate
    fields.forEach(function (field) {
      const input = form.querySelector(`[name=${field.name}]`);
      const error = document.getElementById(`${field.name}Error`);
      const value = input.value.trim();

      // Check if value is empty and required
      if (field.required && !value) {
        error.textContent = `${field.label} is required.`;
        isValid = false;
      }
      // Check input length limits if specified
      else if (field.min && value.length < field.min) {
        error.textContent = `${field.label} must be at least ${field.min} characters long.`;
        isValid = false;
      } 
      else if (field.max && value.length > field.max) {
        error.textContent = `${field.label} cannot exceed ${field.max} characters.`;
        isValid = false;
      }

      // Additional checks for email and password fields
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

  // Function to check if email is valid
  function isValidEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
  }

  // Handle form submission for registration
  const registerForm = document.getElementById('register_form');
  registerForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    if (validateForm(registerForm)) {
      // If the form is valid, submit it (you can use AJAX or simple form submit)
      registerForm.submit();
    }
  });

  // Handle the show/hide password functionality for login
  const showPasswordButton = document.getElementById('signup-show-password');
  const passwordField = document.getElementById('signup-password');
  
  if (showPasswordButton) {
    showPasswordButton.addEventListener('click', function () {
      // Toggle password visibility
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;
      showPasswordButton.classList.toggle('fa-eye-slash');
    });
  }

  // Handle the form switch between sign up and sign in
  const toggleLinks = document.querySelectorAll('.toggle');
  toggleLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      const signUpForm = document.querySelector('.sign-up-form');
      const signInForm = document.querySelector('.sign-in-form');
      signUpForm.classList.toggle('active');
      signInForm.classList.toggle('active');
    });
  });

});
