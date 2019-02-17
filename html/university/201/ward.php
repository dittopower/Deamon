<?php 

	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

			<!-- CONTENT START -->

			<?php

			if(isset($_POST['delID'])){

				$del = $_POST['delID'];

				$h = runSQL("DELETE FROM patientlocation WHERE PatientNo=$del",$mysqli);

				

				echo 'Patient ' . $del . ' released.';

				

			} else{ ?>

			

				<table>

					<tr>

					<th>Patient Number</th>

					<th>Patient Name</th>

					<th>Doctor ID</th>

					<th>Ward</th>

					<th>Time Entered (y-d-m)</th>

					<th></th>

					</tr>

					<?php

						$s = multiSQL("SELECT patientlocation.PatientNo, CONCAT(patients.Firstname,' ',patients.Lastname) as name, patientlocation.DoctorID, patientlocation.WardId, patientlocation.EnterTime

							FROM patientlocation

							LEFT JOIN patients

							ON patients.PatientNO=patientlocation.PatientNo ORDER BY WardId",$mysqli);

							

						while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){

							echo '

							<tr>

								<td>'.$rows['PatientNo'].'</td>

								<td>'.$rows['name'].'</td>

								<td>'.$rows['DoctorID'].'</td>

								<td>'.$rows['WardId'].'</td>

								<td>'.$rows['EnterTime'] . '</td>

								<td><form action="./ward.php" method="post"><input type="hidden" name="delID" value="' . $rows['PatientNo'] . '"><input id="rem" type="submit" value="Remove"></form></td>

							</tr>';

						}

					?>

				</table>

				<?php } ?>

			<!-- CONTENT END -->



<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>