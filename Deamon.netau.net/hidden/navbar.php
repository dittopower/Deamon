<?php
	$D = $_SERVER['HTTP_HOST'];
?>

<div id='nav'>
	<script type="text/javascript">
		function menu(target){
			menus=document.getElementsByTagName("nav");
			for (i=1;i < menus.length;i++){
				if (menus[i].id != target){
					menus[i].hidden = true;
				}else{
					if (menus[i].hidden){
						menus[i].hidden = false;
					}else{
						menus[i].hidden = true;
					}
				}
			}
		}
	</script>
	
<!-- Primary Navigation Bar -->
	<nav id='navMain'>
		<a href="//<?php echo $D; ?>"><div>Home</div></a><div onclick='menu("tech")'>Tech*</div><div onclick='menu("games")'>Games</div><div onclick='menu("code")'>Code</div><div onclick='menu("user")'>User</div>
	</nav>
	<!-- End Primary -->
	
<!-- Tech Navigation -->
	<nav id='tech' class='submenu' hidden>
		<div>News*</div>
		<div>Tech Base*</div>
		<div>Parts Base*</div>
		<div>*Search*</div>
	</nav>
	<!-- End Tech -->

<!-- Game Navigation -->
	<nav id='games' class='submenu' hidden>
		<div>News*</div>
		<a href='//<?php echo $D; ?>/games'><div>Game Base</div></a>
		<?php if (canUser("game_review")){?><a href='//<?php echo $D; ?>/games/reviewer.php'><div>Submit Review</div></a><?php }?>
		<div>Text Adventure*</div>
		<div>*Search*</div>
	</nav>
	<!-- End Games -->

<!-- Code Navigation -->
	<nav id='code' class='submenu' hidden>
		<div>News*</div>
		<?php if (canUser("code_edit")){?><a href='//<?php echo $D; ?>/Editor'><div>Editor</div></a><?php }?>
		<a href='//<?php echo $D; ?>/random'><div>Random</div></a>
		<a href='//<?php echo $D; ?>/uni'><div>University</div></a>
		<div>*Search*</div>
	</nav>
	<!-- End Code -->

<!-- User Navigation -->
	<nav id='user' class='submenu' <?php if(!isset($_SESSION['User'])){echo ' hidden';}?>>
	<?php 
	if (isset($_SESSION['User'])){ ?>
		<a href='//<?php echo $D; ?>/me/Friends'><div>Friends (w.i.p)</div></a>
		<a href='<?php echo "//$D/me/";?>'><div><?php echo $_SESSION['User']; ?></div></a>
		<div id='navUser'><form id='userForm' method='POST'>
			<input name='logout' hidden><input id='logoutbtn' type='submit' value='Logout'>
	<?php }else{ 
		echo "<a href='//$D/me/register.php'><div id='navReg'>Register</div></a>";
		echo "<div id='navUser'><form id='userForm' method='POST'>";
			echo "<input type='text' name='username' placeholder='Username'>";
			echo "<input type='password' name='password' placeholder='Password'>";
			echo "<input type='submit' value='>'>";
	} ?>
	</form></div>
	</nav>
	<!-- End User -->
	
</div>