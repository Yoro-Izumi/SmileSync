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
$key = $_ENV['ENCRYPTION_KEY'] ?? null;

//this is the encryption function
function encryptData($data, $key) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encryptedData = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encryptedData);
}

function decryptData($data, $key) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $data = base64_decode($data);
    $iv = substr($data,0, $ivlen);
    $encryptedData = substr($data, $ivlen);
    return openssl_decrypt($encryptedData, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}
