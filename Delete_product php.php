<?php
include 'db_connect.php';
include 'header.php';
include 'navbar.php';

// Check if a product ID is set for deletion
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "No product ID provided.";
}
?>
