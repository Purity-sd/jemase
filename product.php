<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'db_connect.php';
$products = [
    ["product_name" => "Running Sneakers", "category" => "Sportswear", "price" => "5999.00", "stock" => "150", "supplier_id" => "Global Footwear Supplies"],
    ["product_name" => "Leather Boots", "category" => "Formal", "price" => "12000.00", "stock" => "75", "supplier_id" => "Shoes Direct"],
    ["product_name" => "Sandals", "category" => "Casual", "price" => "3550.00", "stock" => "200", "supplier_id" => "Global Footwear Supplies"],
    ["product_name" => "High Heels", "category" => "Formal", "price" => "8000.00", "stock" => "100", "supplier_id" => "Leather & Lace"],
    ["product_name" => "Slip-Ons", "category" => "Casual", "price" => "4000.00", "stock" => "120", "supplier_id" => "Shoes Direct"],
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="css.style.css">
</head>
<body>
<div class="container">
        <h1>Products</h1>
        <p>Manage your product inventory here.</p>
    <div class="sidebar">
        <h2>Jemase Shoes</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="suppliers.php">Suppliers</a>
        <a href="transactions.php">Transactions</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
            <h1>Product List</h1>
            <a href="add_product.php">Add New Product</a><br><br>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Supplier</th>
                
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product["product_name"]; ?></td>
                            <td><?php echo $product["category"]; ?></td>
                            <td><?php echo $product["price"]; ?></td>
                            <td><?php echo $product["stock"]; ?></td>
                            <td><?php echo $product["supplier_id"]; ?></td>
                            <td><a href='delete_product.php?id=" . $row['id'] ." '>Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <footer>© 2024 Jemase Shoes. All Rights Reserved.</footer>
        </div>
    </div>
</body>
</html>

    </div>
</body>
</html>

