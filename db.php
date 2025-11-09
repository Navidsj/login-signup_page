<?php
$servername = "localhost";
$username = "root";
$password = "";
$db   = "auth_db";

$conn = mysqli_connect($servername, $username, $password, $db);

$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(1000) NOT NULL,
password VARCHAR(1000) NOT NULL)";

if ($conn->query($sql) === TRUE) {
}
else {
    throw new RuntimeException("Error creating table: " . $conn->error);
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
