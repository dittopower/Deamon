<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	if(canUser('admin')){
		//START content
		
		echo "<h1>Permissions</h1>";
		dump_table("D_Perms");
		
		echo "<hr><h1>User</h1>";
		dump_table("D_Accounts");

	}else{
		echo "Admin Only";
		toss(403);
	}
?>