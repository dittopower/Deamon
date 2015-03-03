<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."page.php";
?>

<?php
	if(isUser()){
		if(isset($_POST['room']) && isset($_POST['title'])){
			$vid = escapeSQL($_POST['room']);
			if(count($_POST['title']) > 0){
				$title = escapeSQL($_POST['title']);
			}else{
				$title = "$_SESSION[User]'s Room";
			}
			if(count($_POST['priv']) > 0){
				$pri = escapeSQL($_POST['priv']);
			}else{
				$pri = 0;
			}
			if(count($_POST['time']) > 0){
				$tm = escapeSQL($_POST['time']);
			}else{
				$tm = 0;
			}
			$sql = "INSERT INTO watch_rooms (user, video, time, play, public, name) VALUES ('$_SESSION[User]', '$vid', '$tm', '0', '$pri', '$title')";
			//echo "<br>here $sql <br>";
			runSQL($sql);
		}
	}



	if($_GET['r']){
		$room = escapeSQL($_GET['r']);
		$sql = "SELECT * FROM watch_rooms WHERE user = '$_SESSION[User]' limit 1";
		$row = singleRowSQL($sql);
		echo "<div id='ytplayer'></div><script>
			  // Load the IFrame Player API code asynchronously.
			  var tag = document.createElement('script');
			  tag.src = 'https://www.youtube.com/player_api';
			  var firstScriptTag = document.getElementsByTagName('script')[0];
			  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			  // Replace the 'ytplayer' element with an <iframe> and
			  // YouTube player after the API code downloads.
			  var player;
			  function onYouTubePlayerAPIReady() {
				player = new YT.Player('ytplayer', {
				  height: '390',
				  width: '640',
				  videoId: '$row[video]',
				  playerVars: {
					autoplay: '$row[play]',
					enablejsapi: '1',
					start: '$row[time]',
					origin: '$D'
				  },
				  events: {
				  'onPlay': thing here///////////////////////////////////////////
				}
				});
			  }
			</script>";
	}else{
		echo "<ul>";
		$sql = "SELECT name, user FROM watch_rooms where public = 1 or user = '$_SESSION[User]'";
		$rooms = multiSQL($sql);
		while($row = mysqli_fetch_array($rooms,MYSQLI_BOTH)){
			echo "<li><a href='?r=$row[user]'>$row[name]</a></li>";
		}
		$sql = "SELECT name, user FROM watch_rooms join `user_friends` a on a.user_b = user join Users b on a.user_b = b.username where user_a = '$_SESSION[User]' and block_a = 0 and public = 0 union all SELECT name, user FROM watch_rooms join `user_friends` a on a.user_a = user join Users b on a.user_a = b.username where user_b = '$_SESSION[User]' and block_b = 0 and public = 0";
		$rooms = multiSQL($sql);
		while($row = mysqli_fetch_array($rooms,MYSQLI_BOTH)){
			echo "<li><a href='?r=$row[user]'>$row[name]</a></li>";
		}
		echo "</ul>";
		
		if(isUser()){
		
			echo "<script>
				function tubify(){
					vid = document.getElementById('room');
					pat = /\?v=([^&]+)/; patt = /be\/([^&?]+)/;
					res = pat.exec(vid.value) || patt.exec(vid.value);
					pat = /[?&]t=((\d+)m)?((\d+)s)?/
					tm = pat.exec(vid.value) || [0,0,0,0,0];
					sec = eval(tm[4]) || 0;
					min = eval(tm[2]) || 0;
					tm = min * 60 + sec;
					document.getElementById('time').value = tm;
					vid.value = res[1];
				}
				</script>
				<form method='post' onsubmit='tubify();'>
					<input type='text' name='title' id='title' maxlength='30' placeholder='Room Name'>
					<input type='text' name='room' id='room' maxlength='70' placeholder='youtube URL'>
					<input type='text' name='time' id='time' hidden>
					<input type='checkbox' name='priv' id='priv'><label for='priv'>Public</label>
					<input type='submit' value='Create'>
				</form>";
	}
	}
	
	
