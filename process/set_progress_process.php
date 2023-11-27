<?php
session_start();
include "../utilities/sanitizer.php";
require_once "../classes/Goal.php";
require_once "../classes/UserProgress.php";


if($_POST){
    if(isset($_POST['submit'])){
        $goal_id = $_POST['goal_id'];
        //$current_value = sanitizer($_POST['current_value']);
        $progress_value = sanitizer($_POST['progress_value']);
        $comment = sanitizer($_POST['comment']);

        // Validate inputs
        if(empty($progress_value) || empty($comment)){
            $_SESSION['progress'] = "all fields are required";
            header("location:../set_progress.php");
            exit();
        }

        //instantiate
        $progress = new UserProgress();
        $progress_set = $progress->add_progress($goal_id, $progress_value, $comment);
            if ($progress_set) {
                $_SESSION['set_progress'] = "Progress added successfully";
                header("location:../set_progress.php");
                exit();
            }else{
                $_SESSION['set_progress'] = "error, unable to add progress";
                header("location:../set_progress.php");
                exit();
            }
        
    }
    // else{
    //     header("location:../set_progress.php");
    //     exit();
    //}
//}
// else{
//     header("location:../set_progress.php");
//     exit();
}

?>