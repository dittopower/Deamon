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
		
		if(isset($_POST['apply']) && (!isset($_POST['coverletter'])) ){ 
			
			$projectID = $_POST['apply'];
			$projectName = singleSQL("SELECT Name From Projects WHERE P_Id=" . $projectID); ?>
			
			<h2>Applying for project #<?php echo $projectID . " (" . $projectName . ")"; ?></h2><br>
			<div class="apply">
				<form action="" method="post">
					<textarea name="coverletter" placeholder="Insert your cover letter here..."></textarea><br>
					<input type="hidden" name="apply" value="<?php echo $projectID; ?>">
					<input type="submit" value="Submit Application" class="button button1">
				</form>
			</div>
			
		<?php }else{
			
			if(isset($_POST['apply']) && isset($_POST['coverletter'])){
				$newproject = $_POST['apply'];
				
				$coverLetter = $_POST['coverletter'];
				
				//echo "Group #" . $group . " applying to project #" . $newproject . "<br><br>";
				
				$result = runSQL("INSERT INTO Project_Applications (P_Id, GroupId, CoverLetter, Status, TimeSubmitted) VALUES(".$newproject.", ".$group.", '".$coverLetter."', 'Applied', now())");
				
				if($result){ echo "<span class='sucess'>Project successfully applied for.</span>"; }
				else{ echo "<span class='error'>Something went wrong.</span><br><br><br>" . $coverLetter; }
				
				echo "<br><span class='div'></div><br>";
			}
			else if(isset($_POST["studentDecision"]) && isset($_POST["appid"])){
				
				$decision = $_POST["studentDecision"];
				$appid = $_POST["appid"];
				
				$res = rowSQL("SELECT pa.GroupId as GroupId, pa.P_Id as P_Id, p.Supervisor as Sup FROM Project_Applications pa LEFT JOIN Projects p ON pa.P_Id=p.P_Id WHERE pa.ApplicationID=".$appid);
				$groupid = $res["GroupId"];
				$projectid = $res["P_Id"];
				$supervisor = $res["Sup"];
				
				if($decision == "Accept"){
					
					$q1 = runSQL("UPDATE Project_Applications SET Status='StudentAccepted' WHERE ApplicationID=" . $appid);
					if($q1){ echo "<span class='sucess'>Project_Applications field updated.</span><br>"; }
					else{ echo "<span class='error'>Something went wrong.</span><br>"; }
					
					$q2 = runSQL("UPDATE Groups SET GroupProject='".$projectid."' WHERE GroupId=".$groupid);//, Supervisor='".$supervisor."' IDK IF WE WANT TO DO THIS ????
					if($q2){ echo "<span class='sucess'>Groups field updated."; }
					else{ echo "<span class='error'>Something went wrong.</span>"; }
					
				}
				else if($decision == "Decline"){
					
					$q1 = runSQL("UPDATE Project_Applications SET Status='StudentDeclined' WHERE ApplicationID=" . $appid);
					if($q1){ echo "<span class='sucess'>Project_Applications field updated.</span><br>"; }
					else{ echo "<span class='error'>Something went wrong.</span><br>"; }
					
				}
				
				echo "<br><span class='div'></div><br>";
				
			}
			
			$ifalreadyaccepted = singleSQL("SELECT P_Id FROM Project_Applications WHERE GroupId=" . $group . " AND Status='StudentAccepted'");
			
			$applicationAction = arraySQL("SELECT ApplicationID, P_Id FROM Project_Applications WHERE GroupId=" . $group . " AND Status='SupervisorAccepted'");
			
			if($ifalreadyaccepted == 0){//hopefully there isn't a project zero
				if(count($applicationAction) > 0){
				
					$topcard = "";
					
					foreach($applicationAction as $thing){
						$projectname = singleSQL("SELECT Name FROM Projects WHERE P_Id=" . $thing["P_Id"]);
					
						$topcard .= "<h4>".$projectname."</h4><p>Your application was accepted by the supervisor.</p>";
						
						$topcard .= "<form method='post'><input type='hidden' name='appid' value='".$thing["ApplicationID"]."'><input type='submit' name='studentDecision' value='Decline' class='button button5'></form>";
						$topcard .= "<form method='post'><input type='hidden' name='appid' value='".$thing["ApplicationID"]."'><input type='submit' name='studentDecision' value='Accept' class='button button3'></form>";
						
						$topcard .= "<div class='clear'></div><br><hr>";
					}
					
					card("Applications Requiring Action",$topcard,"calc(100% - 60px)");//bro
					
					echo "<p>&nbsp;</p>";
				
				}
			}
			else{
				$projectname = singleSQL("SELECT Name FROM Projects WHERE P_Id=" . $ifalreadyaccepted);
				echo "You have already accepted project: <strong>" . $projectname . "</strong>";
				
				echo "<p>&nbsp;</p>";
			}
			
			$currentProject = singleSQL("SELECT GroupProject FROM Groups WHERE GroupId=" . $group);
			
			?>
			
			<h2 class='searchtitle'>All Projects
			
			<?php
				if(isset($_GET['search']) && $_GET['search'] != "") echo " - Search results for: \"" . $_GET["search"] . "\"";
			?>
			
			</h2>
			
			<div class="searchbox">
				<form method="get">
					<input type="text" name="search" placeholder="Search" value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>">
					<input type="submit" class="button button4" value="Search">
				</form>
			</div>
			
			<div class="clear"></div>
			
			<?php
			
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
			
			if(inGroup()){
				$sql = "SELECT `P_Id`, `Name`, `ProjectType1`, `ProjectType2`, `ProjectType3`, `Description`, `skill`, `requirements`, p.`UnitCode`, s.FirstName as Supervisor, DATE_FORMAT(`Start`,'%d/%c/%Y') as Start, DATE_FORMAT(`End`,'%d/%c/%Y') as End, DATE_FORMAT(`Dueby`,'%d/%c/%Y') as Dueby FROM Projects p JOIN Supervisor s ON p.Supervisor = s.SupervisorID JOIN Groups g on g.UnitCode = p.UnitCode WHERE P_Id <> 0 and g.GroupId = '$_SESSION[group]' AND DATE(p.Start) > DATE_SUB(DATE(NOW()),INTERVAL 1 QUARTER)";
			}else{
				$sql = "SELECT `P_Id`, `Name`, `ProjectType1`, `ProjectType2`, `ProjectType3`, `Description`, `skill`, `requirements`, `UnitCode`, s.FirstName as Supervisor, DATE_FORMAT(`Start`,'%d/%c/%Y') as Start, DATE_FORMAT(`End`,'%d/%c/%Y') as End, DATE_FORMAT(`Dueby`,'%d/%c/%Y') as Dueby FROM Projects p JOIN Supervisor s ON p.Supervisor = s.SupervisorID WHERE P_Id <> 0 AND DATE(p.Start) > DATE_SUB(DATE(NOW()),INTERVAL 1 QUARTER)";
			}
			
			if(isset($_GET['search']) && $_GET['search'] != ""){
				$si = $_GET['search'];
				$sql .= " AND (p.P_Id LIKE '%" . $si . "%'";
				$sql .= " OR p.Name LIKE '%" . $si . "%'";
				$sql .= " OR p.ProjectType1 LIKE '%" . $si . "%'";
				$sql .= " OR p.ProjectType2 LIKE '%" . $si . "%'";
				$sql .= " OR p.ProjectType3 LIKE '%" . $si . "%'";
				$sql .= " OR p.Description LIKE '%" . $si . "%'";
				$sql .= " OR p.skill LIKE '%" . $si . "%'";
				$sql .= " OR p.requirements LIKE '%" . $si . "%'";
				$sql .= " OR p.UnitCode LIKE '%" . $si . "%')";
			}// SEARCHING STUFF (EVERYTHING)
			
			$sql .= " ORDER BY p.Start";
			
			$projects = arraySQL($sql);
			
			foreach($projects as $thing){
				//echo "<tr class='card'><td class='ptitle'><h3>" . $thing["Name"] . "</h3></td>";
				$cardcont = "<span class='pinfo'><h4>Dates</h4><i>Start</i><p>$thing[Start]</p><br><i>Finish</i><p>$thing[End]</p></span>";
				$cardcont .= "<span class='pinfo'><h4>Description</h4>" . $thing["Description"] . "</span>";
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
			}

			
		}//if not cover letter
	}
	else{
		echo "You must be in a group to select a project.";	
	}	
?>
