<?php 
	include "../../page.php";
?>
<div class='page'>
	<h1>Minecraft</h1>
	<hr>
	<p>The Central Hub for my Texture packs and maybe eventually Mods.</p>
	<hr>
	<?php
		$projects = scandir('./');
		$fileex = "(.zip)|(.jar)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)/",$project))){
				$p = preg_replace("/$fileex/","",$project);
				echo "<a href='$project' class='obj'>$p</a>";
			}
		}
	?>
</div>