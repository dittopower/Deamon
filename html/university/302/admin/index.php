<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_code();
	lib_perms();
	lib_group();
	lib_feed();
	lib_database();
	
	//Function for making groups
	function makeGroup($group){
		Ndebug("New Group",$group);
		global $subject;
		$sql = "INSERT INTO `deamon_INB302`.`Groups` (`GroupName`, `GroupProject`, `UnitCode`) VALUES ('Pending', '0', '$subject')";
		if(runSQL($sql)){
			debug("Group Created");
			$gid = singleSQL("Select LAST_INSERT_ID();");
			note("Groups","Created::$gid::$_SESSION[person]");
			runSQL("UPDATE `deamon_INB302`.`Groups` SET `GroupName` = '$subject G$gid' WHERE `Groups`.`GroupId` = $gid");
			$sql = "INSERT INTO `deamon_INB302`.`Group_Members` (`GroupId`, `UserId`) VALUES";
			foreach($group as $member){
				$sql .= " ('$gid', '$member'),";
			}
			$sql = trim($sql, ',');
			debug("$sql");
			if(runSQL($sql)){
				debug("Inserted?");
				note("Groups","$gid :: Inserted Members");
				foreach($group as $member){
					runSQL("DELETE FROM `deamon_INB302`.`Group_Requests` WHERE `Group_Requests`.`UserId` = '$member' AND `Group_Requests`.`UnitCode` = '$subject'");
				}
			}else{
				debug("Failed insert");
				note("Groups","$gid :: Failed Members");
			}
		}else{
			debug("Failed group creation");
			note("Groups","FAILED::$sql");
		}
	}
	
	if(isset($_GET['sub'])){
		if(strlen($_GET['sub']) < 11){
			$level = getUserLevel($_GET['sub']);
			if($level > 0){
				$subject = $_GET['sub'];
				if($subject != "Admin"){
					
					//This is the automated group maker
					if(isset($_POST['G_resolve'])){
						$result = multiSQL("SELECT `UserId`, GPA, `Similar`, `PreferenceType1`, `PreferenceType2`, `PreferenceType3` FROM `Group_Requests` NATURAL join User_Details WHERE `UnitCode` = '$subject' ORDER by User_Details.GPA desc, `PreferenceType1`, `PreferenceType2`, 'PreferenceType3'");
						$fields = array();
						$students = array();
						while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
							$students[$row['UserId']] = $row;
							debug($row);
							if(isset($fields[$row['PreferenceType1']])){
								$fields[$row['PreferenceType1']][] = $row['UserId'];
							}else{
								$fields[$row['PreferenceType1']] = array();
								$fields[$row['PreferenceType1']][] = $row['UserId'];
							}
							if(isset($fields[$row['PreferenceType2']])){
								$fields[$row['PreferenceType2']][] = $row['UserId'];
							}else{
								$fields[$row['PreferenceType2']] = array();
								$fields[$row['PreferenceType2']][] = $row['UserId'];
							}
							if(isset($fields[$row['PreferenceType3']])){
								$fields[$row['PreferenceType3']][] = $row['UserId'];
							}else{
								$fields[$row['PreferenceType3']] = array();
								$fields[$row['PreferenceType3']][] = $row['UserId'];
							}
						}
						foreach($fields as $key=>$arrays){
							$fields[$key] = array_unique($arrays);
						}
						debug("primary process done");
						debug($fields);
						debug($students);
						
						
						foreach($students as $person=>$row){
							if(isset($students[$person])){///This line is only necessary because foreach loops apparently run off the variables inital state...
							debug($person);
							//find people with simlar preferences
							$ab = array_intersect($fields[$row['PreferenceType1']],$fields[$row['PreferenceType2']]);
							$ac = array_intersect($fields[$row['PreferenceType1']],$fields[$row['PreferenceType3']]);
							$bc = array_intersect($fields[$row['PreferenceType2']],$fields[$row['PreferenceType3']]);
							
							//Create one list that puts people with the most similar prefs first
							$abc = array_merge($ab,$ac,$bc);
							$matches = array_count_values($abc);
							natsort($matches);
							$matches=array_reverse($matches,true);
							unset($matches[$person]);
							debug($matches);
							
							//if there's enough similar people match a team
							if(count($matches) > 1){
								$group = array();
								$group[] = $person;
								foreach($matches as $key=>$value){
									if($row['Similar'] == 1){//check gpa
										if(($students[$key]['GPA']/$row['GPA']) > 0.75){
											$group[] = $key;
										}
									}else{
										$group[] = $key;
									}
									if(count($group) > 4){//max group forming size of 5 people
										break;
									}
								}
								if(count($group) > 1){//Make a group. minimum 2 people
									debug($group);
									foreach($group as $mem){
										unset($students[$mem]);
										foreach($fields as $key=>$value){
											if(($me = array_search($mem, $value)) !== false) {
												unset($fields[$key][$me]);
											}
										}
									}
									makeGroup($group);
								}
							}
							Ndebug("Cycle",$students);
							}
						}
						debug("secondary done");
					}//automated group maker ends here
		
					
					echo "<span class='admintables'>";
					//My groups
					$result = multiSQL("SELECT g.`GroupId`, g.`GroupName`, p.Name, count(*) as mem FROM `Groups` g join Projects p on g.`GroupProject` = p.P_Id JOIN Group_Members m on m.GroupId = g.`GroupId` WHERE g.`Supervisor` = '$_SESSION[person]' group by g.`GroupId`");
					$cardcont = "<table><tr><th>Group Name</th><th>Project</th><th>Members</th></tr>";
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
						$cardcont .= "<tr><td><a href='http://$_SERVER[HTTP_HOST]/group/?group=$row[GroupId]'>$row[GroupName]</a></td><td>$row[Name]</td><td>Members: $row[mem]</td></tr>";
					}
					card("My Groups", $cardcont . "</table>");
					
					
					//Seeking groups
					$result = multiSQL("Select a.Username, a.FirstName from Group_Requests g join D_Accounts a  where g.UnitCode = '$subject' and g.UserId = a.UserId");
					$cardcont = "<table><tr><th>Student Id</th><th>Name</th></tr>";
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
						$cardcont .= "<tr><td><a href='http://$_SERVER[HTTP_HOST]/user/?u=$row[Username]'>$row[Username]</a></td><td>$row[FirstName]</td></tr>";
					}
					$cardcont .= "</table><form method='POST' class='wideinput'><input type='submit' class='button button1' name='G_resolve' value='Resolve Teams'></form>";
					card("Seeking Groups", $cardcont);
					
					
					$cardcont = "";
					if($level > 1){
						
												
						//handling staff changes
						if(isset($_POST['who'])&& is_numeric($_POST['who'])){
							if(isset($_POST['revoke'])){//delete
								runSQL("UPDATE `D_Perms` SET `level` = level-1 WHERE UserId = '$_POST[who]' and what = 'INB302';");
								runSQL("DELETE FROM `D_Perms` WHERE level = 0");
								note("$_GET[sub]","Revoking::$_POST[who]");
							}else if(isset($_POST['raise'])){//buff
								if(singleSQL("Select 1 from D_Perms where UserId='$_POST[who]' and what='$_GET[sub]'") == 1){
									runSQL("UPDATE `D_Perms` SET `level`= '2' WHERE `UserId`='$_POST[who]' and `what`='$_GET[sub]'");
								}else{
									runSQL("INSERT INTO `D_Perms`(`UserId`, `what`, `level`) VALUES ('$_POST[who]','$_GET[sub]', 1)");
								}
								note("$_GET[sub]","Raising::$_POST[who]");
							}
						}
						
						$result = multiSQL("SELECT a.UserId, a.Username, a.FirstName, IF(p.level > 1, 'Lecturer/Coordinator', 'Tutor') as Role FROM `D_Perms` p join D_Accounts a on p.UserId = a.UserId WHERE what = '$_GET[sub]'");
						
						$cardcont = "<table><tr><th>Username</th><th>Name</th><th>Role</th><th>Permissions</th></tr>";
						
						while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
						
							$cardcont .= "<tr><td>$row[Username]</td><td>$row[FirstName]</td><td>$row[Role]</td>";

							$cardcont .= "<td><form method=POST class='inline'>
							<input type=text name=who value='$row[UserId]' hidden>
							<input class='button button2 inline mar' type=submit name=revoke value='-'>
							<input class='button button3 inline mar' type=submit name=raise value='+'>
							</form></td></tr>";
						}
						card("$_GET[sub] Staff", $cardcont . "</table>");
						
						$cardcont="";
						
						//This is where it should have been josh
						if(isset($_POST["usernameBuff"])){
							$username = $_POST["usernameBuff"];
							$userid = singleSQL("SELECT UserId FROM D_Accounts WHERE Username='".$username."'");
							
							$uwot = false;
							
							if($userid!=0){
								$unit = $subject;
								$uwot = runSQL("INSERT INTO D_Perms (UserId,what,level) VALUES('".$userid."','".$unit."','1')");
							}
						}
						
						$cardcont .= "<datalist id='tutors'>";
						$result = multiSQL("SELECT a.Username, a.FirstName, IF(p.level > 1, 'Lecturer/Coordinator', 'Tutor') as Role FROM `D_Perms` p join D_Accounts a on p.UserId = a.UserId WHERE what = '$_GET[sub]'");
						while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
							$cardcont .= "<option value='$row[Username]'>$row[FirstName]</option>";
						}
						$cardcont .= "</datalist>";
						if(isset($_POST['settut']) && isset($_POST['tutor']) && is_numeric($_POST['grouptut'])){
							$userid = singleSQL("SELECT UserId FROM D_Accounts WHERE Username='".$_POST['tutor']."'");
							if($userid > 0){
							if(runSQL("UPDATE `Groups` SET `Supervisor` = '$userid' WHERE `GroupId` = '$_POST[grouptut]';")){
								note("$subject","Group Tutor::SET::$_POST[tutor]");
								post("#$_POST[grouptut]|@$_POST[grouptut]","Tutor Assigned","$_POST[tutor] is now this group's allocated tutor.");
								$cardcont .= "<span class=sucess>Tutor set.</span><meta http-equiv='refresh' content='1'>";
							}else{
								note("$subject","Group Tutor::Failed set::$_POST[tutor]");
								$cardcont .= "<span class=error>Failed to set Tutor</span>";
							}}else{$cardcont .= "<span class=error>Invalid Tutor.</span>";}
						}
						//All groups
						$result = multiSQL("SELECT g.`GroupId`, g.`GroupName`, p.Name, count(*) as mem, a.Username FROM `Groups` g join Projects p on g.`GroupProject` = p.P_Id JOIN Group_Members m on m.GroupId = g.`GroupId` left join D_Accounts a on g.`Supervisor` = a.UserId WHERE g.UnitCode = '$subject' group by g.`GroupId`");
						$cardcont .= "<table><tr><th>Group Name</th><th>Project</th><th>Members</th><th>Tutor</th><th>Change Tutor</th><th>Report</th></tr>";
						while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
							$cardcont .= "<tr><td><a href='http://$_SERVER[HTTP_HOST]/group/?group=$row[GroupId]'>$row[GroupName]</a></td><td>$row[Name]</td><td>Members: $row[mem]</td>";
							$cardcont .= "<td>$row[Username]</td><td><form method=POST><input type=text name='grouptut' value='$row[GroupId]' hidden>
							<input list='tutors' name='tutor' class='inputpadding' style='position: relative; top: 5px;'><input type=submit class='button button4 inline' name=settut value='&#10004;'></form></td>";
							$cardcont .= "<td><form method='GET' action='generateReport.php' target='_blank'><input type='hidden' value='" . $row["GroupId"] . "' name='groupidreport'><input type='submit' value='Generate Report' class='button button1 smallerbtn'></form></td>";
							$cardcont .= "</tr>";
						}
						card("All $_GET[sub] Groups", $cardcont . "</table>");
						
						
						
						$cardbuff = "";
						if(isset($uwot)){
							if($uwot){
								$cardbuff .= "<span class='sucess'>User promoted.</span>";
							}else{
								$cardbuff .= "<span class='error'>Failed to be promoted. (Maybe user doesn't exist?)</span>";
							}
						}
						$units = arraySQL("SELECT * FROM Unit");
						$cardbuff .= "
						<span class='wideinput'><form method='POST'>
							<input type='text' name='usernameBuff' placeholder='Username'><br><br>
							<input type='hidden' name='unitBuff' value='".$_GET[sub]."'>";
							/*<select name='unitBuff' class='inputpadding'>";
							foreach($units as $u){
								$cardbuff.= "<option value='".$u["UnitCode"]."' class='inputpadding'>".$u["UnitCode"]." - ".$u["Unit"]."</option>";
							}
							$cardbuff.="</select><br><br>";*/
							
							$cardbuff .= "<input type='submit' value='Promote' class='button button1'>
						</form></span>";
						
						card2("Promote to Tutor", $cardbuff);
						
					}
					echo "</span>";
					
				}else{//Full system Admin page
					
					echo "<span class='admintables'>";
					
					$cardcont = "";
					//handling staff changes
					if(isset($_POST['who'])&& is_numeric($_POST['who']) && isset($_POST['what'])){
						if(isset($_POST['revoke'])){//delete
							runSQL("UPDATE `D_Perms` SET `level` = level-1 WHERE UserId = '$_POST[who]' and what = '$_POST[what]';");
							runSQL("DELETE FROM `D_Perms` WHERE level = 0");
							note("$_POST[what]","Revoking::$_POST[who]");
						}else if(isset($_POST['raise'])){//buff
							if(singleSQL("Select 1 from D_Perms where UserId='$_POST[who]' and what='$_POST[what]'") == 1){
								runSQL("UPDATE `D_Perms` SET `level`= '2' WHERE `UserId`='$_POST[who]' and `what`='$_POST[what]'");
							}else{
								runSQL("INSERT INTO `D_Perms`(`UserId`, `what`, `level`) VALUES ('$_POST[who]','$_POST[what]', 1)");
							}
							note("$_POST[what]","Raising::$_POST[who]");
						}
					}
					
					$result = multiSQL("SELECT a.UserId, a.Username, a.FirstName, p.what, IF(p.level > 1, 'Lecturer/Coordinator', 'Tutor') as Role FROM `D_Perms` p join D_Accounts a on p.UserId = a.UserId order by what");
					$cardcont = "<table><tr><th>Username</th><th>Name</th><th>Role</th><th>Subject</th><th>Permissions</th></tr>";
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
						$cardcont .= "<tr><td>$row[Username]</td><td>$row[FirstName]</td><td>$row[Role]</td><td>$row[what]</td>";
						$cardcont .= "<td><form method=POST class='inline'>
						<input type=text name=who value='$row[UserId]' hidden>
						<input type=text name=what value='$row[what]' hidden>
						<input class='button button2 inline mar' type=submit name=revoke value='-'>
						<input class='button button3 inline mar' type=submit name=raise value='+'>
						</form></td></tr>";
					}
					card("All Staff", $cardcont . "</table>");
					
					$cardbuff = "";
					
					if(isset($_POST["usernameBuff"])){
						$username = $_POST["usernameBuff"];
						$userid = singleSQL("SELECT UserId FROM D_Accounts WHERE Username='".$username."'");
						
						$uwot = false;
						
						if($userid!=0){
							$unit = $_POST['unitBuff'];
							$uwot = runSQL("INSERT INTO D_Perms (UserId,what,level) VALUES('".$userid."','".$unit."','1')");
						}
						
						if($uwot){ $cardbuff .= "<span class='sucess'>User promoted.<meta http-equiv='refresh' content='1'></span>"; }
						else { $cardbuff .= "<span class='error'>Failed to be promoted. (Maybe user doesn't exist?)</span>"; }
						
						$cardbuff .= "<div class='clear'></div><br>";
					}
					
						$units = arraySQL("SELECT * FROM Unit");
						$cardbuff .= "
						<span class='wideinput'><form method='POST'>
							<input type='text' name='usernameBuff' placeholder='Username' class='bump'><br>
							<input type='hidden' name='unitBuff' value='".$_GET[sub]."'>
							<select name='unitBuff' class='inputpadding bump'>";
							foreach($units as $u){
								$cardbuff.= "<option value='".$u["UnitCode"]."' class='inputpadding'>".$u["UnitCode"]." - ".$u["Unit"]."</option>";
							}
							$cardbuff.="</select><br>";
							
							$cardbuff .= "<input type='submit' value='Promote' class='button button1'>
						</form></span>";
						
						card2("Promote to Tutor", $cardbuff);
					
					
					//All units
					$cardcont = "";
					if(isset($_POST['newunit'])){
						global $mysqli;
						$sql= mysqli_prepare($mysqli, "INSERT INTO `Unit` (`UnitCode`, `Unit`) VALUES (?, ?) ON DUPLICATE KEY UPDATE UnitCode = ?,  Unit = ? ;");
						mysqli_stmt_bind_param($sql,"ssss",$_POST['ucode'],$_POST['uname'],$_POST['ucode'],$_POST['uname']);
						if(mysqli_stmt_execute($sql)){
							$cardcont .= "<span class=sucess>Unit Added<meta http-equiv='refresh' content='1'></span>";
						}else{
							$cardcont .= "<span class=error>Failed to add unit</span>";
						}
					}
					$result = multiSQL("SELECT * FROM `Unit`");
					$cardcont .= "<table><tr><th>Unit Code</th><th>Unit Name</th></tr>";
					while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
						$cardcont .= "<tr><td>$row[UnitCode]</td><td>$row[Unit]</td></tr>";
					}
					$cardcont .= "</table><span class='wideinput'>";
					
					$cardcont .= "<br><form method='POST'><h3>Add a Unit</h3><hr>";
					$cardcont .= "<input id='unitname' type=text name=uname placeholder='Unit name' class='bump'><br>";//<label for='unitname'>Unit Name</label>I.e. IT Capstone Project
					$cardcont .= "<input id='unitcode' type=text name=ucode placeholder='Unit code'><br>";//<label for='unitcode'>Unit Code</label>I.e. INB302
					$cardcont .= "<input class='button button1' type=submit name=newunit value='Add'></span></form>";
					card("Units", $cardcont);
					
					$cardcont .= "</span></span>";
					
				}
				
			}else{
				echo "You are not authorised for $_GET[sub]";
			}
		}else{
			echo "Invaild subject selection";
		}
	}else{
		echo "<h1>Please select subject you are authorised to monitor.</h1>";
		$result = multiSQL("Select what from D_Perms where UserId = '$_SESSION[person]'");
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
			card("<a href='http://$_SERVER[HTTP_HOST]/admin?sub=$row[what]'>$row[what]</a>");
		}
	}
	
?>