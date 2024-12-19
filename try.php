<?php
$root_dir = __DIR__;
require_once __DIR__ . '/vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access the environment variable
echo 'MY_VARIABLE: ' . $_ENV['MY_VARIABLE'];
echo $root_dir;
?>
