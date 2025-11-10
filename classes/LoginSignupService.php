<?php
include "../pages/db.php";
class LoginSignupService{


    static function checkUsername($username){
        if(!filter_var($username, FILTER_VALIDATE_EMAIL) and !preg_match('/^[0-9]{11}+$/', $username)) {
            return false;
        }else{
            return true;
        }
    }
    static function checkLogin($username, $password): bool{
        $user = findByUsername($username);
        if($user == null){
            return false;
        }

        if(!password_verify($password, $user['password'])){
            return false;
        }
        return true;
    }

    static function checkUserExist($username): bool{
        $user = findByUsername($username);
        if($user == null){
            return false;
        }
        return true;
    }

}

?>