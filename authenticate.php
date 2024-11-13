<?php
include 'db_connect.php'; // Include your database connection file

// Retrieve username and password from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to retrieve the user's stored hash
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found
    $row = $result->fetch_assoc();

    // Verify the password using password_verify()
    if (password_verify($password, $row['password'])) {
        // Password is correct, start a session for the user
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];

        // Redirect the user to a protected page, e.g., dashboard
        header("Location:dashboard.php");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No user found with that username.";
}

$stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
</head>
<body>
<h2>Login</h2>
<form action="authenticate.php" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>

