<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'db_connect.php';
$transactions = [
    ["transaction_id" => 1, "product_name" => "Running Sneakers", "quantity" => 5, "total" => 29995.00],
    ["transaction_id" => 2, "product_name" => "Sandals", "quantity" => 10, "total" => 35500.00],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Jemase Shoes</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="product.php">Products</a>
        <a href="suppliers.php">Suppliers</a>
        <a href="transaction.php">Transactions</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
    </div>
    
    <div class="main-content">
            <h1>Transaction List</h1>
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>transaction_ID</th>
                        <th>product_name</th>
                        <th>quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction["transaction_id"]; ?></td>
                            <td><?php echo $transaction["product_name"]; ?></td>
                            <td><?php echo $transaction["quantity"]; ?></td>
                            <td><?php echo $transaction["total"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</body>
</html>


