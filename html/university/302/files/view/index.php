<?php //Load Template
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_media();

	media_(key($_GET));	
?>