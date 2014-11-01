<?php 
	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
			
			<!-- CONTENT START -->
				
				<?php
					if(isset($_GET['search']) && $_GET['search'] != ""){	
						$r = multiSQL("SELECT p.PatientNo, p.Firstname, p.Lastname, sex, email, phone, s.Lastname as Doctor, WardID FROM 201_patients p left join 201_patientlocation l on p.patientNo = l.patientNo left join 201_staff s on s.StaffID = l.DoctorID WHERE p.Firstname LIKE '%" . $_GET['search'] . "%' OR p.Lastname LIKE '%" . $_GET['search'] . "%' OR p.PatientNo LIKE '%" . $_GET['search'] . "%' ORDER BY Doctor,WardID,p.Lastname,p.Firstname ASC",$mysqli);
						if($r->num_rows === 0){
							$title = 'No search results for: "' . $_GET['search'] . '"';
						}
						else{
							$title = 'Search for: "' . $_GET['search'] . '"';
						}
					}
					else{			
						$r = multiSQL("SELECT p.PatientNo, p.Firstname, p.Lastname, sex, email, phone, s.Lastname as Doctor, WardID FROM 201_patients p left join 201_patientlocation l on p.patientNo = l.patientNo left join 201_staff s on s.StaffID = l.DoctorID ORDER BY Doctor,WardID,p.Lastname,p.Firstname ASC",$mysqli);
						$title = 'Patients List';
					}
				?>
				
				<h2 style="display: inline;"><?php echo $title; ?></h2>
				<?php searchbox(); ?>
						
				<table id="patient_list">
					<thead>
					<tr>
						<th>Patient Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Doctor</th>
						<th>Ward</th>
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
							<td>'.$rows['sex'].'</td>
							<td>'.$rows['phone'].'</td>
							<td>'.$rows['email'].'</td>
							<td>'.$rows['Doctor'].'</td>
							<td>'.$rows['WardID'].'</td>
						</tr>';
						
					} ?>
					</tbody>
				</table>
			<div class="clear h20"></div>
            <!--<div class="health_paging">
                <ul>
                    <li><a href="#" rel="nofollow" target=		"_parent">Previous</a></li>
                    <li><a rel="nofollow" href="#" rel="nofollow" target="_parent">1</a></li>
                    <li><a rel="nofollow" href="#" rel="nofollow" target="_parent">2</a></li>
                    <li><a rel="nofollow" href="#" rel="nofollow" target="_parent">3</a></li>
                   
                </ul>
                <div class="clear"></div>
           </div>			-->	
			<!-- CONTENT END -->

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>