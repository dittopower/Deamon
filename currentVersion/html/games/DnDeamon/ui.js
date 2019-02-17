var menublock = $("<div id='menu' class='sections'>");
var logblock = $("<div id='log' class='sections'>");
var textblock = $("<div id='rolls'>");
var mainblock = $("<div id='main' class='sections'>");

var statblock = $("<div id='stat' class='mstats'>");
var tabs_rolls = $("<div id='controls-rolls' class='stat mrolls'>");
var tabs_main = $("<div id='controls-main' class='stat mmain'>");
var tabs_chars = $("<div id='chars' class='stat mchars'>");
var tabs_spell = $("<div id='spell' class='stat mspell'>");
var tabs_settings = $("<div id='settings' class='msetting'>");
var tabs_circumstance = $("<div id='cirs' class='mcir'>");

var extras = $("<div id='converter'>");
var extra_meters = $("<input class='meas' type=number value=0>");
var extra_foot = $("<input class='meas' type=number value=0>");
var extra_unita = $("<select class='unit' id='unita'>");
var extra_unitb = $("<select class='unit' id='unitb'>");
var extra_nd = $("<input class='diceroll' id='num_d' type=number value=1>");
var extra_ds = $("<input class='diceroll' id='num_sides' type=number value=6>");
var extra_dmod = $("<input class='diceroll' id='dice_mod' type=number value=0>");
var extra_dsum = $("<input class='dicerollsum' id='dice_mod' type=checkbox checked>");

var chars_races = $("<table id=races>");
var cirs = $("<div id=cirs>");
var disChars = $("<table id=charsel>");
var audio;

characters = new Array();
current = "Default";
pref_unit = "ft";
pref_wt = "lbs";
UI = [];
characters[current] = new Character(current,'D_player','Human','Fighter','N',10,10,10,10,10,10,"None","Australia",'Male',5.7,90,Sizes[4],'blond','green');

function mytabs(){
	tabs_circumstance.appendTo(document.body);
	menublock.appendTo(document.body);
	mainblock.appendTo(document.body);
	logblock.appendTo(document.body);
	
//Menu
	menublock.append("<h1>Menu</h1>");
	menublock.append("<h4 class='mchars' onclick=\"reveal('chars')\">Characters</h4>");
	menublock.append("<h4 class='mmain' onclick=\"reveal('main')\">Character Info</h4>");
	menublock.append("<h4 class='mstats' onclick=\"reveal('stats')\">Abilities & Skills</h4>");
	menublock.append("<h4 class='mrolls' onclick=\"reveal('rolls')\">Combat & Defence</h4>");
	menublock.append("<h4 class='mspell' onclick=\"reveal('spell')\">Spells & Abilities</h4>");
	//menublock.append("<h4 class='mcir' onclick=\"reveal('cir')\">Circumstances</h4>");
	
	menublock.append("<h4 class='msetting' onclick=\"reveal('setting')\">Settings</h4>");
	
	//disChars[0].onchange = function(eve){current=eve.target.value; displayStats();}
	
//Main Tab
	tabs_main.hide();
	mainblock.append(tabs_main);
	
//Rolls Tab - Combat & Defence Tab
	UI['atk_bonus'] = characters[current].BABmax();
	tabs_rolls.hide();
	mainblock.append(tabs_rolls);
	
//Spells and Abilities Tab
	tabs_spell.hide();
	mainblock.append(tabs_spell);
	
//Characters Tab
	tabs_chars.hide();
	tabs_chars.append("<h1>Characters</h1>");
	tabs_chars.append("<h2>Select Character</h2>");
	tabs_chars.append(disChars);
	tabs_chars.append("<h2>Create a Character (CS)</h2>");
	tabs_chars.append(chars_races);
	race_list();
	tabs_chars.append("<hr><h2>Level Up(CS)</h2>");
	mainblock.append(tabs_chars);

//Stats Tab
	statblock.hide();
	mainblock.append(statblock);
	
//Settings
	tabs_settings.hide();
	tabs_settings.append("<h1>Settings</h1>");
	
	var div = $("<div class='statdiv'>");
	div.append("<label for=disUnit>Distance Unit</label> ");
	var temp = $("<select id=disUnit>");
	temp.append("<option value='ft' selected>Foot</option>");
	temp.append("<option value='in' select>Inch</option>");
	temp.append("<option value='m' select>Metres</option>");
	temp.append("<option value='cm' select>Centimetres</option>");
	div.append(temp);
	tabs_settings.append(div);
	temp[0].onchange = function(eve){pref_unit=eve.target.value; displayStats();}
	
	var div = $("<div class='statdiv'>");
	div.append("<label for=wtUnit>Weight Unit</label> ");
	var temp = $("<select id=wtUnit>");
	temp.append("<option value='lbs' selected>Pounds</option>");
	temp.append("<option value='kg' select>Kilograms</option>");
	temp.append("<option value='g' select>Grams</option>");
	div.append(temp);
	tabs_settings.append(div);
	temp[0].onchange = function(eve){pref_wt=eve.target.value; displayStats();}
	
	var div = $("<div class='statdiv'>");
	div.append("Distance Converter: ");
	div.append(extra_meters);
	div.append(extra_unita);
	div.append(" to ");
	div.append(extra_foot);
	div.append(extra_unitb);
	extra_unita.append("<option value='ft' selected>Foot</option>");
	extra_unita.append("<option value='in'>Inch</option>");
	extra_unita.append("<option value='m'>Metres</option>");
	extra_unita.append("<option value='cm'>Centimetres</option>");
	extra_unitb.append("<option value='ft'>Foot</option>");
	extra_unitb.append("<option value='in'>Inch</option>");
	extra_unitb.append("<option value='m' selected>Metres</option>");
	extra_unitb.append("<option value='cm'>Centimetres</option>");
	tabs_settings.append(div);
	var round = 1000;
	extra_meters[0].onchange = function(){
		extra_foot.val(Math.round(distance(extra_meters.val(),extra_unitb.val(),extra_unita.val()) * round)/round);
	}
	extra_foot[0].onchange = function(){
		extra_meters.val(Math.round(distance(extra_foot.val(),extra_unitb.val(),extra_unita.val()) * round)/round);
	}
	extra_unita[0].onchange = function(){
		extra_foot.val(Math.round(distance(extra_meters.val(),extra_unitb.val(),extra_unita.val()) * round)/round);
	}
	extra_unitb[0].onchange = function(){
		extra_foot.val(Math.round(distance(extra_meters.val(),extra_unitb.val(),extra_unita.val()) * round)/round);
	}
	
	mainblock.append(tabs_settings);
	
//circumstances
	//tabs_circumstance.hide();
	tabs_circumstance.append("<h1>Circumstances</h1>");
	
	var div = $("<div class='statdiv'>");
	div.append("<label for=lighting>Light Level: </label> ");
	var temp = $("<select id=lighting>");
	var vtemp = cStatus[Circumstances.lastIndexOf("light")];
	if(vtemp == 'normal'){
		temp.append("<option value='darkness'>Darkness</option>");
		temp.append("<option value='dim'>Dim Light</option>");
		temp.append("<option value='normal' selected>Normal Light</option>");
		temp.append("<option value='bright'>Bright Light</option>");
	}else if(vtemp == 'darkness'){
		temp.append("<option value='darkness' selected>Darkness</option>");
		temp.append("<option value='dim'>Dim Light</option>");
		temp.append("<option value='normal'>Normal Light</option>");
		temp.append("<option value='bright'>Bright Light</option>");
	}else if(vtemp == 'dim'){
		temp.append("<option value='darkness'>Darkness</option>");
		temp.append("<option value='dim' selected>Dim Light</option>");
		temp.append("<option value='normal'>Normal Light</option>");
		temp.append("<option value='bright'>Bright Light</option>");		
	}else{
		temp.append("<option value='darkness'>Darkness</option>");
		temp.append("<option value='dim'>Dim Light</option>");
		temp.append("<option value='normal'>Normal Light</option>");
		temp.append("<option value='bright' selected>Bright Light</option>");
	}
	div.append(temp);
	tabs_circumstance.append(div);
	temp[0].onchange = function(eve){cStatus[Circumstances.lastIndexOf("light")]=eve.target.value; displayStats();}
	
	var div = $("<div class='statdiv'>");
	div.append("<label for=Source>Effect Source: </label> ");
	var temp = $("<select id=Source>");
	var vtemp = cStatus[Circumstances.lastIndexOf("Source")];
	if(vtemp == 'spell-like ability'){
		temp.append("<option value=''>none</option>");
		temp.append("<option value='poison'>Poison</option>");
		temp.append("<option value='ability'>Ability</option>");
		temp.append("<option value='spell'>Spell</option>");
		temp.append("<option value='spell-like ability' selected>Spell-like Ability</option>");
	}else if(vtemp == 'spell'){
		temp.append("<option value=''>none</option>");
		temp.append("<option value='poison'>Poison</option>");
		temp.append("<option value='ability'>Ability</option>");
		temp.append("<option value='spell' selected>Spell</option>");
		temp.append("<option value='spell-like ability'>Spell-like Ability</option>");
	}else if(vtemp == 'ability'){
		temp.append("<option value=''>none</option>");
		temp.append("<option value='poison'>Poison</option>");
		temp.append("<option value='ability' selected>Ability</option>");
		temp.append("<option value='spell'>Spell</option>");
		temp.append("<option value='spell-like ability'>Spell-like Ability</option>");
	}else if(vtemp == 'poison'){
		temp.append("<option value=''>none</option>");
		temp.append("<option value='poison' selected>Poison</option>");
		temp.append("<option value='ability'>Ability</option>");
		temp.append("<option value='spell'>Spell</option>");
		temp.append("<option value='spell-like ability'>Spell-like Ability</option>");
	}else{
		temp.append("<option value='' selected>none</option>");
		temp.append("<option value='poison'>Poison</option>");
		temp.append("<option value='ability'>Ability</option>");
		temp.append("<option value='spell'>Spell</option>");
		temp.append("<option value='spell-like ability'>Spell-like Ability</option>");
	}
	div.append(temp);
	tabs_circumstance.append(div);
	temp[0].onchange = function(eve){cStatus[Circumstances.lastIndexOf("Source")]=eve.target.value; displayStats();}
	
	var div = $("<div class='statdiv'>");
	div.append("<label for=Opposed>Opposed Check: </label> ");
	var temp = $("<input type=checkbox id=Opposed>");
	temp.prop("checked",cStatus[Circumstances.lastIndexOf("Opposed")]);
	div.append(temp);
	tabs_circumstance.append(div);
	temp[0].onchange = function(eve){cStatus[Circumstances.lastIndexOf("Opposed")]=eve.target.checked; displayStats();}

	var div = $("<div class='statdiv'>");
	div.append("<label for=Subtype>Target's Subtype: </label> ");
	var temp = $("<input type=text id=Subtype>");
	temp.val(cStatus[Circumstances.lastIndexOf("Subtype")]);
	div.append(temp);
	tabs_circumstance.append(div);
	temp[0].onchange = function(eve){cStatus[Circumstances.lastIndexOf("Subtype")]=eve.target.value;}
	
	//mainblock.append(tabs_circumstance);

//Log
	logblock.append("<h1>Log</h1>");
	logblock.append(textblock);
	logblock.append("<hr>");
	logblock.append(extras);
	extras.append("Roll: ");
	extras.append(extra_nd);
	extras.append(" d ");
	extras.append(extra_ds);
	extras.append(" + ");
	extras.append(extra_dmod);
	extras.append("<div class='rollable' style='display:inline-block;' onclick='r()'>x</div>");
	extras.append("<hr><b>Show Individual Rolls?<b>");
	extras.append(extra_dsum);
	extra_dsum[0].onchange = function(){
		show_all_res = extra_dsum.prop("checked");
	}
	extras.append("<span class='spacer2'>");
	
	reveal("chars");
	upkeep();
}

function r(){
	chat_msg("Custom: "+multi_roll(extra_nd.val(),extra_ds.val(),extra_dmod.val()));
}

function charsUpdate(){
	disChars.empty();
	disChars.append("<tr><th></th><th>Name</th><th>Race</th><th>Note</th></tr>");
	for(var ib in characters){
		var temp = $("<tr>");
		if(ib == current){
			temp.append("<td><span class='clickablenot'>Current</span></td>");
		}else{
			temp.append("<td><span class='clickable' onclick='current = \""+ib+"\";displayStats();'>Select</span></td>");
		}
		temp.append("<td>"+ib+"</td>");
		temp.append("<td>"+characters[ib].Race+"</td>");
		temp.append("<td>"+characters[ib].Note+"</td>");
		disChars.append(temp);
	}
}

function reveal(data){
	mainblock.children().hide();
	mainblock.removeClass();
	mainblock.addClass("sections");
	switch(data){
		case 'rolls':
			tabs_rolls.show();
			break;
		case 'stats':
			statblock.show();
			break;
		case 'chars':
			tabs_chars.show();
			break;
		case 'spell':
			tabs_spell.show();
			break;
		case 'setting':
			tabs_settings.show();
			break;
		case 'cir':
			tabs_circumstance.show();
			break;
		default:
			tabs_main.show();
			data = 'main';
	}
	mainblock.addClass("m"+data);
	displayStats();
}

function displayStats(){
	statblock.empty();
	tabs_main.empty();
	tabs_rolls.empty();
	tabs_spell.empty();
	charsUpdate();
	if(current == null || current == ""){
		return;
	}
	show_all_res = extra_dsum.prop("checked");
	var disTemp;

//basic
	tabs_main.append("<h1>Character Info</h1>");
	tabs_main.append("<div class='name statdiv'>Name: "+ characters[current].Name +"</div>");
	tabs_main.append("<div class='alignment statdiv'>Alignment: "+ characters[current].Alignment +"</div>");
	tabs_main.append("<div class='player statdiv'>Player: "+ characters[current].Player +"</div>");
	tabs_main.append("<div class='race statdiv'>Race: "+ characters[current].Race +"</div>");
	tabs_main.append("<div class='class statdiv'>Class: "+ characters[current].Class +"</div>");
	tabs_main.append("<div class='level statdiv'>Level: "+ characters[current].Level() +"</div>");
	tabs_main.append("<div class='deity statdiv'>Deity: "+ characters[current].Deity +"</div>");
	tabs_main.append("<div class='homeland statdiv'>Homeland: "+ characters[current].Homeland +"</div>");
	tabs_main.append("<div class='gender statdiv'>Gender: "+ characters[current].Gender +"</div>");
	tabs_main.append("<div class='height statdiv'>Height: "+ distance(characters[current].Height,pref_unit)+pref_unit +"</div>");
	tabs_main.append("<div class='weight statdiv'>Weight: "+ weight(characters[current].Weight,pref_wt)+pref_wt +"</div>");
	tabs_main.append("<div class='hair statdiv'>Hair: "+ characters[current].Hair +"</div>");
	tabs_main.append("<div class='eye statdiv'>Eye: "+ characters[current].Eye +"</div>");
	tabs_main.append("<div class='money statdiv'>Money: "+ pMoney(characters[current].Money) +"</div>");
	
	tabs_main.append("<hr><h1>Stat Sources</h1>");
	for(var i = 0; i < characters[current].stats.length;i++){
		tabs_main.append("<div class='effects statdiv'>"+ characters[current].stats[i][0] +" : "+ characters[current].stats[i][2] +"</div>");
	}

	statblock.append("<h1>Abilities & Skills</h1>");
//abilitys
	disTemp = $("<table class='abilities'><tr><th><div class='rollableIcon'>x</div></th><th>Ability</th><th>Score</th><th>Mod</th></tr></table>");
	for(var ib = 0; ib < Abilities.length;ib++){
		disTempRow = $("<tr>");
		disTempRow.append("<td><div class='rollable' onclick='roll_abl(\""+Abilities[ib]+"\")'>x</div></td>");
		disTempRow.append("<td>"+Abilities[ib]+"</td>");
		disTempRow.append("<td>"+characters[current].ability_score(Abilities[ib])+"</td>");
		disTempRow.append("<td>"+characters[current].ability_mod(Abilities[ib])+"</td>");
		disTemp.append(disTempRow);
	}
	statblock.append(disTemp);
//skills
	disTemp = $("<table class='skills'><tr><th><div class='rollableIcon'>x</div></th><th>T</th><th>Skills</th><th>Total</th><th>Mod</th><th>Ranks</th><th>Misc</th></tr></table>");
	for(var ib = 0; ib < Skills.length;ib++){
		disTempRow = $("<tr>");
		var trained = false;
		var clas = false;
		var ranks = 0;
		var bonus = 0;
		for(var ic = 0; ic < characters[current].stats.length; ic++){
			trained = trained || characters[current].stats[ic][1].skill[Skills[ib]][0];
			clas = clas || characters[current].stats[ic][1].skill[Skills[ib]][1];
			ranks += characters[current].stats[ic][1].skill[Skills[ib]][3];
			bonus += characters[current].stats[ic][1].skill[Skills[ib]][4];
		}
		disTempRow.append("<td><div class='rollable' onclick='roll_skl(\""+Skills[ib]+"\")'>x</div></td>");
		if(clas){
			disTempRow.append("<td>X</td>");
		}else{
			disTempRow.append("<td></td>");
		}
		disTempRow.append("<td>"+Skills[ib]+"</td>");
		disTempRow.append("<td>"+characters[current].skill_score(Skills[ib])+"</td>");
		disTempRow.append("<td>"+characters[current].stats[0][1].skill[Skills[ib]][2]+"</td>");
		disTempRow.append("<td>"+ranks+"</td>");
		disTempRow.append("<td>"+bonus+"</td>");
		if(!trained || clas){
			disTemp.append(disTempRow);
		}
	}
	statblock.append(disTemp);
	
//combat
	tabs_rolls.append("<h1>Defence</h1>");
	tabs_rolls.append("<div class='ac statdiv'>AC: "+ characters[current].ac() +" Flat: "+ characters[current].ac(true) +"</div>");
	tabs_rolls.append("<div class='actouch statdiv'>AC Touch: "+ characters[current].ac_touch() +" Flat: "+ characters[current].ac_touch(true) +"</div>");
	tabs_rolls.append("<div class='sr statdiv'>Spell Resistance: "+ characters[current].sr() +"</div>");
	tabs_rolls.append("<div class='concentration statdiv'>Concentration: "+ characters[current].concentration() +"</div>");
	
	var disTempRow = $("<table class='resistances'><tr><th>Resistance</th><th>Total</th></tr></table>");
	for(var i = 0;i< EnergyTypes.length; i++){
		disTempRow.append("<tr><td>"+ EnergyTypes[i].UCfirst() + "</td><td>" + characters[current].resistance(EnergyTypes[i]) +"</td></tr>");
	}
	tabs_rolls.append(disTempRow);
	
	var disTempRow = $("<table class='saves'><tr><th><div class='rollableIcon'>x</div></th><th>Save</th><th>Total</th></tr></table>");
	disTempRow.append("<tr><td><div class='rollable' onclick='roll_save(\"fort\")'>x</div></td><td>Fortitude</td><td>" + characters[current].save_fort() +"</td></tr>");
	disTempRow.append("<tr><td><div class='rollable' onclick='roll_save(\"refl\")'>x</div></td><td>Reflex</td><td>" + characters[current].save_refl() +"</td></tr>");
	disTempRow.append("<tr><td><div class='rollable' onclick='roll_save(\"will\")'>x</div></td><td>Will</td><td>" + characters[current].save_will() +"</td></tr>");
	tabs_rolls.append(disTempRow);

	
	tabs_rolls.append("<hr><h1>Combat</h1>");
	var Temp = $("<div class='bab statdiv'>Attack Bonus: </div>");
	var result = characters[current].BAB();
	for(var i = 0; i < result.length;i++ ){
		Temp.append("<span class='clickable' onclick=\"setATKbonus("+result[i]+")\">"+result[i]+"</span>");
	}
	tabs_rolls.append(Temp);
	tabs_rolls.append("<div class='cmb statdiv'>CMB: "+ characters[current].CMB() +" <div class='rollable' onclick='roll_CMB()'>x</div></div>");
	tabs_rolls.append("<div class='cmd statdiv'>CMD: "+ characters[current].CMD() +" <div class='rollable' onclick='roll_CMD()'>x</div></div>");
	
	var disTempRow = $("<table class='Attacks'><tr><th><div class='rollableIcon'>x</div></th><th>Attack</th><th>ATK Bonus</th><th>Critical</th><th>Damage</th><th>Range</th><th>Ammunition</th></tr></table>");
	for(var i = 0; i < characters[current].weapons.length;i++){
		var Temp = "";
		for(var ia = 0; ia < characters[current].weapons[i].Bonus.length; ia++){
			Temp += ", " + characters[current].weapons[i].Bonus[ia][0] +"d"+characters[current].weapons[i].Bonus[ia][1] +"-"+characters[current].weapons[i].Bonus[ia][2];
		}
		disTempRow.append("<tr><td><div class='rollable' onclick='roll_W("+i+")'>x</div></td><td>"+characters[current].weapons[i].Name+"</td><td><div class='rollable' onclick='roll_Watk("+i+")'>x</div>+"+weapon_atk_bonus(i)+"</td><td>"+characters[current].weapons[i].Crit[0]+"-20, x"+characters[current].weapons[i].Crit[1]+"</td><td><div class='rollable' onclick='roll_Wdmg("+i+")'>x</div>"+characters[current].weapons[i].DMG.toString().replace(",","d")+"-"+characters[current].weapons[i].Type+Temp+"</td><td>"+characters[current].weapons[i].Range+"</td><td>"+characters[current].weapons[i].Ammo+"</td></tr>");
	}
	disTempRow.append("<tr><td></td><td>Melee</td><td><div class='rollable' onclick='roll_atk_melee()'>x</div>+"+atk_abl("Melee")+"</td><td>20</td><td> - </td><td> - </td><td> - </td><td> - </td></tr>");
	disTempRow.append("<tr><td></td><td>Ranged</td><td><div class='rollable' onclick='roll_atk_range()'>x</div>+"+atk_abl("Ranged")+"</td><td>20</td><td> - </td><td> - </td><td> - </td><td> - </td></tr>");
	disTempRow.append("<tr><td></td><td>Melee Touch</td><td><div class='rollable' onclick='roll_atk_touch()'>x</div>+"+atk_abl("melee")+"</td><td>20</td><td> - </td><td> - </td><td> - </td><td> - </td></tr>");
	disTempRow.append("<tr><td></td><td>Ranged Touch</td><td><div class='rollable' onclick='roll_atk_Rtouch()'>x</div>+"+atk_abl("ranged")+"</td><td>20</td><td> - </td><td> - </td><td> - </td><td> - </td></tr>");
	tabs_rolls.append(disTempRow);
	
//Spells and Abilities
	tabs_spell.append("<h1>Abilities</h1>");
	var disTempRow = $("<table class=castable>");
	tabs_spell.append(disTempRow);
	var temp = characters[current].Abilities();
	for(var i = 0; i < temp.length; i++){
		disTempRow.append("<tr><td>"+print_Castable(temp[i])+"</tr>");
	}
	tabs_spell.append("<hr><h1>Spells</h1>");
	var disTempRow = $("<table class=castable>");
	tabs_spell.append(disTempRow);
	var temp = characters[current].Spells();
	for(var i = 0; i < temp.length; i++){
		disTempRow.append("<tr><td>"+print_Castable(temp[i])+"</tr>");
	}
	
	var temp = mainblock.height()*0.95;
	if(statblock.height() > temp){
		statblock.append("<span class='spacer'>");
	}
	if(tabs_rolls.height() > temp){
		tabs_rolls.append("<span class='spacer'>");
	}
	if(tabs_main.height() > temp){
		tabs_main.append("<span class='spacer'>");
	}
	if(tabs_chars.height() > temp){
		tabs_chars.append("<span class='spacer'>");
	}
	if(tabs_spell.height() > temp){
		tabs_spell.append("<span class='spacer'>");
	}
}

function chat_msg(msg,clas){
	if(clas == undefined){
		clas = "";
	}
	textblock.append("<div class='msg "+clas+"'>"+msg+"</div>");
	textblock.scrollTop(textblock[0].scrollHeight);
}

function setATKbonus(data){
	UI['atk_bonus'] = data;
	displayStats();
}

function sound_play(sound){
	audio.src = sound;
	audio.play();
}
function loadAudio(url){
	var audio = new Audio();
	audio.src = url;
	audio.preload = "auto";
	return;
}

function upkeep(){
	displayStats();
	var il = 0; var data;
	for(data in characters){il++;}
	/*if(disChars.children().length != il){
		charsUpdate();
	}*/
}

onload = function(){
	load_stuff();
	mytabs();
	resise();
	loadAudio(audio_crit_sucess);
	loadAudio(audio_crit_failure);
	audio = new Audio();
	//tick = setInterval(function(){upkeep();}, 10000);
}

window.onresize = function(){resise();}

function resise(){
	var temp = window.innerHeight - tabs_circumstance.outerHeight(true);
	mainblock.height(temp);
	logblock.height(temp);
	menublock.height(temp);
	var tem = logblock.children();
	for(var te = 0; te < tem.length;te++){
		if(tem[te] != textblock[0]){
			temp -= $(tem[te]).outerHeight(true);
		}
	}
	textblock.height(temp);
	displayStats();
}
