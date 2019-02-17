<?php
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	lib_group();
	lib_files();
	
	debug($_POST);
	if(isset($_POST['findgroup'])){
		$requested = 0;
		$request = array();
		if(isset($_POST['unit'])){
			if(singleSQL("Select 1 from Unit where UnitCode = '$_POST[unit]'") == 1){
				$request['unit'] = $_POST['unit'];
			}
		}
		if($_POST['sgpa'] == 'on'){
			$request['similar'] = 1;
		}else{
			$request['similar'] = 0;
		}
		
		if(isset($_POST['type1'])){
			$request[1] = $_POST['type1'];
		}else{
			$request[1] = null;
		}
		if(isset($_POST['type2'])){
			$request[2] = $_POST['type2'];
		}else{
			$request[2] = null;
		}
		if(isset($_POST['type3'])){
			$request[3] = $_POST['type3'];
		}else{
			$request[3] = null;
		}
		if(isset($request['unit'])){
			global $mysqli;
			$sql= mysqli_prepare($mysqli, "INSERT INTO `Group_Requests` (`UserId`, `UnitCode`, `Similar`,  `PreferenceType1`,  `PreferenceType2`,  `PreferenceType3`) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE Similar = ?,  PreferenceType1 = ?,  PreferenceType2 = ?,  PreferenceType3 = ?;");
			mysqli_stmt_bind_param($sql,"ssisssssss",$_SESSION['person'],$request['unit'],$request['similar'],$request[1],$request[2],$request[3],$request['similar'],$request[1],$request[2],$request[3]);
			if(mysqli_stmt_execute($sql)){
				$requested = 1;
				note("requests","Sucess::$_SESSION[person]::$_POST[unit]:$_POST[type1]:$_POST[type2]:$_POST[type3]");
			}else{
				note("requests","Failure::$_SESSION[person]::$_POST[unit]:$_POST[type1]:$_POST[type2]:$_POST[type3]");
			}
		}
	}else if(isset($_POST['makegroup'])){
		$created = 0;
		$create = array();
		if(isset($_POST['tsub'])){
			if(singleSQL("Select 1 from Unit where UnitCode = '$_POST[tsub]'") == 1){
				$create['unit'] = $_POST['tsub'];
			}
		}
		
		$create['name'] = 'Pending';
		if(isset($_POST['tname']) && strlen($_POST['tname']) > 1){
			$create['name'] = $_POST['tname'];
		}
		
		debug($create);
		if(isset($create['unit'])){
			$sql = "INSERT INTO `Groups` (`GroupName`, `GroupProject`, `UnitCode`) VALUES ('$create[name]', '0', '$create[unit]')";
			debug($sql);
			if(runSQL($sql)){
				debug("Group Created");
				$gid = singleSQL("Select LAST_INSERT_ID();");
				note("Groups","Created::$gid::$_SESSION[person]");
				if($create['name'] == 'Pending'){
					runSQL("UPDATE `Groups` SET `GroupName` = '$create[unit] G$gid' WHERE `Groups`.`GroupId` = $gid");
				}
				if(runSQL("INSERT INTO `Group_Members` (`GroupId`, `UserId`) VALUES ('$gid', '$_SESSION[person]')")){
					runSQL("DELETE FROM `Group_Requests` WHERE `UserId` = '$_SESSION[person]' and `UnitCode` = '$create[unit]'");
				}
				$created = 1;
				group($gid);
				echo "<meta http-equiv='refresh' content='0;URL=http://$_SERVER[HTTP_HOST]/group'>";
			}else{
				note("Groups","Failed::$_SESSION[person]");
			}
		}
	}
	
	
?>
<div>
<h1>Active Group Requests</h1>
<?php 
	$result = multiSQL("Select UnitCode, PreferenceType1 as 'Preference 1', PreferenceType2 as 'Preference 2', PreferenceType3 as 'Preference 3' from Group_Requests where UserId = '$_SESSION[person]'"); 
	while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		card($row['UnitCode'],"Preferences: ".$row['Preference 1'].", ".$row['Preference 2'].", ".$row['Preference 3']);
	}
?>
</div>

<form method='POST'>
<style>
form .card div {
    margin-top: 10;
    margin-bottom: 10;
}
</style>
	<br><hr><br><h1>Find a Team</h1>
	
	<?php if(isset($requested)){if($requested){echo "<div class='sucess'>Request successfully lodged.</div>";}else{echo "<div class='error'>Request Failed.</div>";}}?>
	
	<div class='card'>
	<p>This will match you into a group at a later date (chosen by the unit coordinator)</p><hr>
	<div>
		<label for='unit'>Unit Code</label>
		<input list='units' name='unit' id='unit' class='inputpadding'>
		<datalist id='units'>
		<?php
			$result = multiSQL("SELECT * FROM Unit");
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
				echo "<option value='$row[UnitCode]'>$row[Unit]</option>";
			}
		?>
		</datalist>
		<?php if(isset($requested) && (!isset($request['unit']))){echo "<br><span class='error'>You already have a request for a group in this subject please resolve it before trying again.</span>";}?>
	</div>
	
	<div>
		<label for='sgpa'>Prefer Similar GPA Students?</label>
		<input type='checkbox' name='sgpa' id='sgpa'>
	</div>
	
	<div>
		<label for='type1'>Project Type Preference 1</label>
		<input list='types1' name='type1' id='type1' class='inputpadding'>
		<datalist id='types1'>
			<option value='any'>
		<?php
			$result = multiSQL("SELECT * FROM `Project_Types`");
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
		<input list='types1' name='type2' id='type2' class='inputpadding'>
	</div>
	
	<div>
		<label for='type3'>Project Type Preference 3</label>
		<input list='types1' name='type3' id='type3' class='inputpadding'>
	</div>
	
	<input type='submit' class='button button1' name='findgroup' value='Submit Request'>
	</div>

</form>

<form method='POST'>
<br><hr><br><h1>Already have a Team?</h1>
<?php
	if(isset($created)){
		if($created){
			echo "<div class='sucess'>Group Created Successfully.<br>You will be redirected <a href='http://$_SERVER[HTTP_HOST]/group'>here</a>.</div>";
		}else{
			echo "<div class='error'>Group Creation Failed.</div>";
		}
	}
	$cardcont = "This option is for students who already have a team. I.e. Teams were formed in workshops or assigned by the unit coordinator.<br>";
	$cardcont .= "<div><label for='tsub'>Subject</label>";
	$cardcont .= "<input list='units' id='tsub' name='tsub' class='inputpadding'></div>";
	$cardcont .= "<div><label for='tname'>Team Name</label>";
	$cardcont .= "<input type='text' id='tname' name='tname' placeholder='Default Teamname'></div>";
	$cardcont .= "<input type='submit' class='button button1' name='makegroup' value='Create'>";
	
	card("Invite your Existing Team",$cardcont);
?>
</form>