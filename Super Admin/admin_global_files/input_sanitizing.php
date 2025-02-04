<?php
//function that sanitizes any string or input data
function sanitize_input($data,$connect_db){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connect_db, $data);
    return $data;
}

//function to format dateTime format
function formatDateTime($datetime, $format = 'l, F j, Y g:i A') {
    try {
        // Create a DateTime object
        $date = new DateTime($datetime);
        // Format the DateTime object and return the result
        return $date->format($format);
    } catch (Exception $e) {
        // Handle invalid datetime input
        return "Invalid datetime format";
    }
}

// Function to format the date
function formatDate($datetime, $dateFormat = 'l, F j, Y') {
    try {
        $date = new DateTime($datetime);
        return $date->format($dateFormat);
    } catch (Exception $e) {
        return "Invalid datetime format";
    }
}

// Function to format the time
function formatTime($datetime, $timeFormat = 'g:i A') {
    try {
        $date = new DateTime($datetime);
        return $date->format($timeFormat);
    } catch (Exception $e) {
        return "Invalid datetime format";
    }
}