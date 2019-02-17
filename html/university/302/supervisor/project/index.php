<?php

	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	supervisor();
	
	$projectid = $_POST['projectID']; //**** EVERYONEE GETTT IINN HEEERRREEE ****//
	
	if(isset($_POST['editproject']) && $_POST['title'] != null && $_POST['description'] != null && $_POST['requirements'] != null && $_POST['type1'] != null && $_POST['type2'] != null && $_POST['type3'] != null && $_POST['skills'] != null && $_POST['unit'] != null && $_POST['start'] != null && $_POST['end'] != null && $_POST['dueby'] != null){
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
		
		$res = runSQL("UPDATE Projects SET Name='".$title."', ProjectType1='".$type1."', ProjectType2='".$type2."', ProjectType3='".$type3."', Description='".$description."', skill='".$skills."', requirements='".$requirements."', UnitCode='".$unit."', Start='".$start."', End='".$end."', Dueby='".$dueby."' WHERE P_Id=".$projectid);
					
		if($res){
			echo "<span class='sucess'>Project Edited.</span>";
		}else{
			echo "<span class='error'>Something went wrong. Project failed to save.</span>";
		}
	}
	
	echo "<div class='card2' style='width: calc(100% - 60px);'>";//do the card manually because i dont want to change all this stuff m8
		
	if(isset($_POST['editproject'])){
		
		$fillvalues = rowSQL("SELECT * FROM Projects WHERE P_Id=".$projectid);
		
		$title = $fillvalues['Name'];
		$description = $fillvalues['Description'];
		$requirements = $fillvalues['requirements'];
		$type1 = $fillvalues['ProjectType1'];
		$type2 = $fillvalues['ProjectType2'];
		$type3 = $fillvalues['ProjectType3'];
		$skills = $fillvalues['skill'];
		$unit = $fillvalues['UnitCode'];
		$start = $fillvalues['Start'];
		$end = $fillvalues['End'];
		$dueby = $fillvalues['Dueby'];
		
		echo "<h2>Edit Project #" . $projectid . "</h2>";
		
	}else{
		
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
		
		echo "<h2>Create New Project</h2>";
		
	}
	
	?>
	
	<hr>
	
	<form method='POST' id='projcreate' <?php if(! isset($_POST['editproject'])) echo "action='/supervisor/'"; ?>>
		<?php if(isset ($_POST['title']) && $_POST['title'] == null){
			echo "<span class='error'>You are missing a title</span><br>";
			} 
		?>
		<input type='text' name='title' placeholder='Project Title' value='<?php echo $title; ?>'><br><br>
		
		
		<?php if(isset ($_POST['description']) && $_POST['description'] == null){
			echo "<span class='error'>You are missing a project description</span><br>";
			}
		?>
		<textarea rows="4" cols="40" name='description' form='projcreate' placeholder='Project Description'><?php echo $description; ?></textarea>
		<br><br>
		
		
		<?php if(isset ($_POST['requirements']) && $_POST['requirements'] == null){
			echo "<span class='error'>You are missing requirements</span><br>";
			} 
		?>
		<input type='text' name='requirements' placeholder='Requirements' value='<?php echo $requirements; ?>'><br><br><br>
		<div>
			<label for='type1'>Project Type Preference 1</label>
			<?php if(isset ($_POST['type1']) && $_POST['type1'] == null){
				echo "<span class='error'>You are missing this preference</span>";
				}
			?>
			<br><input list='types1' name='type1' id='type1' value='<?php echo $type1; ?>' class='inputpadding'><br><br>
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
			<?php if(isset ($_POST['type2']) && $_POST['type2'] == null){
				echo "<span class='error'>You are missing this preference</span>";
				} 
			?>
			<br><input list='types1' name='type2' id='type2' value='<?php echo $type2; ?>' class='inputpadding'><br><br>

		</div>
		<div>
			<label for='type3'>Project Type Preference 3</label>
			<?php if(isset ($_POST['type3']) && $_POST['type3'] == null){
				echo "<span class='error'>You are missing this preference</span>";
				} 
			?>
			<br><input list='types1' name='type3' id='type3' value='<?php echo $type3; ?>' class='inputpadding'><br>

		</div><br><br>
		<?php if(isset ($_POST['skills']) && $_POST['skills'] == null){
			echo "<span class='error'>You are missing the skills required</span><br>";
			} 
		?>
		<input type='text' name='skills' placeholder='Skills required' value='<?php echo $skills; ?>'><br><br>
		<?php if(isset ($_POST['unit']) && $_POST['unit'] == null){
			echo "<span class='error'>You are missing this date</span><br>";
			} 
		?>
		<input type='text' name='unit' placeholder='Unit Code' value='<?php echo $unit; ?>'><br><br>
		
		
		Project Start Date:
		<?php if(isset ($_POST['start']) && $_POST['start'] == null){
			echo "<span class='error'>You are missing this date</span><br>";
			}
		?>
		<br><input type='date' name='start' value='<?php echo $start; ?>' class='inputpadding'><br><br>
		
		Project End Date:
		<?php if(isset ($_POST['end']) && $_POST['end'] == null){
			echo "<span class='error'>You are missing this date</span><br>";
			} 
		?>
		<br><input type='date' name='end' value='<?php echo $end; ?>' class='inputpadding'><br><br>
		
		Deliverables Due Date:
		<?php if(isset ($_POST['dueby']) && $_POST['dueby'] == null){
			echo "<span class='error'>You are missing this date</span><br>";
			} 
		?>
		<br><input type='date' name='dueby' value='<?php echo $dueby; ?>' class='inputpadding'><br><br>
		
		
		<?php /************** CHOOSE WHAT BUTTON TO PUT @ THE END (CREATE OR EDIT)************/
		
			if(isset($_POST['editproject'])){
				echo "<input type='submit' name='editproject' value='Save Changes' class='button button1'>";
			}
			else{
				echo "<input type='submit' name='createproject' value='Create Project' class='button button1'>";
			}
			
			echo "<input type='hidden' value='". $projectid ."' name='projectID'>";
			
		?>
		<br><br>
		
	</form>
	
	<?php if(isset($_POST['editproject'])){ // THIS IS FOR THE DELETE BUTTON ?>
		<br><br>
		<form method='POST' action='/supervisor/' onsubmit='return confirm("Do you really want to delete this project?");'>
			<input type='hidden' value='<?php echo $projectid; ?>' name='projectID'>
			<input type='submit' name='deleteproject' value='Delete Project' class='button button5'>
		</form>
	<?php } ?>
	
</div><!-- end of the card -->
	
	
<?php 
/* 	
if(isset($_POST['title']) != null && $_POST['description'] != null && $_POST['requirements'] != null && $_POST['type1'] != null && $_POST['type2'] != null && $_POST['type3'] != null && $_POST['skills'] != null && $_POST['unit'] != null && $_POST['start'] != null && $_POST['end'] != null && $_POST['dueby'] != null){
if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['requirements']) && isset($_POST['type1']) && isset($_POST['type2']) && isset($_POST['type3']) && isset($_POST['skills']) && isset($_POST['unit']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['dueby'])){
 */
?>