<h1>
<?php
require "Jwt.php";
if(isset($_COOKIE['token'])){

    $jwtBuilder = new Jwt();

    $payload = $jwtBuilder->decode($_COOKIE['token']);

    echo  "welcome ".$payload["username"].", You are logged in and your Coockis are set."; ;

}else{
    header("location:login.php");
}


?>
</h1>




