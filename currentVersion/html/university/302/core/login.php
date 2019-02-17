<?php
	
	lib_database();
	lib_code();
	lib_files();
	session_start();
	
//Login
	
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['userType'])){
		
		$user = escapeSQL(strtolower($_POST['username']));
		$pass = $_POST['password'];
		
		if($_POST['userType'] == 'supervisor'){
			
			$data = rowSQL("SELECT SupervisorID, Password, Salt FROM Supervisor WHERE Username='$user'");
			
			if($data['Password'] === encrypt($pass,$data['Salt'],$user)){
				
				$_SESSION['SupervisorID'] = $data['SupervisorID'];
				header("Location: http://" . $_SERVER[HTTP_HOST] . "/supervisor/");
			
			} else {
				$e_login = "Incorrect Login Details.";
				note('login',"(Supervisor) Failed" . $data['Password'] . "|" . encrypt($pass,$data['Salt'],$user) . "::$user");
			}
			
		}
		else if($_POST['userType'] == 'student'){

			$data = rowSQL("SELECT UserId, PassPhrase, Length, salt FROM D_Accounts WHERE username='$user'");
			
			if($data['Length'] === ''.strlen($pass) && $data['PassPhrase'] === encrypt($pass,$data['salt'],$user)){
				$_SESSION['person'] = $data['UserId'];
				$_SESSION['name'] = strtolower($_POST['username']);
				
				$_SESSION['registered'] = singleSQL("Select 1 from User_Details where UserId = '$data[UserId]';");
				
			} else {
				$e_login = "Incorrect Login Details.";
				note('login',"Failed::$user");
			}
			
		}
	}

//Logout		
	if (isset($_POST['logout'])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
	}
	
	//Check if logged in
	function isUser(){
		return isset($_SESSION['person']);
	}
	
	function user_form(){
		if(!isUser()){
			echo "<form id='userForm' class='_pannel' method='POST'"; 
			if(isset($e_login)){
				echo "style='border: red 1px solid;background: rgba(250,0,0,0.5);'";
			}
			echo ">
		<input type='text' name='username' placeholder='Username'>
		<input type='password' name='password' placeholder='Password'>
		<input class='button button1' type='submit' value='>'>";
		}else{
			echo "<form id='userForm' class='_pannel' method='POST'>
		<input name='logout' hidden>
		<input class='button button1' id='logoutbtn' type='submit' value='Logout'>";
		}
		echo "</form>";
	}
	
	if(!isUser() && ! isset($_SESSION['SupervisorID'])){
		global $local;
		include $local."login/index.php";
		die();
	}
?>