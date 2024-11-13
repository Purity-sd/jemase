<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // Hash the password

    // Insert user into the database
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password','$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. You can now <a href='login.php'>log in</a>.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label for="role">Role:</label><br>
        <input type="role" name="role" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
