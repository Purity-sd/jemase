<?php
include 'db_connect.php';

$username = "admin_user";
$password = password_hash("0000", PASSWORD_DEFAULT); 
$role = "admin";

$sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $password, $role);

if ($stmt->execute()) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
