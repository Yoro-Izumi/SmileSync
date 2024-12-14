<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_date'])) {
    $selected_date = $_POST['selected_date'];
    // Store the date in the session
    $_SESSION['selected_date'] = $selected_date;

} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
