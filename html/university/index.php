<?php
	require_once "/var/www/html/lib.php";
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
		$fileex = "(.php)|(.htm.*)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)|302MEDIA|cgi-bin|302/",$project))){
				$p = preg_replace("/$fileex/","",$project);
				echo "<span class='obj'  style='width:96%;text-align:center;'><a href='$project'><h3>$p</h3></a>";
				if (file_exists("$p.png")){
					echo "<img src='./$p.png' class='project_banner' alt='$p Banner' style='width:50%;'>";
				}
				echo "<br><p style='text-align:justify;'>";
				if (file_exists("$p.info")){
					$text = file_get_contents("$p.info");
					echo $text;
				}else{
					echo "Project .info Not Found.";
				}
				echo "</p></span>";
			}
		}
	?>