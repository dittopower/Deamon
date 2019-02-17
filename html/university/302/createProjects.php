<?php
		
	require_once('supervisor.php');

	if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['requirements']) && isset($_POST['type1']) && isset($_POST['type2']) && isset($_POST['type3']) && isset($_POST['skills']) && isset($_POST['unit']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['dueby'])){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$requirements = $_POST['requirements'];
		$type1 = $_POST['type1'];
		$type2 = $_POST['type2'];
		$type3 = $_POST['type3'];
		$skills = $_POST['skills'];
		$unit = $_POST['unit'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$dueby = $_POST['dueby'];
		
		$res = runSQL("INSERT INTO Projects (Name, ProjectType1, ProjectType2, ProjectType3, Description, skill, requirements, UnitCode, Start, End, Dueby) VALUES('".$title."', '".$type1."', '".$type2."', '".$type3."', '".$description."', '".$skills."', '".$requirements."', '".$unit."', '".$start."', '".$end."', '".$dueby."')");
			
		if($res){ 
			echo "Project Created.";
		}
	}
	else{
?>
		<form action='createProjects.php' method='POST' id='projcreate'>
			<input type='text' name='title' placeholder='Project Title' value=''><br><br>
			<textarea rows="4" cols="40" name='decscription' form='projcreate' placeholder='Project Description' value=''></textarea><br><br>
			<input type='text' name='requirements' placeholder='Requirements' value=''><br><br>
			<div>
				<label for='type1'>Project Type Preference 1</label>
				<input list='types1' name='type1' id='type1'>
				<datalist id='types1'>
					<option value='any'>
				<?php
					$result = multiSQL('SELECT * FROM `Project_Types`');
					$types = "";
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
						$types .= "<option value='$row[type]'>";
					}
					echo $types;
				?>
				</datalist>
			</div>
			<div>
				<label for='type2'>Project Type Preference 2</label>
				<input list='types2' name='type2' id='type2'>
				<datalist id='types2'>
					<option value='any'>
				<?php
					echo $types;
				?>
				</datalist>
			</div>
			<div>
				<label for='type3'>Project Type Preference 3</label>
				<input list='types3' name='type3' id='type3'>
				<datalist id='types3'>
					<option value='any'>
				<?php
					echo $types;
				?>
				</datalist>
			</div><br>
			<input type='text' name='skills' placeholder='Skills required' value=''><br><br>
			<input type='text' name='unit' placeholder='Unit Code' value=''><br><br>
			<input type='text' name='start' placeholder='Start Date' value=''>
			<input type='text' name='end' placeholder='End Date' value=''><br><br>
			<input type='text' name='dueby' placeholder='Deliverables Due Date' value=''><br><br>
			<input type='submit' name='createproj' value='Create' class='button button1'><br><br>
		</form>
<?php 
	}
	echo print_r($_POST);
?>