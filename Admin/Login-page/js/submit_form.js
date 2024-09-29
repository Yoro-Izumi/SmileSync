
 //ajax code for form submission
$(document).ready(function () {
  $("#register_form").on("submit", function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    // Disable the button to prevent multiple clicks
    $("#registerBtn").prop("disabled", true);
    
    $.ajax({
      type: "POST",
      url: "register_code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response); // Handle success response
        // Redirect or show success message
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
      complete: function() {
        // Enable the button after request completes
        $("#registerBtn").prop("disabled", false);
      }
    });
  });

  $("#login_form").on("submit", function (e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    // Disable the button to prevent multiple clicks
    $("#loginBtn").prop("disabled", true);
    
    $.ajax({
      type: "POST",
      url: "login_code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        //console.log(response); // Handle success response
        // Redirect or show success message
        window.location.href = "../Dashboard/Dashboard.php";
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
      complete: function() {
        // Enable the button after request completes
        $("#loginBtn").prop("disabled", false);
      }
    });
  });
}); 

    
/*
$(document).ready(function() {
    $('#myForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: formData,
            success: function(response) {
                if (response === "Form submitted successfully!") {
                    $('#modalMessage').text(response);
                } else if (response === "Failed to submit the form. Please try again.") {
                    $('#modalMessage').text(response);
                } else {
                    $('#modalMessage').text("Unexpected response: " + response);
                }
                $('#responseModal').modal('show');
            },
            error: function(xhr, status, error) {
                $('#modalMessage').text('An error occurred: ' + xhr.responseText);
                $('#responseModal').modal('show');
            }
        });
    });
});

*/