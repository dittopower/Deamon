<!-- Damon Jones n8857954 -->

<!-- Josh Henley n8858594 -->



<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->

<nav>

	<?php

		if(isset($_SESSION['User'])){

		$un = $_SESSION['User'];

		$t=singleSQL("SELECT admin FROM members WHERE username='$un'",$mysqli);

	

	if($t == 1){?><a href="./uploadCSV.php">Upload CSV</a>  | <?php } }?>

	<a href="./info.txt">Submision Info</a>  |  

	<a href="./">Search</a>  |  

	<a href="./parks.php">Playgrounds</a>  |  

	<?php if(!isset($_SESSION['User'])){ ?>

		<a href='userAuth.php?createUser=true'>Register</a> | 

		<form method='post' action='userAuth.php' style='display:inline;'>

			<input type='text' name='username' placeholder='Username'>

			<input type='password' name='password' placeholder='Password'>

			<input type='submit' value='Login'>

		</form>

	<?php } else { echo 'Logged in as: <u>' . $_SESSION['User'] . '</u> <button onclick="window.location=\'./logout.php\'">Logout</a>'; } ?>



</nav>