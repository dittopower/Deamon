<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_login();
	lib_group();
	
	$group = $_SESSION['group'];
	
	/*
	
	CREATE TABLE Project_Applications(
		ApplicationID int(11),
		P_Id int(11),
		GroupId int(11),
		CoverLetter text(1000),
		TimeSubmitted timestamp
	)
	
	*/
	
	if(ingroup()){
		
		if(isset($_POST['apply']) && isset($_POST['coverletter'])){
			$newproject = $_POST['apply'];
			
			$coverLetter = $_POST['coverletter'];
			
			echo "Group #" . $group . " applying to project #" . $newproject . "<br><br>";
			
			$result = runSQL("INSERT INTO Project_Applications (P_Id, GroupId, CoverLetter, Status, TimeSubmitted) VALUES(".$newproject.", ".$group.", '".$coverLetter."', 'Applied', now())");
			
			if($result){ echo "Project successfully applied for."; }
			else{ echo "Something went wrong.<br><br><br>" . $coverLetter; }
		}
		else if(isset($_POST['apply']) && (!isset($_POST['coverletter'])) ){ 
			
			$projectID = $_POST['apply'];
			
			$projectName = singleSQL("SELECT Name From Projects WHERE P_Id=" . $projectID);
		
		?>
			
			<h2>Applying for project #<?php echo $projectID . " (" . $projectName . ")"; ?></h2><br>
			<div class="apply">
				<form action="" method="post">
					<textarea name="coverletter" placeholder="Write your cover letter here..."></textarea><br>
					<input type="hidden" name="apply" value="<?php echo $projectID; ?>">
					<input type="submit" value="Submit Application" class="button button1">
				</form>
			</div>
			
		<?php
		}else{
	
			$currentProject = singleSQL("SELECT GroupProject FROM Groups WHERE GroupId=" . $group);
			
			echo "<h2>All Projects</h2>";
			
		/*	echo "<table>";	
			
			echo "<tr class='card'><th class='ptitle'>Title</th>";
			echo "<th class='pdes'>Description</th>";
			echo "<th class='preq'>Requirements</th>";
			echo "<th class='ptype'>Type</th>";
			echo "<th class='pskill'>Skills</th>";
			echo "<th class='punit'>Unit</th>";
			echo "<th class='psup'>Supervisor</th>";
			echo "<th class='papply'>Apply</th></tr>";
			*/
			
			$projects = arraySQL("SELECT * FROM Projects WHERE P_Id <> 0 ORDER BY P_Id ASC");
			
			foreach($projects as $thing){
				//echo "<tr class='card'><td class='ptitle'><h3>" . $thing["Name"] . "</h3></td>";
				$cardcont = "<span class='pinfo'><h4>Description</h4>" . $thing["Description"] . "</span>";
				$cardcont .= "<span class='pinfo'><h4>Requirements</h4>" . $thing["requirements"] . "</span>";
				$cardcont .= "<span class='pinfo'><h4>Project Type</h4><ul><li>" . $thing["ProjectType1"] ."</li><li>". $thing["ProjectType2"] ."</li><li>". $thing["ProjectType3"] . "</li></ul></span>";
				
				$skills=explode(",",$thing["skill"]);
				
				$cardcont .= "<span class='pinfo'><h4>Skills</h4><ul>";
					foreach($skills as $skill){
						$cardcont .= "<li>" . $skill . "</li>";
					}
				$cardcont .= "</ul></span>";
				
				$cardcont .= "<span class='pinfo'><h4>Unit</h4>" . $thing["UnitCode"] . "</span>";
				$cardcont .= "<span class='pinfo'><h4>Supervisor</h4>" . $thing["Supervisor"] . "</span>";
				
				$app = singleSQL("SELECT ApplicationID FROM Project_Applications WHERE GroupId=" . $group . " AND P_Id=" . $thing["P_Id"]);
				
				if($app != "" && $app != 0 && $app != "0"){
					$cardcont .= "<span class='pinfo'><input type='submit' class='button button1' value='Applied' disabled></span>";
				}
				else{
					$cardcont .= "<span class='pinfo'><form action='' method='post'><input type='hidden' name='apply' value='".$thing["P_Id"]."'>";
					$cardcont .= "<input type='submit' class='button button1' value='Apply'></form></span>";
				}
				card($thing["Name"],$cardcont,"calc(100% - 60px)");
				//echo "</tr>";
			}
			
			//echo "</table>";
			
		}//if no input
	}
	else{
		echo "You must be in a group to select a project.";	
	}	
?>
