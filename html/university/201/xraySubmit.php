<?php 



	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

            

	<!-- CONTENT START -->

	<center>

		<?php if(isset($_FILES["xrayImage"]["name"]) && isset($_POST["patientID"])){/* etc */

		

			$patientID = $_POST["patientID"];

			$user = $_SESSION['User'];

			

			//get the staffid of the user

			$StaffID = singleSQL("SELECT StaffID FROM staff WHERE Username='" . $user . "'", $mysqli);

			

			//get the next image ID

			$newID = singleSQL('SELECT XrayFileId FROM xray ORDER BY XrayFileId DESC LIMIT 1', $mysqli) + 1;

		

			$originalFile = $_FILES["xrayImage"]["name"];

			$dot = explode('.', $originalFile);

			$extension = end($dot);

			$fileName = $StaffID . "-" . $patientID . "-" . $newID . "-xray." . $extension;

			$newPath = "./xrays/" . $fileName;

			move_uploaded_file($_FILES["xrayImage"]["tmp_name"], $newPath);

			

			$opID = "xray001";

			$cost = singleSQL("SELECT OperationCost FROM prices where OperationID = '$opID' ORDER BY OperationCost DESC LIMIT 1", $mysqli);

			$fee = runSQL("INSERT INTO patientfinancial (billID, PatientID, OperationID, MoneyOwed) VALUES('xray-$newID', $patientID,'$opID','$cost')", $mysqli);

			

			$sql="INSERT INTO xray (XrayFileId, Xray, PatientID, StaffID, XrayDate) VALUES($newID,'$fileName',$patientID,$StaffID,CURRENT_TIMESTAMP())";

			/* Need to find real values */

			if(mysqli_query($mysqli,$sql)){ echo 'Finished upload.'; }

			else { echo 'Everything is broken. ' . $sql; }

		

		} else { ?>

			<form action='xraySubmit.php' method='post' enctype="multipart/form-data" id="contact_form">

				<label>Patient:</label>

				<select name="patientID">

				<?php

				

					$s = multiSQL("SELECT PatientNo, CONCAT(Firstname,' ',Lastname) as name FROM patients",$mysqli);

					

					while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){

						echo '<option value="'. $rows["PatientNo"] .'">' . $rows["PatientNo"] . ": " . $rows["name"] . '</option>';

					}

				

				?>

				</select>

				<br>

				<label>X-Ray Image</label><input type="file" name="xrayImage"><br>

				

				<input type="submit" value="Upload">

				

			</form>

		<?php } ?>

	</center>

	

	<!-- CONTENT END -->



<?php } else { include 'permissionDenied.html'; } ?>

	<?php include 'footer.php'; ?>

