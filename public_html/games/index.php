<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();
	lib_feed();
	?>
	<h1>My Games</h1>
	<hr>
	<p>Just a few random Games I made for one reason or another at some point.
	<br>Don't expect them to be amazing...</p>
	<hr>
	<?php
		$projects = scandir('./');
		$fileex = "(.php)|(.htm.*)|(.jpg)|(.png)|(.gif)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)|images/",$project))){
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
	<hr>
	<h1>Gaming Feed</h1>
	<?php 
		feed('games');
	?>
</div>