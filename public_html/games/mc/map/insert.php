<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	if(canUser("mc")){
		if(isset($_POST['recipe'])){
			if(isset($_POST['src']) && isset($_POST['dst'])){
				if(!is_numeric($_POST['qsrc'])){
					$_POST['qsrc']=1;
				}
				if(!is_numeric($_POST['qdst'])){
					$_POST['qdst']=1;
				}
				$sql = "INSERT INTO `deamon_core`.`MC_recipes` (`src`, `dst`, `method`, `qsrc`, `qdst`) VALUES ('$_POST[src]', '$_POST[dst]', '$_POST[method]', '$_POST[qsrc]', '$_POST[qdst]');";
				runSQL($sql);
		}else{
			echo "recipe failed!";
		}
	}
		echo "<form method='POST'>";
			echo "<select name='src' required>";
			$blocks = "";
				$result = multiSQL("SELECT * FROM MC_objects ORDER BY Name ASC");
				while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
					$blocks .= "<option value='$row[id]'>$row[Name]</option>";
				}
			echo $blocks;
			echo "</select>";
			echo "<input name='qsrc' type='number'>";

			echo "<select name='method' required>";
				echo "<option value='Crafting'>Crafting</option>";
				echo "<option value='Furnace'>Smelting</option>";
				echo "<option value='Brewwing'>Brewwing</option>";
				echo "<option value='Enchant'>Enchanting</option>";
				echo "<option value='Mine'>Mining</option>";
			echo "</select>";

			echo "<select name='dst' required>";
			echo $blocks;
			echo "</select>";
			echo "<input name='qdest' type='number'>";

			echo "<input name='recipe' type='submit' value='Record'>";
		echo "</form>";
	}
?>