<?php
global $conn;
include "../classes/LoginSignupService.php";
require "../classes/Jwt.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    if(!LoginSignupService::checkUsername($username)){
        $wrong = true;
    }else {
        $message = findByUsername($username);

        if (LoginSignupService::checkUserExist($username)) {
            if (isset($_SESSION['code'])) {
                header("Location: varification.php");
            }
            $_SESSION['username'] = $username;
            $_SESSION['code'] = rand(100000, 999999);
            $_SESSION['wrongs'] = 0;
            $_SESSION['last_activity'] = time();
            header("Location: varification.php");
        } else {
            $wrong = true;
        }
    }
}



?>

<link rel="stylesheet" href="../html-and-css/styl.css">
<body>
<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
            <h1 class="opacity">Login Via Code</h1>
            <h3 class="opacity" style="color:red;"><?php global $wrong; $message = $wrong?"user not found":""; echo $message;?></h3>
            <form method="post">
                <input type="text" name="username" placeholder="EMAIL OR PHONE" />
                <button class="opacity">SUBMIT</button>
            </form>
            <div class="register-forget opacity">
                <a href="http://localhost/auth/pages/login.php">LOGIN VIA PASSWORD</a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
</body>

<script src="../html-and-css/style.js" type="text/javascript"></script>
