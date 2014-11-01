<?php
	session_start();
	
	if(isset($_POST['username']) && isset($_POST['password'])){
			
			$user = strtolower($_POST['username']);
			$pass = $_POST['password'];

			$dbPassword = singleSQL("SELECT password FROM Users WHERE username='$user'");
			
			if($dbPassword === encrypt($pass)){
				$_SESSION['User'] = $user;
			} else {
				echo "Incorrect Login Details.";
			}
		}
	
	if (isset($_POST['logout'])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
	}
	
	function isUser(){
		return isset($_SESSION['User']);
	}
	
	function canUser($what){
		$cUsql = "Select $what from user_priv where username = '$_SESSION[User]'";
		return singleSQL($cUsql);
	}

?>