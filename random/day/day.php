<?php
	include '../../page.php';
	
	$s = '<link rel="stylesheet" type="text/css" href="day.css">';
	
	echo $s;
	
	$datesql = "SET time_zone = '+10:00';SELECT * FROM `dates` where day = DATE_FORMAT(NOW(),'%d/%c');";
	$result = multi_SQL($datesql);
	
	if ($result->num_rows != 0){
		while($rows = mysqli_fetch_array($result,MYSQLI_BOTH)){
			echo "<link rel='stylesheet' type='text/css' href='$rows[dance].css'>";
			echo "<div class='$rows[dance]' id='box'><div id='a' class='card'></div><div id='b' class='card'></div>";
			echo "<div class='pie'><h1 class='sp_text'>$rows[what]</h1></div><div id='c' class='card'></div><div id='d' class='card'></div></div>";
		}
	}else{
		echo "<h1 class='sp_text'>Nothing Today...</h1>";
	}
	
	echo '</div></div>';
?>