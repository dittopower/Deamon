<?php
	require_once('./db.php');
	require_once('./code.php');
	session_start();
	
//Login
	if(isset($_POST['username']) && isset($_POST['password'])){
			
			$user = strtolower($_POST['username']);
			$pass = $_POST['password'];

			$data = rowSQL("SELECT L.UserId, L.PassPhrase, L.Length FROM D_Login L join D_Accounts A on L.UserId = A.UserId WHERE username='$user'");
			
			if($data['Length'] === strlen($pass) && $data['PassPhrase'] === encrypt($pass)){
				$_SESSION['person'] = $data['UserId'];
			} else {
				echo "Incorrect Login Details.";
			}
		}

//Logout		
	if (isset($_POST['logout'])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
	}

?>