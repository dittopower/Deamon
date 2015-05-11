<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	if($layers <= 1){
		$home = "./";
	}else{
		for($i = 1;$i < $layers;$i++){
			$home .= "../";
		}
	}
	require $home."hidden/deamon.php";
	require $home."hidden/start.php";
	require $home."hidden/nav.php";
	
?>
<!-- START content -->

<h1>Deamon</h1><h2>Tech, Games & Code</h2><h3>Coming Soon</h3>
<br>
<?php
if(!isUser()){?>
	<form id='userForm' method='POST' <?php if(isset($e_login)){
		echo "style='border: red 1px solid;background: rgba(250,0,0,0.5);'";}?>>
		<input type='text' name='username' placeholder='Username'>
		<input type='password' name='password' placeholder='Password'>
		<input type='submit' value='>'>
<?php }else{ ?>
	<form id='userForm' method='POST'>
		<input name='logout' hidden>
		<input id='logoutbtn' type='submit' value='Logout'>
<?php } ?>
	</form>

<!-- END content -->
<?php
	require $home."hidden/end.php";
?>