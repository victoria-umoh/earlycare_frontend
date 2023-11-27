<?php


class DateDiff{

    // TIMME DIFFERENCE FUNCTION
    function date_difference($start_date, $finish_date) {
        // Create DateTime objects for the start_date and finish_date
        $start_date = new DateTime($start_date);
        $finish_date = new DateTime($finish_date);
        $currentDateTime = new DateTime();
            if ($start_date <= $currentDateTime) {
                // Calculate the difference between the current date and $finish_date
                $interval = $currentDateTime->diff($finish_date);
            } else {
                // Calculate the difference between $start_date and $finish_date
                $interval = $start_date->diff($finish_date);
            }
                // Return the difference as an array with days, hours, minutes, and seconds
        $timedifference =  array(
            'days' => $interval->days,
            'hours' => $interval->h,
            'minutes' => $interval->i,
            'seconds' => $interval->s
        );
        return $timedifference;
    }

}
?>