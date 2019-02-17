<?php include 'head.php' ?>



<!--_______________________________ Start Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Header  - - - - - - - - - - - - - -->



<?php include 'header.php' ?>







<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->

<?php include 'navbar.php' ?>







<!-- - - - - - - - - - - - - - Page Content  - - - - - - - - - - - - - -->

<div id="page">

		<script>

			function addmarker(lat,lon,mytitle){

				var myLatlng = new google.maps.LatLng(lat,lon);

				var marker = new google.maps.Marker({

				position: myLatlng,

				map: map,

				title: mytitle

				});

				window.lastMarker = marker;

			}

			function addInfoWin(text){

				var infowindow = new google.maps.InfoWindow({

					content: text

				});

				

				//Attach the infowindow

				infopopup(mymap,lastMarker,infowindow)

			}

			

			/*

			Attach the info window to the mark.

			*/

			function infopopup(map,marker,infowindow){

				//Add event listner

				google.maps.event.addListener(marker, 'click', function() {

					//Have it open the infowindow at the marker

					infowindow.open(map,marker);

				});

			}

		

			function showmypos(){

				//Check the users browser supports geolocations.

				if (navigator.geolocation){

					//Disable location related form elements once this happens.

					document.getElementById("maplocal").disabled = true;

					//Get the location and input it into the function.

					navigator.geolocation.getCurrentPosition(function (pos){

					//format position.

					var myLatlng = new google.maps.LatLng(pos.coords.latitude,pos.coords.longitude);

					//Create User marker.

					userlocalmark(myLatlng);

					});

					//Notify the User if their browser doesn't support geolocations.

				}else{

					alert("Geolocation is not supported by your browser.");

				}

			}

		 

		function userlocalmark(myLatlng){

			//Create marker at user location

			var marker = new google.maps.Marker({

				position: myLatlng,

				icon: { //The marker will be a blue fading circle.

					path: google.maps.SymbolPath.CIRCLE,

					scale: 10,

					strokeColor: '#000CFF',

					strokeOpacity: 0.3,

					strokeWeight: 20,

					fillColor: '#000CFF',

					fillOpacity: 0.6,

					},

				map: mymap,

				title: "Your Location"

			});

			//Zoom out map to help see

			mymap.setCenter(myLatlng);

			mymap.setZoom(13);

		}

		</script>

		

		<?php 

		if(isset($_GET['name']) && isset($_GET['rating'])){

		

			if(isset($_GET['suburbs'])){ $sub = $_GET['suburbs']; }else{ $sub =""; }

			

			echo '<br><center><a href="./">New Search</a></center>';

			echo '&nbsp;<h3 id="search">Search results for: <strong>"' . $_GET['name'] . '"</strong>, In suburb: <strong>"' . $sub . '"</strong>, With a minimum rating of: <strong>"' . $_GET['rating'] . '".</strong></h3>';



			if(!isset($_GET['rating']) || $_GET['rating'] == 0){

				$sql = "SELECT id, ParkName, Street, Suburb, PlaygroundName, Latitude, Longitude FROM items";

			}

			else{

				$sql = "SELECT ROUND(AVG(rating),1) as 'average',id, ParkName, Street, Suburb, PlaygroundName, Latitude, Longitude, street".

						" FROM reviews".

						" INNER JOIN items".

						" ON items.id=reviews.parkID";

			}

			

			if(isset($_GET['name']) && $_GET['name'] != ""){

				$sql .= " WHERE (ParkName LIKE '%" . $_GET['name'] . "%' OR PlaygroundName LIKE '%" . $_GET['name'] . "%')";

			}

			

			if(isset($_GET['suburbs']) && $_GET['suburbs'] != ""){

				if(isset($_GET['name']) && $_GET['name'] != ""){ $sql .= " AND"; } else { $sql .= " WHERE"; }

				$sql .= " Suburb='" . $sub . "'";

			}

						

			if($_GET['rating']==0){$sql .= " ORDER BY id DESC"; }

			else{$sql .= " GROUP BY parkID"; }

			

			$r = multiSQL($sql,$mysqli);

		}

		else{

			$r = multiSQL("SELECT id, ParkName, Street, Suburb, PlaygroundName, Latitude, Longitude FROM items ORDER BY id DESC",$mysqli);

		}



		if(isset($_GET['playground'])){

			$id = $_GET['playground'];

			$r = multiSQL("SELECT ParkName, Street, Suburb, PlaygroundName, Latitude, Longitude FROM items WHERE id=$id",$mysqli);

			$row = mysqli_fetch_array($r,MYSQLI_BOTH);

		

		?>

		

		<script type="text/javascript">

			function updateTextInput(val) {

				document.getElementById('rating').innerHTML=val;

			}

		</script>

		

		<div id="maps">

			<div id="map-canvas">

			</div>

			<button id="maplocal" onclick="showmypos()">Show My Location</button>

		</div>

		<script>

			var myLatlng = new google.maps.LatLng(<?php echo $row['Latitude']; ?>,<?php echo $row['Longitude']; ?>);

			  var mapOptions = {

			   zoom: 14,

			   center: myLatlng

			  }

			  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);



			  // To add the marker to the map, use the 'map' property

			  addmarker(<?php echo $row['Latitude']; ?>,<?php echo $row['Longitude']; ?>, "<?php echo $row['PlaygroundName'];?>");

		  

		  window.mymap = map;

		</script>

		<span itemscope="" itemtype="http://schema.org/Place">

		<img id="parkimg" itemprop="photo" alt="The Park" src="./parks/playground.jpg"/>

		

		<div id='infoBox'>

			

			<?php

				$idd = $_GET['playground'];

				$ratingg = round(singleSQL("SELECT AVG(rating) FROM reviews WHERE parkID=$idd",$mysqli),1);

				if($ratingg == null){ $ratingg = 'Unrated'; }

			?>

		

			<h2 id="title"><span itemprop="name"><?php echo $row['PlaygroundName']; ?></span></h2>

			<!--<?php echo 'Average rating: ' . $ratingg . '/5'; ?>-->

			<div id="location">

				

				Park:<span itemprop="containedIn"> <?php echo $row['ParkName'] . "</span><br>Location: <span itemprop='address'>" . $row['Street'] . "," . $row['Suburb']; ?></span>

				

			</div><br>

			

		</div>

		<div id='myrating'>

			<fieldset>

			<?php $rating = round(singleSQL("SELECT AVG(rating) FROM reviews WHERE parkID=$id",$mysqli)); ?>

			<span itemscope="" itemtype="http://schema.org/Review">

				<span itemprop="itemReviewed" hidden><?php echo $row['PlaygroundName']; ?></span>

				<h4>Reviews: 

					<span id="textrating" itemscope="" itemtype="http://schema.org/Rating">

					<span itemprop="worstRating" hidden>0</span>

					<span itemprop="ratingValue"><?php echo $rating; ?></span> / <span itemprop="bestRating">5</span>

					</span>

					<div class="rating">

					<div class="rated<?php if($rating == 'Unrated'){echo 'n';}else{ echo $rating; } ?>"></div>

					</div>

				</h4>

				<span itemprop="reviewBody">

				<div id="comments">

						<?php

							$id = $_GET['playground'];

							$y = multiSQL("SELECT text, user, reviewID, rating FROM reviews WHERE parkID=$id ORDER BY reviewID",$mysqli);

							

							while($row = mysqli_fetch_array($y,MYSQLI_BOTH)){

								echo "<div id='reviewEntry'><div class='left'><strong>" . $row['rating'] . "/5 - " .

								$row['user'] . "</strong>: \"" . $row['text'] . "\"</div><div class='dateText'>" . $newDate = date("d-m-Y h:ia", strtotime($row['submitted'])) . "</div></div>";

							}

						?>

					</div>

					</span>

				</span>

			</fieldset>							

							

		</div>

		</span>

		<fieldset>			

			<form name="commentform" id="commentform" method="post" action="./reviewSubmit.php">

			

					<h4>Write a review:</h4>

					

					<input type="range" name="rater" min="0" max="5" value="3" onchange="updateTextInput(this.value);"<?php if(!isset($_SESSION['User'])){?> disabled="disabled"<?php } ?>>

					<span id="rating">3</span>/5<br>

					<input type="hidden" name="parkID" value="<?php echo $_GET['playground']; ?>">

					<textarea id="reviewText" name="comment" 

						<?php if(!isset($_SESSION['User'])){?> placeholder="You must be logged in to post reviews." disabled="disabled"

						<?php } else { ?> placeholder="Write your review here. It must be 255 characters or less." <?php } ?>></textarea>

					<br><input type="submit" value="Post Review" <?php if(!isset($_SESSION['User'])){?>disabled="disabled"<?php } ?>>

				

			</form>

		</fieldset>

		

		<?php } else { ?>

			

			<div id="maps">

				<div id="map-canvas">

				</div>



				<button id="maplocal" onclick="showmypos()">Show My Location</button>

			</div>

			<script>

				//Centre the map on brisbane (i cant find an easy way to move it

				//  to around the markers... when not using user position).

				<?php 

				if(isset($_GET['gps']) && $_GET['gps'] != ""){

					$ll = explode("~",$_GET['gps']);

					echo 'var myLatlng = new google.maps.LatLng(' . $ll[0] . ', ' . $ll[1] . ');';

				}

				else{ echo 'var myLatlng = new google.maps.LatLng(-27.478202, 153.029081);'; } ?>



				//Setup Map

				var mapOptions = {

				zoom: <?php if(isset($_GET['gps']) && $_GET['gps'] != ""){echo 13;}else{echo 11;} ?>,

				center: myLatlng

				}

				//Initialise map

				var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

				window.mymap = map;

			</script>

			<div id="results">

			

			<?php

			while($rows = mysqli_fetch_array($r,MYSQLI_BOTH)){

				

				if(isset($_GET['gps']) && $_GET['gps'] != ""){

					if(distance($ll[0], $ll[1],$rows['Latitude'],$rows['Longitude']) > 3){ continue; }

				}

				if(isset($_GET['rating']) && $_GET['rating'] != 0){

					if($rows['average'] < $_GET['rating']){ continue; }

				}

			

				$id = $rows['id'];

				$rating = round(singleSQL("SELECT AVG(rating) FROM reviews WHERE parkID=$id",$mysqli));

				if($rating == null){ $rating = 'Unrated'; }?>

				

				<a id="parkLink" href="./parks.php?playground=<?php echo $rows['id'];?>">

					<article>

						<div class="parkthumbnail"><img class="parkthumb" src="./parks/playground.jpg" alt="<?php echo $rows['ParkName'];?>"></div>

						<h3 class="parklist"><?php echo $rows['PlaygroundName'];?></h3>

						<p class="rate">Rating:</p>

						<span itemprop="rating" itemscope="" itemtype="http://data-vocabulary.org/Rating">

							<span id="textrating">

							<span itemprop="value"><?php echo $rating; ?></span> / <span itemprop="best">5</span>

							</span>

							<div class="rating">

								<div class="rated<?php if($rating == 'Unrated'){echo 'n';}else{ echo $rating; } ?>"></div>

							</div>

							<br>

							<p class="parklistsub"><?php echo $rows['ParkName'] . ": " . $rows['Street'] . ", " . $rows['Suburb']; ?></p>

							<p class="parklistnotes"></p>

						</span>

					</article>

				</a>

				<script>

					addmarker(<?php echo $rows['Latitude']; ?>,<?php echo $rows['Longitude']; ?>,"<?php echo $rows['PlaygroundName']; ?>");

					addInfoWin(<?php echo '"<a href=\'./parks.php?playground=' . $rows['id'] . '\'>' . $rows['PlaygroundName'] . '<br>' . $rows['ParkName'] . '</a>: ' . $rows['Street'] . ', ' . $rows['Suburb'] . '"';?>);

				</script>

			<?php } ?>

			

			</div>

			

		<?php } ?>

	

</div>





<!--_______________________________ End Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Footer  - - - - - - - - - - - - - -->

<?php include 'footer.php' ?>









</html>