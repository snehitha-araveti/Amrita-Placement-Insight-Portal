<?php
$host = 'localhost';
$db   = 'amrita_placement';
$user = 'root';
$pass = 'Snehitha@07'; // Default WAMP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>