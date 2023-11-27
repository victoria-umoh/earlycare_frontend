<?php
require_once "../classes/PlanCategory.php";

if($_POST){
    $fixedamount = $_POST['xyz'];
    //echo $fixedamount;
    //die();

    $price1 = new PlanCategory();
    $response = $price1->get_price_detail($fixedamount);
    //print_r($response);
    echo $response['price_name'];

    //ajax does not obey header("")
    //ajax validation isntead of saying die(), use return true or false
}
?>