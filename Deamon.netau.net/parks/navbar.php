<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->
<nav>
	<a href="./">Search</a>  |  
	<a href="./parks.php">Playgrounds</a>  |  
	<?php if(!isset($_SESSION['User'])){ ?>
		<a href='//deamon.netau.net/register.php'>Register</a> | 
		<form method='post' action='userAuth.php' style='display:inline;'>
			Login Via This sub-site is Disabled until i fix this part of the site.<a href="//deamon.netau.net">Login Here</a>
		</form>
	<?php } else {
		
	?>	<script> 
			function bye (){
				logout = new XMLHttpRequest();
				logout.open("POST", "logout.php");
				logout.send();
				location = location;
			}
		</script><?php
		$name =  singleSQL("Select first_name from Users where username = '". $_SESSION['User'] ."'", $mysqli);
		echo 'Logged in as: <u>' . $name . '</u> <button id="outbtn" onclick="bye()">Logout</button>'; } ?>
</nav>