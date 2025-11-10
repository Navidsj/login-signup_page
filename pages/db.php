<?php
$servername = "localhost";
$username = "root";
$password = "";
$db   = "auth_db";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$sqlQuery = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL)";
$conn->query($sqlQuery);


function insertUser($username, $password): bool{
    global $conn;
    $sqlQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($sqlQuery, "s", $username);
    mysqli_stmt_execute($sqlQuery);
    $result = mysqli_stmt_get_result($sqlQuery);

    if ($result->num_rows == 0) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sqlQuery = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($sqlQuery, "ss", $username, $hashed_password);
        mysqli_stmt_execute($sqlQuery);
        return true;
    }else {
        return false;
    }
}

function findByUsername($username): array|null{
    global $conn;
    $sqlQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($sqlQuery, "s", $username);
    mysqli_stmt_execute($sqlQuery);
    $result = mysqli_stmt_get_result($sqlQuery);
    if($result->num_rows == 1){
        return $result->fetch_assoc();
    }else{
        return null;
    }
}



?>
