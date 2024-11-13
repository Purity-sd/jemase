<?php
// Start the session
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    exit;
}

// Include database connection
include 'db_connect.php';


// Only admin users can access this section
if ($_SESSION['role'] === 'admin') {
    echo "<h1>Welcome, Admin " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    echo "<p>You have full access to the stock control system.</p>";
} else {
    echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
    echo "<p>Your role is: " . htmlspecialchars($_SESSION['role']) . ".</p>";
}  
function fetch_products($conn) {
    $sql = "SELECT * FROM products";  // Adjust the SQL query as needed for your table
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output the data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['product_id'] . "</td>";    // Assuming a column 'product_id'
            echo "<td>" . $row['product_name'] . "</td>";  // Assuming a column 'product_name'
            echo "<td>" . $row['quantity'] . "</td>";      // Assuming a column 'quantity'
            echo "<td>" . $row['price'] . "</td>";         // Assuming a column 'price'
            echo "<td><a href='edit_product.php?id=" . $row['product_id'] . "'>Edit</a></td>";  // Edit link
            echo "<td><a href='delete_product.php?id=" . $row['product_id'] . "'>Delete</a></td>"; // Delete link
            echo "</tr>";
        }
    } 
    else {
        echo "<tr><td colspan='6'>No products found</td></tr>";
    }
}
// Fetch user details (optional if you want to display username on the dashboard)
$username = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'undefined';


// Fetch statistics using mysqli with fetch_assoc
try {
$productCountResult = $conn->query("SELECT COUNT(*) AS count FROM products");
$productCount = $productCountResult->fetch_assoc()['count'];

$supplierCountResult = $conn->query("SELECT COUNT(*) AS count FROM suppliers");
$supplierCount = $supplierCountResult->fetch_assoc()['count'];

$transactionCountResult = $conn->query("SELECT COUNT(*) AS count FROM transactions");
$transactionCount = $transactionCountResult->fetch_assoc()['count'];
} catch (Exception $e) {
    echo "Error fetching data: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jemase Shoes Stock Control</title>
    <link rel="stylesheet" href="css.css">
    <style>
    body {
            background-image: url('images/reou.jpg'); /* Replace with your image path */
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #333;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background-color: rgba(255, 255, 255, 0.9); /* Adds a semi-transparent white background */
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            margin: 40px auto;
            max-width: 1200px;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .sidebar h2 {
            text-align: center;
            color: #fff;
        }

        .sidebar a {
            display: block;
            color: #ccc;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #575757;
            color: #fff;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }

        footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            margin-top: 20px;
            color: #777;
        }
        
        footer a {
            color: #333;
            text-decoration: none;
            margin: 0 5px;
        }
    </style>

</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Jemase Shoes</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="product.php">Products</a>
        <a href="suppliers.php">Suppliers</a>
        <a href="transaction.php">Transactions</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
</div>
<div> class="dashboard">
<div class="main-content">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <p>Your role is: <?php echo htmlspecialchars($role); ?>.</p>
            <p>Welcome to the Dashboard, <?php echo htmlspecialchars($username); ?>!</p>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Jemase Shoes. All Rights Reserved.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>