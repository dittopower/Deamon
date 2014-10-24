<?php
	include '../page.php';
	$sql = "Select * from GameDB g join GameReviews d on game_id = id and user_id = 'demon'";

	if (isset($_GET['id'])){
		$sql .= "where id = $_GET[id]";
	}

	$result = multiSQL($sql,$mysqli);
	
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
	
	echo '<div class="page"><hr class="spacer">';
	if (!isset($_GET['id'])){
	echo '<table class="gamebase">';
	echo "<tr class='gb_head'><th class='gb_img'>Cover</th><th class='gb_name'>Name</th><th class='gb_type'>Game Genre</th><th class='gb_modes'>Modes</th><th class='gb_graphics'>Graphics Type/Rating</th><th class='gb_res'>Responsiveness</th><th class='gb_ai'>AI</th></tr>";
	
	while($rows = mysqli_fetch_array($result,MYSQLI_BOTH)){
		$game = "<tr onclick='location=\"?id=$rows[id]&".str_replace(' ','_',$rows['name'])."\"'><td class='gb_img'><img src='./res/$rows[id].png'></td>";
		$game .= "<td class='gb_name'>$rows[name]</td>";
		$game .= "<td class='gb_type'>".showGtypes($rows)."</td>";
		$game .= "<td class='gb_modes'>".showGmodes($rows)."</td>";
		$game .= "<td class='gb_graphics'>$rows[graphic_style],$rows[graphic_rating]</td>";
		$game .= "<td class='gb_res'>$rows[responsive_rating]</td>";
		$game .= "<td class='gb_ai'>$rows[ai_rating]</td></tr>";
		echo $game;
	}
	
	echo '</table>';
	}else{
		$rows = mysqli_fetch_array($result,MYSQLI_BOTH);
		echo "<table id='gb_page'><tr><td class='quarter_w'><table id='gb_stats'>";
		echo "<tr><td><h4>Developer</h4></td><td>$rows[dev]</td></tr>";
		echo "<tr><td><h4>Publisher</h4></td><td>$rows[publisher]</td></tr>";
		echo "<tr><td><h4>Release</h4></td><td>$rows[date]</td></tr>";
		echo "<tr><td><h4>Game Genre</h4></td><td>".showGtypes($rows)."</td></tr>";
		echo "<tr><td><h4>Game Modes</h4></td><td>".showGmodes($rows)."</td></tr>";
		echo "<tr><td><h4>Graphics Style</h4></td><td>$rows[graphic_style]</td></tr>";
		echo "<tr><td><h4>Graphics Rating</h4></td><td>$rows[graphic_rating]</td></tr>";
		echo "<tr><td><h4>Responsiveness</h4></td><td>$rows[responsive_rating]</td></tr>";
		echo "<tr><td><h4>AI Rating</h4></td><td>$rows[ai_rating]</td></tr>";
		echo "</table></td><td class='quarter3_w'><table id='gb_stuff'>";
		echo "<tr><th><h1 id='gb_title'>".$rows['name']."</h1><hr></th></tr>";
		echo "<td>img + review goes here</td>";
		echo "</table></td></tr></table>";
	}
	echo '</div></body>';
?>

