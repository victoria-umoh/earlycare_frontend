<?php
require_once "Db.php";

class UserProgress extends Db{
        //ADD PROGRESS
    public function add_progress($goal_id, $progress_value, $comment){

        $sql = "INSERT INTO progress (goal_id, progress_value, comment) VALUES(?,?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt -> bindParam(1, $goal_id, PDO::PARAM_INT);
                $stmt -> bindParam(2, $progress_value, PDO::PARAM_STR);
                $stmt -> bindParam(3, $comment, PDO::PARAM_STR);
                $progress = $stmt->execute();
                if($progress){
                    $_SESSION['add_progress'] = "Progress added successfully";
                    return true;
                }else{
                    $_SESSION['add_progress'] = "error, unable to add progress";
                    return false;
                }
        }

        //FETCH PROGRESS
    public function fetch_all_progress(){
        $sql = "SELECT * FROM progress"; 
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $progress = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $progress;
    }

        //A PROGRESS DETAIL
    public function get_progress_detail($progress_id, $user_id){
        $sql = "SELECT * FROM progress WHERE progress_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->bindParam(1, $progress_id, PDO::PARAM_INT);
                $stmt->execute();

                $count = $stmt->rowCount();      //count how many recoreds with the id
                    if($count < 1) {                //if count is less than 1, no record with that id
                        return false;
                    }else{
                        //It means d book exist, fetch it with d fetch function()
                        $progress = $stmt->fetch(PDO::FETCH_ASSOC);
                        return $progress;
                    }
     }

        //DELETE PROGRESS
    public function update_progress($user_id, $goal_id, $progress_value){
        $sql = "UPDATE progress SET user_id = ?, goal_id = ?, progress_value WHERE progress_id = ?";
                $stmt = $this->connect()->prepare($sql);

                $stmt -> bindParam(1, $user_id, PDO::PARAM_INT);
                $stmt -> bindParam(2, $goal_id, PDO::PARAM_INT);
                $stmt -> bindParam(3, $progress_value, PDO::PARAM_INT);
                $stmt -> bindParam(4, $progress_id, PDO::PARAM_INT);
                $updated= $stmt->execute();
                if ($updated){
                    $_SESSION['edit_progress'] = "Progress was successfully updated";
                    return true;
                }else{
                    $_SESSION['edit_progress'] = "Unable to update progress";
                    return false;
                }
    }

        //delete goal method
    public function delete_progress($goal_id){
        $sql = "DELETE FROM progress WHERE progress_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->bindParam(1, $progress_id, PDO::PARAM_INT);
                $deleted = $stmt->execute();
                return $deleted;
    }


}

//ADMIN CAN ADD GOAL
//$goal = new UserProgress();
// $result=$goal->add_progress(2, "weightloss", "goal achieved");
// echo $result;
// echo "<pre>";
// print_r($result);
// echo "</pre>";


 
 //ADMIN CAN FETCH GOAL
// $goal = new Goal();
// $goal_list = $goal->fetch_all_goals();
// echo "<pre>";
// print_r($goal_list);
// echo "</pre>";

// ADMIN CAN GET GOAL DETAILS
// $goal = new Goal();
// $goaldetails = $goal->get_goal_detail(2);
// echo "<pre>";
// print_r($goaldetails);
// echo "</pre>";

 //ADMIN CAN FETCH GOAL
// $goal = new Goal();
// $goallist = $goal->fetch_all_goals();
// echo "<pre>";
// print_r($goallist);
// echo "</pre>";

// ADMIN CAN UPDATE GOAL
// $goal = new Goal();
// $update_goal = $goal->update_goal("Exercise", "exercise", 1);
// echo $update_goal;
// echo "<pre>";
// print_r($update_goal);
// echo "</pre>";

//ADMIN CAN DELETE GOAL
// $goal = new Goal();
// $delete_goal =  $goal->delete_goal(6);
// echo "<pre>";
// print_r($delete_goal);
// echo "</pre>";

?>