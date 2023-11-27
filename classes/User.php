<?php
include_once "Db.php";

class User extends Db{
    //SIGNUP METHOD
    public function signup($user_firstname, $user_lastname, $user_email, $user_password, $user_height, $user_gender, $user_dob){
        $sql = "SELECT * FROM user WHERE user_email = ?";
        $db1 = new Db();
        $conn= $db1->connect();
        // print_r($conn);
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user_email, PDO::PARAM_STR);
        $stmt->execute();

        //count all rows in db 
        $user_count = $stmt->rowCount();
        if($user_count > 0) {
        $_SESSION["signup_error"] = "User with this email already exist"; 
              
        }

        //IF IT DONT EXIST, INSERT INTO DB
        $sql = "INSERT INTO user(user_firstname, user_lastname, user_email, user_password, user_height, user_gender, user_dob) VALUES(?,?,?,?,?,?,?)";
        $stmt = $db1->connect()->prepare($sql);
        $stmt -> bindParam(1, $user_firstname, PDO::PARAM_STR);
        $stmt -> bindParam(2, $user_lastname, PDO::PARAM_STR);
        $stmt -> bindParam(3, $user_email, PDO::PARAM_STR);
        $stmt -> bindParam(4, $user_password, PDO::PARAM_STR);
        $stmt -> bindParam(5, $user_height, PDO::PARAM_INT);
        $stmt -> bindParam(6, $user_gender, PDO::PARAM_STR);
        $stmt -> bindParam(7, $user_dob, PDO::PARAM_STR);
        

        $response = $stmt->execute();
        if($response){
            $_SESSION['signup_error'] = "Registration successful, please login...";
            header("location:../login.php");
            return true;
            exit();   
        }else{
            $_SESSION['signup_error'] = "either email or password is incorrect";
            header("location:../signup.php");
            return false;
            exit();
        }     
    }//REGISTER METHOD ENDS HERE

    //LOGIN METHOD
    public function login($user_email, $user_password){
        //check if email is in db 
        $sql = "SELECT * FROM user WHERE user_email = ?"; 
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_email, PDO::PARAM_STR);
        $stmt->execute();
        
        $user_count = $stmt->rowCount();
        //if usercount is less than one, email exists
        if ($user_count < 1) {
           //if it is not in db, send error return msg
           return "Either email or password is incorrect";
        //    exit();
        }

        //if it is in db, fetch that user email for d user to login to ur app
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //check if pasword matches using password verify
        $password_matches = password_verify($user_password, $user["user_password"]);
        
        //if it matches, set session
        if ($password_matches) {
           $_SESSION["user_id"] = $user["user_id"];  //store pwd in session
           header("location:../profile.php");      //redirect user to their profile
            //exit();
        }
        //else return error msg
        //return "password is incorrect";
        // exit();
   } //END OF LOGIN METHOD

     //fetching a user detail with user id
    public function fetch_user_details($user_id){
        $sql = "SELECT * FROM user WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $user_details = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user_details;
        
    }

    //UPDATE METHOD
    public function update_user_profile($user_id, $user_firstname, $user_lastname, $user_email, $user_height, $user_gender, $user_dob) {
    $sql = "UPDATE user SET user_firstname = ?, user_lastname = ?, user_email = ?, user_height = ?, user_gender = ?, user_dob = ? WHERE user_id = ?";
    
    try {
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_firstname, PDO::PARAM_STR);
        $stmt->bindParam(2, $user_lastname, PDO::PARAM_STR);
        $stmt->bindParam(3, $user_email, PDO::PARAM_STR);
        $stmt->bindParam(4, $user_height, PDO::PARAM_INT);
        $stmt->bindParam(5, $user_gender, PDO::PARAM_STR);
        $stmt->bindParam(6, $user_dob, PDO::PARAM_STR);
        $stmt->bindParam(7, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Check if any rows were affected (update was successful)
        $rowsAffected = $stmt->rowCount();
        
        if ($rowsAffected > 0) {
            return true; // Return true to indicate success
        } else {
            return false; // Return false to indicate no changes were made
        }
    } catch (PDOException $ex) {
        // Handle the exception here, e.g., log the error or display an error message
        error_log($ex->getMessage());
        return false; // Return false to indicate an error occurred
    }
}


       //uploadprofileimage method UPDATE
    public function upload_profile_image($user_id, $user_dp){
        $sql = "UPDATE user SET user_dp = ? WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_dp, PDO::PARAM_STR);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
        $response = $stmt->execute();

        return $response;
  
        if($response){
           return true;
        }else{
           return false;
        }
    }

    
} //END OF CLASS


//weightlost test
// $user1 = new User();
// $response = $user1->insert_weightloss();
// print_r($response);

//USER CAN REGISTER 
// $user1 = new User();
// $signup = $user1->signup("stella", "stella", "stella@yahoo.com", "12345678");
// echo "<pre>";
// print_r($signup);
// echo "</pre>";

//USER CAN LOGIN
// $user1 = new User();
// $loggedin = $user1-> login("victoriasuave07@gmail.com", "12345678");
//echo $loggedin;
//echo "<pre>";
// print_r($loggedin);
// echo "</pre>";

//FETCH test
// $user1 = new User();
// $fetched = $user1->fetch_user_details("user_id");
// echo $fetched;
// echo "<pre>";
// print_r($fetched);
// print_r($user1->fetch_user_details(12));
// echo "</pre>";

//UPDATE PROFILE PICTURE
// $user1 = new User();
// $uploadpic = $user1->upload_profile_image("user_id", "user_dp");
// echo "<pre>";
// print_r($uploadpic);
// echo "</pre>";

//UPDATE USER PROFILE
// $user1 = new User();
// $updated_profile = $user1->update_user_profile(43, "olamide", "olamide", "olamide@yahoo.com");


?>