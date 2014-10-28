<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."page.php";
	if(isUser()){
?>
<div class='page'>


<?php
	if(isset($_POST['MSG']) && isset($_POST['who'])){
	
	}
?>

<!-- Send Quote -->
<form method=POST action='./'>
	<input type=text name=MSG maxlength=220 >
	<select multiple id="friends" name="whom">
		<?php
		$sql = "SELECT user_b as nick, com_id FROM `user_friends` where user_a = '$_SESSION[User]' and block_a = 0 union all SELECT user_a as nick, com_id FROM `user_friends` where user_b = '$_SESSION[User]' and block_b = 0;";
		$results = multiSQL($sql);
		while($rows = mysqli_fetch_array($results,MYSQLI_BOTH)){
				echo "<option value='$rows[com_id]'>$rows[nick]</option>";
		}
		?>
	</select>
	<input type='submit' value=Quote >
</form>


<?php }?>
</div>