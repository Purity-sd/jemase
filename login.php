<?php
session_start();
include 'db_connect.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['role'] = $user['role']; // where $userRole is fetched from the database
            header("Location:dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Jemase Shoes</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to external CSS file -->
    <style>
        /* Page background image */
        body {
            background-image: url('images/store.background.jpg'); /* Path to your background image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Centered login container */
        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            width: 300px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Logo image styling */
        .logo {
            width: 100px; /* Adjust the logo size */
            margin-bottom: 1rem;
        }

        /* Form styling */
        form input[type="text"], form input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        form button {
            width: 100%;
            padding: 0.75rem;
            background-color: #4CAF50; /* Button color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo image -->
        <img src="images/logo.jpg" alt="Jemase Shoes Logo" class="logo"> <!-- Path to your logo image -->
        <h2>Login to Jemase Shoes</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>

