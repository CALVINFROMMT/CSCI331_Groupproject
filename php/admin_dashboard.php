<?php
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$db_host = "localhost";
$db_user = "user43";
$db_pass = "43falx";
$db_name = "db43";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the database
$query = "SELECT username, admin FROM users";
$result = $conn->query($query);

echo "<h1>Admin Dashboard</h1>";
echo "<table border='1'>
        <tr>
            <th>Username</th>
            <th>Admin</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['username']}</td>
            <td>" . ($row['admin'] ? 'Yes' : 'No') . "</td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
