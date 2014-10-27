<?php 
	include "../page.php";
?>
<div class='page'>
	<h1>Random Things</h1>
	<hr>
	<p>Just a few random pages and other bits of code I made for one reason or another at some point.</p>
	<hr>
	<?php
		$projects = scandir('./');
		$fileex = "(.php)|(.htm.*)|(.jpg)|(.png)|(.gif)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)/",$project))){
				$p = preg_replace("/$fileex/","",$project);
				echo "<a href='$project' class='obj'>$p</a>";
			}
		}
	?>
</div>