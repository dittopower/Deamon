<html>

<?php

	include "db.php";

	$found = False;

	$title = "Form not found";

	if(isset($_GET['form'])){

		$id = $_GET['form'];

		

		$sql= mysqli_prepare($mysqli, "SELECT Name, Creator, Target from Forms where Form_Id = ?");

		mysqli_stmt_bind_param($sql,"s",$id);

		

		if(mysqli_stmt_execute($sql)){

			mysqli_stmt_bind_result($sql,$title,$owner,$target);

			mysqli_stmt_fetch($sql);

			$found = true;

		}

		mysqli_stmt_close($sql);

	}

	

	function htmlescape($string){

		return htmlentities($string,ENT_QUOTES | ENT_HTML5);

	}

?>

<head>

	<link rel="shortcut icon" href="favicon.ico"/>

	<title><?php echo $title; ?></title>

	<script src='http://deamon.info/jquery.js'></script>

	<script type="text/javascript" src='work.js'></script>

	<link rel="stylesheet" type="text/css" href="fstyles.css">

</head>



<body>

<?php

	if(!$found){

		echo "<h2>Form not Found</h2>";

	}else{

		echo "<h1>$title</h1>";

		$sql = "SELECT * from Form_$id order by 'question'";

		$table = multiSQL($sql);

		

		while($row = mysqli_fetch_array($table,MYSQL_ASSOC)){

			echo "<article onclick='this.scrollIntoViewIfNeeded();' onfocus='this.scrollIntoViewIfNeeded();'><hr>";

			if($row['type'] == 'heading' || $row['type'] == 'note'){

				echo "<h1>$row[text]</h1>";

				echo "<span>$row[answers]</span>";

			}else{

				if($row['question'] > 0){

					echo "<h1>Q$row[question]</h1>";

				}

				if($row['text'] != ""){

					echo "<span>$row[text]</span>";

				}

				

				if($row['type'] == 'radio'){//radio buttons

					$ans = explode(";", $row['answers']);

					for($a = 0; $a < count($ans);$a++){

						echo "<input type='radio' name='Q$row[Id]' id='Q$row[Id]A$a' onchange='radioGUI(this)' value='$a'>";

						echo "<label class='radio' for='Q$row[Id]A$a'>".$ans[$a]."</label>";

					}

					

				}else if($row['type'] == 'checkbox'){//checkboxes

					echo "<input type=checkbox name='Q$row[Id]' onchange='checkGUI(this)'>";

					echo "<img src='./tick.png' class=checker onclick='check(this)'>";

					echo "<img src='./cross.png' class=checker onclick='check(this)'>";

				

				}else if($row['type'] == 'instr'){//instructions

					echo "<h2>Instructions</h2><ul>";

					$ans = explode(";", $row['answers']);

					for($a = 0; $a < count($ans);$a++){

						echo "<li>$ans[$a]</li>";

						

					}

					echo "</ul>";

				

				}else if($row['type'] == 'number'){//numbers and tallies

					echo "<div class=button id=Q$row[Id] onclick='tally(this)' style='border-right:none;'><span class='center'>-1</span></div>";

					echo "<input type=number name=Q$row[Id] id=Q$row[Id] class=tally value=0>";

					echo "<div class=button id=Q$row[Id] onclick='tally(this)' style='border-left:none;'><span class='center'>+1</span></div>";

					

				}else if($row['type'] == 'slider'){//sliders|ranges

					$ans = explode(";", $row['answers']);

					

					echo "<input type='range' name='q$row[Id]' id='q$row[Id]' onchange='slideto(this)' value='$ans[0]' min='$ans[0]' max='$ans[1]' step='$ans[2]' style='width:".((count($ans)-4)*114)."px;'>";/**/

					for($a = 3; $a < count($ans);$a++){

						echo "<div id='q$row[Id]v".($a+$ans[0]-3)."' class='radio' onclick='slide(this)'>".$ans[$a]."</div>";

					}

					

					

				}else{//other

					echo "<input type='$row[type]' name='Q$row[Id]' onchange='checkGUI(this)' value='$row[answers]'>";

				}

			}

			echo "</article>";

		}

	}

?>

</body>