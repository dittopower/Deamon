<?php 
	include "../page.php";
?>
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
				if (file_exists("$p.info")){
					$text = file_get_contents("$p.info");
				}else{
					$text = $p;
				}
				$text = htmlescape($text);
				echo "<a href='$project' class='obj' title='$text'>$p</a>";
			}
		}
	?>
</div>