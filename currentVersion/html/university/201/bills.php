<?php 

	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

	

	<!-- CONTENT START -->

		

		<?php	



		$rows = singleRowSQL("SELECT billID, Firstname, Lastname, MoneyOwed, Operation, OperationCost, Rebate, medicare is not null as eligable FROM patientfinancial f natural join prices c join patients p on f.patientID = p.PatientNo where billID = '". $_GET['id']."'" ,$mysqli);

		

		?>

		

		<h2>Bill: <?php echo $rows['billID']; ?></h2>

		

		<?php

			

			echo '<table>

				<tr><td class="leftc">Patient:</td><td>'.$rows['Firstname'].$rows['Lastname'].'</td></tr>

				<tr><td class="leftc">Bill for:</td><td>'.$rows['Operation'].'</td></tr>

				<tr><td class="leftc">Bill ID</td><td>'.$rows['billID'].'</td></tr>

				<tr><td class="leftc">Total Amount:</td><td>$'.$rows['OperationCost'].'</td></tr>

				<tr><td class="leftc">Payment Due:</td><td>$'.$rows['MoneyOwed'].'</td></tr>';

			if ($rows['eligable']){

				echo '<tr><td class="leftc">Available Rebate Amoumt:</td><td>$'.$rows['Rebate'].'</td></tr>';

			}else{

				echo '<tr><td class="leftc">Available Rebate Amoumt:</td><td>No Rebate Available</td></tr>';

			}

			echo '</table>';

				

		?>

				

			<br><br>

			

	<!-- CONTENT END -->



<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>

	

