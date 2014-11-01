<?php 
	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
	
	<!-- CONTENT START -->
		
		<?php	
		
		if(isset($_GET['id']) && isset($_POST['PatientNo']) && isset($_POST['Firstname']) && isset($_POST['Lastname']) && isset($_POST['sex']) && isset($_POST['dob']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['medicare']) && isset($_POST['insurance']) && isset($_POST['Notes'])){
			
			$id = $_GET['id'];
			
			$pn = $_POST['PatientNo'];
			$fn = $_POST['Firstname'];
			$ln = $_POST['Lastname'];
			$gender = $_POST['sex'];
			$dateofbirth = $_POST['dob'];
			$add = $_POST['address'];
			$ph = $_POST['phone'];
			$em = $_POST['email'];
			$med = $_POST['medicare'];
			$insur = $_POST['insurance'];
			$not = $_POST['Notes'];
			
			$sql = "UPDATE 201_patients SET Lastname='$ln',Firstname='$fn',Sex='$gender',Notes='$not', dob='$dateofbirth', address='$add',phone='$ph', email='$em', medicare='$med', insurance='$insur' WHERE PatientNo=$id";
			
			$check = runSQL($sql,$mysqli);
			echo '<center>';
			if($check){
				echo 'Patient Details Updated.';
			} else { echo 'Patient details not updated. Try again.'; }
			echo '<br></center>';
		}//updating user details
		
		if(isset($_POST['ward']) && isset($_POST['doctor']) && isset($_POST['id'])){
			$w = $_POST['ward'];
			$d = $_POST['doctor'];
			$id = $_POST['id'];
			
			$numUsed = singleSQL("SELECT COUNT(*) FROM 201_patientlocation WHERE WardID='$w'",$mysqli);
			
			$numAvail = singleSQL("SELECT NoOfBeds FROM 201_wards WHERE WardID='$w'",$mysqli);
			
			$wardd = multiSQL("SELECT PatientNo FROM 201_patientlocation WHERE PatientNo=$id",$mysqli);
			
			if($wardd->num_rows === 0){
				if(($numAvail - $numUsed) > 0){					
					if(runSQL("INSERT INTO 201_patientlocation (PatientNo, DoctorID, BedNo, WardId) VALUES($id, $d, 0, '$w')",$mysqli)){
						echo 'Patient ' . $id . ' added to ward ' . $w . '.';
						
						$opID = "WardBed01";
						$cost = singleSQL("SELECT OperationCost FROM 201_prices where OperationID = '$opID' ORDER BY OperationCost DESC LIMIT 1", $mysqli);
						$numward = singleSQL("SELECT count(billID)+1 as num FROM 201_patientfinancial WHERE billID like 'ward%'",$mysqli);
						$fee = runSQL("INSERT INTO 201_patientfinancial (billID, PatientID, OperationID, MoneyOwed) VALUES('ward-$numward', $id,'$opID','$cost')", $mysqli);
						
					} else { echo 'Something went wrong.'; }
				}
				else{
					echo 'This ward is full, try another.';
				}
			} else { echo 'Patient is already in a ward, remove them from that one first.'; }
		}else{
			$rows = singleRowSQL("SELECT PatientNo, Notes, Firstname, Lastname, sex, email, dob, phone, address, medicare, insurance FROM 201_patients WHERE PatientNo=". $_GET['id'] ,$mysqli);
		?>
		
		<h2 style="display: inline;"><?php echo $rows['Firstname'] . " " . $rows['Lastname']; ?></h2>
		<?php searchbox(); ?>
		
		<?php
			
			echo '<table id="patientDetails"><form method="post" action="patient.php?id='.$_GET['id'].'">
				<tr><td class="leftc">Patient Number</td><td><input name="PatientNo" type="text" value="'.$rows['PatientNo'].'"></td></tr>
				<tr><td class="leftc">First Name</td><td><input name="Firstname" type="text" value="'.$rows['Firstname'].'"></td></tr>
				<tr><td class="leftc">Lastname</td><td><input name="Lastname" type="text" value="'.$rows['Lastname'].'"></td></tr>
				<tr><td class="leftc">Gender</td><td><input name="sex" type="text" value="'.$rows['sex'].'"></td></tr>
				<tr><td class="leftc">Date of birth</td><td><input name="dob" type="text" value="'.date('d M Y', strtotime($rows['dob'])).'"></td></tr>
				<tr><td class="leftc">Address</td><td><input name="address" type="text" value="'.$rows['address'].'"></td></tr>
				<tr><td class="leftc">Phone</td><td><input name="phone" type="text" value="'.$rows['phone'].'"></td></tr>
				<tr><td class="leftc">Email</td><td><input name="email" type="text" value="'.$rows['email'].'"></td></tr>
				<tr><td class="leftc">Medicare</td><td><input name="medicare" type="text" value="'.$rows['medicare'].'"></td></tr>
				<tr><td class="leftc">Insurance</td><td><input name="insurance" type="text" value="'.$rows['insurance'].'"></td></tr>
				<tr><td class="leftc">Notes</td><td><textarea name="Notes">'.$rows['Notes'].'</textarea></td></tr>
				</table>';
				
				echo '<center><br><input type="submit" value="Save Changes"></form></center>'
				
				?>
				
			<br><br>
			
			<?php include 'admit.php'; ?>
			
			<?php 
				$id = $_GET['id'];
				$t = multiSQL("SELECT BillID, Operation, MoneyOwed FROM 201_prices p join 201_patientfinancial f on p.OperationID = f.OperationID where patientID = $id",$mysqli);
				echo '<p>&nbsp;</p><br><hr><h2>Bills</h2>';
				if($t->num_rows !== 0){
					
					echo '<table id="patient_list">';
					
					echo '<tr><th>Bill ID</th><th>Operation Type</th><th>Remaining Payment</th></tr>';
					
					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){
						
						echo '<tr onclick=\'window.location="./bills.php?id='.$row['BillID'].'"\'>';
						
						echo '<td>'.$row['BillID'].'</td>';
						echo '<td>'.$row['Operation'].'</td>';
						echo '<td>$'.$row['MoneyOwed'].'</td>';
						
						echo '</tr>';
					}
					$tot = singleSQL("SELECT sum(MoneyOwed) as total FROM 201_patientfinancial where PatientID = '$id'",$mysqli);
					echo '<tr><td></td><td style="text-align:right;">Total:</td><td>$'.$tot.'</td></tr>';
					echo '</table>';
				}else{
					echo 'This Patient has no Bills';
				}
			
			?>
			
			<?php include 'prescription.php'; ?>
			
			<?php 
				$id = $_GET['id'];
				$t = multiSQL("SELECT XrayFileID, Xray,XrayDate, StaffID FROM 201_xray WHERE PatientID='$id' ORDER BY XrayDate DESC",$mysqli);
				
				if($t->num_rows !== 0){
					
					echo '<p>&nbsp;</p><br><hr><h2>Xrays</h2><table id="patient_list">';
					
					echo '<tr><th>Xray #</th><th>Date</th><th>Scanned in by staff #</th><th>Preview</th></tr>';
					
					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){
						
						echo '<tr onclick=\'window.location="./xrays/'.$row['Xray'].'"\'>';
						
						echo '<td>'.$row['XrayFileID'].'</td>';
						echo '<td>'.date('d M Y', strtotime($row['XrayDate'])).'</td>';
						echo '<td>'.$row['StaffID'].'</td>';
						echo '<td><center><img src="./xrays/'.$row['Xray'].'" width="180px"></center></td>';
						
						echo '</tr>';
					}
					
					echo '</table>';
					
				}
			
			?>
			
		<div class="clear h20"></div>
	<?php include 'exportButton.php';} ?>
	<!-- CONTENT END -->

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>
	
