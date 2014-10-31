<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."/hidden/code.php";
	include $home."/hidden/login.php";
?>
<?php
if(isUser()){
	if(isset($_POST["Name"]) && isset($_POST["please"])){
		$name = $_POST["Name"];
		if($_POST["please"] === "find"){
			$sql = "Select username, first_name, img from Users where username like '%$name%' or concat(first_name, ' ', last_name) like '%$name%'";
			$results = multiSQL($sql);
			while($rows = mysqli_fetch_array($results,MYSQLI_BOTH)){
				echo "$rows[username]:$rows[first_name]:$rows[img];";
			}
		}else if($_POST["please"] === "add"){
			$sqla = "Select com_id, block_a from user_friends where user_b = '$name' and user_a = '$_SESSION[User]'";
			$sqlb = "Select com_id, block_b from user_friends where user_a = '$name' and user_b = '$_SESSION[User]'";
			
			$sqli = "INSERT INTO user_friends(user_a, user_b, block_a, block_b) VALUES ('$_SESSION[User]', '$name', 0, 1)";
			
			$row = singleRowSQL($sqla);
			$rows = singleRowSQL($sqlb);
			if($row != 0){
				if($row['block_a']){
					$sqlau = "UPDATE user_friends SET block_a = 0 WHERE com_id = '$row[com_id]' LIMIT 1";
					runSQL($sqlau);
				}else if($rows != 0){
					if($rows['block_b']){
						$sqlbu = "UPDATE user_friends SET block_b = 0 WHERE com_id = '$rows[com_id]' LIMIT 1";
						runSQL($sqlbu);
					}else{
						runSQL($sqli);
					}
				}
			}
		}else if($_POST["please"] === "un"){
			echo "un";
			$sqla = "Select com_id, block_a from user_friends where user_b = '$name' and user_a = '$_SESSION[User]'";
			$sqlb = "Select com_id, block_b from user_friends where user_a = '$name' and user_b = '$_SESSION[User]'";
			
			$row = singleRowSQL($sqla);
			$rows = singleRowSQL($sqlb);
			if($row != 0){
			echo "A";
				if(!$row['block_a']){
			echo "b";
					$sqlau = "UPDATE user_friends SET block_a = 1 WHERE com_id = '$row[com_id]' LIMIT 1";
					runSQL($sqlau);
				}else if($rows != 0){
			echo "C";
					if(!$rows['block_b']){
			echo "d";
						$sqlbu = "UPDATE user_friends SET block_b = 1 WHERE com_id = '$rows[com_id]' LIMIT 1";
						runSQL($sqlbu);
					}
				}
			}
		}
	}
}
?>