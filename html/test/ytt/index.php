<?php
	require_once "/var/www/html/lib.php";
	page();
	
	echo "<h1>Watch Together</h1>";
	
	echo "<h3>My Room</h3>";
	echo "Start Room: ";
?>
	<form method='POST'>
		<label for="url">Video Url: </label><input name="url" id="url" type="text" oninput="" placeholder="youtube.com/watch?v=aBcdEf">
<input name="service" id="service" type="text" hidden><input name="time" id="time" type="text" hidden>
		<br><label for="access">Allow Access: </label><select name="access" id="access" oninput="">
			<option value="public">Public</option>
			<option value="pass">Password</option>
			<option value="friends">Friends Only - coming soon</option>
		</select>
		<span id='pass' hidden><br><label for="password">Password: </label><input name="pass" id="password" type="text" oninput="" placeholder="password"></span>
		<br><input type='submit' value='Watch'>
	</form>
<?php
	echo "<h3>Friend's Rooms</h3>";
	echo "coming eventually...";
	
	echo "<h3>Public Rooms</h3>";
	echo "coming soon...";
?>