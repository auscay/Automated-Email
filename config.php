<?php
// Load Composer's autoloader
require_once 'vendor/autoload.php';

// Use Dotenv to load .env file
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Example usage: Fetch database configuration from environment variables
$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];

// Example usage: Fetch mail configuration from environment variables
$mailHost = $_ENV['MAIL_HOST'];
$mailPort = $_ENV['MAIL_PORT'];
$mailUsername = $_ENV['MAIL_USERNAME'];
$mailPassword = $_ENV['MAIL_PASSWORD'];
$mailEncryption = $_ENV['MAIL_ENCRYPTION'];
