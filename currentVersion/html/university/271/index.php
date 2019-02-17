<?php include 'head.php' ?>



<!--_______________________________ Start Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Header  - - - - - - - - - - - - - -->



<?php include 'header.php' ?>







<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->

<?php include 'navbar.php' ?>







<!-- - - - - - - - - - - - - - Page Content  - - - - - - - - - - - - - -->

<div id="page">

	&nbsp;

	<form name="parksearch" id="parksearch" action="parks.php" method='get'>



		<h2>Search for Playgrounds</h2>



		<fieldset>

			<input type='text' name='gps' hidden>

			Name: <input type="text" name="name" placeholder="Park Name"><br>



			<!-- Playground Rating -->

			Rating: <input type="radio" name="rating" value="0" checked>Any

					<input type="radio" name="rating" value="1">1

					<input type="radio" name="rating" value="2">2

					<input type="radio" name="rating" value="3">3

					<input type="radio" name="rating" value="4">4

					<input type="radio" name="rating" value="5">5

			<br>



			Suburb: <select id="suburbs" name="suburbs">



						<!-- Populate Suburbs List based Playground's suburbs -->

						<?php

							

							$sql = multiSQL("SELECT DISTINCT Suburb FROM items ORDER BY Suburb ASC",$mysqli);

							

							if($sql->num_rows !== 0){

								echo '<option value="">Any</option>';

								while($rows = mysqli_fetch_array($sql,MYSQLI_BOTH)){

									echo '<option>' . $rows['Suburb'] . '</option>';

								}									

							}else{							

								echo '<option>Error Loading Suburbs</option>';						

							}

						?>

						

					</select><br><br>

				

			<input type="submit" value="Search">

				<script> function getlocal(){

				  //Check the users browser supports geolocations

				  if (navigator.geolocation){

				  

				   //Disable location related form elements while this happens

				   parksearch.suburbs.disabled = true;

				   parksearch.geo.value = "Please wait..";

				   parksearch.geo.disabled = true;

				   

				   //Get the location and input it into the function 

				   navigator.geolocation.getCurrentPosition(function (position){

				   

				   //Create search url from search form fields and latitude/longitude.

				   document.parksearch.gps.value = position.coords.latitude + "~" + position.coords.longitude;

				   document.parksearch.submit();

				  });

				  }else{

					alert("Geolocation is not supported by your browser.");

				  }}

				</script>

			<input type="button" name="geo" onclick="getlocal()" value="Search Nearby Me">



		</fieldset>

	</form>

</div>





<!--_______________________________ End Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Footer  - - - - - - - - - - - - - -->

<?php include 'footer.php' ?>









</html>