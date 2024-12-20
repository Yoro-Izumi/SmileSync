<?php
$root_dir = $_SERVER['DOCUMENT_ROOT'].'/SmileSync';
require_once $root_dir.'/vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
$dotenv->load();

//initialize servername username and password first for database connection
$servername = $_ENV['DB_SERVERNAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Functions to connect to specific databases

function connect_appointment($servername, $username, $password) {
    $dbname = "smilesync_appointments";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}

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

function smilesync_chatbot($servername, $username, $password) {
    $dbname = "smilesync_chatbot";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    return $conn;
}
?>
