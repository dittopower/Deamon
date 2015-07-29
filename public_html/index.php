<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/feed.php";
	
?>
<!-- START content -->

<h1>Deamon</h1><h2>Tech, Games & Code</h2><h3>Coming Soon</h3>
<br>
yeah, yeah, i'm slowly making it..

<?php 
	feed('');
?>