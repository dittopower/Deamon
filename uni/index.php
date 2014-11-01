<?php 
	include "../page.php";
	
?>
<div class='page'>
	<h1>University Projects</h1>
	<p>My Web Based University Projects &copy; Damon 2014</p>
	<hr><hr>
	<?php
		$projects = scandir('./');
		$fileex = "(.php)|(.htm.*)";
		$folder = "(^[^.]+$)";
		foreach ($projects as $project){
			if (preg_match("/$fileex|$folder/",$project)&& !(preg_match("/index($fileex)/",$project))){
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

</div></body>