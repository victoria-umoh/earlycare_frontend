<?php
require_once "Db.php";

class Goal extends Db {
	//goal fetcher for admin
        public function fetch_all_goals(){
            $sql = "SELECT * FROM goal"; 
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $goals;
        }

          //get goal detail method
    public function get_goal_detail($goal_id){
        $sql = "SELECT * FROM goals WHERE goal_id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $goal_id, PDO::PARAM_INT);
        $stmt->execute();

        $count = $stmt->rowCount();      //count how many records with the id
        if($count < 1) {                //if count is less than 1, no record with that id
            return false;
        }else{
            //It means d goal exist, fetch it with d fetch function()
            $goal = $stmt->fetch(PDO::FETCH_ASSOC);
            return $goal;
        }
	}

// 	public function fetch_weightloss($user_id){
//         $sql = "SELECT weightloss.user_id, weightloss.current_weight, weightloss.target_weight, weightloss.height, weightloss.activity_level, weightloss.gender, weightloss.age FROM weightloss WHERE weightloss.user_id = ?";
//         $stmt = $this->connect()->prepare($sql);
//         $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
//         $stmt->execute(); 
//         $response = $stmt->fetch(PDO::FETCH_ASSOC);
//         return $response;
//     }
 }

?>