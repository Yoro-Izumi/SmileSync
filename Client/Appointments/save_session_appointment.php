<?php
// Start the session
session_start();

// Check if a value is sent via POST
if (isset($_POST['session_appointment_id'])) {
    // Save the value to a session variable
    $_SESSION['session_appointment_id'] = $_POST['session_appointment_id'];

    // Send a response back
    echo "Value saved to session: " . htmlspecialchars($_POST['session_appointment_id']);
} else {
    echo "No value provided.";
}
?>
