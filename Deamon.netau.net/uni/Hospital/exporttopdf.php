<?php 
	include 'connection_include.php';
	include 'functions.php';
	//if(checkFilePermission(__FILE__, $mysqli)){
	$id = $_GET['id'];
	$t = singleRowSQL("SELECT WardID,DoctorID FROM 201_patientlocation WHERE PatientNo='$id'",$mysqli);
	$rows = singleRowSQL("SELECT PatientNo, Notes, Firstname, Lastname, sex, email, dob, phone, address, medicare, insurance FROM 201_patients WHERE PatientNo=$id" ,$mysqli);
	$xr = multiSQL("SELECT XrayFileID, Xray,XrayDate, StaffID FROM 201_xray WHERE PatientID='$id' ORDER BY XrayDate DESC",$mysqli);
				
		include("./mpdf/mpdf.php");
		$mpdf=new mPDF('win-1252','A4','','',15,10,16,10,10,10);//A4 page in portrait for landscape add -L.
		$mpdf->SetHeader('|Patient Export: '.$rows['Firstname'].' '.$rows['Lastname'].'|');
		$mpdf->setFooter('{PAGENO}');// Giving page number to your footer.
		$mpdf->useOnlyCoreFonts = true;    // false is default
		$mpdf->SetDisplayMode('fullpage');
		// Buffer the following html with PHP so we can store it to a variable later
		ob_start();

		//START FILE OUTPUT
		
		
		echo '<style>
				table{
					width: 100%;
				}
				h2{
					border-bottom:1px dotted black;
				}
				#xrays{
					
				}
				#xrays td,#xrays th{
				border: 1px solid black;
				}
			</style>
			<h2>Patient Details</h2><table id="patientDetails">
			<tr><td class="leftc">Patient Number</td><td>'.$rows['PatientNo'].'</td></tr>
			<tr><td class="leftc">First Name</td><td>'.$rows['Firstname'].'</td></tr>
			<tr><td class="leftc">Lastname</td><td>'.$rows['Lastname'].'</td></tr>
			<tr><td class="leftc">Gender</td><td>'.$rows['sex'].'</td></tr>
			<tr><td class="leftc">Date of birth</td><td>'.date('d M Y', strtotime($rows['dob'])).'</td></tr>
			<tr><td class="leftc">Address</td><td>'.$rows['address'].'</td></tr>
			<tr><td class="leftc">Phone</td><td>'.$rows['phone'].'</td></tr>
			<tr><td class="leftc">Email</td><td>'.$rows['email'].'</td></tr>
			<tr><td class="leftc">Medicare</td><td>'.$rows['medicare'].'</td></tr>
			<tr><td class="leftc">Insurance</td><td>'.$rows['insurance'].'</td></tr>
			<tr><td class="leftc">Notes</td><td>'.$rows['Notes'].'</td></tr>
			</table>';

		if($t != 0){ ?>
			<br><h2>Patient Location</h2>
			Patient is in ward: <b><u><?php echo $t[0]; ?></u></b><br>
			Doctor assigned: <b><u><?php echo $t[1]; ?></u></b>
		<?php }?>
		
		<?php 
				$id = $_GET['id'];
				$t = multiSQL("SELECT BillID, Operation, MoneyOwed FROM 201_prices p join 201_patientfinancial f on p.OperationID = f.OperationID where patientID = $id",$mysqli);
				echo '<p>&nbsp;</p><br><hr><h2>Bills</h2>';
				if($t->num_rows !== 0){
					
					echo '<table id="xrays">';
					
					echo '<tr><th>Bill ID</th><th>Operation Type</th><th>Remaining Payment</th></tr>';
					
					while($row = mysqli_fetch_array($t,MYSQLI_BOTH)){
						
						echo '<tr onclick=\'window.location="./xrays/'.$row['Xray'].'"\'>';
						
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

			<p>&nbsp;</p><br><hr><h2>Prescriptions</h2>
			<?php if(isset($_POST['Prescription']) && isset($_POST['Amount']) && isset($_POST['Price']) && $_POST['Prescription']!=""){
					$id = $_GET['id'];
					$price = $_POST['Price'];
					$name = $_POST['Prescription'];
					$amt = $_POST['Amount'];
					$newID=singleSQL("SELECT PrescriptionID FROM 201_prescriptions ORDER BY PrescriptionID DESC LIMIT 1",$mysqli)+1;
					
					$ss = "INSERT INTO 201_prescriptions (PrescriptionID, PatientID, Price, PrescriptionName, Amount)
					VALUES($newID,$id,$price,'$name',$amt)";
					
					if(runSQL($ss,$mysqli)){
						echo'Prescription Added.<br>';
					}else{ echo 'Prescription failed to be added. Make sure you filled in the fields correctly.<br>'.$ss; }
				
				}
					
				$s = multiSQL("SELECT PrescriptionID, PrescriptionName, Amount, Price FROM 201_prescriptions WHERE PatientID=$id ORDER BY PrescriptionID DESC",$mysqli);
				if($s->num_rows !== 0){
					echo '<h3>Current prescriptions</h3>
					<table id="xrays"><tr><th>Prescription Code</th><th>Prescription Name</th><th>Quantity</th><th>Price</th></tr>';	
					while($ro = mysqli_fetch_array($s,MYSQLI_BOTH)){
						echo '<tr><td>'.$ro['PrescriptionID'].'</td><td>'.$ro['PrescriptionName'].'</td><td>'.$ro['Amount'].'</td><td>$'.round($ro['Price'],2).'</td>';
					}
					echo '</tr></table>';
				}else{ echo 'Patients doesn\'t have any prescriptions.<br>'; }
			
			?>
			
			<?php 				
				if($xr->num_rows !== 0){
					
					echo '<br><br><h2>Xrays</h2><table id="xrays">';
					
					echo '<tr><th>Xray #</th><th>Date</th><th>Scanned in by staff #</th><th>Preview</th></tr>';
					
					while($row = mysqli_fetch_array($xr,MYSQLI_BOTH)){
						
						echo '<tr onclick=\'window.location="./xrays/'.$row['Xray'].'"\'>';
						
						echo '<td>'.$row['XrayFileID'].'</td>';
						echo '<td>'.date('d M Y', strtotime($row['XrayDate'])).'</td>';
						echo '<td>'.$row['StaffID'].'</td>';
						echo '<td><center><img src="./xrays/'.$row['Xray'].'" width="180px"></center></td>';
						
						echo '</tr>';
					}
					
					echo '</table>';
					
				}
		
		
		//END FILE OUTPUT		

		$html = ob_get_contents();
		ob_end_clean();
		// send the captured HTML from the output buffer to the mPDF class for processing
		$mpdf->WriteHTML($html);
		//$mpdf->SetProtection(array(), 'user', 'password'); uncomment to protect your pdf page with password.
		$mpdf->Output();
		exit;
		
	//}else{ echo 'nope';}
?>