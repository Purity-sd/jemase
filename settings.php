<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
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
        <h1>Settings</h1>
        <p>Manage your account settings here.</p>
        
        <!-- Add functionality here, e.g., updating profile details -->
        <form action="settings.php" method="POST">
            <label for="username">username:</label>
            <input type="username" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
            <br><br>
            <label for="password">Change Password:</label>
            <input type="password" id="password" name="password">
            <br><br>
            <button type="submit">Update Settings</button>
        </form>
    </div>
</body>
</html>
