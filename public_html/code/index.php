<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/feed.php";
?>
<!-- START content -->

<?php 
	feed('coding');
?>