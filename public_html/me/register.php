<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/files.php";
?>
<!-- START content -->

<?php
//Create User
	if(isset($_POST['newUser'])||isset($_POST['newFname'])||isset($_POST['newLname'])||isset($_POST['newPass1'])||isset($_POST['newPass2'])||isset($_POST['newEmail'])){
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
					$npass = encrypt($_POST['newPass1']);
					$npass2 = encrypt($_POST['newPass2']);
					if($npass === $npass2){
						$p=1;
					}
				}
			}
		}
		if(isset($_POST['newFname'])){
			$nfname = ucwords(strtolower($_POST['newFname']));
			if(strlen($nfname) > 2){
				$f=1;
			}
		}
		if(isset($_POST['newLname'])){
			$nlname = ucwords(strtolower($_POST['newLname']));
			if(strlen($nlname) > 2){
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
		
			$sql= mysqli_prepare($mysqli, "INSERT INTO D_Accounts(Username, FirstName, LastName, DateOfBirth, Email, PassPhrase, Length) VALUES (?, ?, ?, ?, ?, ?, ?)");
			mysqli_stmt_bind_param($sql,"sssssss",$nuser,$nfname,$nlname,$nday,$nemail,$npass,$nplength);
			
			if(mysqli_stmt_execute($sql)){
				echo 'Account successfully created.';
				note('Registration',"Created::$nuser");
			} else {
				echo 'Failed.';
				note('Registration',"Failed::$nuser");
			}
			mysqli_stmt_close($sql);
		}
	}else{
//Wait for user details
		$u=1;$p=1;$f=1;$l=1;$e=1;$day=1;
	}
	?>
		<form id='regForm' method='POST'>
			<fieldset>
				<h2>User Registration</h2>
				<hr><hr class="spacer">
				<table>
					<?php if(!$u){ echo "<tr><td></td><td>No Spaces and 2+ characters.</td></tr>";} ?>
					<tr>
						<td><label>Username: </label></td>
						<td><input type='text' name='newUser' <?php echo "value='$nuser'";?>></td>
					</tr>
					<?php if(!$p){ echo "<tr><td></td><td>Must be 6+ characters and Match.</td></tr>";} ?>
					<tr>
						<td><label>Password: </label></td>
						<td><input type='password' name='newPass1'></td>
						<td><input type='password' name='newPass2' placeholder='Repeat'></td>
					</tr>
					<?php if((!$f) || (!$l)){ echo "<tr><td></td><td>Name Can Not be Empty</td></tr>";} ?>
					<tr>
						<td><label>Name: </label></td>
						<td><input type='text' name='newFname'placeholder='First' <?php echo "value='$nfname'";?>></td>
						<td><input type='text' name='newLname' placeholder='Last' <?php echo "value='$nlname'";?>></td>
					</tr>
					<?php if(!$e){ echo "<tr><td></td><td>Invaild Email.</td></tr>";} ?>
					<tr>
						<td><label>Email: </label></td>
						<td><input type='email' name='newEmail' <?php echo "value='$nemail'";?>></td>
					</tr>
					
					<tr>
						<td><label>Birthday: </label></td>
						<td><input type='date' name='newdate' <?php echo "value='$nday'";?> placeholder="YYYY-MM-DD"></td>
					</tr>
				</table>
				<hr class="spacer">
				<input type='submit' value='Sign Up'>
			</fieldset>
		</form>