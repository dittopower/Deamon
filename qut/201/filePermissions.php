<?php 

	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
			
			<!-- CONTENT START -->
			<?php
			$files = phpFilesInDirectory();
	
			//$files = array_diff($files, array(basename(__FILE__)));//remove this file from the list
			
			if(isset($_POST['test'])){
			
				foreach($files as $entry){
					$entry = basename($entry, '.php');
					
					if($_POST[$entry] == null){
						$value = "--";
					}
					else{
						$value = $_POST[$entry];
					}
					
					$u = singleSQL("SELECT FileName FROM 201_filepermissions WHERE FileName='$entry'", $mysqli);
					if($u == null){
						$sql = "INSERT INTO 201_filepermissions (FileName, Access) VALUES('$entry','$value')";
					}
					else{
						$sql = "UPDATE 201_filepermissions SET Access='$value' WHERE FileName='$entry'";
					}
					
					if(runSQL($sql, $mysqli)){
						echo $entry . ' updated.<br>';
					} else { echo $entry . ' didn\'t work.<br>'; }
					
				}
					
			
			}
				
			echo '<hr><br><br><form action="filePermissions.php" method="post" id="contact_form">';

			echo 'Doctor = DD<br>Nurse = NN<br>Technician = TT<br>Receptionist = RR<br>Hospital Admin = HA<br><br>To give no-one permission (or it\'s irrelevant) put "--"<br>Or to give anyone permission put "AA"<br>(Note: System Admins have access to everything automatically.)<br><br>';
			
			foreach($files as $entry){
				$entry = basename($entry, '.php');
				$y = singleSQL("SELECT Access FROM 201_filepermissions WHERE FileName='$entry'",$mysqli);
				echo "<label>$entry</label><input type='text' name='$entry' value='$y'><br>\n";
			}
			   
			echo '<input type="hidden" name="test" value="true"><input type="submit"></form>';

			?>
				
			<!-- CONTENT END -->

	

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>