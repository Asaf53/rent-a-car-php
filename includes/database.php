<?php
$host = 'sql.freedb.tech';
$db = 'freedb_rent-a-car';
$dsn = "mysql:host=$host;dbname=$db;";
$username = 'freedb_Asafrushiti';
$password = 'fQ@DpWv9ZG7aF#2'; // %23 is the URL encoding for the '#' character
try {
    $pdo = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
