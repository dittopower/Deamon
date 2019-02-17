<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}
	
	include 'connection_include.php';

	if(isset($_SESSION['User'])){ echo 'logged in as ' . $_SESSION['User'] . " <a href='logout.php'>logout</a>"; }
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		
		$user = strtolower($_POST['username']);
		$pass = $_POST['password'];

		$p = mysqli_query($mysqli,"SELECT Password FROM users WHERE Username='" . $user ."'");
		
		if($p != NULL){
	
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$dbPassword = $t[0];

			if($dbPassword === md5($pass)){
				$_SESSION['User'] = $user;				
				echo 'Logged in <meta http-equiv="refresh" content="0; url=index.php" />';
			} else {
				echo 'wrong password <a href="index.php">refresh</a>';
			}

		} else {
			echo 'User not found.';
		}//if returns empty

	} else { 
		include 'loginpage.php';
	} ?>
