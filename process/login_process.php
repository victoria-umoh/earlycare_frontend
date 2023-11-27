<?php
session_start();
include_once "../classes/User.php";
require_once "../utilities/sanitizer.php";



if ($_POST) {
    if (isset($_POST["loginbtn"])) {

        $user_email = sanitizer($_POST["email"]);
        $user_password = sanitizer($_POST["password"]);

        //validate email nd password not empty
        if (empty($user_email) || empty($user_password)) {
            $_SESSION["login_error"] = "All fields are required";
            header("location:../login.php");
            // exit();
        }

        
        if (strlen($user_password) < 8) {
            //error message stored in session
            $_SESSION["login_error"] = "password must be 8 characters";
            //redirect to register page
            header("location:../login.php");
            exit();
        }

        //$hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $user1 = new User();
        $addUser = $user1->login($user_email, $user_password);

        if($addUser){
            //$_SESSION["login_error"] = "Login successful";
            header("location:../profile.php");
            // exit();
        }else{
            $_SESSION["login_error"] = "Login unsuccessful";
        }

    }else{
        header("location:../login.php");
    }
}else{
    header("location:../login.php");
}
?>