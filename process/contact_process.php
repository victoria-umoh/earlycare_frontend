<?php
session_start();
require_once "../classes/Contact.php";
require_once "../utilities/sanitizer.php";



if($_POST){
    if(isset($_POST['submit'])){
      $firstname = sanitizer($_POST['firstname']);
      $lastname = sanitizer($_POST['lastname']);
      $email = sanitizer($_POST['email']);
      $comment = sanitizer($_POST['comment']);

      //validate
      if (empty($firstname) || empty($lastname) || empty($email) || empty($comment)) {
        $_SESSION['contact'] = "all fields are required";
        header("location:../contact.php");
        exit();
      }

       //instantiate
       $contact1 = new Contact();
       $result = $contact1->add_contact_us($firstname, $lastname, $email, $comment);

        if($result){
            $_SESSION['contact'] = "form submitted, we will get back to you shortly";
            header("location:../contact.php");
            exit();
        }
    }else{
        header("location:../contact.php");
        exit();
    }
}else{
    header("location:../contact.php");
    exit();
}



?>