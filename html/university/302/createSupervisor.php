<?php
	
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	
	lib_login();
	lib_code();
	
	session_start();
	
	if(isset($_POST['username']) && isset($_POST['FirstName']) && isset($_POST['Surname']) && isset($_POST['Email']) && isset($_POST['password']) && isset($_POST['password2'])){
		
		$user = escapeSQL(strtolower($_POST['username']));
		
		$nplength = strlen($_POST['password']);
		if($nplength > 6){
			if(isset($_POST['password2'])){
				$salt = salt();
				$npass = encrypt($_POST['password'],$salt,$user);
				$npass2 = encrypt($_POST['password2'],$salt,$user);
				if($npass === $npass2){
					
					$un = escapeSQL(strtolower($_POST['username']));
					$fn = $_POST['FirstName'];
					$sn = $_POST['Surname'];
					$em = $_POST['Email'];
					
					if($un != "" && $fn != "" && $sn != "" && $em != ""){
						$res = runSQL("INSERT INTO Supervisor (Username, FirstName, Surname, Email, Password, Salt) VALUES('".$un."', '".$fn."', '".$sn."', '".$em."', '".$npass."','".$salt."')");
						
						if($res){ echo "Supervisor Created."; }
						else{ echo "Something went wrong."; }
					}
					else{
						echo "You missed some fields.";
					}
				}
			}
		}
		
	}
	else{?>
		
		<form action="" method="post">
		
			<label>Username</label><input type="text" name="username"><br>
			<label>First Name</label><input type="text" name="FirstName"><br>
			<label>Surname</label><input type="text" name="Surname"><br>
			<label>Contact Email</label><input type="email" name="Email"><br>
			<label>Password</label><input type="password" name="password"><br>
			<label>Repeat Password</label><input type="password" name="password2"><br><br>
			
			<input class="button button1" type="submit" value="Create Supervisor">
		
		</form>
		
		
	<?php }
		
		echo "<br><h2>Supervisors</h2>";
		
		$arr = arraySQL("SELECT * FROM Supervisor");
		
		foreach($arr as $item){
			echo "# ";
			foreach($item as $d){
				echo "'$d', ";
			}
			echo "<br><br>";
		}
	
	/*
	
	CREATE TABLE Supervisor(
		SupervisorID int(11) NOT NULL AUTO_INCREMENT,
		Username varchar(255),
		FirstName varchar(255),
		Surname varchar(255),
		Email varchar(255),
		Password varchar(255),
		Salt varchar(255),
		PRIMARY KEY (SupervisorID)
	)

	*/
	
?>