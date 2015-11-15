<?php //Load Template
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	page();
	
	
	function gamemodes($var){
		echo "<ul>";
		switch($var){
			case 0:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				break;
			case 1:
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				break;
			case 2:
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				break;
			case 3:
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 4:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				break;
			case 5:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				break;
			case 6:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 7:
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				break;
			case 8:
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 9:
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 10:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				break;
			case 11:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 12:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 13:
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			case 14:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				echo "<li><a href='?mode=multi'>Multiplayer</a></li>";
				echo "<li><a href='?mode=coop'>Co-Operative</a></li>";
				echo "<li><a href='?mode=local'>Local Co-Operative</a></li>";
				break;
			default:
				echo "<li><a href='?mode=single'>Single Player</a></li>";
				break;
		}
		echo "</ul>";
	}
?>

<style>
.game_review{
	display:inline-block;
	margin-bottom: 0.6em;
	margin-left:0.5em;
	margin-right:0.5em;
	padding: 0.5em;
	vertical-align: top;
	background:rgba(0,0,0,0.05);
	border: dotted black 1px;
	min-width:100px;
}
.game_review h3{
	margin-top:0.5em;
}

#imagebar{
	/*white-space: nowrap;
    overflow-y: auto;*/
    width: 25%;
    height: 90vh;
    display: inline-block;
    overflow-y: auto;
    overflow-x: hidden;
}
#imagebar span{
	display:inline-block;
	/*width:300px;
	height:150px;*/
	width: 100%;
    height: 20%;
    margin: 5px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

#textbox {
    display: inline-block;
    width: 74%;
    margin-left: 1%;
    vertical-align: top;
    text-align: center;
}
#g_name{
	background:none;
	display:block;
	font-size:2.5em;
	border:none;
	margin-left:0;
}
#g_name h1{
	margin:0;
	text-align:center;
}
#g_description {
    min-width: calc(100% - 2em);
}
#g_opinion {
    min-width: calc(100% - 2em);
}
#g_Reviewer {
    background: rgba(255,255,0,0.1);
    font-weight: bolder;
    margin-bottom: 0;
    border-bottom: none;
	float: left;
}
#g_Reviewer h3{
	margin:0;
}
#g_Reviewer h3 {
    display: inline-block;
    margin-right: 1em;
}

.content ul{
	padding-left:30px;
    list-style-type: square;
	margin:0;
}

#textbox * {
    text-align: justify;
    font-family: monospace;
}
table{
	width:100%;
	background: rgba(0,0,0,0.05);
	padding: 1em;
}

tr:nth-child(even) {
	background: rgba(0,0,0,0.1);
}
</style>
<?php
	if(is_numeric($_GET['id'])){
		
		echo "<div id=imagebar>";
		$mytemp = dir_list($home."games/images/$_GET[id]");
		foreach($mytemp as $var){
			echo "<span style='background-image:url(//$_SERVER[HTTP_HOST]/games/images/$_GET[id]/$var);' onclick='imageview(this)'></span>";
		}
		echo "</div><div id=textbox>";
		
		$sql = "SELECT g.name, g.series, g.`release date`, r.version, g.`publisher`, g.`developer`, g.`genre`, g.`modes`,";
		$sql .= " g.`steam`, g.`origin`, g.`gog`, r.`difficulty`,";
		$sql .= " r.`performance rating`, r.`internet rating`, r.`responsiveness rating`, r.`graphics style`, r.`graphics rating`,";
		$sql .= " r.`gameplay rating`, r.`overall rating`, g.`description`, a.Username as Reviewer, r.`opinion`";
		$sql .= " FROM `D_Games` g join D_Games_Review r on g.id = r.game join D_Accounts a on r.user = a.UserId where g.id = '$_GET[id]'";
		$result = multiSQL($sql);

		$row = mysqli_fetch_array($result,MYSQL_ASSOC);
		foreach($row as $key=>$value){
			if($value != NULL && $value >= 0){
				echo "<div id='g_".str_replace(" ","_",$key)."' class='game_review'>";
				switch($key){
					case "name":
						echo "<h1>".ucwords($value)."</h1>";
						break;
					case "steam":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><ul><li><a href='https://store.steampowered.com/app/$value' target='_blank'>Website</a></li>";
						echo "<li><a href='steam://store/$value'>Client</a></li></ul></span>"; 
						break;
					case "origin":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><a href='https://www.origin.com/en-au/store/buy/$value' target='_blank'>Website</a></span><br>";
						break;
					case "gog":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><a href='https://www.gog.com/game/$value' target='_blank'>Website</a></span><br>";
						break;
					case "developer":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><a href='?developer=$value'>$value</a></span><br>";
						break;
					case "publisher":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><a href='?publisher=$value'>$value</a></span><br>";
						break;
					case "series":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><a href='?series=$value'>$value</a></span><br>";
						break;
					case "Reviewer":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'>$value</span><br>";
						break;
					case "opinion":
						echo "<span class='content'>$value</span><br>";
						break;
					case "genre":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><ul>";
						$mytemp = explode(", ",$value);
						//var_dump($mytemp);
						foreach($mytemp as $var){
							echo "<li><a href='?genre=$var'>$var</a></li>";
						}
						echo "</ul></span>";
						break;
					case "graphics style":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'><ul>";
						$mytemp = explode(", ",$value);
						//var_dump($mytemp);
						foreach($mytemp as $var){
							echo "<li><a href='?graphics_style=$var'>$var</a></li>";
						}
						echo "</ul></span>";
						break;
					case "modes":
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'>";
						gamemodes($value);
						echo "</span>";
						break;
					default:
						echo "<h3>".ucwords($key)."</h3>";
						echo "<span class='content'>".preg_replace("/\n\r|\r\n|\r|\n/","<br>",$value)."</span>";
						break;
				}
				echo "</div>";
			}
		}
		echo "</div>";
	}else{
		echo "<h1>Gamebase</h1>";
		echo "<table>";
		$bool = 1;
		$sql = "SELECT * FROM `D_Games` ";
		if(isset($_GET['series'])){
			if($bool){
				$sql .= "where ";
			}else{
				$sql .= "and ";
			}
			$sql .= "series = '".escapeSQL($_GET['series']) . "' ";
		}
		if(isset($_GET['developer'])){
			if($bool){
				$sql .= "where ";
			}else{
				$sql .= "and ";
			}
			$sql .= "developer = '".escapeSQL($_GET['developer']) . "' ";
		}
		if(isset($_GET['publisher'])){
			if($bool){
				$sql .= "where ";
			}else{
				$sql .= "and ";
			}
			$sql .= "publisher = '".escapeSQL($_GET['publisher']) . "' ";
		}
		if(isset($_GET['mode'])){
			if($bool){
				$sql .= "where ";
			}else{
				$sql .= "and ";
			}
			switch($_GET['mode']){
				case "single":
					$sql .= "(modes = 0 or modes = 4 or modes = 5 or modes = 6 or modes = 10 or modes = 11 or modes = 12)";
					break;
				case "coop":
					$sql .= "(modes = 1 or modes = 4 or modes = 7 or modes = 8 or modes = 10 or modes = 11 or modes = 13)";
					break;
				case "multi":
					$sql .= "(modes = 2 or modes = 5 or modes = 7 or modes = 9 or modes = 10 or modes = 12 or modes = 13)";
					break;
				case "local":
					$sql .= "(modes = 3 or modes = 6 or modes = 8 or modes = 9 or modes = 11 or modes = 12 or modes = 13)";
					break;
				default:
					$sql .= "modes = 666";
					break;
			}
		}
		if(isset($_GET['genre'])){
			if($bool){
				$sql .= "where ";
			}else{
				$sql .= "and ";
			}
			$sql .= "genre like '%".escapeSQL($_GET['genre']) . "%' ";
		}
		//var_dump($sql);
		$result = multiSQL($sql);
		while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
			echo "<tr>";
			echo "<td class=content><a href='?id=$row[id]&$row[name]'>$row[name]</a></td>";
			echo "<td class=content><a href='?series=$row[series]'>$row[series]</a></td>";
			echo "<td class=content><a href='?publisher=$row[publisher]'>$row[publisher]</a></td>";
			echo "<td class=content><a href='?developer=$row[developer]'>$row[developer]</td>";
			
			echo "<td class=content><ul>";
			$mytemp = explode(", ",$row['genre']);
			//var_dump($mytemp);
			foreach($mytemp as $var){
				echo "<li><a href='?genre=$var'>$var</a></li>";
			}
			echo "</ul></td>";
			
			echo "<td class=content>";
			gamemodes($row['modes']);
			echo "</td>";
			
			echo "</tr>";
		}
		echo "</table>";
	}
?>
<script>
	function rating_bars(){
	divs = document.getElementsByTagName('div');
	for(i=0;i<divs.length;i++){
		if(/[A-Za-z]*_?rating/.test(divs[i].id)){
			//divs[i].childNodes[1].style.display = 'inline-block';
			//divs[i].childNodes[1].style.width = '100px';
			//divs[i].childNodes[1].style.height = '20px';
			divs[i].percent = parseInt(divs[i].childNodes[1].innerHTML);
			divs[i].style.background = 'linear-gradient(90deg, rgba(0,150,0,0.8) '+divs[i].percent+'%, rgba(175,0,0,0.7) 0%)';
			//divs[i].childNodes[1].style.color = 'rgba(0,0,0,0)';
			divs[i].style.textAlign = 'center';
			divs[i].childNodes[0].style.textAlign = 'center';
			divs[i].childNodes[1].innerHTML += "%";
			divs[i].style.minWidth = "200px";
		}
	}}
window.onload = rating_bars;

	function imageview(element){
		if(element.style.width == "100%"){
			element.style.position = "";
			element.style.width = "";
			element.style.height = "";
			element.style.zIndex = "";
		}else{
			element.style.position = "fixed";
			element.style.width = "100%";
			element.style.height = "100%";
			element.style.left = "0";
			element.style.top = "0";
			element.style.zIndex = "10000";
		}
	}
</script>