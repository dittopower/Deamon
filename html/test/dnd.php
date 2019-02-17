<head>
<script src="http://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
<style>
body{
	margin:0;
	overflow:hidden;
}
.sections{
	display:inline-block;
    vertical-align: bottom;
	overflow:hidden;
}
#log{
	width:25%;
	height:100%;
	overflow-y:auto;
}
#stat{
	width:25%;
	height:100%;
}
#main{
	width:calc(50% - 2px);
	height:100%;
	border:1px black solid;
    background-color: beige;
}
.msg{
	margin:10px;
	padding:5px;
	border-top: 1px black solid;
    overflow-wrap: break-word;
}
#stat div{
	margin:3px;
}
.abilities{
	width:100%;
	background-color:lightgrey;
	text-align:center;
}
.skills{
	width:100%;
	font-size:0.7em;
	background-color: beige;
}
.ui-tabs-nav {
    padding: 0;
    padding-bottom: 10px;
    margin: 0;
    margin-top: 8px;
}
.ui-corner-top {
    display: inline-block;
}
.ui-corner-top a{
    margin: 2px;
    padding: 5px;
    padding-left: 20px;
    padding-right: 20px;
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 5px;
    border: black 1px solid;
    background-color: #f5f5c7;
}
.ui-corner-top:hover{
    background-color: #ffff91;
}
.ui-corner-top *{
	text-decoration: none;
	color:black;
}
</style>
</head>
<body>
<div id='log' class='sections'></div><div id='main' class='sections'></div><div id='stat' class='sections'></div>

<script>
function Ability(score,bonus,circumstance){
	if(circumstance == undefined){
		circumstance = "";
	}
	return [score,bonus,circumstance];
}

function Skill(trained,clas,ability,rank,bonus,circumstance){
	if(circumstance == undefined){
		circumstance = "";
	}
	return [trained,clas,ability,rank,bonus,circumstance];
}


Abilities = ["STR","DEX","CON","INT","WIS","CHA"];
Skills = ["Acrobatics", "Appraise", "Bluff", "Climb", "Craft", "Diplomacy", "Disable Device", "Disguise", "Escape Artist", "Fly", "Handle Animal", "Heal", "Intimidate", "Knowledge Arcana", "Knowledge Dungeoneering", "Knowledge Engineering", "Knowledge Geography", "Knowledge History", "Knowledge Local", "Knowledge Nature", "Knowledge Nobility", "Knowledge Planes", "Knowledge Religion", "Linguistics", "Perception", "Perform", "Profession", "Ride", "Sense Motive", "Sleight of Hand", "Spellcraft", "Stealth", "Survival", "Swim", "Use Magic Device"];
function Stats(str,dex,con,intt,wis,cha){
this.ability = [];
	this.ability["STR"] = new Ability(str,0);
	this.ability["DEX"] = new Ability(dex,0);
	this.ability["CON"] = new Ability(con,0);
	this.ability["INT"] = new Ability(intt,0);
	this.ability["WIS"] = new Ability(wis,0);
	this.ability["CHA"] = new Ability(cha,0);
this.skill = [];
	this.skill["Acrobatics"] =				new Skill(false,false,"DEX",0,0);
	this.skill["Appraise"] = 				new Skill(false,false,"INT",0,0);
	this.skill["Bluff"] = 					new Skill(false,false,"CHA",0,0);
	this.skill["Climb"] = 					new Skill(false,false,"STR",0,0);
	this.skill["Craft"] =					new Skill(false,false,"INT",0,0);
	this.skill["Diplomacy"] = 				new Skill(false,false,"CHA",0,0);
	this.skill["Disable Device"] = 			new Skill( true,false,"DEX",0,0);
	this.skill["Disguise"] = 				new Skill(false,false,"CHA",0,0);
	this.skill["Escape Artist"] = 			new Skill(false,false,"DEX",0,0);
	this.skill["Fly"] = 					new Skill(false,false,"DEX",0,0);
	this.skill["Handle Animal"] = 			new Skill( true,false,"CHA",0,0);
	this.skill["Heal"] = 					new Skill(false,false,"WIS",0,0);
	this.skill["Intimidate"] = 				new Skill(false,false,"CHA",0,0);
	this.skill["Knowledge Arcana"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Dungeoneering"] = new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Engineering"] = 	new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Geography"] = 	new Skill( true,false,"INT",0,0);
	this.skill["Knowledge History"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Local"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Nature"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Nobility"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Planes"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Knowledge Religion"] = 		new Skill( true,false,"INT",0,0);
	this.skill["Linguistics"] = 			new Skill( true,false,"INT",0,0);
	this.skill["Perception"] = 				new Skill(false,false,"WIS",0,0);
	this.skill["Perform"] = 				new Skill(false,false,"CHA",0,0);
	this.skill["Profession"] = 				new Skill( true,false,"WIS",0,0);
	this.skill["Ride"] = 					new Skill(false,false,"DEX",0,0);
	this.skill["Sense Motive"] = 			new Skill(false,false,"WIS",0,0);
	this.skill["Sleight of Hand"] = 		new Skill( true,false,"DEX",0,0);
	this.skill["Spellcraft"] = 				new Skill( true,false,"INT",0,0);
	this.skill["Stealth"] = 				new Skill(false,false,"DEX",0,0);
	this.skill["Survival"] = 				new Skill(false,false,"WIS",0,0);
	this.skill["Swim"] = 					new Skill(false,false,"STR",0,0);
	this.skill["Use Magic Device"] = 		new Skill( true,false,"CHA",0,0);
}

function Character (name,player,level,race,clas,al,str,dex,con,intt,wis,cha,deity,HL,g,h,w,hair,eye){
	this.Name = name;
	this.Player = player;
	this.Level = level;
	this.Race = race;
	this.Class = clas
	this.Alignment = al;
	this.Deity = deity;
	this.Homeland = HL;
	this.Gender = g;
	//need age
	this.Height = h;
	this.Weight = w;
	this.Hair = hair;
	this.Eye = eye;
	this.stats = [];
	this.stats.push( ['Base',new Stats(str,dex,con,intt,wis,cha),'perm'] );
	
	this.ability_score = function (what){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].ability[what][0];
		}
		//need circumstance bonus
		return result;
	}
	this.ability_mod = function (what){
		var result = 0;
		var resultb = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].ability[what][0];
			resultb += this.stats[ia][1].ability[what][1];
		}
		//need circumstance bonus
		return Math.floor((result-10)/2)+resultb;
	}
	this.skill_score = function (what){
		var result = 0;
		var resultb = 0;
		var trained = this.stats[0][1].skill[what][0];
		var clas = this.stats[0][1].skill[what][1];
		for(ia = 0; ia < this.stats.length; ia++){
			trained = trained || this.stats[ia][1].skill[what][0];
			clas = clas || this.stats[ia][1].skill[what][1];
			resultb += this.stats[ia][1].skill[what][3];
			result += this.stats[ia][1].skill[what][4];
		}
		result += this.ability_mod(this.stats[0][1].skill[what][2]);
		if(clas || !trained){
			result += resultb;
		}
		if(!clas && trained){
			result = NaN;
		}
		//need circumstance bonus
		return result;
	}
}


function roll(num){
	return Math.floor(Math.random()*num+1);
}

function roll_abl(stat){
	var result = 0;
	var text = '';
	switch(stat){
		case "STR":
			result = characters[current].ability_mod('STR');
			text = 'Strength';
			break;
		case "DEX":
			result = characters[current].ability_mod('DEX');
			text = 'Dexterity';
			break;
		case "CON":
			result = characters[current].ability_mod('CON');
			text = 'Consititution';
			break;
		case "INT":
			result = characters[current].ability_mod('INT');
			text = 'Intelligence';
			break;
		case "WIS":
			result = characters[current].ability_mod('WIS');
			text = 'Wisdom';
			break;
		case "CHA":
			result = characters[current].ability_mod('CHA');
			text = 'Charisma';
			break;
		default:
			text = 'None';
	}
	result += roll(20);
	chat_msg(text+": " +result);
}
function roll_skl(stat){
	var result = 0;
	characters[current].skill_score(stat);
	result += roll(20);
	chat_msg(stat+": " +result);
}
</script>
<script>
statblock = $("#stat");
logblock = $("#log");
mainblock = $("#main");

characters = [];
current = "deamon";
characters[current] = new Character(current,'Damon',3,'elf','sorceror','N',14,15,10,9,17,11,"None","Aus",'Male',5.7,90,'blond','green');
characters[current].stats.push(['Elf',new Stats(0,2,0,0,0,-1),'perm']);
buff = new Stats(0,0,0,0,0,0);
buff.skill['Climb'][0] = true;
buff.skill['Climb'][3] = 3;
buff.skill['Ride'][0] = false;
buff.skill['Ride'][3] = 3;
buff.skill['Swim'][0] = true;
buff.skill['Swim'][1] = true;
buff.skill['Swim'][3] = 3;
characters[current].stats.push(['bulls strength',buff,'5r']);


$(function() {
    $( "#controls" ).tabs();
  });
var tabs = $("<div id='controls'>");
tabs.append("<ul><li><a href='#controls-1'>Main</a></li><li><a href='#controls-2'>Rolls</a></li></ul><hr>");
var tabs_rolls = $("<div id='controls-2'>");
tabs_rolls.append("<h2>Abilities</h2>");
	for(ib = 0; ib < Abilities.length;ib++){
		tabs_rolls.append("<button onclick='roll_abl(\""+Abilities[ib]+"\")'>"+Abilities[ib]+"</button>");
	}
tabs_rolls.append("<hr><h2>Skills</h2>");
	for(ib = 0; ib < Skills.length;ib++){
		tabs_rolls.append("<button onclick='roll_skl(\""+Skills[ib]+"\")'>"+Skills[ib]+"</button>");
	}
var tabs_normal = $("<div id='controls-1'>stuff</div>");
tabs.append(tabs_normal);
tabs.append(tabs_rolls);
mainblock.append(tabs);

function displayStats(){
	statblock.empty();
	statblock.append("<div class='name'>Name: "+ characters[current].Name +"</div>");
	statblock.append("<div class='alignment'>Alignment: "+ characters[current].Alignment +"</div>");
	statblock.append("<div class='player'>Player: "+ characters[current].Player +"</div>");
	statblock.append("<div class='race'>Race: "+ characters[current].Race +"</div>");
	statblock.append("<div class='class'>Class: "+ characters[current].Class +"</div>");
	statblock.append("<div class='level'>Level: "+ characters[current].Level +"</div>");
	statblock.append("<div class='deity'>Deity: "+ characters[current].Deity +"</div>");
	statblock.append("<div class='homeland'>Homeland: "+ characters[current].Homeland +"</div>");
	statblock.append("<div class='gender'>Gender: "+ characters[current].Gender +"</div>");
	statblock.append("<div class='height'>Height: "+ characters[current].Height +"</div>");
	statblock.append("<div class='weight'>Weight: "+ characters[current].Weight +"</div>");
	statblock.append("<div class='hair'>Hair: "+ characters[current].Hair +"</div>");
	statblock.append("<div class='eye'>Eye: "+ characters[current].Eye +"</div>");
	
	var disAbility = $("<table class='abilities'><tr><th>Ability</th><th>Score</th><th>Mod</th></tr></table>");
	for(ib = 0; ib < Abilities.length;ib++){
		disAbilityRow = $("<tr>");
		disAbilityRow.append("<td>"+Abilities[ib]+"</td>");
		disAbilityRow.append("<td>"+characters[current].ability_score(Abilities[ib])+"</td>");
		disAbilityRow.append("<td>"+characters[current].ability_mod(Abilities[ib])+"</td>");
		disAbility.append(disAbilityRow);
	}
	statblock.append(disAbility);
	
	var disSkill = $("<table class='skills'><tr><th>*</th><th>Skills</th><th>Total</th><th>Mod</th><th>Ranks</th><th>Misc</th></tr></table>");
	for(ib = 0; ib < Skills.length;ib++){
		disSkillRow = $("<tr>");
		var trained = false;
		var clas = false;
		var ranks = 0;
		var bonus = 0;
		for(ic = 0; ic < characters[current].stats.length; ic++){
			trained = trained || characters[current].stats[ic][1].skill[Skills[ib]][0];
			clas = clas || characters[current].stats[ic][1].skill[Skills[ib]][1];
			ranks = characters[current].stats[ic][1].skill[Skills[ib]][3];
			bonus = characters[current].stats[ic][1].skill[Skills[ib]][4];
		}
		if(clas){
			disSkillRow.append("<td>X</td>");
		}else{
			disSkillRow.append("<td></td>");
		}
		disSkillRow.append("<td>"+Skills[ib]+"</td>");
		disSkillRow.append("<td>"+characters[current].skill_score(Skills[ib])+"</td>");
		disSkillRow.append("<td>"+characters[current].stats[0][1].skill[Skills[ib]][2]+": "+characters[current].ability_mod(characters[current].stats[0][1].skill[Skills[ib]][2])+"</td>");
		disSkillRow.append("<td>"+ranks+"</td>");
		disSkillRow.append("<td>"+bonus+"</td>");
		if(!trained || clas){
			disSkill.append(disSkillRow);
		}
	}
	statblock.append(disSkill);
}

function chat_msg(msg){
	logblock.append("<div class='msg'>"+msg+"</div>");
	logblock.scrollTop(logblock[0].scrollHeight);
}

tick = setInterval(function(){displayStats();}, 1000);
</script>
</body>