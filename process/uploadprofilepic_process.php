<?php
session_start();
require_once "../classes/User.php";


    if ($_POST) {
        if (isset($_POST["uploadpicbtn"])) {
            $user_id = $_POST["user_id"];
            $profile = $_FILES["profile"];

                //file error vaidation
                $error = $profile["error"];
                if ($error > 0) {
                   header("location:../profile.php");
                    $_SESSION['file_upload'] = "please uoload a valid file";
                    exit();
                }//end of error validation

                //validate file size
                $file_size = $profile["size"];
                if ($file_size > 2097152) {
                    header("location:../profile.php");
                    $_SESSION['file_upload'] = "Picture size cannot be more than 2mb";
                    exit();
                }//end of size validation

                //vaildate file type/name via d extension
                $allowed = ["jpeg", "png", "jpg"];  //allowed file extension
                $filename = $profile["name"];
                //to get the extension of the user uploaded file
                $arrfilename = explode(".", $filename);
                $file_ext = end($arrfilename);
                // echo $file_ext;

                //if file they tried to uoload is not in the list of allowed file extension
                if(!in_array($file_ext, $allowed)){
                header("location:../profile.php");
                    $_SESSION['file_upload'] = "please upload an image of type png or jpg";
                    exit();
                }

                //generate a unique filename for d file
                $final_filename = "photo" . time() . "." . $file_ext;

                $destination = "../uploads/$final_filename";
                $tempo = $profile["tmp_name"];

                $fileUploaded = move_uploaded_file($tempo, $destination);

                //if upload is successful, send file name and user id to user class method to be updated for d user
                if($fileUploaded){
                    $user = new User();
                    $response = $user->upload_profile_image($user_id, $final_filename);
                        if ($response) {
                        header("location:../profile.php");
                        $_SESSION['file_upload'] = "picture upload successful";
                        exit();
                        }
                }else{
                    header("location:../profile.php");
                    $_SESSION['file_upload'] =  "unable to upload";
                    exit();
                }
        }
    }

?>