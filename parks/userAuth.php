<?php include 'head.php' ?>

<!--_______________________________ Start Body _______________________________-->
<!-- - - - - - - - - - - - - - Page Header  - - - - - - - - - - - - - -->

<?php include 'header.php' ?>



<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->
<?php include 'navbar.php' ?>



<!-- - - - - - - - - - - - - - Page Content  - - - - - - - - - - - - - -->
<div id="page">
	
	<div id='inner'>
		<?php

		if(isset($_SESSION['User'])){ ?>
		<?php
			
		}else{
		
		/*
		Register New User
		*/
		if(isset($_GET['createUser']) && isset($_POST['newUser']) && isset($_POST['newPass1']) && isset($_POST['newPass2']) && isset($_POST['newFname']) && isset($_POST['newLname']) && isset($_POST['newEmail'])){
			
			$nuser = strtolower($_POST['newUser']);
			$npass = md5($_POST['newPass1']);	
			$npass2 = md5($_POST['newPass2']);
			$nfname = strtolower($_POST['newFname']);
			$nlname = strtolower($_POST['newLname']);
			$nemail = strtolower($_POST['newEmail']);
			
			if(!strpos($nuser,' ')){
				if($npass == $npass2){
					if(filter_var($nemail, FILTER_VALIDATE_EMAIL)){
						$sql="INSERT INTO Users(username, password, first_name, last_name, email) VALUES ('$nuser', '$npass', '$nfname', '$nlname', '$nemail')";
						if(runSQL($sql, $mysqli)){
							echo 'User created.';
						} else { echo 'Failed.'; }
					} else { echo 'Email is invalid.'; }
				} else { echo 'Passwords do not match.'; }
			} else { echo 'You can\'t have spaces in usernames.'; }
			
			echo ' <a href="./userAuth.php?createUser=true">Back.</a>';

		}
		else if(isset($_GET['createUser'])){ ?>
			<h2>Register New User<hr></h2>
			<form method='post' action='userAuth.php?createUser=true'>
				<label>Username: </label><input type='text' name='newUser'><br>
				<label>Password: </label><input type='password' name='newPass1'><br>
				<label>Password (again): </label><input type='password' name='newPass2'><br>
				<label>First Name: </label><input type='text' name='newFname'><br>
				<label>Last Name: </label><input type='text' name='newLname'><br>
				<label>Email: </label><input type='email' name='newEmail'><br>
				<input type='submit' value='Sign Up'>
			</form>

		<?php } else if(isset($_POST['username']) && isset($_POST['password'])){
			
			$user = strtolower($_POST['username']);
			$pass = $_POST['password'];

			$dbPassword = singleSQL("SELECT password FROM Users WHERE username='$user'", $mysqli);
			
			if($dbPassword === md5($pass)){
				$_SESSION['User'] = $user;				
				echo 'Logged in <meta http-equiv="refresh" content="0; url=index.php" />';
			} else {
			$pass = md5($pass);
				echo "Wrong password. <a href='index.php'>Refresh.</a>$dbPassword, $pass";
			}

		} else { ?>
			<a href='userAuth.php?createUser=true'>Register</a>
			<form method='post' action='userAuth.php'>
				<input type='text' name='username' placeholder='Username'>
				<input type='password' name='password' placeholder='Password'>
				<input type='submit' value='Login'>
			</form>

		<?php }} ?>
	</div>

</div>


<!--_______________________________ End Body _______________________________-->
<!-- - - - - - - - - - - - - - Page Footer  - - - - - - - - - - - - - -->
<?php include 'footer.php' ?>




</html>

