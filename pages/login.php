<?php
global $conn;
require "../classes/Jwt.php";
include "../classes/LoginSignupService.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = "wrong answer";
    if (LoginSignupService::checkLogin($username, $password)) {
        $jwtBuilder = new Jwt();
        $payload = [
                "username" => $username
        ];
        $jwt = $jwtBuilder->encode($payload);
        $cookie_name = "token";
        $cookie_value = $jwt;
        setcookie($cookie_name, $cookie_value, time() + 10 * 60, "/");
        header("location: home.php");
    }else {
        $wrongLogin = true;
    }

}
?>


<link rel="stylesheet" href="../html-and-css/styl.css">

<body>
<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                 alt="illustration" class="illustration"/>
            <h1 class="opacity">LOGIN</h1>
            <h3 class="opacity" style="color:red;"><?php global $wrongLogin;
                $message = $wrongLogin ? "Wrong username or password" : "";
                echo $message; ?></h3>
            <form method="post">
                <input type="text" name="username" placeholder="EMAIL OR PHONE"/>
                <input type="password" name="password" placeholder="PASSWORD"/>
                <button class="opacity">SUBMIT</button>
            </form>
            <div class="register-forget opacity">
                <a href="http://localhost/auth/pages/signup.php">REGISTER</a>
                <a href="http://localhost/auth/pages/loginviacode.php">LOGIN VIA CODE</a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
</body>

<script src="../html-and-css/style.js" type="text/javascript"></script>