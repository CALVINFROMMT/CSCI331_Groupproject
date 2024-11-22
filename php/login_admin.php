<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Listing</title>
   
</head>
<body>
    <h1>LOGIN PAGE</h1>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection (replace with your credentials)
$db_host = "localhost";
$db_user = "user43";
$db_pass = "43falx";
$db_name = "db43";

$conn_1 = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn_1->connect_error) {
    die("Connection failed: " . $conn_1->connect_error);
}

$query_admin = "SELECT * FROM users";
$result_1 = $conn_1->query($query_admin);


if($result_1 && $result_1->num_rows > 0){
    $columns = array_keys($result_1->fetch_assoc());

    foreach ($columns as $column){
        echo "<th>" . htmlspecialchars($column) . "</th>"."____";
    }
    
    $result_1->data_seek(0);
}

if($result_1 && $result_1->num_rows > 0){
    echo "<tr><td colspan='2' style='height: 20px;'></td></tr>";
    while($row=$result_1->fetch_assoc()){
        echo "<tr>";
        foreach($row as $value){
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
    echo "</tr>";
    echo "    ";
    }
}
else {
    echo "<tr><td colspan='100%'>NO DATA FOUND</td></tr>";
 
}

$conn_1->close();
?>
</body>
</html>