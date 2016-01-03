<?php
	require_once "/home3/deamon/public_html/lib.php";
	lib_wordnet();

	$order = "";
	$limit = "";
	$mine = "";
	if(isset($_GET['order'])){
		switch($_GET['order']){
			case "rand":
				$order = 0;
				break;
			case "desc":
				$order = 2;
				break;
			case "asc":
				$order = 1;
				break;
		}
	}
	if(isset($_GET['mine'])){
		$mine = wn_escapeSQL($_GET['mine']);
	}
	if(is_numeric($_GET['limit'])){
		$limit = $_GET['limit'];
	}

	if(isset($_GET['op'])){
		switch($_GET['op']){
			case "words":
				wn_words($mine,$limit,$order);
				break;
		}
	}
?>