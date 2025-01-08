<?php
include "../admin_global_files/set_sesssion_dir.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_service_edit'])) {
    $selected_service = $_POST['selected_service_edit'];
    // Store the date in the session
    $_SESSION['selected_service_edit'] = $selected_service;

} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
