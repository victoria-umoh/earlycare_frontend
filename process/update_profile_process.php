<?php
session_start();
include_once "../classes/User.php";
include_once "../utilities/sanitizer.php";

if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }

    if (isset($_POST['submit'])) {
        $user_firstname = sanitizer($_POST['fname']);
        $user_lastname = sanitizer($_POST['lname']);
        $user_email = sanitizer($_POST['email']);
        $user_height = sanitizer($_POST['height']);
        $user_gender = $_POST['gender'];
        $user_dob = $_POST['dob'];

        //echo $user_id;
        $userr = new User();
        $updated = $userr->update_user_profile($user_id, $user_firstname, $user_lastname, $user_email, $user_height, $user_gender, $user_dob);

        if ($updated) {
            $_SESSION['updated'] = "Profile update successful";
            header("location: ../profile.php#editProfile");
            exit();
        } else{
            $_SESSION['updated'] = "An error occurred during the update.";
            header("location: ../profile.php#editProfile");
            exit();
        }


    }
?>


