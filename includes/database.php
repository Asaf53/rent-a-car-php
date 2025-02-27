<?php
$host = 'sql.freedb.tech';
$port = 3306; // Ensure this is the correct port
$db = 'freedb_rent-a-car';
$username = 'freedb_Asafrushiti';
$password = 'fQ@DpWv9ZG7aF#2';

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
