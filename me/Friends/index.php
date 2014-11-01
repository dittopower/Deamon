<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	for($i = 1;$i < $layers;$i++){
		$home .= "../";
	}
	include $home."page.php";
	if(isUser()){
?>
<div class='page'>

<div id=myfriends>
<h1>My Friends</h1>
<table class=FrList>
		<?php
		$sql = "SELECT username, first_name, img, com_id FROM `user_friends` a join Users b on a.user_b = b.username where user_a = '$_SESSION[User]' and block_a = 0 union all SELECT username, first_name, img, com_id FROM `user_friends` a join Users b on a.user_a = b.username where user_b = '$_SESSION[User]' and block_b = 0;";
		$results = multiSQL($sql);
		while($rows = mysqli_fetch_array($results,MYSQLI_BOTH)){
				echo "<tr id='$rows[username]' class=FrCur onclick=\"unfriend('$rows[username]','')\"><td><img class='ProIco' width='100px' src='/res/users/$rows[img]'></td><td><h2>$rows[username]</h2></td><td><h3>$rows[first_name]</h3></td><td><button onclick=\"unfriend('$rows[username]','')\">+</button></td></tr>";
		}
		?>
</table>
</div>


<div id=notyetfriends>
		<?php
		$sql = "SELECT username, first_name, img, com_id FROM `user_friends` a join Users b on a.user_b = b.username where user_a = '$_SESSION[User]' and block_a = 1 and block_b = 0 union all SELECT username, first_name, img, com_id FROM `user_friends` a join Users b on a.user_a = b.username where user_b = '$_SESSION[User]' and block_b = 1 and block_a = 0;";
		$results = multiSQL($sql);
		if (mysqli_num_rows($results) != 0){
			echo "<h1>Friend Requests</h1><table class=FrOpt>";
			while($rows = mysqli_fetch_array($results,MYSQLI_BOTH)){
					echo "<tr id='rr$rows[username]' class=FrPend onclick=\"addfriend('$rows[username]','rr')\"><td><img class='ProIco' width='100px' src='/res/users/$rows[img]'></td><td><h2>$rows[username]</h2></td><td><h3>$rows[first_name]</h3></td><td><button onclick=\"addfriend('$rows[username]','rr')\">+</button></td></tr>";
			}
			echo "</table>";
		}
		?>
</div>


<!-- find Friend -->
<div id=friendfinder>
<h1>Find Friends</h1>
<script>
function getfriends(){
	who = document.getElementById("target").value;
	jQuery.post("./_FF.php", {Name: who, please: "find"},function(data){
		here = document.getElementById("FrOpt");
		here.innerHTML = "";
		if (data.length > 5){
		a=data.split(";");
		a.pop();
		for(b of a){
			c = b.split(":");
			d = "<tr id='ur"+c[0]+"' class=FrPend onclick=\"addfriend('"+c[0]+"','ur')\"><td><img class='ProIco' width='50px' src='/res/users/"+c[2]+"'></td><td>"+c[0]+"</td><td>"+c[1]+"</td></tr>";
			here.innerHTML += d;
		}}else{
			here.innerHTML = "<tr><td>No Results</td></tr>";
		}});
}

function addfriend(who,pre){
	jQuery.post("./_FF.php", {Name: who, please: "add"},function(data){
		here = document.getElementById(pre+who);
		here.className = "FrCur";
		ere = here.outerHTML;
		here.outerHTML = ere.replace("addfriend","unfriend");
		console.log(data);
		});
}

function unfriend(who,pre){
	jQuery.post("./_FF.php", {Name: who, please: "un"},function(data){
		here = document.getElementById(pre+who);
		here.className = "FrBye";
		ere = here.outerHTML;
		here.outerHTML = ere.replace("unfriend","addfriend");
		console.log(data);
		});
}
</script>
<form method=POST action='./' onsubmit="getfriends(); return false;" name=FF>
	<input type=text id=target maxlength=220 placeholder="Nickname, Name">
	<input type='button' value=Find onclick="getfriends()">
</form>
<table id=FrOpt class=FrOpt></table>
</div>




<?php }?>
</div>