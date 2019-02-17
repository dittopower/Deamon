<?php
	
	session_start();
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	
	if(isset($_SESSION['SupervisorID'])){
		require_once($_SERVER[DOCUMENT_ROOT]."/supervisor/supervisor.php");
	}
	else{
		page();
	}
		
	include "profile.php";
		
?>