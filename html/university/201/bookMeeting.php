<?php 



	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

			

	<!-- CONTENT START -->

	

	<?php

		if(isset($_POST["theater"]) && isset($_POST["date"])){

			$un = $_SESSION['User'];

			

			$th = $_POST["theater"];

			$d = $_POST["date"];

			$patient = $_POST['patientID'];

			

			$staffid = singleSQL("SELECT StaffID FROM staff WHERE Username='$un'",$mysqli);

			$bookID = singleSQL("SELECT BookingID FROM bookings ORDER BY BookingID DESC LIMIT 1",$mysqli)+1;

			

			$g = runSQL("INSERT INTO bookings (TheaterID, BookingID,BookerID, Patient,StartTime) VALUES('$th',$bookID,$staffid,$patient,'$d')",$mysqli);

			

			if($g){

				echo 'Meeting Booked.';

			}else{ echo 'Something went wrong.'; }

		}else{

		

	?>



		<form action="./bookMeeting.php" method="post">

			Theater:

			<select name="theater">

				<?php

					$t = multiSQL("SELECT TheaterID, RoomType FROM theaters ORDER BY TheaterID DESC",$mysqli);

					

					while($rows = mysqli_fetch_array($t,MYSQLI_BOTH)){

						echo '<option value="'.$rows['TheaterID'].'">'.$rows['TheaterID']. " - ".$rows['RoomType'].'</option>';

					}

				?>

			</select><br><br>

			Patient:

			<select name="patientID">

			<?php

				$s = multiSQL("SELECT PatientNo, CONCAT(Firstname,' ',Lastname) as name FROM patients",$mysqli);

				

				while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){

					echo '<option value="'. $rows["PatientNo"] .'">' . $rows["PatientNo"] . ": " . $rows["name"] . '</option>';

				}

			?>

			</select>

			Date:

			<input name="date" type="date" maxlength="30" /><br>

			<input type="submit" value="Book Theater">

		</form>

	<?php } ?>

	

	<!-- CONTENT END -->





<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>