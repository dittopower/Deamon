<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require $home."../core/feed.php";
?>
<!-- START content -->

<?php 
	feed('coding');
?>