<?php
$host = 'sql.freedb.tech';
$port = 3306; // Default MySQL port
$db = 'freedb_rent-a-car';
$dsn = "mysql:host=$host;port=$port;dbname=$db;";
$username = 'freedb_Asafrushiti';
$password = 'fQ@DpWv9ZG7aF#2'; // URL-encoded password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

