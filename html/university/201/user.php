<?php 



	include 'header.php';

	if(checkPermission("AA", $mysqli)){

?>

			

		<!-- CONTENT START -->

			

			<?php	

			if(isset($_POST['password']) && isset($_POST['npassword'])){

				if (isset($_GET['id'])){

				$id = $_GET['id'];

				}else{

				$id = $_SESSION['User'];

				}

				if(($id == $_SESSION['User'])||checkFilePermission(__FILE__, $mysqli)){

					$pw = md5($_POST['password']);

					$npw = md5($_POST['npassword']);

					

					if ($pw == singleSQL("SELECT Password FROM users WHERE Username='" . $id ."'",$mysqli) || checkFilePermission(__FILE__, $mysqli)){

						echo '<center>';

						if(runSQL("UPDATE users SET Password='$npw' WHERE Username='$id'", $mysqli)){

							echo "Password Changed!";

						}else{

							echo "Password Change Failed!!";

						}

						echo '<br></center>';

					}else{

						echo '<center>Wrong Current Password.<br></center>';

					}

				}else{

				echo '<center>You are Not Authoritsed to Change Other\'s passwords.<br></center>';

				}

			}

			if(checkFilePermission(__FILE__, $mysqli) && isset($_POST['Username']) && isset($_POST['Firstname']) && isset($_POST['Lastname']) && isset($_POST['type']) && isset($_POST['AccessCode']) && isset($_POST['Room'])){

				if (isset($_GET['id'])){

				$id = $_GET['id'];

				}else{

				$id = $_SESSION['User'];

				}

				

				$un = $_POST['Username'];

				$fn = $_POST['Firstname'];

				$ln = $_POST['Lastname'];

				$st = $_POST['type'];

				$ac = $_POST['AccessCode'];

				$add = $_POST['Room'];

				

				$up1 = runSQL("UPDATE users SET Username='$un',AccessCode='$ac' WHERE Username='$id'", $mysqli);

				if ($up1){

					$sql = "UPDATE staff SET Lastname='$ln',Firstname='$fn',Stafftype='$st',Username='$un', Room='$add' WHERE Username='$id'";

					$check = runSQL($sql,$mysqli);

				}else{

				echo "primary failure";

				$check = false;

				}

				echo '<center>';

				if($check){

					echo 'User Details Updated.';

				} else { echo 'User details not updated. Try again.'; }

				echo '<br></center>';

				$target = $un;

			}else{

				if (isset($_GET['id']) && checkFilePermission(__FILE__, $mysqli)){

					$target = $_GET['id'];

				}else{

					$target = $_SESSION['User'];

				}

			}

				$rows = singleRowSQL("SELECT s.Username, Firstname, Lastname, Stafftype, Accesscode, Room FROM users u join staff s on u.Username = s.Username WHERE s.Username ='".$target."'" ,$mysqli);

			?>

			

			<h2 style="display: inline;"><?php echo $rows['Firstname'] . " " . $rows['Lastname']; ?></h2>

			<?php usersearchbox(); ?>

			

			<?php

				

				echo '<h3>User Details</h3><table id="patientDetails"><form method="post" action="user.php?id='.$target.'">

					<tr><td class="leftc">Username</td><td><input name="Username" type="text" value="'.$rows['Username'].'"></td></tr>

					<tr><td class="leftc">First Name</td><td><input name="Firstname" type="text" value="'.$rows['Firstname'].'"></td></tr>

					<tr><td class="leftc">Lastname</td><td><input name="Lastname" type="text" value="'.$rows['Lastname'].'"></td></tr>

					<tr><td class="leftc">Staff Type</td><td><select name="type"><option value="Nurse" ';

				if ($rows['Stafftype'] == 'Nurse'){

						echo ' selected';}

				echo '>Nurse</option><option value="Doctor"';

				if ($rows['Stafftype'] == 'Doctor'){

						echo ' selected';}

				echo '>Doctor</option><option value="Receptionist"';

				if ($rows['Stafftype'] == "Receptionist"){

						echo ' selected';}

				echo '>Receptionist</option><option value="System Admin"';

				if ($rows['Stafftype'] == "System Admin"){

						echo ' selected';}

				echo '>System Admin</option><option value="Technician"';

				if ($rows['Stafftype'] == "Technician"){

						echo ' selected';}

				echo '>Technician</option><option value="Hospital Admin"';

				if ($rows['Stafftype'] == "Hospital Admin"){

						echo ' selected';}

				echo '>Hospital Admin</option></select></td></tr>

					<tr><td class="leftc">Access Level</td><td><input name="AccessCode" type="text" value="'.$rows['Accesscode'].'"></td></tr>

					<tr><td class="leftc">Assigned Room</td><td><input name="Room" type="text" value="'.$rows['Room'].'"></td></tr>

					</table>';

				echo '<center><br><input type="submit" value="Save Changes"></form></center>';

				

				echo '<h3>Change Password</h3><table id="patientDetails">

				<form method="post" action="user.php?id='.$target.'">

				<tr><td class="leftc">Current Password</td><td><input name="password" type="password" value=""></td></tr>

				<tr><td class="leftc">New Password</td><td><input name="npassword" type="password" value=""></td></tr></table>

				<center><br><input type="submit" value="Change Password"></form></center>';

					?>

					

				<br><br>

				

				

			<div class="clear h20"></div>

		<!-- CONTENT END -->





<?php } else { include 'permissionDenied.html'; } ?>

	<?php include 'footer.php'; ?>