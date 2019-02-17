<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	supervisor();
	if(isset($_GET['u'])){
		require_once "$local/user/profile.php";
	}else{
		card("You must select a applicant to view this page.","");
	}
?>