<?php
session_start(); // Start the session
require_once "../classes/Hydration.php";

include "../utilities/sanitizer.php";


if ($_POST) {
    if (isset($_POST['submit_btn'])) {
        $user_id = $_POST["user_id"];
        $goal_id = $_POST["goal_id"];
        $gender = sanitizer($_POST["gender"]);
        $target_water = sanitizer($_POST['target_water']);
        $wakingHours = sanitizer($_POST['waking_hour']);

        // Validate target_water and gender here
        if(!isset($gender)){
            $_SESSION['hydration_msg'] = "All fields are required";
            header("location:../hydration.php");
            exit();
        }elseif(empty($target_water) || empty($wakingHours)) {
            $_SESSION['hydration_msg'] = "All fields are required";
            header("location:../hydration.php");
            exit();
        }else{
            function calculateWaterIntakePerHour($totalDailyIntakeCups, $wakingHours, $gender) {
                $totalDailyIntakeCupsPerDay = 16; //cups of water in 24 hr
                if ($wakingHours <= 0) {
                    return 0;
                }


                if ($gender == "male") {
                    $waterIntakePerHour = $totalDailyIntakeCupsPerDay / $wakingHours;
                } elseif ($gender == "female") {
                    $waterIntakePerHour = $totalDailyIntakeCupsPerDay / $wakingHours;
                } else {
                    $waterIntakePerHour = 0; // Handle other gender options or invalid input
                }

                return $waterIntakePerHour;
            }

            $totalDailyIntakeCupsMen = 15.5;
            $totalDailyIntakeCupsWomen = 11.5;
            $wakingHoursMen = 24; // 24 waking hours in a day

            $waterIntakePerHourMen = calculateWaterIntakePerHour($totalDailyIntakeCupsMen, $wakingHoursMen, $gender);

            // Format the result for better display
            $formattedResult = "For {$gender}: Water intake per hour is approximately {$waterIntakePerHourMen} cups per hour";

            // Instantiate method to insert into the database (uncomment this part)
            $water = new Hydration();
            $waters = $water->insert_hydration($user_id, $goal_id, $target_water, $gender, $waking_hour);

            if ($waters) {
                $_SESSION['hydration_insert'] = "Weight loss insert successful";
                header("location:../hydration_view.php");
                exit();
            } else {
                $_SESSION['hydration_insert'] = "Error, unable to insert weight loss";
                header("location:../hydration_view.php");
                exit();
            }
        }
    }
}


// function calc_Bmr($gender, $target_water, $wakingHours) {
//         // Calculate BMR based on gender and activity level (you can customize this calculation)
//         //calculate Basal Metabolic(BMR) using Mifflin-St Jeor formula
//         //men: BMR = BMR = (10 × weight in kg) + (6.25 × height in cm) − (5 × age in years) + 5
//         //women: BMR = (10 × weight in kg) + (6.25 × height in cm) − (5 × age in years) − 161
//         //$bmr = "";
//         if($gender == "male" && $wakingHours == $wakingHours) {
//             return (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
//         }elseif($gender == "male" && $activity_level == "active") {
//             return (10 * $weight) + (6.25 * $height) - (5 * $age) + 500;
//         }elseif($gender == "female" && $activity_level == "sedantary") {
//             return (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
//         }elseif($gender == "female" && $activity_level == "active") {
//             return (10 * $weight) + (6.25 * $height) - (5 * $age) + 161;
//         }
        

//     //return $bmr;
// }
?>
