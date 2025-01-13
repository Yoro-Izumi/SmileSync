<?php

//initialize servername username and password first for database connection

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