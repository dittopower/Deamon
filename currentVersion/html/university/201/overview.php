<?php 

	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

	

	<!-- CONTENT START -->

		



		

		<h2 style="display: inline;">Overview</h2>

		

			

			<?php 

				$t = multiSQL("SELECT Operation, count(*) as Num, sum(MoneyOwed) as Total, OperationCost as cost from patientfinancial f join prices p on f.OperationID = p.OperationID group by f.OperationID",$mysqli);

				echo '<p>&nbsp;</p><br><hr><h3>Finnancial</h3>';

				if($t->num_rows !== 0){

					

					echo '<table >';

					

					echo '<tr><th>Procedure</th><th>Total Operations</th><th>Cost</th><th>Oustanding Fees</th></tr>';

					$tot2 = 0;

					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){

						

						echo '<tr>';

						

						echo '<td>'.$row['Operation'].'</td>';

						echo '<td>'.$row['Num'].'</td>';

						$cost = $row['cost'] * $row['Num'];

						echo '<td>$'.$cost.'</td>';

						$tot2 += $cost;

						echo '<td>$'.$row['Total'].'</td>';

						

						echo '</tr>';

					}

					$tot = singleSQL("SELECT sum(MoneyOwed) FROM patientfinancial",$mysqli);

					echo '<tr><td></td><td style="text-align:right;">Total:</td><td>$'.$tot2.'</td><td>$'.$tot.'</td></tr>';

					echo '</table>';

				}else{

					echo 'No Finnancial Records Found';

				}

			?>

			

			

			<?php 

				$t = multiSQL("SELECT WardID, count(*) as Total, count(medicare) as Medicare, count(insurance) as Private from patients p left join patientlocation l on p.patientNo = l.patientNo group by l.WardID",$mysqli);

				echo '<p>&nbsp;</p><br><hr><h3>Patients</h3>';

				if($t->num_rows !== 0){

					

					echo '<table >';

					

					echo '<tr><th>Ward</th><th>Total</th><th>Total Medicare</th><th>Total Private Insurance</th></tr>';

					

					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){

						

						echo '<tr>';

						

						echo '<td>'.$row['WardID'].'</td>';

						echo '<td>'.$row['Total'].'</td>';

						echo '<td>'.$row['Medicare'].'</td>';

						echo '<td>'.$row['Private'].'</td>';

						

						echo '</tr>';

					}

					$tot = singleSQL("SELECT count(*) from patients",$mysqli);

					$tot2 = singleSQL("SELECT count(*) from patients where medicare is not null",$mysqli);

					$tot3 = singleSQL("SELECT count(*) from patients where insurance is not null",$mysqli);

					echo '<tr><td style="text-align:right;">Total:</td><td>'.$tot.'</td><td>'.$tot2.'</td><td>'.$tot3.'</td></tr>';

					echo '</table>';

				}else{

					echo 'No Patient Records Found';

				}

			?>

			

			

			<?php 

				$t = multiSQL("SELECT PrescriptionName, count(*) as Total, ROUND(avg(Amount),1) as Amount, Round(avg(Price),2)as Price from prescriptions group by PrescriptionName order by PrescriptionName ASC",$mysqli);

				echo '<p>&nbsp;</p><br><hr><h3>Prescriptions</h3>';

				if($t->num_rows !== 0){

					

					echo '<table >';

					

					echo '<tr><th>Prescription</th><th>No. Patients</th><th>AVG. Amount</th><th>Price for Amount</th></tr>';

					$tot2 = 0;

					$tot3 = 0;

					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){

						

						echo '<tr>';

						

						echo '<td>'.$row['PrescriptionName'].'</td>';

						echo '<td>'.$row['Total'].'</td>';

						echo '<td>'.$row['Amount'].'</td>';

						$tot2 += $row['Amount'];

						echo '<td>$'.$row['Price'].'</td>';

						$tot3 += $row['Price'];

						

						echo '</tr>';

					}

					$tot = singleSQL("SELECT count(*) from prescriptions",$mysqli);

					echo '<tr><td style="text-align:right;">Total:</td><td>'.$tot.'</td><td>'.$tot2.'</td><td>'.$tot3.'</td></tr>';

					echo '</table>';

				}else{

					echo 'No Prescription Records Found';

				}

			?>

			

			

			<?php 

				$t = multiSQL("SELECT TheaterID, count(Patient) as patients, count(BookerID) as staff FROM bookings group by TheaterID",$mysqli);

				echo '<p>&nbsp;</p><br><hr><h3>Theaters</h3>';

				if($t->num_rows !== 0){

					

					echo '<table>';

					

					echo '<tr><th>Theater</th><th>No. Patients Booked</th><th>Staff Booked</th></tr>';

					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){

						

						echo '<tr>';

						

						echo '<td>'.$row['TheaterID'].'</td>';

						echo '<td>'.$row['patients'].'</td>';

						echo '<td>'.$row['staff'].'</td>';

						

						echo '</tr>';

					}

					$tot = singleSQL("SELECT count(Patient) from bookings",$mysqli);

					$tot2 = singleSQL("SELECT count(BookerID) from bookings",$mysqli);

					echo '<tr><td style="text-align:right;">Total:</td><td>'.$tot.'</td><td>'.$tot2.'</td></tr>';

					echo '</table>';

				}else{

					echo 'No Booking Records Found';

				}

			?>





			<?php 

				echo '<p>&nbsp;</p><br><hr><h3>X-rays</h3>';

				$tot = singleSQL("SELECT count(*) FROM bookings b join theaters t on b.TheaterID = t.TheaterID where RoomType = 'X-ray Scan' group by b.TheaterID",$mysqli);

				$tot2 = singleSQL("SELECT count(*) from xray",$mysqli);

				$tot3 = singleSQL("Select count(distinct Patient) from (SELECT PatientID as Patient FROM xray union all SELECT Patient FROM bookings b join theaters t on b.TheaterID = t.TheaterID where RoomType = 'X-ray Scan') p",$mysqli);

					

				echo '<table>';

				echo '<tr><th>Booked</th><th>Completed</th><th>No. Different Patients</th></tr>';

				echo '<tr>';

				echo '<td>'.$tot.'</td>';

				echo '<td>'.$tot2.'</td>';

				echo '<td>'.$tot3.'</td>';				

				echo '</tr>';

				echo '</table>';

				

			?>



			

			

		<div class="clear h20"></div>

	<!-- CONTENT END -->



<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>

	

