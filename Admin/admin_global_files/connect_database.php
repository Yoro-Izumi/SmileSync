<?php
$root_dir = $root_dir = $_SERVER['DOCUMENT_ROOT'].'/SmileSync';
require_once $root_dir . '/vendor/autoload.php';

// Load the .env file
if (!file_exists($root_dir . '/.env')) {
    die("Environment configuration file is missing!");
}
$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
$dotenv->load();

// Initialize servername, username, and password
$servername = $_ENV['DB_SERVERNAME'] ?? null;
$username = $_ENV['DB_USERNAME'] ?? null;
$password = $_ENV['DB_PASSWORD'] ?? null;

if (!$servername || !$username || !$password) {
    die("Database credentials are missing from the environment variables.");
}

// Generalized function to connect to a database
function connect_database($servername, $username, $password, $dbname) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection to $dbname failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Connect to specific databases
function connect_appointment($servername, $username, $password) {
    return connect_database($servername, $username, $password, "smilesync_appointments");
}

function connect_inventory($servername, $username, $password) {
    return connect_database($servername, $username, $password, "smilesync_inventory");
}

function connect_patient($servername, $username, $password) {
    return connect_database($servername, $username, $password, "smilesync_patient_management");
}

function connect_accounts($servername, $username, $password) {
    return connect_database($servername, $username, $password, "smilesync_accounts");
}

function connect_chatbot($servername, $username, $password) {
    return connect_database($servername, $username, $password, "smilesync_chatbot");
}
?>

