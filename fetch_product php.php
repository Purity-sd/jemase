<?php
include 'db_connect.php';

header('Content-Type: application/json');

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>

