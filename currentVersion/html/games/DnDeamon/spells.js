
Castable = [];

function scale(base,rate,stat,per,offset,max){
	if(base == undefined){
		base = 0;
	}
	if(rate == undefined){
		rate = 0;
	}
	if(stat == undefined){
		stat = "";
	}
	if(per == undefined){
		per = 1;
	}
	if(offset == undefined){
		offset = 0;
	}
	if(max == undefined){
		max = 0;
	}
	return [base,rate, stat, per, offset, max];
}

function Scaled(data){
	var result = 0;
	var resultb = 0;
	result += data[0];
	switch(data[2]){
		case "Level":
			resultb = characters[current].CasterLV;
			break;
		default:
			if(Abilities.indexOf(data[2]) > -1){
				resultb = characters[current].ability_mod(data[2]);
			}
	}
	result += data[1] * (resultb - data[4])/data[3];
	if(data[5] != 0){
		result = Math.min(data[5],result);
	}
	return result;
}

function isScale(data){
	if(typeof(data) != "object"){
		return false;
	}else if(data.length != 6){
		return false;
	}
	return true;
}

//Castable.push(["Name","Type",["range"],["targets"],["area"],["dmg"],"School", "Subschool","spell resistance",["saves"],"cast time","duration","effect","description","Components"]);

//spells
function find_Castable(name){
	for(var i = 0; Castable.length > i; i++){
		if(Castable[i][0] == name){
			return i;
		}
	}
	return null;
}

function print_Castable(id){
	characters[current].set_CLV(id);
	var result = "<h3>"+Castable[id][0]+"</h3>";
	if(Castable[id][6] != null){
		result += "<div class=spell_stat>School: " + Castable[id][6];
		if(Castable[id][7] != null){
			result += " [" + Castable[id][7].UCfirst() + "]";
		}
		result += "</div>";
	}
	if(Castable[id][14] != null){
		result += "<div class=spell_stat>Components: " + Castable[id][14] + "</div>";
	}
	if(Castable[id][10] != null){
		result += "<div class=spell_stat>Cast Time: " + Castable[id][10] + "</div>";
	}
	result += "<div class=spell_stat>DC: " + (10+characters[current].ability_mod(characters[current].CasterMod))/*+spell level*/ + "</div>";
	if(Castable[id][2] != null){
		if(isScale(Castable[id][2])){
			result += "<div class=spell_stat>Range: " + distance(Scaled(Castable[id][2]),pref_unit)+pref_unit + "</div>";
		}else{
			result += "<div class=spell_stat>Range: " + Castable[id][2] + "</div>";
		}
	}
	if(Castable[id][3] != null){
		result += "<div class=spell_stat>Targets: " + Scaled(Castable[id][3]) + "</div>";
	}
	if(Castable[id][4] != null){
		result += "<div class=spell_stat>Area: " + distance(Scaled(Castable[id][4]),pref_unit)+pref_unit + " radius</div>";
	}
	if(Castable[id][11] != null){
		result += "<div class=spell_stat>Duration: " + Scaled(Castable[id][11]) + " rounds</div>";
	}
	if(Castable[id][5] != null){
		result += "<div class=spell_stat>Damage: ";
		result += "<div class=rollable onclick='roll_cast("+id+")'>x</div>";
		for(var i = 0; i < Castable[id][5].length;i++ ){
			result += Scaled(Castable[id][5][i][0]) + "d"+ Scaled(Castable[id][5][i][1]) + " + "+ Scaled(Castable[id][5][i][2]) +" "+ Castable[id][5][i][3].UCfirst() +"; ";
		}
		result += "</div>";
	}
	if(Castable[id][8] != null){
		if(Castable[id][8]){
			result += "<div class=spell_stat>Spell Resistance: Yes</div>";
		}else{
			result += "<div class=spell_stat>Spell Resistance: No</div>";
		}
	}
	result += "<div class=spell_des>" + makeRollable(Castable[id][13]) + "</div>";
	return result;
}

function roll_cast(id){
	var temp = "";
	for(var i = 0; i < Castable[id][5].length;i++ ){
		temp += multi_roll(Scaled(Castable[id][5][i][0]),Scaled(Castable[id][5][i][1]),Scaled(Castable[id][5][i][2]));
	}
	chat_msg(Castable[id][0]+": "+temp+" Damage");
}

