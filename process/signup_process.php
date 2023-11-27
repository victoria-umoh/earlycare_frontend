<?php
session_start();
include_once "../utilities/sanitizer.php";
include_once "../classes/User.php";

if ($_POST) {
    if (isset($_POST["signup_btn"])) {
        $user_firstname = sanitizer($_POST["firstname"]);
        $user_lastname = sanitizer($_POST["lastname"]);
        $user_email = sanitizer($_POST["email"]);
        $user_password = sanitizer($_POST["password"]);
        $confirmpassword = sanitizer($_POST["confirmpassword"]);
        $user_height = sanitizer($_POST["height"]);
        $user_gender = $_POST["gender"];
        $user_dob = $_POST["dob"];

       //validate if fields are empty
       if(empty($user_firstname) || empty($user_lastname) || empty($user_email) || empty($user_password) || 
       empty($confirmpassword) || empty($user_height) ||  empty($user_dob) || empty($user_gender)){
        $_SESSION["signup_error"] = "All fields are required";
        header("location:../signup.php");
         exit();
       }

      //  elseif(!isset($user_gender) || ){
      //   $_SESSION["signup_error"] = "please select one gender";
      //   header("location:../signup.php");
      //    exit();
      //  }
       
       //validate password string length
       else if (strlen($user_password) < 8) {
        $_SESSION["signup_error"] = "Password must be 8 characters";
        header("location:../signup.php");
         exit();
       }

       //validate if password match confirm password
      else if ($user_password !== $confirmpassword) {
        $_SESSION["signup_error"] = "Password does not match confirm password";
        header("location:../signup.php");
         exit();
       }


       $hashedPwd = password_hash($user_password, PASSWORD_DEFAULT);

       $user1 = new User();
       //hash password
       

       $addUser = $user1->signup($user_firstname, $user_lastname, $user_email, $hashedPwd, $user_height, $user_gender, $user_dob);
       if($addUser){
            header("location:../login.php");
            $_SESSION["signup_error"] = "Registration successful, please login...";
            exit();
       }else{
            $_SESSION["signup_error"] = "either email or password is incorrect";
            header("location:../signup.php");
       }

    }else{
        header("location:../signup.php");
    }

}
else {
    header("location:../signup.php");
}

?>

