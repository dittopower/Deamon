<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_files();
	$subject = $_GET['unit'];
	
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
	}
	
	echo "<h1>".singleSQL("Select CONCAT(UnitCode,': ',Unit) from Unit where UnitCode='$subject'")."</h1><hr>";
	
	echo "<div><h2>Groups</h2>";
	table("Select GroupName as 'Group Name', Name as 'Project Name', count(*) as 'No. Members' from Groups g join Projects p join Group_Members m where `GroupProject` = P_ID and g.`GroupId` = m.GroupId and g.UnitCode = '$subject' group by GroupName");
	echo "</div>";
	
	echo "<div><h2>Seeking Groups</h2>";
	table("Select a.Username as 'Student No.', a.FirstName from Group_Requests g join D_Accounts a  where g.UnitCode = '$subject' and g.UserId = a.UserId");
	echo "</div>";
?>

<form method='POST'>
	<input type='submit' name='G_resolve' value='Resolve Teams'>
</form>