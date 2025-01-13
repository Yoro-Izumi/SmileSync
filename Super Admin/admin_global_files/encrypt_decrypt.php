<?php
// code to encrypt data before inserting in database
//$root_dir = $_SERVER['DOCUMENT_ROOT'].'/SmileSync';
$root_dir = (PHP_OS === 'WINNT') ? 'C:/xampp/htdocs/SmileSync' : '/var/www/html/SmileSync';
require_once $root_dir.'/vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
$dotenv->load();

$key = $_ENV['ENCRYPTION_KEY'];

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


