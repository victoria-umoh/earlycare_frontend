<?php
require_once "Db.php";

class UserGoal extends Db{
    //weightloss method
    public function insert_user_goal($user_id, $goal_id, $current_value, $target_value, $activity_level, $start_date, $finish_date){
        //insert user detail
      $sql = "INSERT INTO user_goals(user_id, goal_id, current_value, target_value, activity_level, start_date, finish_date) VALUES(?,?,?,?,?,?,?)";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $goal_id, PDO::PARAM_INT);
        $stmt->bindParam(3, $current_value, PDO::PARAM_STR);
        $stmt->bindParam(4, $target_value, PDO::PARAM_STR);
        $stmt->bindParam(5, $activity_level, PDO::PARAM_STR);
        $stmt->bindParam(6, $start_date, PDO::PARAM_STR);
        $stmt->bindParam(7, $finish_date, PDO::PARAM_STR);

        $response = $stmt->execute();
        if ($response) {
          $_SESSION['goal_insert'] = "goal insert successful";
            return true;
        }else{
          $_SESSION['goal_insert'] = "error, unable to insert goal";
          return false;
        }
    }

    public function fetch_user_goal(){
        $sql = "SELECT * FROM user_goals"; 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $weightloss = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $weightloss;
    }


    public function fetch_user_goal_details($user_id){
        $sql = "SELECT * FROM user_goals WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $weightloss_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $weightloss_details;
        
    }

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


    
  // public function days_to_go($start_date, $finish_date){
  //   $sql = "SELECT DATEDIFF(YEAR, $start_date, $finish_date) FROM user_goals WHERE $start_date=? $finish_date=? ;
  //   $stmt = $this->connect()->prepare($sql);
  //   $stmt->bindParam(1, $start_date, PDO::PARAM_STR);
  //   $stmt->bindParam(2, $finish_date, PDO::PARAM_STR);
  //   $result = $stmt->execute();
  //   if ($result) {
  //     return true;
  //   }else{
  //     return false;
  //   }
  // }

    // public function fetch_weightloss($user_id){
    //     $sql = "SELECT user_goals.weight, weightloss.target_weight, weightloss.height, weightloss.activity_level, weightloss.gender, weightloss.age FROM weightloss WHERE weightloss.user_id = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    //     $stmt->execute(); 
    //     $response = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $response;
    //         if ($response) {
    //             return true;
    //         } else {
    //             return false;
    //         }
        
    // }
}
//fetch_weightlost test
// $user1 = new UserGoal();
// $response = $user1->fetch_user_goal_details(54);
// echo "<pre>";
// print_r($response);
// echo "</pre>";

// $user1 = new UserGoal();
// $response = $user1->get_goal_detail(6);
// echo "<pre>";
// print_r($response);
// echo "</pre>";
?>