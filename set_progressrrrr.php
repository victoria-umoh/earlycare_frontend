<?php
require_once "partials/earlycarenav.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = new DateTime($_POST["start_date"]);
        $end_date = new DateTime($_POST["end_date"]);

        // Create a table header row with day names
        echo "<table border='1'><tr><th>Date</th><th>Day</th></tr>";

        // Loop through the range of dates
        $interval = new DateInterval('P1D'); // 1 day interval
        $date_range = new DatePeriod($start_date, $interval, $end_date);
        foreach ($date_range as $date) {
            $date_formatted = $date->format('Y-m-d'); // Change the date format as needed
            $day_name = $date->format('l'); // Get the day name

            // Create a table row for each date
            echo "<tr><td>$date_formatted</td><td>$day_name</td></tr>";
        }

        // Close the table
        echo "</table>";
    }


?>
<div class="container-fluid">
	<div class="row mt-5">
		<form method="POST">
			<div class="col-md-2">
				<label>Goal start date</label>
				<input type="date" name="start_date" class="form-control" required>
			</div>
			<div class="col-md-2">
				<label>Goal end date</label>
				<input type="date" name="end_date" class="form-control" required>
			</div>
			<input type="submit" value="Set Progress">
		</form>
	</div>
	<div class="row">
		<div class="col">
			<table class="table table-striped table-bordered mt-5" style="border:2px solid black">
				<thead>
					<tr>
						<th scope="col"><label>Days</th>
						<th scope="col"><label for="">Physical activity, including both cardio and strength training.</label></th>
						<th scope="col"><label for="">300-350 caloric Reduction</label></th>
						<th scope="col"><label for="">Ate either vegetables, lean protein, or whole grains.</label></th>
						<th scope="col"><label>% goal achieved</label></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="col"><?php echo $day_name .'-'. $date_formatted ; ?></td>
						<td>
							<label>Yes</label>
							<input type="checkbox" name="progress">
							<label>No</label>
							<input type="checkbox" value="No">
						</td>
						<td>                        	
                        	<label>Yes</label>
							<input type="checkbox" value="Yes">
							<label>No</label>
							<input type="checkbox" value="No">
						</td>
						<td>
	                        <label for="yes">Yes</label>
							<input type="checkbox" value="Yes">
							<label for="no">No</label>
							<input type="checkbox" value="No">
						</td>
						<!-- <td>
                        	<label>Yes</label>
							<input type="checkbox" value="Yes">
							<label>No</label>
							<input type="checkbox" value="No">
						</td> -->
						<td>
							<div class="progress" style="height: 20px;">
								<div class="progress-bar" role="progressbar" <?php echo $style;  ?> aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

         
		<?php $style =  "style = 'width : 10%;' "?>
		
	</div>
</div>

    <script src="assets/scripts/jquery.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){
        var score = 0
             $("#check1").click(function() {
                if ($(this).prop("checked")) {
                    score += 20;
                } else {
                    score -= 20;
                }
                updateScore();
                //alert("Score: " + score);
            });

            $("#check2").click(function() {
                if ($(this).prop("checked")) {
                    score += 40; // Add 40 when Checkbox 2 is checked
                } else {
                    score -= 40; // Subtract 40 when Checkbox 2 is unchecked
                }
                updateScore();
                //alert("Score: " + score);
            });

            $("#check3").click(function() {
                if ($(this).prop("checked")) {
                    score += 40; // Add 40 when Checkbox 3 is checked
                } else {
                    score -= 40; // Subtract 40 when Checkbox 3 is unchecked
                }
                updateScore();
                //("Score: " + score);
            });

            function updateScore() {
                $("#para").text("Score: " + score);
            }

        })
    </script>

<?php include "partials/earlycarefooter.php"; ?>
