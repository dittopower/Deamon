<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();
	lib_feed();
	?>
	<h1>Minecraft</h1>
	<hr>
	<p>Just a couple of random minecraft related things. I'd don't think any of them are done, they're mostly little ideas i had at one point or another and never finished.</p>
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