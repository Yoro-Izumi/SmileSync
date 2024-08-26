<?php
//function that sanitizes any string or input data
function sanitize_input($data,$connect_db){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connect_db, $data);
    return $data;
}