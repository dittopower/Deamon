<?php 

	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

			

			<!-- CONTENT START -->

				

				<?php

					if(isset($_GET['search']) && $_GET['search'] != ""){	

						$r = multiSQL("SELECT u.Username, Stafftype, AccessCode, Firstname, Lastname, Room FROM users u join staff s on u.Username = s.Username WHERE Firstname LIKE '%" . $_GET['search'] . "%' OR Lastname LIKE '%" . $_GET['search'] . "%' OR u.Username LIKE '%" . $_GET['search'] . "%' OR Stafftype LIKE '%" . $_GET['search'] . "%' OR Room LIKE '%" . $_GET['search'] . "%' OR AccessCode LIKE '%" . $_GET['search'] . "%'ORDER BY AccessCode, Lastname, Firstname ASC",$mysqli);

						if($r->num_rows === 0){

							$title = 'No staff results for: "' . $_GET['search'] . '"';

						}

						else{

							$title = 'Search for: "' . $_GET['search'] . '"';

						}

					}

					else{			

						$r = multiSQL("SELECT u.Username, Stafftype, AccessCode, Firstname, Lastname, Room FROM users u join staff s WHERE u.Username = s.Username ORDER BY Lastname, Firstname ASC",$mysqli);

						$title = 'Hospital Staff List';

					}

				?>

				

				<h2 style="display: inline;"><?php echo $title; ?></h2>

				<?php usersearchbox(); ?>

						

				<table id="patient_list">

					<thead>

					<tr>

						<th>Username</th>

						<th>Staff Type</th>

						<th>Access Level</th>

						<th>First Name</th>

						<th>Last Name</th>

						<th>Room</th>

					</tr>

					</thead>

					<tbody>

					<?php

					

					while($rows = mysqli_fetch_array($r,MYSQLI_BOTH)){

						echo '

						<tr onclick=\'window.location="./user.php?id=' . $rows['Username'] . '"\'>

							<td>'.$rows['Username'].'</td>

							<td>'.$rows['Stafftype'].'</td>

							<td>'.$rows['AccessCode'].'</td>

							<td>'.$rows['Firstname'].'</td>

							<td>'.$rows['Lastname'].'</td>

							<td>'.$rows['Room'].'</td>

						</tr>';

						

					} ?>

					</tbody>

				</table>

			<div class="clear h20"></div>

			<!-- CONTENT END -->



<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>