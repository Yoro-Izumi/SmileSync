$(document).ready(function() {
  // Prevent the default form submission
  $('#multiStepForm').on('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Disable the submit button to prevent multiple clicks
      $('#submitButton').prop('disabled', true);

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the form data using AJAX
      $.ajax({
          url: 'register_code.php', // The URL to the PHP file that processes the form
          type: 'POST',
          data: formData,
          success: function(response) {
              // Handle the response from the server
              if (response == "Registration successful!") {
                  // Show success alert
                  modifyCreateAlert(response, "modify-alert-success", 5000);

                  // Redirect to another page after 5 seconds (5000 milliseconds)
                  setTimeout(function() {
                      window.location.href = '../Register'; 
                  }, 5000);
              } else {
                  // Show error alert
                  modifyCreateAlert(response, "modify-alert-error", 5000);

                  // Re-enable the submit button if there's an error
                  $('#submitButton').prop('disabled', false);
              }
          },
          error: function(xhr, status, error) {
              // Show error alert for AJAX errors
              modifyCreateAlert(error, "modify-alert-error", 5000);

              // Re-enable the submit button if there's an error
              $('#submitButton').prop('disabled', false);
          }
      });
  });
});