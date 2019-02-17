<?php
	session_start();
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	
	lib_code();
	
	if(isset($_POST["SupervisorLogout"])){
		unset($_SESSION);
		$_SESSION = array();
		session_destroy();
		
		header("Location: /");
		exit();
	}//logout
	
	if( isset($_SESSION["SupervisorID"]) ){
		lib_database();
		//lib_group();
?>
	
<HTML>

<HEAD>
	<title>Teamwork</title>
	<link rel="Shortcut Icon" href="https://esoe.qut.edu.au/static/favicon-d177589c7efc2024aefe76fe35962db2.ico">
	<link rel="stylesheet" type="text/css" href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/style.css">
	
	<script src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/jquery-2.1.4.min.js"></script>
	
</HEAD>
<BODY>
	<aside id="supervisoraside">
	
		<div id="infobox">			
			<!--<img src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/qut-logo-200.jpg" id="logoimg">-->
			<img src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/teamwork-logo-800px.png" id="teamworklogo">
			
			<div class='clear'></div>
			
			<h3 id="sidebartitle">Supervisor View</h3>
			<!--Supervisor: #<?php //echo $_SESSION["SupervisorID"]; ?>-->
		</div>
		
		<div id="chatarea">
			<div id="supervisorSide">
				<!--<h3>Supervisor Actions</h3>
				<input type="button" value="Generate Summary Report" class='button button1'><br><br>
				<input type="button" value="Some other function" class='button button1'>-->
			</div>
		</div>
	</aside>
	
	<nav id="supervisornav">
		<ul>
			<li <?php if($_SERVER['PHP_SELF'] == "/supervisor/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/supervisor/">View Projects</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == "/supervisor/project/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/supervisor/project/">Create Project</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == "/supervisor/groups/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/supervisor/groups/">View Groups</a></li>
		</ul>
		<form id='logoutBtn' class='_pannel' method='POST' action=''>
			<?php echo singleSQL("SELECT CONCAT(FirstName, ' ', Surname) FROM Supervisor WHERE SupervisorID=".$_SESSION['SupervisorID']); ?>&nbsp;
			<input class='button button1' name="SupervisorLogout" id='logoutbutton' type='submit' value='Logout'>
		</form>
	</nav>
	
	<section id="supervisorsection">	

<!--page content start -->

<?php function myEnd(){ ?>

<!--page content end -->
			<footer>
				For QUT 2015.<br><br><br>
				Joshua Henley | Damon Jones | Emma Jackson | Will Jakobs | Declan Winter
			</footer>
		</section>
	</BODY>
	</HTML>
<?php
	}
	
	register_shutdown_function('myEnd');
	
	} else{ header("Location: http://" . $_SERVER[HTTP_HOST]); } ?>
