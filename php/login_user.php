<?php
session_start();
if (password_verify($password, $user['password_hash'])) {
    $_SESSION['username'] = $username; // Fix typo from '==' to '='
    $_SESSION['admin'] = $user['admin'];
}


// Database connection (replace with your actual credentials)
$db_host = "localhost";
$db_user = "user43";
$db_pass = "43falx";
$db_name = "db43";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['l-username']);
    $password = $_POST['l-password'];
// --------------------------------------------------------------
// Prepare SQL statement to prevent SQL injection
    $query = "SELECT password_hash, admin FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] == $username;
            $_SESSION['admin'] = $user['admin'];

            if($user['admin']){
                echo "admin"; // Send "admin" message for JavaScript to process
            }
            else{
                echo "success"; // Send "success" message for JavaScript to process
            }
        } else {
            echo "failure";  // Send "failure" message for JavaScript to process
        }
    } 
    else {
        echo "failure";  // Send "failure" message if user not found
    }
    $stmt->close();
}
$conn->close();
?>
