<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."page.php";
?>

<?php
	$sql = "Select * from game g join game_Reviews d on game_id = id";
	if (isset($_GET['id'])){
		$sql .= " where id = $_GET[id]";
	}
	$sql .= " limit 0,30";
	$result = multiSQL($sql);
	
	function showGmodes ($rows){
		$results = "<ul>";
		if($rows['play_single']){$results.="<li>Single Player</li>";}
		if($rows['play_coop']){$results.="<li>Co-Operative</li>";}
		if($rows['play_multi']){$results.="<li>Multi-player</li>";}
		return $results."</ul>";
	}
	function showGtypes($rows){
		$results = "<ul><li>".str_replace(';','</li><li>',$rows['types'])."</li></ul>";
		return $results;
	}

//List All Games
	if (!isset($_GET['id'])){
		if(!isset($_GET['2'])){
			echo '<table class="gamebase">';
			echo "<tr><th>Game</th><th>Publisher</th><th>Developer</th><th>Game Style</th><th>Play Modes</th></tr>";
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
				echo "<tr onclick=\"location='?id=$row[id]&$row[name]'\">";
				echo "<td class='gname'>$row[name]</td>";
				echo "<td class='gpublisher'>$row[publisher]</td>";
				echo "<td class='gdev'>$row[dev]</td>";
				echo "<td class='gtypes'>".showGtypes($row)."</td>";
				echo "<td class='gmodes'>".showGmodes($row)."</td>";
				echo "</tr>";
			}
			echo '</table>';
		}else{
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
				echo "<div class='obj' onclick=\"location='?id=$row[id]&$row[name]'\">";
				echo "<h2 class='gname'>$row[name]</h2>";
				echo "<h3 class='gpublisher'>$row[publisher]</h3>";
				echo "<h3 class='gdev'>$row[dev]</h3>";
				echo "<span class='gtypes'>".showGtypes($row)."</span>";
				echo "<span class='gmodes'>".showGmodes($row)."</span>";
				echo "</div>";
			}
		}
		
	}else{
		$row = mysqli_fetch_array($result,MYSQL_ASSOC);
		echo "<table id='gb_stats'>";
		echo "<h1>$row[name]</h1>";
		echo "<tr><td><h4>Developer</h4></td><td>$row[dev]</td></tr>";
		echo "<tr><td><h4>Publisher</h4></td><td>$row[publisher]</td></tr>";
		echo "<tr><td><h4>Release</h4></td><td>$row[date]</td></tr>";
		echo "<tr><td><h4>Game Genre</h4></td><td>".showGtypes($row)."</td></tr>";
		echo "<tr><td><h4>Game Modes</h4></td><td>".showGmodes($row)."</td></tr>";
		echo "<tr><td><h4>Graphics Style</h4></td><td>$row[graphic_style]</td></tr>";
		echo "<tr><td><h4>Graphics Rating</h4></td><td>$row[graphic_rating]</td></tr>";
		echo "<tr><td><h4>Responsiveness</h4></td><td>$row[responsive_rating]</td></tr>";
		echo "<tr><td><h4>story quality</h4></td><td>$row[story_quality]</td></tr>";
		echo "<tr><td><h4>story engagement</h4></td><td>$row[story_engagement]</td></tr>";
		echo "<tr><td><h4>lore</h4></td><td>$row[lore]</td></tr>";
		echo "<tr><td><h4>world</h4></td><td>$row[world]</td></tr>";
		echo "<tr><td><h4>Reviewer</h4></td><td>$row[user_id]</td></tr>";
		$images = scandir("$home/res/games/$row[id]");
		unset($images[0]);unset($images[1]);
		foreach($images as $image){
			echo "<div class='obj' style='width:20%;height:20%;background: url(\"/res/games/$row[id]/$image\");background-size: contain;background-repeat: no-repeat;background-position: center;'></div>";
		}
		echo "</table>";
	}
	echo '</div></body>';
?>

