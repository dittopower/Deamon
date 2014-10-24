<?php
	include '../page.php';
	
//Check permissions
	$sql="SELECT game_review FROM user_priv WHERE username='$_SESSION[User]'";
	if (singleSQL($sql, $mysqli)){
	
		echo '<div class="page"><hr class="spacer">';
		echo "<h1>Review Game</h1><hr class='spacer'>";
		
		if (!isset($_GET['game'])){
		//Add new game
			if (isset($_POST['new'])&&isset($_POST['date'])){
			$sql_add_game="INSERT INTO `a4561011_core`.`GameDB` (`id`, `name`, `publisher`, `dev`, `date`) VALUES (LAST_INSERT_ID(), '$_POST[new]', '$_POST[pub]', '$_POST[dev]', '$_POST[date]');";
			runSQL($sql_add_game, $mysqli);
			}
		//Get Un-reviewed game list
			$sql="SELECT id,name FROM GameDB WHERE id not in (select game_id from GameReviews)";
			
			echo "<table class='gamebase'><tr><th><h2>Game</h2></th></tr>";
			
			$result = multiSQL($sql, $mysqli);
			while($rows = mysqli_fetch_array($result,MYSQLI_BOTH)){
				echo "<tr><td><a href='?game=$rows[id]'>$rows[name]</a></td></tr>";
			}
			echo "</table><hr class='spacer'>";
			echo "<form method='POST' style='text-align:center;'><table class='gamebase'>";
			echo "<tr><th><h1>New Game</h1></th></tr>";
			echo "<tr><td><label>Title: </label><input type='text' name='new' placeholder='Game'></td></tr>";
			echo "<tr><td><label>Publisher: </label><input type='text' name='pub' placeholder='Publisher'></td></tr>";
			echo "<tr><td><label>Developer: </label><input type='text' name='dev' placeholder='Developer'></td></tr>";
			echo "<tr><td><label>Release Date: </label><input type='date' name='date' placeholder='Release Date'></td></tr>";
			echo "<tr><td><input type='submit'></td></tr>";
			echo "</table></form>";


		}else{

		//Add new game
			if (isset($_POST['g_details'])&&isset($_POST['types'])&&isset($_POST['style'])&&isset($_POST['gr_rate'])&&isset($_POST['ai_rate'])&&isset($_POST['res_rate'])&&(isset($_POST['m_single'])||isset($_POST['m_coop'])||isset($_POST['m_multi']))){
				$ms = $_POST['m_single'] == 'on';
				$mc = $_POST['m_coop'] == 'on';
				$mm = $_POST['m_multi'] == 'on';

				$sql_add_game = "INSERT INTO `a4561011_core`.`GameReviews` (`game_id`, `user_id`, `graphic_style`, `graphic_rating`, `ai_rating`, `responsive_rating`, `types`, `play_single`, `play_coop`, `play_multi`, `time`)";
				$sql_add_game .= "VALUES ('$_GET[game]', '$_SESSION[User]', '$_POST[style]', '$_POST[gr_rate]', '$_POST[ai_rate]', '$_POST[res_rate]', '$_POST[types]', '$ms', '$mc', '$mm', CURDATE());";

				if (!runSQL($sql_add_game, $mysqli)){
					echo "Failed";
				}
			}

		/* Rating The Chosen Game */
			$sql = "SELECT * FROM GameDB WHERE id='$_GET[game]'";
			$row = singleRowSQL($sql, $mysqli);
			
			echo "<table class='gamebase'>";
			echo "<tr><th><h2>Detail</h2></th><th><h2>Game</h2></th></tr>";
			echo "<tr><td><h2>Title: </h2></td><td><h3>$row[name]</h3></td></tr>";
			echo "<tr><td><h2>Publisher: </h2></td><td><h3>$row[publisher]</h3></td></tr>";
			echo "<tr><td><h2>Developer: </h2></td><td><h3>$row[dev]</h3></td></tr>";
			echo "<tr><td><h2>Release Date: </h2></td><td><h3>$row[date]</h3></td></tr>";
			
			echo "<form method='POST' style='text-align:center;'>";
			echo "<tr><td><h2>Genre: </h2></td><td><input type='text' name='types' placeholder='RPG, FPS, Action..'></td></tr>";
			echo "<tr><td><h2>Graphical Style: </h2></td><td><input type='text' name='style' placeholder='2D Sprites, Hand Draw, 3D..'></td></tr>";
			echo "<tr><td><h2>Graphics Rating: </h2></td><td><input type='range' name='gr_rate' min='0' max='4'></td></tr>";
			echo "<tr><td><h2>AI Rating: </h2></td><td><input type='range' name='ai_rate' min='0' max='4'></td></tr>";
			echo "<tr><td><h2>Responsiveness: </h2></td><td><input type='range' name='res_rate' min='0' max='4'></td></tr>";
			echo "<tr><td><h2>Gameplay Modes: </h2></td><td>";
				echo "<input type='checkbox' id='m_s' name='m_single'><label for='m_s'> Single Player</label><br>";
				echo "<input type='checkbox' id='m_c' name='m_coop'><label for='m_c'> Co-Operative</label><br>";
				echo "<input type='checkbox' id='m_m' name='m_multi'><label for='m_m'> Multi-Player</label></td></tr>";
			echo "<tr><td><a href='?'><h3>Back</h3></a></td><td><input type='submit' name='g_details'></td></tr>";
			echo "</table></form>";

		}
	}
?>
