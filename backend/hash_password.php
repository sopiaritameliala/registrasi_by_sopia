<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

var_dump($_ENV['ADMIN_PASSWORD']);

$adminPassword = $_ENV['ADMIN_PASSWORD'];

// lalu gunakan $adminPassword di kode kamu
echo "Password admin: " . $adminPassword;
?>
