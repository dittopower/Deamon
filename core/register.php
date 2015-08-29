<?php //registration
	require_once "/home3/deamon/lib.php";
	lib_database();
	lib_code();
	lib_files();

	global $u , $p, $f, $l, $e, $day, $nuser, $nfname, $nlname, $nemail, $nday;
	//Create User if necessary
	if(isset($_POST['newUser']) && isset($_POST['newFname']) && isset($_POST['newLname']) && isset($_POST['newPass1']) && isset($_POST['newEmail'])){
		$u=0;$p=0;$f=0;$l=0;$e=0;$day=0;
		
		if(isset($_POST['newUser'])){
			$nuser = strtolower($_POST['newUser']);
			if(strlen($nuser) > 2){
				if(!strpos($nuser,' ')){
					$u = 1;
				}
			}
		}
		if(isset($_POST['newPass1'])){
			$nplength = strlen($_POST['newPass1']);
			if($nplength > 6){
				if(isset($_POST['newPass2'])){
					$salt = salt();
					$npass = encrypt($_POST['newPass1'],$salt,$nuser);
					$npass2 = encrypt($_POST['newPass2'],$salt,$nuser);
					if($npass === $npass2){
						$p=1;
					}
				}
			}
		}
		if(isset($_POST['newFname'])){
			$nfname = ucwords(strtolower($_POST['newFname']));
			if(strlen($nfname) > 1){
				$f=1;
			}
		}
		if(isset($_POST['newLname'])){
			$nlname = ucwords(strtolower($_POST['newLname']));
			if(strlen($nlname) > 1){
				$l=1;
			}
		}
		if(isset($_POST['newEmail'])){
			$nemail = strtolower($_POST['newEmail']);
			if(filter_var($nemail, FILTER_VALIDATE_EMAIL)){
				$e=1;
			}
		}
		if(isset($_POST['newdate'])){
			$nday = $_POST['newdate'];
			$day=1;
		}
		if($u && $p && $f && $l && $e && $day){
		global $mysqli;
			$sql= mysqli_prepare($mysqli, "INSERT INTO D_Accounts(Username, FirstName, LastName, DateOfBirth, Email, PassPhrase, Length, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			mysqli_stmt_bind_param($sql,"ssssssss",$nuser,$nfname,$nlname,$nday,$nemail,$npass,$nplength, $salt);
			
			if(mysqli_stmt_execute($sql)){
				$regouttext = 'Account successfully created.';
				note('Registration',"Created::$nuser");
				$_SESSION['person'] = singleSQL("Select LAST_INSERT_ID();");
				$_SESSION['name'] = $nuser;
			} else {
				$regouttext = 'Registration Failed.';
				note('Registration',"Failed::$nuser");
			}
			mysqli_stmt_close($sql);
		}
	}else{
		//Wait for user details
		$u=1;$p=1;$f=1;$l=1;$e=1;$day=1;
	}
	
	//registration form
	function reg_form(){
		global $u , $p, $f, $l, $e, $day, $nuser, $nfname, $nlname, $nemail, $nday;
		echo "<form id='regForm' method='POST'>";
		echo "<fieldset><h2 class='reg_title'>User Registration</h2>";
		echo "<hr><hr class='spacer'><table>";
		if(!$u){
			echo "<tr><td></td><td>No Spaces and 2+ characters.</td></tr>";
		}
		echo "<tr><td><label>Username: </label></td><td>";
		echo "<input type='text' name='newUser' value='$nuser'></td></tr>";
		if(!$p){
			echo "<tr><td></td><td>Must be 6+ characters and Match.</td></tr>";
		}
		echo "<tr><td><label>Password: </label></td><td><input type='password' name='newPass1'></td><td><input type='password' name='newPass2' placeholder='Repeat'></td></tr>";
		if((!$f) || (!$l)){
			echo "<tr><td></td><td>Name must be longer than 1 letter.</td></tr>";
		}
		echo "<tr><td><label>Name: </label></td>";
		echo "<td><input type='text' name='newFname'placeholder='First' value='$nfname'></td>";
		echo "<td><input type='text' name='newLname' placeholder='Last' value='$nlname'></td></tr>";
		if(!$e){
			echo "<tr><td></td><td>Invaild Email.</td></tr>";
		}
		echo "<tr><td><label>Email: </label></td><td><input type='email' name='newEmail' value='$nemail'></td></tr>";
		echo "<tr><td><label>Birthday: </label></td>";
		echo "<td><input type='date' name='newdate' value='$nday' placeholder='YYYY-MM-DD'></td></tr>";
		echo "</table><hr class='spacer'><input type='submit' value='Sign Up'>";
		echo "</fieldset></form>";
	}
