<?php
global $conn;
include "../classes/LoginSignupService.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(LoginSignupService::checkUsername($username)) {
        $wrongSignup = true;
    }else {
        if (insertUser($username, $password)) {
            header("Location: login.php");
        }else {
            $wrongSignup = true;
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
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
                 alt="illustration" class="illustration"/>
            <h1 class="opacity">SIGN UP</h1>
            <h3 class="opacity" style="color:red;"><?php global $wrongSignup;
                $message = $wrongSignup ? "choose another username" : "";
                echo $message; ?></h3>
            <form method="post">
                <input type="text" name="username" placeholder="EMAIL OR PHONE"/>
                <input type="password" name="password" placeholder="PASSWORD"/>
                <button class="opacity">SUBMIT</button>
            </form>
            <div class="register-forget opacity">
                <a href="http://localhost/auth/pages/login.php">LOGIN</a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>
</body>

<script src="../html-and-css/style.js" type="text/javascript"></script>

