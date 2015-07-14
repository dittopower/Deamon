</div>
<footer>
<?php if(!isUser()){?>
	<form id='userForm' class='_pannel' method='POST' <?php if(isset($e_login)){
		echo "style='border: red 1px solid;background: rgba(250,0,0,0.5);'";}?>>
		<input type='text' name='username' placeholder='Username'>
		<input type='password' name='password' placeholder='Password'>
		<input type='submit' value='>'>
<?php }else{ ?>
	<form id='userForm' class='_pannel' method='POST'>
		<input name='logout' hidden>
		<input id='logoutbtn' type='submit' value='Logout'>
<?php } ?>
	</form>


</footer>
<?php
	require_once("connection_include.php");
	mysqli_close($mysqli);
?>
</body>