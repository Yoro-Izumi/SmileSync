<?php
//initialize servername username and password first for database connection
$servername = "localhost";
$username = "root";
$password = "";

// Secure connection using PDO
function connectToDatabase($servername, $username, $password, $dbname) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set PDO to throw exceptions on error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        // Handle errors gracefully
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
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
?>
