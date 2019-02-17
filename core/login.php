<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_database();
	lib_code();
	lib_files();
	session_start();
	
//Login
	if(isset($_POST['username']) && isset($_POST['password'])){
			$user = escapeSQL(strtolower($_POST['username']));
			$pass = $_POST['password'];

			$data = rowSQL("SELECT UserId, PassPhrase, Length, salt FROM D_Accounts WHERE username='$user'");
//			debug(encrypt($pass,$data['salt'],$user));
			if($data['Length'] === ''.strlen($pass) && $data['PassPhrase'] === encrypt($pass,$data['salt'],$user)){
				$_SESSION['person'] = $data['UserId'];
				$_SESSION['name'] = strtolower($_POST['username']);
			} else {
				$e_login = "Incorrect Login Details.";
				note('login',"Failed::$user::");
			}
		}

//Logout		
	if (isset($_POST['logout'])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
	}

?>
