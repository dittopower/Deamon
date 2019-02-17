<?php
	require_once "/var/www/html/lib.php";
	lib_code();
	lib_perms();
	lib_files();
	lib_database();

	debug("$home/games/games.json");
	$games = json_decode(load("$home/games/games.json"),true);
	debug($games);
	debug($_POST);

	if(isset($games[$_POST['game']])){
		debug("game");

		enforce_user();
		if(isset($_POST['fetch'])){
			debug("fetch");
			$score = max(0,singleSQL("Select score from Game_Score where Game = '$_POST[game]' and User = $_SESSION[person]"));
			debug($score);
			echo "{\"score\":$score}";


		}else if(is_numeric($_POST['update'])){
			debug("update");
			echo runSQL("INSERT INTO Game_Score (`User`, `Game`, `score`) VALUES('$_SESSION[person]', '$_POST[game]', '$_POST[update]') ON DUPLICATE KEY UPDATE score = GREATEST(score, VALUES(score));");


		}else if(isset($_POST['scoreboard'])){
			debug("scoreboard");
			$sql = "SELECT a.Username,`score` FROM `Game_Score` s join D_Accounts a on s.User = a.UserId where Game = '$_POST[game]'";
			$scoreboard = arraySQL($sql);
			echo json_encode($scoreboard,true);
		}

}else{
?>

function Score (name){
	this.name = name;
	this.value = 0;
	this.alter = function (data){this.value += data;}
	this.set = function(data){this.value = data;}
	this.valueOf = function(){return this.value;}
	this.toString = function(){return this.value;}
	this.load = function(){
		if(typeof(Storage) !== "undefined") {
			if(localStorage.getItem(this.name+"_score") != null){
				dat = JSON.parse(localStorage.getItem(this.name+"_score"));
				if(dat !== null && dat !== undefined){
					if(this.value < dat){
						this.value = dat;
					}
				}
			}
		} else {
			console.log("Local Storage not avalible.....");
		}
		var base = this;
		$.post("//deamon.info/api/games/score/",{game:name,fetch:3456},function(data){
			data = JSON.parse(data)['score'];
			if(base.value < data){
				base.value = data;
			}
		});
	}
	this.save = function(){
		if(typeof(Storage) !== "undefined") {
			localStorage.setItem(this.name+"_score", JSON.stringify(this.value));
		} else {
			console.log("Local Storage not avalible.....");
		}
		$.post("//deamon.info/api/games/score/",{game:name,update:this.value},function(data){
			console.log(data);
		});
	}
}

//Deamon score API|Script

<?php
}
?>