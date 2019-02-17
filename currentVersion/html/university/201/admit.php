<?php

	if(checkFilePermission(__FILE__, $mysqli)){

		$id = $_GET['id'];

		$t = singleRowSQL("SELECT WardID,DoctorID FROM patientlocation WHERE PatientNo='$id'",$mysqli);

		if($t == 0){ ?>

	

			<h2>Admit Patient</h2>

			<form action="./patient.php" method="post">

				<label>Ward:</label>

				<select name="ward">

				<?php

				

					$s = multiSQL("SELECT WardID FROM wards",$mysqli);

					

					while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){

						echo '<option value="'. $rows["WardID"] .'">' . $rows["WardID"] . '</option>';

					}

				

				?>

				</select><br><br>

				<label>Doctor:</label>

				<select name="doctor">

				<?php

				

					$s = multiSQL("SELECT CONCAT(Firstname,' ',Lastname) AS name, StaffID FROM staff WHERE Stafftype='Doctor'",$mysqli);

					

					while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){

						echo '<option value="'. $rows["StaffID"] .'">' . $rows["name"] . '</option>';

					}

				

				?>

				</select><br><br>

				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

				<input type="submit" value="Admit Patient">

			</form>

	<?php }else{ ?>

		

		<hr><h2>Patient Location</h2>

		Patient is in ward: <b><u><?php echo $t[0]; ?></u></b><br>

		Doctor assigned: <b><u><?php echo $t[1]; ?></u></b>

		

	<?php } }?>