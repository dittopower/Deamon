<?php 
	echo '<p>&nbsp;</p><br><hr><h2>Prescriptions</h2>';
	
	$s = multiSQL("SELECT PrescriptionID, PrescriptionName, Amount, Price FROM 201_prescriptions WHERE PatientID=$id ORDER BY PrescriptionID DESC",$mysqli);
	if($s->num_rows !== 0){
		echo '<h3>Current prescriptions</h3>
		<table><tr><th>Prescription Code</th><th>Prescription Name</th><th>Quantity</th><th>Price</th></tr>';	
		while($ro = mysqli_fetch_array($s,MYSQLI_BOTH)){
			echo '<tr><td>'.$ro['PrescriptionID'].'</td><td>'.$ro['PrescriptionName'].'</td><td>'.$ro['Amount'].'</td><td>$'.round($ro['Price'],2).'</td>';
		}
		echo '</tr></table>';
	}else{ echo 'Patients doesn\'t have any prescriptions.<br>'; }
	
if(checkFilePermission(__FILE__, $mysqli)){
	
	
	if(isset($_POST['Prescription']) && isset($_POST['Amount']) && isset($_POST['Price']) && $_POST['Prescription']!=""){
		$id = $_GET['id'];
		$price = $_POST['Price'];
		$name = $_POST['Prescription'];
		$amt = $_POST['Amount'];
		$newID=singleSQL("SELECT PrescriptionID FROM 201_prescriptions ORDER BY PrescriptionID DESC LIMIT 1",$mysqli)+1;
		
		$ss = "INSERT INTO 201_prescriptions (PrescriptionID, PatientID, Price, PrescriptionName, Amount)
		VALUES($newID,$id,$price,'$name',$amt)";
		
		$opID = "script01";
		$cost = singleSQL("SELECT OperationCost FROM 201_prices where OperationID = '$opID' ORDER BY OperationCost DESC LIMIT 1", $mysqli) + $price;
		$sp = "INSERT INTO 201_patientfinancial (billID, PatientID, OperationID, MoneyOwed)	VALUES('Script-$newID',$id,'$opID','$price')";
		runSQL($sp,$mysqli);
		
		if(runSQL($ss,$mysqli)){
			echo'Prescription Added.<br>';
		}else{ echo 'Prescription failed to be added. Make sure you filled in the fields correctly.<br>'.$ss; }
		
	}
	
	echo '<br><h3>Add new prescription</h3>
	<form method="post" action="./patient.php?id='.$_GET['id'].'">
	Prescription Name: <input type="text" name="Prescription"><br>
	Quantity: <input type="text" name="Amount"><br>
	Price: <input type="text" name="Price"><br>
	<input type="submit" value="Add"></form>';
	
}

?>