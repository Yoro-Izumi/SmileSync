$(document).ready(function () {
  // Handle registration form
  $("#registerBtn").on("click", function (e) {
    e.preventDefault();

    // Check if form has been submitted before (in the same session)
    if (sessionStorage.getItem("registerFormSubmitted") === "true") {
      return; // Prevent form from being submitted again
    }

    // Get the form
    var form = $("#register_form")[0];
    var formData = new FormData(form);

    // Check if form is valid before proceeding
    if (form.checkValidity()) {
      // Disable the button to prevent multiple clicks
      $(this).prop("disabled", true);

      $.ajax({
        type: "POST",
        url: "register_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          document.getElementById('register_form').reset();
          if (response.trim() === "error") {
            // Show error modal
            //$("#errorModal").modal("show");
            console.log("error");
          } else {
            // Show success modal
            $("#successRegisterModal").modal("show");
            // Set session storage to prevent re-submission
            sessionStorage.setItem("registerFormSubmitted", "true");
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        },
        complete: function () {
          // Enable the button after the request completes
          $("#registerBtn").prop("disabled", false);
        }
      });
    } else {
      form.reportValidity(); // Show validation messages
    }
  });

// Handle login form
$("#loginBtn").on("click", function (e) {
  e.preventDefault();

  // Get the form
  var form = $("#login_form")[0];
  var formData = new FormData(form);

  // Check if form is valid before proceeding
  if (form.checkValidity()) {
    // Disable the button to prevent multiple clicks during the request
    $(this).prop("disabled", true);

    $.ajax({
      type: "POST",
      url: "login_code.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        location.reload();
        if (response.trim() === "error") {
          // Show error modal
          $("#loginFailedModal").modal("show");
        } else {
          // Show success modal or redirect
          $("#successModal").modal("show");
          // You can redirect to the dashboard on success if desired
          // window.location.href = "../Dashboard/Dashboard.php";
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
      complete: function () {
        // Enable the button after the request completes
        $("#loginBtn").prop("disabled", false);
      }
    });
  } else {
    form.reportValidity(); // Show validation messages
  }
});

});
