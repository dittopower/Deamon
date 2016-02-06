<?php //Load Template
	require_once "/home3/deamon/public_html/lib.php";
	lib_login();
	require_once "frame.php";
	lib_feed();
	
?>
<!-- START content -->

<h1>Deamon</h1><h2>Tech, Games & Code</h2><h3>Coming Soon</h3>
<br>
yeah, yeah, i'm slowly making it..

<?php 
	feed('');
?>