<?php 
	include 'header.php';
	if(checkFilePermission(__FILE__, $mysqli)){
?>
			<!-- CONTENT START -->
			
			<h2>Uploaded X-Rays</h2>

            <div class="clear h20"></div>
        	<ul id="gallery" class="nobullet">
				<?php
					$s = multiSQL("SELECT Xray, PatientID, StaffID FROM 201_xray",$mysqli);
						
					while($rows = mysqli_fetch_array($s,MYSQLI_BOTH)){
						echo '<li><a href="./xrays/' . $rows['Xray'] . '"><img src="./xrays/' . $rows['Xray'] . '" width="180" height="100" class="img_border img_border_b" />
                    </a><br>Patient: ' . $rows['PatientID'] . '<br>Scanned by: ' . $rows['StaffID']  . '</li>';
					}
				?>
                </ul>
            <div class="clear h20"></div>
		   
			<!-- CONTENT END -->

<?php } else { include 'permissionDenied.html'; } ?>
<?php include 'footer.php'; ?>