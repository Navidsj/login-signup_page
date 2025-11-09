<?php
global $conn;
include "db.php";
require "Jwt.php";
session_start();
if(isset($_COOKIE['username'])){
    echo "welcome " . $_COOKIE['username'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
        $result = $result->fetch_assoc();
        if (password_verify($password, $result['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['code'] = rand(100000, 999999);
            $_SESSION['wrongs'] = 0;
            $_SESSION['last_activity'] = time();
            header("Location: var.php");
        } else {
            $wrong = true;
        }
    } else {
        $wrong = true;
    }

}


?>





<link rel="stylesheet" href="styl.css">

<body>
<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
            <h1 class="opacity">LOGIN</h1>
            <h3 class="opacity" style="color:red;"><?php global $wrong; $message = $wrong?"Wrong username or password":""; echo $message;?></h3>
            <form method="post">
                <input type="text" name="username" placeholder="USERNAME" />
                <input type="password" name="password" placeholder="PASSWORD" />
                <button class="opacity">SUBMIT</button>
            </form>
            <div class="register-forget opacity">
                <a href="http://localhost/auth/signup.php">REGISTER</a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
</body>
