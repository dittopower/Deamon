<?php
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."../core/database.php";
	require_once $home."../core/code.php";
	session_start();
	
//Login
	if(isset($_POST['username']) && isset($_POST['password'])){
			$user = escapeSQL(strtolower($_POST['username']));
			$pass = $_POST['password'];

			$data = rowSQL("SELECT UserId, PassPhrase, Length FROM D_Accounts WHERE username='$user'");
			
			if($data['Length'] === ''.strlen($pass) && $data['PassPhrase'] === encrypt($pass)){
				$_SESSION['person'] = $data['UserId'];
				$_SESSION['name'] = strtolower($_POST['username']);
			} else {
				$e_login = "Incorrect Login Details.";
			}
		}

//Logout		
	if (isset($_POST['logout'])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
	}

?>