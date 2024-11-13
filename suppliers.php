<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'db_connect.php';
$suppliers = [
    ["supplier_id" => 1, "supplier_name" => "Global Footwear Supplies", "contact_info" => "John Doe", "phone" => "123-456-7890", "email" => "info@globalfootwear.com"],
    ["supplier_id" => 2, "supplier_name" => "Shoes Direct", "contact_info" => "Jane Smith", "phone" => "987-654-3210", "email" => "contact@shoesdirect.com"],
    ["supplier_id" => 3, "supplier_name" => "Leather & Lace", "contact_info" => "Alice Johnson", "phone" => "555-123-4567", "email" => "support@leatherlace.com"]
]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppliers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
        <h1>Supplier Management</h1>
        <p>Manage your suppliers here.</p>
            <table class="suppliers-table">
                <thead>
                    <tr>
                        <th>supplier_id</th>
                        <th>supplier_name</th>
                        <th>contact_info</th>
                        <th>phone</th>
                        <th>email</th>
                     </tr>
                </thead>
                <tbody>
                <?php if ($suppliers): ?>
                    <?php foreach ($suppliers as $supplier):?>
                        <tr>
                            <td><?php echo $supplier["supplier_id"]; ?></td>
                            <td><?php echo $supplier["supplier_name"]; ?></td>
                            <td><?php echo $supplier["contact_info"]; ?></td>
                            <td><?php echo $supplier["phone"]; ?></td>
                            <td><?php echo $supplier["email"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                <tr>
                    <td colspan="7">No supliers found.</td>
                    </tr>
                <?php endif; ?>
                    </tbody>
            </table>
    </div>
</body>
</html>
