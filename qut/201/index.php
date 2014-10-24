<?php 

	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
			
	<!-- CONTENT START -->
	
	<?php
		$user = $_SESSION["User"];
		$t = singleRowSQL("SELECT Firstname, Lastname FROM 201_staff WHERE Username='$user'",$mysqli);
		$fn = $t["Firstname"];
		$sn = $t["Lastname"];
	?>
	
	<h2>Welcome, <?php echo $fn . " " . $sn; ?></h2>
	
	<?php
						
		$staffid = singleSQL("SELECT StaffID FROM 201_staff WHERE Username='$user'",$mysqli);
			
		$s = multiSQL("SELECT TheaterID, CONCAT_WS(' ',Firstname,Lastname) as Patient, StartTime FROM 201_bookings join 201_patients on Patient = patientNo WHERE BookerID='$staffid'",$mysqli);
		
		if($s->num_rows !== 0){
			echo '<ul>';
			while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){
				echo '<li>Theater: '.$rows['TheaterID']. ', With patient: ' .$rows['Patient']. ', Starting at: '.date('d M Y g:ia', strtotime($rows['StartTime'])).'</li>';
			}
			echo '</ul><br><br>';
		}else{ echo "No appointments coming up.<br><br>"; }

		$s = multiSQL("SELECT PatientNo, WardId, EnterTime FROM 201_patientlocation WHERE DoctorID='$staffid'",$mysqli);
		
		if($s->num_rows !== 0){
			echo '<ul>';
			while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){
				echo '<li>Ward ID: '.$rows['WardId']. ', With patient: ' .$rows['PatientNo']. ', Starting at: '.date('d M Y g:ia', strtotime($rows['EnterTime'])).'</li>';
			}
			echo '</ul>';
		}else{ echo ""; }
		
	?>
	
	<!-- CONTENT END -->

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>