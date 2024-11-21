<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    echo "Access denied. Admins only.";
    exit;
}

// Database connection (replace with your credentials)
$db_host = "localhost";
$db_user = "user43";
$db_pass = "43falx";
$db_name = "db43";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the database
$query = "SELECT username, password_hash FROM users";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h1>Registered Users</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Hashed Password</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row['username']) . "</td><td>" . htmlspecialchars($row['password_hash']) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

$conn->close();
?>
