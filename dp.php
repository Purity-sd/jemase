<?php
include 'header.php';
include 'navbar.php';
include 'db_connect.php';

$host = 'localhost';
$dbname = 'jemase_stock';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
include 'footer.php';
?>
