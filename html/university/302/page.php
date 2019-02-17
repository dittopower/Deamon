<?php require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_login();
	lib_group();
	lib_perms();
	if(($_SESSION['registered'] != 1) && ($_SERVER['REQUEST_URI'] != "/first_time/") && !isset($_SESSION['SupervisorID'])){
		header("Location: http://$_SERVER[HTTP_HOST]/first_time");
		echo "<a href='http://$_SERVER[HTTP_HOST]/first_time'>rediect</a>";
		die();
	}
	?>
<HTML>

<HEAD>
	<title>Teamwork</title>
	<link rel="Shortcut Icon" href="https://esoe.qut.edu.au/static/favicon-d177589c7efc2024aefe76fe35962db2.ico">
	<link rel="stylesheet" type="text/css" href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/style.css">
	
	<script src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/jquery-2.1.4.min.js"></script>
	
	<script>
		var freq = 2000;
		var same = 0;
		var freqmod = 0;
		var loop = setInterval(looping, freq);
		<?php $ids=members_id();$names=members();
			echo "var tabs = [{id:'g-2',name:'Global',content:'',last:''}";
			if(inGroup()){
			echo ",{id:'g$_SESSION[group]',name:'$_SESSION[gname]',content:'',last:''}";
			}
			foreach($ids as $key=>$value){
			echo ",{id:'$value',name:'$names[$key]',content:'',last:''}";
			}
			echo "];"
		?>

		var currentTab = "0";
		
		var url="<?php echo "http://$_SERVER[HTTP_HOST]/chat/";?>";
		
		$( document ).ready(function() {
				
			$("#chatInput").keyup(function(event){
				if(event.keyCode == 13){
					$("#chatSend").click();
				}
			});
			
			chatInitiate();
			changeTab(0);
		
		});
				
		function getData(person, tab){
			
			var sendData = {person: person,last:tabs[currentTab]['last']};
			
			if(person.charAt(0) == 'g'){
				sendData = {group: person.substring(1),last:tabs[currentTab]['last']};
			}//send different data if its a group
			
			$.post(url, sendData, function(data) {
				
				var jsonData = $.parseJSON(data);
				var html = "";
				
				$.each(jsonData, function(idx, obj) {
					if(tabs[tab]["content"].indexOf("<span id='cid" + obj.ChatID + "'") == -1){
						pie=data;
						var tt = obj.TimeSent;
						//var timestamp = new Date(tt);
						
						//timestamp.setHours(timestamp.getHours() + 15);
						
						//var time = timestamp.format("g:ia");
						times=/-(\d\d)-(\d\d)\s(\d\d\:\d\d)/.exec(tt);
						time = times[2] + "/" + times[1] + "-" + times[3];
						
						html += "<span id='cid" + obj.ChatID + "' class='preText'>("+time+") @" + obj.FirstName + ":</span> " + obj.Message + "<br>";
						tabs[currentTab]['last'] = obj.ChatID;
					}//<span class="preText">(1:54pm) Josh:</span> chat text goes here<br>
				});
				
				if (html == ""){
					same++;
					if(Math.floor(same/10) > freqmod){
						freqmod = Math.floor(same/10);
						clearInterval(loop);
						loop = setInterval(looping, (freq * Math.pow(2.5, freqmod)));
					}
				}else if(freqmod > 0){
					same = 0;
					freqmod = 0;
					clearInterval(loop);
					loop = setInterval(looping, freq);
				}
				
				tabs[tab]["content"] += html;
				
				$("#chat-text").html(tabs[tab]["content"]);//refresh chat
				
				console.log("Updated chat: " + Date().match(/\d\d\:\d\d\:\d\d/)[0]);
				
			});	

		}
	
		function looping(){
			
			getData(tabs[currentTab]["id"], currentTab);
			
		}//every 2 seconds
		
		function sendMessage(){
			
			var text = $("#chatInput").val();
			var sendTo = tabs[currentTab]["id"];
			var tgroup = "-1";
			
			if(sendTo.charAt(0) == 'g'){
				tgroup = sendTo.substring(1);
				sendTo = "-1";
			}
			
			$.post(url, {person: sendTo, message: text, group: tgroup}, function(data) {
				console.log("Message sent: " + sendTo + ":" + text + ":" + tgroup);
				console.log(data);
			});	

			$("#chatInput").val("");
			
		}
		
		function changeTab(tab){
			
			//reset delay on change tab
			same = 0;
			freqmod = 0;
			clearInterval(loop);
			loop = setInterval(looping, freq);
			
			var lasttab = currentTab;
			currentTab = tab;
			
			looping();
			
			var objDiv = document.getElementById("chat-text");
			objDiv.scrollTop = objDiv.scrollHeight;
			
			var oldlist = $("#ctbs").html();
			
			//revert the last tab to normal colours	
			oldlist = oldlist.replace("<li class=\"selected\"><a onclick=\"changeTab('"+lasttab+"');\">","<li><a onclick=\"changeTab('"+lasttab+"');\">");
			//set current tab to selected
			oldlist = oldlist.replace("<li><a onclick=\"changeTab('"+tab+"');\">","<li class=\"selected\"><a onclick=\"changeTab('"+tab+"');\">");			
			
			$("#ctbs").html(oldlist);
			$("#chat-text").html(tabs[currentTab]["content"]);

		}
		
		function chatInitiate(){
			
			var html = "";
			
			for (var i=0; i < tabs.length; i++) {
				html += "<li><a onclick=\"changeTab('" + i + "');\">" + tabs[i]["name"] + "</a></li>";
			}
			
			$("#ctbs").html(html);
			
			console.log("Chat tabs updated.");
			
		}
		
	</script>
	
</HEAD>
<BODY>
	<aside><!-- sidebar -->
	
		<div id="infobox">			
			<!--<img src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/qut-logo-200.jpg" id="logoimg">-->
			<img src="http://<?php echo "$_SERVER[HTTP_HOST]";?>/teamwork-logo-800px.png" id="teamworklogo">
			
			<div class='clear'></div>

			<h3 id="sidebartitle">Student View</h3>
			<h4>Current Group: "<?php echo $_SESSION['gname']; ?>"</h4>
		</div>
		
		<div id="chatarea">
		
			<div id="chat-tabs">
				<ul>
					<span id="ctbs">
						<!-- Chat tabs get loaded into here. -->
					</span>
				</ul>
			</div>
			
			<div id="chat-text"></div>
			
			<div id="chatControls">
				<input id="chatInput" type="text" placeholder="Type a message here...">
				<input id="chatSend" type="button" class="button-none button1" value="Send" onclick="sendMessage();">
			</div>
		
		</div>
	</aside>
	
	<nav>
		<ul>
			<li <?php if($_SERVER['PHP_SELF'] == "/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>">Group Select</a></li>
		<?php if(inGroup()){?>
			<li <?php if($_SERVER['PHP_SELF'] == "/group/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/group">Group Overview</a></li><?php //echo "$_SESSION[gname]"?>
			<li <?php if($_SERVER['PHP_SELF'] == "/files/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/files">Files</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == "/milestones/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/milestones">Milestones</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == "/projects/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/projects">Projects</a></li>
		<?php }else{ ?>
			<li <?php if($_SERVER['PHP_SELF'] == "/group/find/index.php") echo "class='selected'";?>><a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/group/find">Group Finder</a></li>
		<?php }
		
		$result = multiSQL("Select what from D_Perms where UserId = '$_SESSION[person]'");
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){ 
			echo "<li ";
			if($_SERVER['PHP_SELF'] == "/admin/index.php" && $_GET["sub"]==$row["what"]) echo "class='selected'";
			echo "><a href='http://$_SERVER[HTTP_HOST]/admin?sub=$row[what]'>Admin($row[what])</a></li>";
		}
		?>
		</ul>
		<form id='logoutBtn' class='_pannel' method='POST'>
		<a href="http://<?php echo "$_SERVER[HTTP_HOST]";?>/user" class='button <?php if($_SERVER['PHP_SELF'] == "/user/index.php" || $_SERVER['PHP_SELF'] == "/user/edit/index.php"){echo "selected'";}else{echo "button1'";}?>><?php echo "$_SESSION[name]";?></a>
		<input name='logout' hidden>
		<input class='button button1' id='logoutbutton' type='submit' value='Logout'>
		</form>
	</nav>
	
	<section>	

<!--page content start -->

<?php function myEnd(){ ?>

<!--page content end -->
			<footer>
				For QUT 2015.<br><br><br>
				Joshua Henley | Damon Jones | Emma Jackson | Will Jakobs | Declan Winter
			</footer>
		</section>
	</BODY>
	</HTML>
<?php 
}
register_shutdown_function('myEnd');
?>