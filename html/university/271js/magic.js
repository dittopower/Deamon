/*

Damon Jones n8857954 

Josh Henley n8858594

INB271 - 2014

*/



/*			JavaScript file				*/



//Storage Variables

info = [[],[],[],[],[],[],[],[],[],[],[],[]];

id = 0; parkcode = 1; parkname = 2; street = 3; suburb = 4; nodeid =5; playgroundname = 6;

//The "comments" section of the csv is really just notices

notes = 7; latitude = 8; longitude = 9; rating = 10; comments = 11;



//Just In case Loading the .csv file fails

{hardcode="id,Park Code,Park Name,Street,Suburb,Node Id,Playground Name,Comments,Latitude,Longitude\n\

1,D0228,7TH BRIGADE PARK,HAMILTON RD,CHERMSIDE,16377,BEOR ST PLAYGROUND,,-27.38283393,153.0429601\n\

2,D0228,7TH BRIGADE PARK,HAMILTON RD,CHERMSIDE,16380,DELAWARE ST PLAYGROUND,,-27.37841513,153.0454851\n\

3,D0228,7TH BRIGADE PARK,HAMILTON RD,CHERMSIDE,16388,NAVARRE ST PLAYGROUND,,-27.37640331,153.0344464\n\

4,D0228,7TH BRIGADE PARK,HAMILTON RD,CHERMSIDE,16396,'KIDSPACE' DISTRICT PLAYGROUND,,-27.3784171,153.0337881\n\

5,D0228,7TH BRIGADE PARK,HAMILTON RD,CHERMSIDE,30177,DELWARE ST PLAYGROUND (NEWMAN RD SECTION),,-27.37889219,153.0457117\n\

6,D0696,A.R.C.HILL PARK,GOSS RD,VIRGINIA,17683,GOSS RD PLAYGROUND,,-27.38560887,153.05579\n\

7,D0432,ABBEVILLE STREET PARK,ABBEVILLE ST,UPR MT GRAVATT,15815,KINGSWAY ST PLAYGROUND,,-27.54475436,153.0883013\n\

8,D1009,ABBOTT STREET PARK,ABBOTT ST,CAMP HILL,12899,ABBOT ST PLAYGROUND,,-27.49956668,153.0855349\n\

9,D0409,ACACIA PARK,CARMODY RD,ST LUCIA,19898,ACACIA PK PLAYGROUND,,-27.49905729,153.0078976\n\

10,D1518,ADVANX STREET PARK,MIRBELIA ST,KENMORE HILLS,17903,ADVANX ST PLAYGROUND,,-27.50112422,152.9354673\n\

11,D1515,AKUNA STREET PARK,AKUNA ST,KENMORE,17907,AKUNA ST PLAYGROUND,,-27.51104143,152.9515058\n\

12,D1015,ALAN WILLING PLACE PARK,BERNARRA ST,THE GAP,19363,ALAN WILLING PLAYGROUND,,-27.44806691,152.9592296\n\

13,D1709,ALBANY CREEK ROAD PARK (NO.151),ALBANY CREEK RD,ASPLEY,30938,LIVINGSTON ST PLAYGROUND,,-27.35935363,153.0069263\n\

14,D0800,ALBANY CREEK ROAD RESERVE,ALBANY CREEK RD,BRIDGEMAN DOWNS,12179,ALBANY CREEK RD PLAYGROUND,,-27.34990896,152.9801428\n\

15,D0464,ALBERT BISHOP PARK,HEDLEY AVE,NUNDAH,17506,HEDLEY AVE (BUCKLAND RD) PLAYGROUND,,-27.40406627,153.068307\n\

16,D0464,ALBERT BISHOP PARK,HEDLEY AVE,NUNDAH,17510,HEDLEY AVE (HOWS RD) PLAYGROUND,,-27.40731104,153.0673967\n\

17,D0464,ALBERT BISHOP PARK,HEDLEY AVE,NUNDAH,17511,LEAGUES CLUB PLAYGROUND,,-27.40617208,153.0702826\n\

18,D1077,ALCHERINGA PLACE PARK,ALCHERINGA PL,ROBERTSON,20512,ALCHERINGA PLACE PLAYGROUND,,-27.560947,153.0555825\n\

19,D1077,ALCHERINGA PLACE PARK,ALCHERINGA PL,ROBERTSON,20514,HILLARDT ST PLAYGROUND,,-27.56116471,153.0529184\

"};



//---------------------------------------------------------------------------------------------------------

// RegEx  -- Re-Useable



	/*

	Check if the thing (the RegEx pattern) is in the text.

	*/

	function reg_test(thing,text){

		

		//Create proper RegEx pattern variable.

		var patt=new RegExp(thing,'i');

		

		//test the pattern on the text.

		test=patt.test(text);

		

		//In case of Errors or null.

		//if test has bool value return it otherwise false.

		if (test||!test){

			return test;

		}else{

			return false;

		}

	}

	

	/*

	Return part of the text that matches the RegEx pattern.

	*/

	function reg_get(thing,text){

		//Create proper RegEx pattern variable.

		var patt=new RegExp(thing,'i');

		

		//return the text that matches the pattern.

		return patt.exec(text);

	}





//---------------------------------------------------------------------------------------------------------

// Load & Process .csv file  -- Re-Useable

	

	/*

	Retieve and load the target file into a variable

	*/

	function getme(target) {

		//Try to manage errors.

		try{

			

			//Create the XMLhttpRequst.

			request = new XMLHttpRequest();

			

			//Set it as a file retieval.

			request.open("GET",target,false);

			

			//Send the file request.

			request.send(null);

			

			//Check the responce.

			if (reg_test("404.*Not Found",request.responseText)){

			

				//404 or page not found is effective failure or an error, so make it one.

				throw "404";

				

			}else{

				//Target has been loaded set it as the return text.

				restxt=request.responseText;

			}

			//Return the target

			return restxt;

		

		//Upon failure/errors.

		}catch(err){

			//log it and return null.

			console.log("D:ALERT  "+ target + "\n[>Non-Existent!!");

			return null;

		}

	}



	/*

	Loads our dataset from playgrounds.csv into our array/table variable 'info'.

	*/

	function getdata(){

		//Get the csv file into a variable

		load=getme("Playgrounds.csv");

		

		//Check sucess

		if (load != null){

			//Failed run convert on the few hardcoded CSVs.

			convert(load);

		}else{

			//Sucess run convert on the .CSV's contents.

			convert(hardcode);

		}

	}



	/*

	Convert a csv into a useful array/table.

	*/

	function convert(string){

		//Seperate rows.

		lines = string.split("\n");

		

		//For each row

		for (index = 0; index < lines.length - 1; index++){

			

			//Separate columns

			line=reg_get("(^[^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,\n]*)", lines[index]);

			

			//Add each columns value to it's column/row in the array

			for (each = 0; each < line.length; each++){

				info[each].push(line[each+1]);

			}

			

			//Set the rating column value to none

			info[rating].push("");

			info[comments].push("");

		}

		//Set extra column headers

		info[rating][0] = "Rating";

		info[comments][0] = "User Comments";

		

		//Delete unnessecary variables.

		delete line; delete lines; delete load;

	}





//---------------------------------------------------------------------------------------------------------

// Very Basic User Accounts  - login/register stuff



	/*

	Save all the form elements and log the user in.

	*/

	function runregister(){

		//save Email info

		document.cookie = "email=" + register.email.value;

		document.cookie = "newsletter=" + register.subnews.checked;

		

		//Save Name info

		if (!reg_test("[a-zA-Z]+",register.fname.value)){

			return false;

		}

		document.cookie = "fname=" + register.fname.value;

		document.cookie = "lname=" + register.lname.value;

		

		//save Account info

		document.cookie = "username=" + register.username.value;

		document.cookie = "password=" + register.password.value;

		

		//log them on

		document.cookie="logged=on";

	}

	

	/*

	Check logon details are correct and log the user on.

	*/

	function logon(){

		//prep for comparison

		user="username=" + login.username.value + ";";

		pass="password=" + login.password.value + ";";

		

		//Test if username and password match the currently stored account.

		userb=reg_test(user,document.cookie);

		passb=reg_test(pass,document.cookie);

		

		//If both match login

		if (userb && passb){

			document.cookie="logged=on";

			

		//otherwise notify the user.

		}else{

			alert("Username or Password was Invaild.");

		}

		

		//Delete the variables containing sensitive data.

		delete user; delete pass; delete userb; delete passb;

		

		//Refresh

		location = location;

	}

	

	/*

	Logout.

	*/

	function logout(){

		//Set the cookie to logged out.

		document.cookie="logged=off";

		

		//Refresh the page so user specific elements are replaced with annonimous/login/register.

		location=location;

	}

	

	/*

	Change elements if logged in.

	*/

	function loginout(){

		//if logged in

		if (reg_test("logged=on",document.cookie)){

		

			//Replace login & register with welcome and logout.

			login.innerHTML = '\

			<div id="name">Hi, ' + reg_get("fname=([a-zA-Z]+)",document.cookie)[1] + '</div>\

			<input type="button" id="out" onclick="logout()" value="Logout">';

		}

	}



	

//---------------------------------------------------------------------------------------------------------

// Search form page -- index.html



	/*

	Populate the Suburbs droplist box for the search form.

	*/

	function popsuburbs(){

		subs=[];

		

		//Get the suburbs of avaliable (loaded) parks.

		for (i = 1; i < info[suburb].length; i++){

		

			//Checks the suburbs not already listed.

			if (!reg_test(info[suburb][i],subs.toString())){

				

				//Add the option to the dropdown menu.

				subs.push('<option value="' + info[suburb][i] + '">' + info[suburb][i] + '</option>');

			}

		}

		

		//Sort suburbs.

		subs.sort();

		

		//Place a blank option on top of the list and format it for HTML.

		subs = '<option value=""> </option>' + subs.toString();

		subs = subs.replace(/,/g,"");

		

		//Add the options to the suburbs dropdown list

		document.getElementById("suburbs").innerHTML=subs;

	}



	

//---------------------------------------------------------------------------------------------------------

// Search form auto locate -- index.html



	/*

	Use html5 geolocation to get the users location and input it into a function.

	*/

	function getlocal(){

		//Check the users browser supports geolocations

		if (navigator.geolocation){

		

			//Disable location related form elements while this happens

			parksearch.suburbs.disabled = true;

			parksearch.geo.value = "Please wait..";

			parksearch.geo.disabled = true;

			

			//Get the location and input it into the function 

			navigator.geolocation.getCurrentPosition(showPosition);

			

		}else{

			alert("Geolocation is not supported by your browser.");

		}

	}

	

	/*

	Run Search using user location.

	*/

	function showPosition(position){

		//Create search url from search form fields and latitude/longitude.

		url = "parks.html?name=" + parksearch.name.value + "&rating=" + parksearch.rating.value + "\

		&location=~" + position.coords.latitude + "~" + position.coords.longitude;

		

		//Re-enable the form elements anyway... (technically pointless as we're about to change page)

		parksearch.suburbs.disabled = false;

		parksearch.geo.value = "Close to me";

		parksearch.geo.disabled = false;

		

		//Goto the search url.

		location = url;

	}

	



//---------------------------------------------------------------------------------------------------------

// Google Maps js api3 -- Re-Useable



	function initialize(lat,lon){

        var mapOptions = {

			center: new google.maps.LatLng(lat, lon),

			zoom: 14

        };

        var map = new google.maps.Map(document.getElementById("map-canvas"),

            mapOptions);

    }



	

	function mark(lat,lon,Mname){

		var myLatlng = new google.maps.LatLng(lat,lon);

		var mapOptions = {

			zoom: 14,

			center: myLatlng

		}

		var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);



		// To add the marker to the map, use the 'map' property

		var marker = new google.maps.Marker({

			position: myLatlng,

			map: map,

			title: Mname

		});

		

		window.mymap = map;

	}





//---------------------------------------------------------------------------------------------------------

// Search results, multi-park display page -- parks.html



	/*

	Populate the park list page *using search criteria if appropriate.

	*/

	function listitems(){

		results = [];

		

		//Check for conditions.

		nameb = reg_test("name=([^&]+)",location);

		rateb = reg_test("rating=([0-4]+)",location);

		locb = reg_test("location=([^&]+)",location);

		suburbb = reg_test("suburbs=([^&]+)",location);

		

		//set up the map

		if (locb){

		//If using the users location 

		

			//Get coordinates

			place = reg_get("~([^&~]+)~([^&]+)",location);

			

			//create coordinate variable

			var myLatlng = new google.maps.LatLng(place[1],place[2]);

			

			//Setup Map

			var mapOptions = {

			zoom: 14,

			center: myLatlng

			}



		}else{

		//If not using the users location 

		

			//Centre the map on brisbane (i cant find an easy way to move it

			//  to around the markers... when not using user position).

			var myLatlng = new google.maps.LatLng(-27.478202, 153.029081);

			

			//Setup Map

			var mapOptions = {

			zoom: 12,

			center: myLatlng

			}

		}

		

		//Initialise map

		var map = new google.maps.Map(document.getElementById("res-map-canvas"), mapOptions);

		

		//if using the users location show their location. Has to be done seperately from previous 

		// user location if statement as it require the map to be initialised.

		if (locb){

			userlocalmark(map,myLatlng);

		}

		

		//Iterate all entries.

		for (i = 1; i < info[0].length; i++){

			

			//check that park's name meets the search criteria.

			namebb = true;

			if (nameb){

				namebb = reg_get("name=([^&#]+)",location)[1];

				namebb = (reg_test(namebb, info[playgroundname][i]) || reg_test(namebb, info[parkname][i]));

			}

			

			//check that park's rating meets the search criteria.

			ratebb = true;

			if (rateb){

				ratebb = reg_get("rating=([^&#]+)",location)[1];

				ratebb = reg_test(ratebb, info[rating][i]);

			}

			

			//check that park's suburb matches the search criteria.

			place = true;

			if (suburbb){

				place = reg_get("suburbs=([^&#]+)",location)[1];

				place = place.replace(/\+/g," ");

				place = reg_test(place, info[suburb][i]);

			}

			

			//check if a park's location is near the users. nearby is within 3km.

			if (locb){

				place = reg_get("~([^&~#]+)~([^&#]+)",location);

				place = distance(place[1],place[2],info[latitude][i],info[longitude][i]);

				place = place < 3; //km

			}

			

			//if the parks not already displayed and meets conditions, show it.

			if ((namebb && ratebb && place)){

			

				//Make the items

				results.push(item(i));

				

				//map marker position

				var myLatlng = new google.maps.LatLng(info[latitude][i],info[longitude][i]);

				

				//Create marker

				var marker = new google.maps.Marker({

					position: myLatlng,

					title: info[playgroundname][i]

					});

				

				//put the marker on the map

				marker.setMap(map);

				

				//Create the infowindow

				var infowindow = new google.maps.InfoWindow({

					content: infowindowitem(i)

				});

				

				//Attach the infowindow

				infopopup(map,marker,infowindow)

			}

		}

		

		//Sort the list of parks. 

		results.sort();

		

		//Format it for the page.

		results = "<h2>Playgrounds</h2>" + results.toString();

		results = results.replace(/,/g,"");

		results = results.replace(/~/g,",");

		

		//Output to page.

		document.getElementById("results").innerHTML = results;

	}

	



	/*

	Attach the info window to the mark.

	*Note: has to be done separate or else the listener would be overiden each time.

	*/

	function infopopup(map,marker,infowindow){

		//Add event listner

		google.maps.event.addListener(marker, 'click', function() {

		

			//Have it open the infowindow at the marker

			infowindow.open(map,marker);

		});

	}

	

	/*

	Show the users location on the map

	*/

	function userlocalmark(map,myLatlng){

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

			map: map,

			title: "Your Location"

		});

	}

	

	

	/*

	Creates a playground entry for the listitems().

	*/

	function item(i){

		//Make the entry and make it link to the item's page,

		// and display playground name & details.

		result='\

		<a id="' + info[playgroundname][i].replace(/ /g,"") + '" href="./playgrounds.html?playground=' + info[id][i] + '">\

		<article>\

		<div class="parkthumbnail"><img class="parkthumb" src="./parks/playground.jpg" alt="' + info[playgroundname][i] + '"></div>\

		<h3 class="parklist">' + info[playgroundname][i] + '</h3>\

		<p class="rate">Rating:  </p>' + showrating(i) +

		'<br><p class="parklistsub">' + info[parkname][i] + '~ ' + info[street][i] + '~ ' + info[suburb][i] + '</p>\

		<br><p class="parklistnotes">' + info[notes][i] + '</p>\

		<br></article>\

		</a>';

		

		//return the entry/item.

		return result;

	}

	

	/*

	Creates a playground entry for an infowindow on the map.

	*/

	function infowindowitem(i){

		//Make the entry and make it link to the item's page,

		// and display playground name & details.

		result='\

		<section class="infoentry">\

		<a " href="./playgrounds.html?playground=' + info[id][i] + '">\

		<img class="infothumb" src="./parks/playground.jpg" alt="' + info[playgroundname][i] + '">\

		<br><h3 class="infoh3">' + info[playgroundname][i] + '</h3>\

		<p class="inforate">Rating:  </p>' + showrating(i) +

		'<p class="infopark">' + info[parkname][i] + ', ' + info[street][i] + ', ' + info[suburb][i] + '</p>\

		<br><p class="infonotes">' + info[notes][i] + '</p>\

		</a></section>';

		

		//return the entry/item.

		return result;

	}

	

	

	/*

	Convert degrees (i.e. degrees of lat/long) to radians.

	*/

	function getrad(deg){

		return deg * Math.PI / 180;

	}



	/*

	Calculate distance between positions (in km).

	

	Uses haversine formula for 'great-circle' distances between points.

	http://en.wikipedia.org/wiki/Haversine_formula

	*/

	function distance(lat1,long1,lat2,long2){

		earthsradius = 6371; //km

		

		//Get variables.

		dLat = getrad(lat2-lat1);

		dLong = getrad(long2-long1);

		

		lat1 = getrad(lat1);

		lat2 = getrad(lat2);

		

		hsLat = Math.sin(dLat/2);

		hsLong = Math.sin(dLong/2);

		

		clat1 = Math.cos(lat1);

		clat2 = Math.cos(lat2);

		

		//Calculations

		a = hsLat * hsLat + hsLong * hsLong * clat1 * clat2;



		c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 



		return earthsradius * c;

	}

	



//---------------------------------------------------------------------------------------------------------

// Ratings and comment functions  -- Re-Useable 



	/*

	Returns the code for a rating bar

	*/

	function showrating(i){

		//Write rating with microdata.

		out = '\

		<span itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">\

		<div id="textrating"><span itemprop="value">';

		

		//If rated show rating else unrated

		if (reg_test("[0-4]",info[rating][i])){

			out += info[rating][i];

		}else{

			out += "Unrated";

		}

		

		//Finish microdata

		out += '</span> / <span itemprop="best">4</span>\

		</div>';

		

		//Create rating bar.

		out += '<div class="rating">\

		<div class="';

		

		//set bar value.

		switch (info[rating][i]){

			case "0":

				out += 'rated0';

				break;

			case "1":

				out += 'rated1';

				break;

			case "2":

				out += 'rated2';

				break;

			case "3":

				out += 'rated3';

				break;

			case "4":

				out += 'rated4';

				break;

			default:

				out += 'raten';

				break;

		}

		

		//Finish and return.

		out += '"></div></div>';

		return out;

	}



	/*

	Restore ratings for parks from the cookie.

	*/

	function setratings(){

		//Separate the parks of the cookie.

		lines = document.cookie.split(";");

		

		//For each part of the cookie,

		for (i = 0; i < lines.length; i++){

			//if that part is a rating

			if (reg_test("[0-9]+=[0-4]",lines[i])){

			

				//get index and rating

				line = reg_get("([0-9]+)=([0-4])",lines[i]);

				

				//set rating

				info[rating][line[1]] = line[2];

			}

		}

	}

	

	/*

	Restore comments for parks from the cookie.

	*/

	function setcomments(){

		//Separate the parks of the cookie.

		lines = document.cookie.split(";");

		

		//For each part of the cookie,

		for (i = 0; i < lines.length; i++){

			//if that part is a rating

			if (reg_test("C[0-9]+=#C#[^;]+",lines[i])){

			

				//get index and rating

				line = reg_get("C([0-9]+)=(#C#.+)",lines[i]);

				

				//set rating

				info[comments][line[1]] = line[2];

			}

		}

	}

	

	/*

	Returns a html string of the comments for that item.

	*/

	function showcomments(i){

		//separate all the comments.

		thing = info[comments][i].split("#C#");

		

		//Initialize string

		result = "";

		

		//Iterate through each comment.

		for (a = 1; a < thing.length; a++){

			

			//Separate comment and author.

			lines = thing[a].split("#A#");

			

			//Add comment to result string

			//	-Author

			//	-	Comment

			result += '\

			<div class="commentbox">\

			<div class="commenter"><span itemprop="reviewer">' + lines[1] + '</span> Says:</div>\

			<div class="comment"><span itemprop="summary">' + lines[0] + '</span></div></div><br>';

		}

		

		//Return the comments

		return result;

	}

	



//---------------------------------------------------------------------------------------------------------

//Specific park views -- playgrounds.html



	/*

	Set your rating for a playground.

	*/

	function rateme(){

		//Get playground id.

		place = reg_get("playground=([0-9]+)",location)[1];

		

		//find the right park using the id.

		for (i = 0; i < info[id].length; i++){

			if (place == info[id][i]){

			

				//Set your rating.

				info[rating][i] = myrating.rater.value;

				

				//Refresh displayed rating.

				document.getElementById("vrate").innerHTML = showrating(i);

				

				//Also store rating in cookie so it stays around.

				document.cookie = i + '=' +info[rating][i];

			}

		}

	}

	

	/*

	Adds your comment.

	*/

	function addcomment(){

		//Check theres text in the comment.

		if (!reg_test(".+",commentform.comment.value)){

			

			//Change placeholder to notify user.

			commentform.comment.placeholder = "Min. 2 Letters.";

			

			//Reset comment space

			commentform.comment.value = "";

			

			//End function

			return false;

		}

		

		//Check our storeage values aren't used

		if (reg_test("#C#",commentform.comment.value) || reg_test("#A#",commentform.comment.value)){

			

			//Ensure user knows they cant use these

			alert("You may NOT use our reserved system values: #C# or #A#");

			

			//End function

			return false;

		}

		

		//Get playground id.

		place = reg_get("playground=([0-9]+)",location)[1];

		

		//find the right park using the id.

		for (i = 0; i < info[id].length; i++){

			if (place == info[id][i]){

			

				//Set your rating.

				info[comments][i] += "#C#" + commentform.comment.value;

				

				//Add author

				if (reg_test("logged=on",document.cookie)){

				

					//If its a logged in user, their username.

					info[comments][i] += "#A#" + reg_get("username=([^;]+)",document.cookie)[1];

					

				}else{

					

					//If not a logged in user, annonymous.

					info[comments][i] += "#A#Anonymous";

				}

				

				//Refresh displayed rating.

				document.getElementById("comments").innerHTML = showcomments(i);

				

				//Also store rating in cookie so it stays around.

				document.cookie = "C" + i + '=' + info[comments][i];

				

				commentform.comment.value = "";

			}

		}

	

		return false;

	}

	

	

	/*

	Fill in the information for a specific playground's page based on parkcode.

	*/

	function viewitem(){

		//Check url contains playground id.

		if (reg_test("playground=",location)){

			

			//Get id from url.

			place = reg_get("playground=([0-9]+)",location)[1];

			

			//Iterate through IDs.

			for (i = 0; i < info[id].length; i++){

				

				//Check if the parkcode matches this page's parkcode.

				if (place == info[id][i]){

				

					//Set the title to the playground name.

					document.title = "QLD Playgrounds: " + info[playgroundname][i];

					

					//Microdata review

					document.getElementById("page").innerHTML = '\

						<span itemscope itemtype="http://data-vocabulary.org/Review">' + 

						document.getElementById("page").innerHTML + '</span>';

					

					//Set the on page title to the playground name with microdata

					document.getElementById("title").innerHTML = '\

						<span itemprop="itemreviewed">' + info[playgroundname][i] + '</span>';

					

					

					//Print the parks address on the page.

					document.getElementById("location").innerHTML = '\

					<span itemprop="location" itemscope itemtype="http://data-vocabulary.org/?Organization">\

					Park: <span itemprop="name">' + info[parkname][i] + '</span><br>\

					<span itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">\

					Location: <span itemprop="street-address">' + info[street][i] + '</span>, \

					<span itemprop="locality">' + info[suburb][i] + '</span>\

					</span></span>';

					

					//If the page has any notes or ("comments" in csv file) display them.

					if (info[notes][i] != ""){

						thing = info[notes][i];

						

					//If it doesn't show: --

					}else{

						thing = "--";

					}

					//Actually show the notes.

					document.getElementById("notes").innerHTML = 'Notes: ' + thing;

					

					//Get and show the playgrounds rating.

					document.getElementById("vrate").innerHTML = showrating(i);

					

					//Get and show the playgrounds comments.

					document.getElementById("comments").innerHTML = showcomments(i);

					

					//Show on map.

					mark(info[latitude][i],info[longitude][i],info[playgroundname][i]);

					

					break;

				}

			}	

		}

	}

	

	/*

	Show users location on an idividual item page.

	*/

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

				userlocalmark(mymap,myLatlng);

				

				//Zoom out map to help see

				mymap.setZoom(10);

			});

			

		//Notify the User if their browser doesn't support geolocations.

		}else{

			alert("Geolocation is not supported by your browser.");

		}

	}





//---------------------------------------------------------------------------------------------------------

// Page Load Stuff



	/*

	The function thats run upon the page loading.

	*/

	function pageload(){

	

		//Because forms submit to url, remove login from url.

		if (reg_test("username=",location) || reg_test("password=",location)){

			location = reg_get("([^\\?]+)\\?",location)[1];

		}

		

		//If logged on you can't register

		if (reg_test("logged=on",document.cookie) && reg_test("registration.html",location)){

			location = "index.html";

		}

		

		//if the url includes the specific playground suffix and not on playgrounds.html

		if (reg_test("playground=",location)){

			if (!reg_test("playgrounds\.html",location)){

			

				//Go to playgrounds.html with the specific suffix.

				location = "playgrounds.html" + reg_get("(\\?.+)",location)[1];

			}

		}

		

		//if on playgrounds.html and the url doesn't have a specific playground suffix

		if (reg_test("playgrounds\.html",location)){

			if (!reg_test("playground=",location)){

			

				//return to the parks lookup page

				location = "parks.html";

			}

		}

		

		//load the .csv file into the javascript.

		getdata();

		

		//If the cookie contains ratings

		if (reg_test("[0-9]+=[0-4]",document.cookie)){

		

			//restore ratings from the cookie.

			setratings();

		}

		

		//If the cookie contains comments

		if (reg_test("C[0-9]+=#C#[^;]+",document.cookie)){

			

			//restore comments from the cookie.

			setcomments();

		}

		

	//End pageload().

	}



//Run the on Load functions.

window.onload=pageload();

	

/*

Damon Jones n8857954 

Josh Henley n8858594

INB271 - 2014

*/