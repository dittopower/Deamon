<?php 

	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
			
			<!-- CONTENT START -->
				
				<?php
					$user = $_SESSION['User'];
					if(checkPermission("DD", $mysqli)){
					$r = multiSQL("SELECT p.PatientNo, p.Firstname, p.Lastname, p.Sex,p.Notes, p.dob, d.BedNo, d.WardId, d.DoctorID FROM 201_patients p join `201_patientlocation` d join 201_staff s where p.PatientNo = d.PatientNo and d.DoctorID = s.StaffID and s.Username = '".$user."' ORDER BY PatientNo ASC",$mysqli);
					}else{
					$r = multiSQL("SELECT p.PatientNo, p.Firstname, p.Lastname, p.Sex,p.Notes, p.dob, d.BedNo, d.WardId, d.DoctorID FROM 201_patients p join `201_patientlocation` d join 201_staff s where p.PatientNo = d.PatientNo and d.WardId = s.Room and s.Username = '".$user."' ORDER BY PatientNo ASC",$mysqli);
					}
					if($r->num_rows == 0){
						$title = "You have no assigned Patients.";
					}
					else{
						$title = "Here are your Patient's Doctor: ";
					}
					
				?>
				<h2 style="display: inline;"><?php echo $title;?></h2>
				<?php searchbox(); ?>
						
				<table id="patient_list">
					<thead>
					<tr>
						<th>Patient Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Bed</th>
						<th>Ward</th>
						<th>Notes</th>
					</tr>
					</thead>
					<tbody>
					<?php
					
					while($rows = mysqli_fetch_array($r,MYSQLI_BOTH)){
						echo '
						<tr onclick=\'window.location="./patient.php?id=' . $rows['PatientNo'] . '"\'>
							<td>'.$rows['PatientNo'].'</td>
							<td>'.$rows['Firstname'].'</td>
							<td>'.$rows['Lastname'].'</td>
							<td>'.$rows['Sex'].'</td>
							<td>'.$rows['BedNo'].'</td>
							<td>'.$rows['WardId'].'</td>
							<td>'.$rows['Notes'].'</td>
						</tr>';
						
					} ?>
					</tbody>
				</table>
			<div class="clear h20"></div>
			<!-- CONTENT END -->

<?php } else { include 'permissionDenied.html'; } ?>
	<?php include 'footer.php'; ?>