<?php
require_once "Db.php";
class PlanCategory extends Db{

        //FETCH ALL CATEGORY
    public function fetch_category(){
            $sql = "SELECT * FROM plan_category";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }
    
        //ADD CATEGORY
    public function add_category($plan_cat_title, $plan_cat_desc){
        $sql = "INSERT INTO plan_category(plan_cat_title, plan_cat_desc) VALUES(?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt -> bindParam(1, $plan_cat_title, PDO::PARAM_STR);
            $stmt -> bindParam(2, $plan_cat_desc, PDO::PARAM_STR);
            $response = $stmt->execute();
                if($response){
                    $_SESSION['category_msg'] = "Category successfully Added";
                    return true;
                }else{
                    $_SESSION['category_msg'] = "Unable to Add Category";
                     return false;
                }
        }

    

        //UPDATE CATEGORY
    public function update_category($plan_cat_title, $plan_cat_desc, $plan_cat_id){
            $sql = "UPDATE plan_category SET plan_cat_title=?,plan_cat_desc=? WHERE plan_cat_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $plan_cat_title, PDO::PARAM_STR);
            $stmt->bindParam(2, $plan_cat_desc, PDO::PARAM_STR);
            $stmt->bindParam(3, $plan_cat_id, PDO::PARAM_INT);

            $cat_updated = $stmt->execute();
                if($cat_updated){
                    $_SESSION['cat_edit_msg'] = "Category update successful";
                    return true;
                }else{
                    $_SESSION['cat_edit_msg'] = "Unable to update Category";
                    return false;
                }
    }

        //DELETE CATEGORY
    public function delete_category($plan_cat_id){
        $sql = "DELETE FROM plan_category WHERE plan_cat_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $plan_cat_id, PDO::PARAM_INT);
            $deleted = $stmt->execute();
            return $deleted;
    }

        //FETCH CATEGORY DETAIL
    public function get_category_detail($plan_cat_id){
            $sql = "SELECT * FROM plan_category WHERE plan_cat_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->bindParam(1, $plan_cat_id, PDO::PARAM_INT);
                $stmt->execute();

                $count = $stmt->rowCount();      //count how many recoreds with the id
                if($count < 1) {                //if count is less than 1, no record with that id
                    return false;
                }else{
                    //It means d book exist, fetch it with d fetch function()
                    $cat = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $cat;
                }
    }

    public function get_price_detail($cat_price_id){
        $sql = "SELECT * FROM price WHERE cat_price_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $cat_price_id, PDO::PARAM_INT);
            $stmt->execute();

            $count = $stmt->rowCount();      //count how many recoreds with the id
            if($count < 1) {                //if count is less than 1, no record with that id
                return false;
            }else{
                //It means d book exist, fetch it with d fetch function()
                $cat = $stmt->fetch(PDO::FETCH_ASSOC);
                return $cat;
            }
}
}

// $price1 = new PlanCategory();
// $response = $price1->get_price_detail(4);
// print_r($response);
// ADD CATEGORY TEST
//  $cat = new Category();
// $categories = $cat->add_category("Exercise & Fitness", "100 days of Exercise");
// echo "<pre>";
// print_r($categories);
// echo "</pre>";


// print_r($cat->fetch_Category($plan_cat_id));









?>