<?php
include "Db.php";

class Hydration extends Db{

	public function insert_hydration($user_id, $goal_id, $target_water, $gender, $waking_hour){
      
      //HYDRATION
        $sql = "INSERT INTO hydration(user_id, goal_id, target_water) VALUES(?,?,?)";

          $stmt = $this->connect()->prepare($sql);
          $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
          $stmt->bindParam(2, $goal_id, PDO::PARAM_INT);
          $stmt->bindParam(3, $target_water, PDO::PARAM_STR);
          
          $response = $stmt->execute();
          if($response){
            $_SESSION['hydration_insert'] = "hydration insert successful";
              return true;
          }else{
            $_SESSION['hydration_insert'] = "error, unable to insert hydration";
            return false;
          }
    }
}
?>