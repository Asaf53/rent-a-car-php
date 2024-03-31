<?php
$host = 'localhost:3308';
$db = 'rent-a-car';
$dsn = "mysql:host=$host;dbname=$db;";
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);
