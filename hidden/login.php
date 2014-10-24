<?php
	session_start();
	
	if(isset($_POST['username']) && isset($_POST['password'])){
			
			$user = strtolower($_POST['username']);
			$pass = $_POST['password'];

			$dbPassword = singleSQL("SELECT password FROM Users WHERE username='$user'", $mysqli);
			
			if($dbPassword === md5($pass)){
				$_SESSION['User'] = $user;
			} else {
			$pass = md5($pass);
				echo "Incorrect Login Details.";
			}
		}
	
	if (isset($_POST['logout'])){
		$_SESSION = array();
		session_destroy();
	}

?>