<?php
require "Jwt.php";
session_start();

if(isset($_SESSION['code'])){

    if(time() - $_SESSION['last_activity'] > 60 * 2){
        session_destroy();
        header("Location: login.php");
    }

    $jwtBuilder = new Jwt();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if($_POST["code"] == $_SESSION["code"]){
            $_SESSION['code'] = "";
            $payload = [
                "username" => $_SESSION["username"]
            ];
            $jwt = $jwtBuilder->encode($payload);
            $cookie_name = "token";
            $cookie_value = $jwt;
            setcookie($cookie_name, $cookie_value, time() + 10 * 60, "/");
            session_destroy();
            header("location: home.php");
        }else{
            $_SESSION['wrongs']++;
            if($_SESSION['wrongs'] > 5){
                session_destroy();
                header("location: login.php");
            }
            $wrong = true;
        }
    }


}else{
    header("location:login.php");
}




?>

<link rel="stylesheet" href="styl.css">
<body>
<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
            <h1 class="opacity">VARIFICATION</h1>
            <h3 class="opacity" style="color:red;"><?php global $wrong; $message = $wrong?"Code is wrong":""; echo $message;?></h3>
            <form method="post">
                <input type="text" name="code" placeholder="CODE" />
                <button class="opacity">SUBMIT</button>
            </form>
            <div class="register-forget opacity">
                <a href="http://localhost/auth/login.php">LOGIN AGAIN</a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
</body>

<script src="style.js" type="text/javascript"></script>