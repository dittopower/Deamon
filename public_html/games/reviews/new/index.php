<?php //Load Template
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_code();
	lib_perms();
	if(!canUserPerm("review","game")){
		toss(403);
	}
	page();
	
	if(isset($_POST['submit'])){
		global $mysqli;
		$sql= mysqli_prepare($mysqli, "INSERT INTO `D_Games` (`name`, `release date`, `series`, `publisher`, `developer`, `genre`, `modes`, `description`, `steam`, `origin`, `gog`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($sql,"sssssssssss", $_POST['name'], $_POST['date'], $_POST['series'], $_POST['publisher'], $_POST['developer'], $_POST['genre'], $_POST['modes'], $_POST['desc'], $_POST['steam'], $_POST['origin'], $_POST['gog']);
		
		if(mysqli_stmt_execute($sql)){
			$regouttext = 'Game added Sucessfully';
			note('Review',"Game::Created::$nuser");
			$r_id = singleSQL("Select LAST_INSERT_ID();");
			mysqli_stmt_close($sql);
			
			dir_Ensure($home."games/images/$r_id");
			$sql= mysqli_prepare($mysqli, "INSERT INTO `D_Games_Review` (`game`, `user`, `version`, `difficulty`, `performance rating`, `internet rating`, `responsiveness rating`, `graphics style`, `graphics rating`, `gameplay rating`, `overall rating`, `opinion`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			mysqli_stmt_bind_param($sql,"ssssssssssss", $r_id, $_SESSION['person'], $_POST['version'], $_POST['difficulty'], $_POST['rPerformance'], $_POST['rInternet'], $_POST['rResponse'], $_POST['gStyle'], $_POST['rGraphic'], $_POST['rGameplay'], $_POST['rOverall'], $_POST['opinion']);
			if(mysqli_stmt_execute($sql)){
				$regouttext = 'Reviewed Sucessfully';
				note('Review',"Review::Created::$nuser");
			} else {
				$regouttext = 'Review Failed.';
				note('Review',"Review::Failed::$nuser");
			}
			mysqli_stmt_close($sql);
			
		} else {
			$regouttext = 'Game add Failed.';
			note('Review',"Game::Failed::$nuser");
			mysqli_stmt_close($sql);
		}
	}
?>
<form method='POST'>
<label for='name'>Game </label><input name='name' id='name' type=text>
<label for='series'>Series </label><input name='series' id='series' type=text>
<label for='date'>Release Date </label><input name='date' id='date' type=date>
<br><br>
<label for='publisher'>Publisher </label><input name='publisher' id='publisher' type=text>
<label for='developer'>Developer </label><input name='developer' id='developer' type=text>
<br><br>
<label for='genre'>Genre </label><input name='genre' id='genre' type=text placeholder='Comma seperated ", "'>
<label for='modes'>Gamemodes </label>
<select id='modes' name='modes'>
	<option value='0'>Single</option>
	<option value='1'>Co-Operative</option>
	<option value='2'>Multiplayer</option>
	<option value='3'>Local Co-Operative</option>
	<option value='4'>Single, Co-Operative</option>
	<option value='5'>Single, Multiplayer</option>
	<option value='6'>Single, Local Co-Operative</option>
	<option value='7'>Co-Operative, Multiplayer</option>
	<option value='8'>Co-Operative, Local Co-Operative</option>
	<option value='9'>Multiplayer, Local Co-Operative</option>
	<option value='10'>Single, Co-Operative, Multiplayer</option>
	<option value='11'>Single, Co-Operative, Local Co-Operative</option>
	<option value='12'>Single, Multiplayer, Local Co-Operative</option>
	<option value='13'>Multiplayer, Co-Operative, Local Co-Operative</option>
	<option value='14'>Single, Multiplayer, Co-Operative, Local Co-Operative</option>
</select>
<br><br>
<label for='desc'>Description </label><textarea name='desc' id='desc' rows="4" cols="50"></textarea>
<br><br>
<label for='steam'>Steam </label><input name='steam' id='steam' type=text>
<label for='origin'>Origin </label><input name='origin' id='origin' type=text>
<label for='gog'>GOG </label><input name='gog' id='gog' type=text>
<br><br>
<label for='version'>Version </label><input name='version' id='version' type=text>
<label for='difficulty'>Difficulty </label><input name='difficulty' id='difficulty' type=text>
<br><br>
<label for='rPerformance'>Performance Rating </label><input name='rPerformance' id='rPerformance' type=number min='-1' max='100'>
<label for='rInternet'>Internet Rating </label><input name='rInternet' id='rInternet' type=number min='-1' max='100'>
<label for='rResponse'>Responsiveness Rating </label><input name='rResponse' id='rResponse' type=number min='-1' max='100'>
<br><br>
<label for='gStyle'>Graphics Style </label><input name='gStyle' id='gStyle' type=text placeholder='Comma seperated ", "'>
<label for='rGraphic'>Graphics Rating </label><input name='rGraphic' id='rGraphic' type=number min='-1' max='100'>
<br><br>
<label for='rGameplay'>Gameplay Rating </label><input name='rGameplay' id='rGameplay' type=number min='-1' max='100'>
<label for='rOverall'>Overall Rating </label><input name='rOverall' id='rOverall' type=number min='-1' max='100'>
<br><br>
<label for='opinion'>Opinion </label><textarea name='opinion' id='opinion' rows="4" cols="50"></textarea>
<br><br>
<input type=submit name="submit" value="Post Review">
</form>