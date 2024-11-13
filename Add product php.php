<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier = $_POST['supplier_id'];


    if ($name && $quantity) {
        $sql = "INSERT INTO products (product_name, category, price, stock, supplier_id)
            VALUES ('$product_name', '$category', '$price', '$stock', '$supplier_id')";
        echo json_encode(["message" => "Product added successfully"]);
    } else {
        echo json_encode(["message" => "Product name and quantity are required"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form action="add_product.php" method="POST">
        <label>Product Name:</label><br>
        <input type="text" name="product_name" required><br>
        
        <label>Category:</label><br>
        <input type="text" name="category" required><br>
        
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" required><br>
        
        <label>Stock:</label><br>
        <input type="number" name="stock" required><br>
        
        <label>Supplier:</label><br>
        <input type="text" name="supplier_id" required><br><br>
        
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
