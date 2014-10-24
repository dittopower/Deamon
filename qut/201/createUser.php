<?php 

	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
            
	<!-- CONTENT START -->
	<?php if(isset($_POST['firstName']) && isset($_POST['type'])){
	
		$firstname = $_POST['firstName'];
		$surname = $_POST['surname'];
		$username = $_POST['newUser'];
		$p1 = md5($_POST['newPass1']);
		$p2 = md5($_POST['newPass2']);
		$type = $_POST['type'];
		
		$exist = singleSQL("SELECT Username FROM 201_users WHERE Username='$username'", $mysqli);	
		if($p1 === $p2 && $exist == null){
			
			switch($type){
				case "Nurse":
					$accessCode = "NN";
					break;
				case "Doctor":
					$accessCode = "DD";
					break;
				case "Technician": 
					$accessCode = "TT";
					break;
				case "Receptionist": 
					$accessCode = "RR";
					break;
				case "System Admin":
					$accessCode = "SA";
					break;
				case "Hospital Admin": 
					$accessCode = "HA";
					break;
			}
			
			$sql1 = runSQL("INSERT INTO 201_users (Username, Password, AccessCode) VALUES('$username','$p1','$accessCode')", $mysqli);
			
			if($sql1){
				$staffid = singleSQL('SELECT StaffID FROM 201_staff ORDER BY StaffID DESC LIMIT 1', $mysqli) + 1;
				
				$sql2 = runSQL("INSERT INTO 201_staff (Username, staffID, Stafftype, Lastname, Firstname) VALUES('$username',$staffid,'$type','$surname','$firstname')", $mysqli);
				
				if($sql2){
					echo 'User created.';
				} else { echo 'Something went wrong'; }
				
			} else { echo "Something went wrong"; }
			
		}
		else{
			if($exist != null){ echo 'user already exists'; }
			else { echo 'passwords don\'t match.'; }
		}
		
		
		
	} else { ?>
		<h2>Register New Account</h2>
		<form method='post' action='createUser.php' id="contact_form">
			<label>First Name</label><input type='text' name='firstName'></br>
			<label>Surname</label><input type='text' name='surname'></br>
			<label>Username</label><input type='text' name='newUser'></br>
			<label>Password</label><input type='password' name='newPass1'></br>
			<label>Password (again)</label><input type='password' name='newPass2'></br>
			<label>Staff Type</label>
				<select name="type">
					<option value="Nurse">Nurse</option>
					<option value="Doctor">Doctor</option>
					<option value="Receptionist">Receptionist</option>
					<option value="System Admin">System Admin</option>
					<option value="Technician">Technician</option>
					<option value="Hospital Admin">Hospital Admin</option>
				</select>
			<br><br>
			<input type='submit'>
		</form>
		
	<?php } ?>
	<!-- CONTENT END -->
	

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>
