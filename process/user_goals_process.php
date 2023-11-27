<?php
session_start();

require_once "../classes/User.php";
require_once "../classes/Goal.php";
require_once "../utilities/sanitizer.php";
require_once "../classes/UserGoal.php";

    if(isset($_POST['submit'])){
    // Sanitize and validate 

    $user_id = $_POST["user_id"];
    $goal_id = $_POST["goal_id"];
    $user_height = $_POST["user_height"];
    $user_gender = $_POST["user_gender"];
    $user_dob = $_POST["user_dob"];
    $current_value = sanitizer($_POST["current_value"]);
    $target_value = sanitizer($_POST["target_value"]);
    $activity_level = $_POST["activity_level"];
    $start_date = $_POST["start_date"];
    $finish_date = $_POST["finish_date"];

   
    
        // Validate inputs
        if(empty($current_value) || empty($target_value) || empty($activity_level)){
            $_SESSION['weightloss_insert'] = "all fields are required";
            header("location:../user_goals.php");
            exit();     
        } else{

        function calculateDailyCaloricIntakeForWeightLoss($user_gender, $user_dob, $current_value, $user_height, $activity_level, $target_value){
            // Constants
            // echo "$current_value..current_value, $user_height..user_height i am here 2";
            // $current_value = (int)$current_value;
            // $user_height = (int)$user_height;
            // $answer= $current_value + $user_height;
            // echo $answer;
            $caloriesPerKgOfWeightLoss = 7700; // Calories required to lose 1kg of weight

            // Calculate BMR using the Mifflin-St Jeor formula or another appropriate formula
            $bmr = calc_Bmr($user_gender, $activity_level, $current_value, $user_height, $user_dob);
            
                
            // Calculate the total caloric deficit needed for the desired weight loss
            $totalCaloricDeficit = (int)$target_value * (int) $caloriesPerKgOfWeightLoss;
            // if (is_numeric($target_value) && is_numeric($caloriesPerKgOfWeightLoss)) {
            //     $totalCaloricDeficit = (int)$target_value * (int)$caloriesPerKgOfWeightLoss;
            // } elseif(is_numeric($target_value) || is_numeric($caloriesPerKgOfWeightLoss)) {
            //     $totalCaloricDeficit = (int)$target_value * (int)$caloriesPerKgOfWeightLoss;
            //     // Handle the case where one or both variables are not numeric
            //     // You might display an error message or set a default value, for example.
            // }
            

            // Determine the daily caloric intake required for weight loss
            $dailyCaloricIntakeForLoss = $bmr - ($totalCaloricDeficit / 30); // Assuming a 30-day month

            return $dailyCaloricIntakeForLoss;
        }

            // Example usage:
            $user_gender = $user_gender;          // Replace with the user's gender
            $user_dob = $user_dob;                 // Replace with the user's age
            $current_value = $current_value;          // Replace with the user's current weight in kilograms
            $user_height = $user_height;         // Replace with the user's height in centimeters
            $activity_level = $activity_level; // Replace with the user's activity level (e.g., sedentary, active)
            $target_value = $target_value; // Replace with the desired amount of weight loss in kilograms

            $dailyCaloricIntake = calculateDailyCaloricIntakeForWeightLoss($user_gender, $user_dob, $current_value, $user_height, $activity_level, $target_value);

            $_SESSION["success"] = "To achieve {$target_value}, aim for a daily caloric intake of approximately {$dailyCaloricIntake} calories.";
            
            //instantioate method to insert to database
                $usergoal = new UserGoal();
                $response = $usergoal->insert_user_goal($user_id, $goal_id, $current_value, $target_value, $activity_level, $start_date, $finish_date);
                
                if($response){
                    $_SESSION['goal_insert'] = "goal insert successful";
                    // header("location:../user_goals.php");
                    // exit();

                    $url = "user_goals.php?id=$goal_id";
                    header("location:../$url");
                    exit();
                }else{
                    $_SESSION['goal_insert'] = "error, unable to insert goal";
                    header("location:../user_goals.php");
                    exit();
                }   
            }
        } //end of if post isset

            function calc_Bmr($user_gender, $activity_level, $current_value, $user_height, $user_dob) {
                // Calculate BMR based on gender and activity level (you can customize this calculation)
                //calculate Basal Metabolic(BMR) using Mifflin-St Jeor formula
                //men: BMR = BMR = (10 × weight in kg) + (6.25 × height in cm) − (5 × age in years) + 5
                //women: BMR = (10 × weight in kg) + (6.25 × height in cm) − (5 × age in years) − 161
                //$bmr = "";
                echo $current_value = (int)$current_value;
                echo $user_height = (int)$user_height;
                if($user_gender == "male" && $activity_level == "sedantary") {
                    $result = (10 * $current_value) + (6.25 * $user_height) - (5 * $user_dob) + 5;
                    return $result;
                }elseif($user_gender == "male" && $activity_level == "active") {
                    $result = (10 * $current_value) + (6.25 * $user_height) - (5 * $user_dob) + 500;
                    return $result;
                }elseif($user_gender == "female" && $activity_level == "sedantary") {
                    $result = (10 * $current_value) + (6.25 * $user_height) - (5 * $user_dob) - 161;
                    return $result;
                }elseif($user_gender == "female" && $activity_level == "active") {
                    $result = (10 * $current_value) + (6.25 * $user_height) - (5 * $user_dob) + 161;
                    return $result;
                }
                

            //return $calc_Bmr();
        }

//     function date_difference($start_date, $finish_date) {
//         // Create DateTime objects for the start_date and finish_date
//         $start_date = new DateTime($start_date);
//         $finish_date = new DateTime($finish_date);
//         $currentDateTime = new DateTime();

//         if ($start_date <= $currentDateTime) {
//             // Calculate the difference between the current date and $finish_date
//             $interval = $currentDateTime->diff($finish_date);
//         } else {
//             // Calculate the difference between $start_date and $finish_date
//             $interval = $start_date->diff($finish_date);
//         }

//         // Return the difference as an array with days, hours, minutes, and seconds
//         return array(
//             'days' => $interval->days,
//             'hours' => $interval->h,
//             'minutes' => $interval->i,
//             'seconds' => $interval->s
//         );
// }


?>


