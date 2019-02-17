
//Rolls
var show_all_res = true;

function roll(num){
	return Math.floor(Math.random()*num+1);
}
function roll_d20(b,threashold){
	if(threashold == undefined){
		threashold = 20;
	}
	if(b == undefined){
		b = 0;
	}
	var out = "";
	var result = roll(20);
	var crit = 0;
	
	if(result >= threashold){
		crit = 1;
		sound_play(audio_crit_sucess);
	}else if(result == 1){
		crit = 2;
		sound_play(audio_crit_failure);
	}
	
	out += "<span class=dres>"+1+"d"+20;
	if(b != 0){
		out += " + " + b;
	}
	out += ": <span class=result>" + (result+b)+ "</span>";
	if(show_all_res){
		switch(crit){
			case 0:
				out += " [" + result + "]";
				break;
			default:
				out += " <span class=emphasis>[" + result + "]</span>";
		}
	}
	out += "</span>";
	
	return [out,crit];
}


function multi_roll(n,s,b){
	if(b == undefined){
		b = 0;
	}
	var temp = 0;
	var results = [];
	for(var i = 0; i < n;i++){
		var t = roll(s);
		results.push(t);
		temp += t;
	}
	results = results.join(", ");
	
	var crit = 0;
	if(temp == s){
		crit = 1;
	}else if(temp == 1){
		crit = 2;
	}
	temp += Number(b);
	
	var out = n+"d"+s;
	if(b != 0){
		out += " + " + b;
	}
	out += ": <span class=result>" + temp + "</span>";
	if(show_all_res){
		switch(crit){
			case 0:
				out += " [" + results + "]";
				break;
			default:
				out += " <span class=emphasis>[" + results + "]</span>";
		}
	}
	
	return "<span class=dres>"+out+"</span>";
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
	chat_msg(text+roll_d20(result)[0]);
}
function roll_skl(stat){
	var result = 0;
	result += characters[current].skill_score(stat);
	if(isNaN(result)){
		chat_msg(stat+": Skill Requires Training");
		return;
	}
	chat_msg(stat+roll_d20(result)[0]);
}
function roll_save(stat){
	var result = 0;
	var text = '';
	switch(stat){
		case "fort":
			result = characters[current].save_fort();
			text = 'Fortitude';
			break;
		case "will":
			result = characters[current].save_will();
			text = 'Will';
			break;
		case "refl":
			result = characters[current].save_refl();
			text = 'Reflex';
			break;
		default:
			text = 'None';
	}
	chat_msg("Save: "+text+" "+roll_d20(result)[0]);
}
function roll_CMB(){
	var result = 0;
	result += characters[current].CMB();
	chat_msg("Combat Maneuver: " +roll_d20(result)[0]);
}
function roll_CMD(){
	var result = 0;
	result += characters[current].CMD();
	chat_msg("Defence Maneuver: " +roll_d20(result)[0]);
}



function rollatk(stat,misc){
	stat = stat.toLowerCase();
	if(misc == undefined){
		misc = 0;
	}
	var result = 0;
	result += misc;
	switch(stat){
		case "str":
		case "melee":
			result += characters[current].ability_mod("STR");
			break;
		case "dex":
		case "thrown":
		case "ranged":
			result += characters[current].ability_mod("DEX");
			break;
	}
	result += characters[current].BABmax();
	result += characters[current].Size.Mod;
	return roll_d20(result)[0];
}
function atk_abl(stat){
	stat = stat.toLowerCase();
	var result = 0;
	switch(stat){
		case "STR":
		case "melee":
			result += characters[current].ability_mod("STR");
			break;
		case "DEX":
		case "ranged":
		case "thrown":
			result += characters[current].ability_mod("DEX");
			break;
	}
	result += characters[current].BABmax();
	return result;
}
function weapon_atk_abl(data){
	if(checkFeat("Weapon Finesse",characters[current])){
		var Pat = RegExp("elven curve blade|rapier|spiked chain","i");
		if(characters[current].weapons[data].Hands == "L" || Pat.test(characters[current].weapons[data].Name)){
			return characters[current].ability_mod("DEX");
		}
	}
	if(characters[current].weapons[data].Use == "Melee"){
		return characters[current].ability_mod("STR");
	}
	if(characters[current].weapons[data].Use == "Ranged"){
		return characters[current].ability_mod("DEX");
	}
	if(characters[current].weapons[data].Use == "Thrown"){
		return characters[current].ability_mod("DEX");
	}
	return 0;
}

function weapon_atk_bonus(data){
	var result = 0;
	result += weapon_atk_abl(data);
	result += characters[current].Size.Mod;
	result += UI['atk_bonus'];
	switch(characters[current].weapons[data].Masterwork){
		case "Masterwork":
			result += 1;
			break;
		case "":
			break;
		default:
			result += characters[current].weapons[data].Masterwork;
	}
	return result;
}

function roll_atk_melee(){
	chat_msg("Melee Attack: " +rollatk("melee"));
}
function roll_atk_range(penalty){
	chat_msg("Ranged Attack: " +rollatk("ranged",penalty) + " (- range penalty)");
}
function roll_atk_touch(){
	chat_msg("Melee Touch Attack: " +rollatk("melee"));
}
function roll_atk_Rtouch(){
	chat_msg("Ranged Touch Attack: " +rollatk("ranged"));
}

function roll_Watk(data){
	var temp = roll_d20(weapon_atk_bonus(data),characters[current].weapons[data].Crit[0]);
	if(temp[1] == 1){
		chat_msg(characters[current].weapons[data].Name + " Attack: " +temp[0],"crit_suc");
		chat_msg("Confirm Crit: " + multi_roll(1,20,weapon_atk_bonus(data)+characters[current].CritConfirm()+characters[current].weapons[data].CritBonus));
	}else if(temp[1] == 2){
		chat_msg(characters[current].weapons[data].Name + " Attack: " +temp[0],"crit_fail");
		chat_msg("Crit Fail: roll coming sometime");
	}else{
		chat_msg(characters[current].weapons[data].Name + " Attack: " +temp[0]);
	}
}
function roll_Wdmg(data){
	var result = 0;
	var mod = characters[current].ability_mod("STR");
	if(checkStat("Fatal Finesse",characters[current])){
		var Pat = RegExp("elven curve blade|rapier|spiked chain","i");
		if(characters[current].weapons[data].Hands == "L" || Pat.test(characters[current].weapons[data].Name)){
			mod = characters[current].ability_mod("DEX");
		}
	}
	if(characters[current].weapons[data].Use == "Melee"){
		switch(characters[current].weapons[data].Hands){
			case "2":
				result += (mod *1.5);
				break;
			case "1":
			case "L":
				result += mod;
				break;
		}
	}
	switch(characters[current].weapons[data].Masterwork){
		case "Masterwork":
		case "":
			break;
		default:
			result += characters[current].weapons[data].Masterwork;
	}
	
	result = multi_roll(characters[current].weapons[data].DMG[0],characters[current].weapons[data].DMG[1],result);

	var Temp = "";
	for(var i = 0;i < characters[current].weapons[data].Bonus.length;i++){
		Temp += "; "
		Temp += multi_roll(characters[current].weapons[data].Bonus[i][0],characters[current].weapons[data].Bonus[i][1])+" "+characters[current].weapons[data].Bonus[i][2].UCfirst();
	}
	chat_msg(characters[current].weapons[data].Name +": "+result+" "+ characters[current].weapons[data].Type+" "  +Temp);
}
function roll_W(data){
	roll_Watk(data);
	roll_Wdmg(data);
}


function makeRollable(text){
	text = text.replace(/((\d+)d(\d+)\s?\+?\s?(\d+)?)/igm,"\<span><div class='rollable' onclick='chat_msg(multi_roll\($2,$3,$4))'\>x</div>$1</span>");
	text = text.replace(/,\)/igm,")");
	return text;
}