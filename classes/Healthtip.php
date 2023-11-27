<?php
require_once "Db.php";

class Healthtip extends Db{
		//ADD HEALTHTIP
	public function add_healthtip($category_id, $healthtips_title, $healthtips_description, $cover_image, $healthtips_article){
	    $sql = "INSERT INTO healthtips(category_id, healthtips_title, healthtips_description, cover_image)
	    VALUES(?,?,?,?)";
		    $stmt = $this->connect()->prepare($sql);
		    $stmt->bindParam(1, $category_id, PDO::PARAM_INT);
		    $stmt->bindParam(2, $healthtips_title, PDO::PARAM_STR);
		    $stmt->bindParam(3, $healthtips_description, PDO::PARAM_STR);
		    $stmt->bindParam(4, $cover_image, PDO::PARAM_STR);    
		    $response = $stmt->execute();
		    //return $response;

			    if($response){
			    	$_SESSION['tips'] = "Healthtip added successfully";
			        return true;
			    }else{
			    	$_SESSION['tips'] = "Unable to add Healthtip";
			        return false;
			    }
		}
	

		//FETCH ALL HEALTHTIPS
	public function fetch_all_healthtips(){
		$sql = "SELECT * FROM healthtips";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$all_health_tips = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $all_health_tips;
		
	}

		//FETCH HEALTHTIPS DETAIL
	public function fetch_healthtip_detail($healthtips_id){
		$sql = "SELECT * FROM healthtips WHERE healthtips_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(1, $healthtips_id, PDO::PARAM_INT);
		$stmt->execute();

		$healthtips_count = $stmt->rowCount();
			if ($healthtips_count < 1) {
				return false;
			}else{
				$response = $stmt->fetch(PDO::FETCH_ASSOC);
				return $response;
			}
	}

		//UPDATE HEALTHTIPS
	public function update_healthtip($healthtips_title, $healthtips_description, $healthtips_id){
		$sql = "UPDATE healthtips SET healthtips_title=?,healthtips_description=? WHERE healthtips_id=?";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(1, $healthtips_title, PDO::PARAM_STR);
			$stmt->bindParam(2, $healthtips_description, PDO::PARAM_STR);
			$stmt->bindParam(3, $healthtips_id, PDO::PARAM_INT);

			$healthtips_updated = $stmt->execute();
				if ($healthtips_updated){
					$_SESSION["edit_healthtips"] = "Health-tips updated successfully";
					return true;
				}else{
					$_SESSION["edit_healthtips"] = "error, health-tips update failed";
					return false;
				}
	}

		//DELETE HEALTHTIP
	public function delete_healthtip($healthtips_id){
	    $sql = "DELETE FROM healthtips WHERE healthtips_id=?";
		       $stmt = $this->connect()->prepare($sql);
		       $stmt->bindParam(1, $healthtips_id, PDO::PARAM_INT);
		        
		        $healthtips_deleted = $stmt->execute();
		        
		        if ($healthtips_deleted) {
		        	//$_SESSION["deleted_healthtip"] = "healthtip deleted successfully";
		            //return true;
		        } else{
		        	//$_SESSION["deleted_healthtip"] = "unable to delete healthtip";
		           // return false;
		        }
		        return $healthtips_deleted;
		    
	}

}
//ADD HEALTHIP TEST
// $health = new Healthtip();
// $healths = $health->add_healthtip(9, "Aging gracefully", "Aging like fine wine", "hello.png");
// echo "<pre>";
// print_r($healths);
// echo "<pre>";

//FETCH ALL HEALTHIP TEST
// $health = new Healthtip();
// $healths = $health->fetch_all_healthtips();
// echo "<pre>";
// print_r($healths);
// echo "<pre>";

//FETCH HEALTHIP TEST
//$health = new Healthtip();
// $healths = $health->fetch_healthtip(2);
// echo "<pre>";
// print_r($healths);
// echo "<pre>";

//UPDATE HEALTHIP TEST
// $health = new Healthtip();
// $healths = $health->update_healthtip("benefits", "importance of drinking", "oldddd.jpg", 70);
// if($healths){
// 	echo "is there";
// }else{
// 	echo "is not there";
// }
//echo $healths;
// echo "<pre>";
// print_r($healths);
// echo "<pre>";

//DELETE HEALTHIP TEST
// $health = new Healthtip();
// $healths = $health->delete_healthtip(2);
// echo "<pre>";
// print_r($healths);
// echo "<pre>";
// ?>

