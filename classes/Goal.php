<?php
require_once "Db.php";

class Goal extends Db{
        //add goal method
    public function add_goal($goal_title, $goal_description){
        $sql = "INSERT INTO goals (goal_title, goal_description) VALUES(?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt -> bindParam(1, $goal_title, PDO::PARAM_STR);
        $stmt -> bindParam(2, $goal_description, PDO::PARAM_STR);
        $goal = $stmt->execute();
            return $goal;
            //     if($response){
            //         $_SESSION['goal_msg'] = "Goal added successfully";
            //         return true;
            //     }else{
            //         $_SESSION['goal_msg'] = "error, unable to add goal";
            //         return false;
            //     }
    }

        //goal fetcher for admin
    public function fetch_all_goals(){
        $sql = "SELECT * FROM goals"; 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $goals;
    }

        //get book detail method
    public function get_goal_detail($goal_id){
        $sql = "SELECT * FROM goals WHERE goal_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $goal_id, PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->rowCount();      //count how many recoreds with the id
            if($count < 1) {                //if count is less than 1, no record with that id
                return false;
            }else{
        //It means d book exist, fetch it with d fetch function()
        $goal = $stmt->fetch(PDO::FETCH_ASSOC);
            return $goal;
        }
    }


        // public function get_goal_detail($goal_title){
        //     $sql = "SELECT * FROM goals WHERE goal_title = ?";
        //     $stmt = $this->connect()->prepare($sql);
        //     $stmt->bindParam(1, $goal_title, PDO::PARAM_STR);
        //     $stmt->execute();
        //     $goal_title = $stmt->fetch(PDO::FETCH_ASSOC);
        //     return $goal_title;
            
        // }


        // public function fetch_goal_detail($goal_title){
        //     $sql = "SELECT * FROM goals WHERE goal_title = ?";
        //     $stmt = $this->connect()->prepare($sql);
        //     $stmt->bindParam(1, $goal_title, PDO::PARAM_STR);
        //     $stmt->execute();
    
        //     $count = $stmt->rowCount();      //count how many recoreds with the id
        //         if($count < 1) {                //if count is less than 1, no record with that id
        //             return false;
        //         }else{
        //             //It means d book exist, fetch it with d fetch function()
        //             $goal = $stmt->fetch(PDO::FETCH_ASSOC);
        //             return $goal;
        //         }
        // }

        //update goal method
    public function update_goal($goal_title, $goal_description, $goal_id){
        $sql = "UPDATE goals SET goal_title = ?, goal_description = ? WHERE goal_id = ?";
                $stmt = $this->connect()->prepare($sql);

                $stmt -> bindParam(1, $goal_title, PDO::PARAM_STR);
                $stmt -> bindParam(2, $goal_description, PDO::PARAM_STR);
                $stmt -> bindParam(3, $goal_id, PDO::PARAM_INT);
                
                $updated= $stmt->execute();
                if ($updated){
                    $_SESSION['goal_edit'] = "Goal was successfully updated";
                    return true;
                }else{
                    $_SESSION['goal_edit'] = "Unable to update goal";
                    return false;
                }
    }

        //delete goal method
    // public function delete_goal($goal_id){
    //     $sql = "DELETE FROM goal WHERE goal_id = ?";
    //             $stmt = $this->connect()->prepare($sql);
    //             $stmt->bindParam(1, $goal_id, PDO::PARAM_INT);
    //             $deleted = $stmt->execute();
    //             return $deleted;
    // }


}

//ADMIN CAN ADD GOAL
// $goal = new Goal();
// $result=$goal->add_goal("Exercise", "Exercise");
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
// $goaldetails = $goal->get_goal_detail(1);
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
// $update_goal = $goal->update_goal("weightloss", "losing weight", 2);
// echo "<pre>";
// print_r($update_goal);
// echo "</pre>";

//ADMIN CAN DELETE GOAL
// $goal = new Goal();
// $delete_goal =  $goal->delete_goal(6);
// echo "<pre>";
// print_r($delete_goal);
// echo "</pre>";

//ADMIN CAN DELETE GOAL
// $goal = new Goal();
// $fetch_goal =  $goal->fetch_goal_detail("we");
// echo "<pre>";
// print_r($delete_goal);
// echo "</pre>";

?>