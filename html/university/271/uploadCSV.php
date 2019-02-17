<?php include 'head.php' ?>



<!--_______________________________ Start Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Header  - - - - - - - - - - - - - -->



<?php include 'header.php' ?>







<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->

<?php include 'navbar.php' ?>







<!-- - - - - - - - - - - - - - Page Content  - - - - - - - - - - - - - -->

<div id="page">

	<div id="inner">

	<?php

	$un = $_SESSION['User'];

	$t=singleSQL("SELECT admin FROM members WHERE username='$un'",$mysqli);

	

	if(isset($_FILES["newfile"]) && $t == 1){

		$filename = $_FILES["newfile"]["name"];

		$filesize = ($_FILES["newfile"]["size"] / 1024);

						

		if ($_FILES["newfile"]["error"] > 0){

			echo "Return Code: " . $_FILES["newfile"]["error"] . "<br />";

		}

	

		$file = fopen($_FILES["newfile"]["tmp_name"],"r");

		$first = fgetcsv($file);

		

		runSQL("TRUNCATE TABLE items",$mysqli);

		echo '<p>Running...';

		while(! feof($file)){

			$a = fgetcsv($file);

			$sql = "INSERT INTO items (id, ParkCode, ParkName, Street, Suburb, NodeId, PlaygroundName, Comments, Latitude, Longitude)" . 

			"VALUES($a[0],'$a[1]','$a[2]','$a[3]','$a[4]',$a[5],'$a[6]','$a[7]',$a[8],$a[9])";

			runSQL($sql,$mysqli);

		 }

		echo '</p>Finished.';



		fclose($file);

		

	} else { ?> 

		<h3>Upload New 'playgrounds.csv' File</h3>

		<p>This will take a while to complete...</p>

		<fieldset>

		<form action='uploadCSV.php' method='post' enctype='multipart/form-data'>

		<input type='file' name='newfile'>

		<input type='submit' name='submit' value='Upload' />

		</form>

		</fieldset>

	<?php } ?>

	</div>

</div>





<!--_______________________________ End Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Footer  - - - - - - - - - - - - - -->

<?php include 'footer.php' ?>









</html>