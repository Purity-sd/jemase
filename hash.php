<?php
// Start the session (optional, if you need to manage sessions)
session_start();

// Database credentials
$servername = "localhost";
$username = "root";    // Your MySQL username
$password = "";        // Your MySQL password
$dbname = "jemase_stock_control";  // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users with plain text passwords
$sql = "SELECT id, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $plain_text_password = $row['password'];

        // Hash the password using password_hash()
        $hashed_password = password_hash($plain_text_password, PASSWORD_DEFAULT);

        // Prepare and execute the query to update the password with the hashed version
        $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $update_stmt->bind_param("si", $hashed_password, $user_id);
        if ($update_stmt->execute()) {
            echo "Password for user ID $user_id has been updated successfully.<br>";
        } else {
            echo "Error updating password for user ID $user_id: " . $update_stmt->error . "<br>";
        }
    }
} else {
    echo "No users found with plain text passwords.";
}

// Close the statement and connection
$conn->close();
?>
