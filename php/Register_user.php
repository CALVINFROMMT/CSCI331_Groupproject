<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Listing</title>
   
</head>
<body>
    <h1>Just Added</h1>
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection (replace with your credentials)
$db_host = "localhost";
$db_user = "user43";
$db_pass = "43falx";
$db_name = "db43";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
 echo "<p> Connetion made </p>" ;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p> Request made </p>" ;
    if (isset($_POST['c-username'], $_POST['c-password'])) {
    
    $username = $conn->real_escape_string($_POST['c-username']);
    $password = $_POST['c-password'];

    echo "<p>Adding <strong> $username </strong> with password <strong>$password</strong>.</p>";
    // Generate a secure password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    echo "<p>Adding <strong>$username </strong> with hashed password <strong>$password_hash</strong>.</p>";
    
    
    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_query);

    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result-> num_rows > 0) {
        echo "Username already exists!";
    } 
    
    else {
        // Insert new user
        $query = "INSERT INTO users (username, password_hash) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password_hash);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration: " . $conn->error;
        }
        $stmt->close();
    }
    $check_stmt->close();}
else {
        echo "Please fill in both username and password fields.";
    }
}

$conn->close();
?>
</body>
</html>
