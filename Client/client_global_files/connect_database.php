<?php
//initialize servername username and password first for database connection
$servername = "localhost";
$username = "root";
$password = "";

// Secure connection using PDO
function connectToDatabase($servername, $username, $password, $dbname) {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}


// Functions to connect to specific databases
function connect_appointment($servername, $username, $password) {
    $dbname = "smilesync_appointments";
    return connectToDatabase($servername, $username, $password, $dbname);
}

function connect_inventory($servername, $username, $password) {
    $dbname = "smilesync_inventory";
    return connectToDatabase($servername, $username, $password, $dbname);
}

function connect_patient($servername, $username, $password) {
    $dbname = "smilesync_patient_management";
    return connectToDatabase($servername, $username, $password, $dbname);
}

function connect_accounts($servername, $username, $password) {
    $dbname = "smilesync_accounts";
    return connectToDatabase($servername, $username, $password, $dbname);
}

function connect_chatbot($servername, $username, $password) {
    $dbname = "smilesync_chatbot";
    return connectToDatabase($servername, $username, $password, $dbname);
}
?>