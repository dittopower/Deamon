<?php
	
	include '../page.php';
	
	echo "<div class=page>";
	
	//Ensure a USER is viewing the user page
	if (isset($_SESSION['User'])){
		$cuser = ucfirst($_SESSION['User']);
		echo "<h1>$cuser's Account</h1><hr>";
		
	// Password Change
		$match = 0;$wrong = 0;
		if (isset($_POST['word1'])||isset($_POST['word2'])||isset($_POST['word3'])){
			if ($_POST['word2'] != $_POST['word3']){
				$match = 1;
			}
	
			$dbPassword = singleSQL("SELECT password FROM Users WHERE username='$_SESSION[User]'");
			if($dbPassword === encrypt($_POST['word1'])){
				$wrong = 0;
			}else{
				$wrong = 1;
			}
			
			if(!$match && (!$wrong)){
					$passw = encrypt($_POST['word2']);
					$sql = "UPDATE `a4561011_core`.`Users` SET `password` = '$passw' WHERE CONVERT(`Users`.`username` USING utf8) = '$_SESSION[User]' LIMIT 1";
					runSQL($sql);
					$done = 1;
			}
		}
	// End PW Change
?>
	<?php if ($done){echo "<h3>!!Password Changed!!</h3>";}?>
	
	<hr class=spacer><hr class=spacer>
	<div id=uinfo class=obj>
		<h2>Details</h2>
		<?php 
			$sql = "SELECT * FROM Users where username = '$_SESSION[User]'";
			$row = singleRowSQL($sql);
			echo "<b> User:</b> $row[username]<br>";
			echo "<b> Name:</b> $row[first_name] $row[last_name]<br>";
			echo "<b>Email:</b> $row[email]<br>";
		?>
	</div>
	
	<div class=obj>
		<form id='passchange' method='POST'>
			<h2>Change Password</h2>
			<input name='word1' type='password' placeholder='Old Password'>
			<?php if ($wrong){ echo "Wrong Password!";} ?><br>
			<input name='word2' type='password' placeholder='New Password'>
			<input name='word3' type='password' placeholder='Repeat New Password'><br>
			<?php if ($match){echo "New Passwords Don't Match.<br>";} ?>
			<input type='submit' value='Change'>
		</form>
	</div>
	<hr>
	
<?php
	}else{
		echo "...There's no point to this page when your not <b>Logged in</b>..";
	}
?>
</div>
</body>