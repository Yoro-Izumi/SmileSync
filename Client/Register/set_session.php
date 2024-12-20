<?php
// Start the session
session_start();

// Check if a value was sent via POST
if (isset($_POST['service_id'])) {
    // Store the selected value in the session
    $_SESSION['service_id'] = $_POST['service_id'];

} else {
    // Set value as 0 or 1 as default
    $_SESSION['service_id'] = 0;
}
?>
