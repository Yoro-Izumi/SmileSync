<?php
//initialize servername username and password first for database connection
$servername = "localhost";
$username = "root";
$password = "";


// Functions to connect to specific databases

function connect_inventory($servername, $username, $password) {
    $dbname = "smilesync_inventory";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}

function connect_patient($servername, $username, $password) {
    $dbname = "smilesync_patient_management";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}

function connect_accounts($servername, $username, $password) {
    $dbname = "smilesync_accounts";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}
?>
