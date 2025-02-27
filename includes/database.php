<?php
$host = getenv('DB_HOST') ?: 'sql.freedb.tech'; // Do NOT use 'localhost'
$port = getenv('DB_PORT') ?: '3306';
$db = getenv('DB_NAME') ?: 'freedb_rent-a-car';
$username = getenv('DB_USER') ?: 'freedb_Asafrushiti';
$password = getenv('DB_PASS') ?: 'fQ@DpWv9ZG7aF#2';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "Connected successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
