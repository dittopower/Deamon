<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();
	lib_feed();
	?>
	<h1>University</h1>
	<hr>
	<p>Just a few Projects and things i made for university.
	<br>A few of them require logins so you wont be able to access them.</p>
	<hr>
	<?php
		$projects = scandir('./');
		$fileex = "(.php)|(.htm.*)|(.jpg)|(.png)|(.gif)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)|302MEDIA|cgi-bin/",$project))){
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