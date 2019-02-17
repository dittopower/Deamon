/*
Character Implementations
*/

function Ability(score,bonus,circumstance){
	if(circumstance == undefined){
		circumstance = "";
	}
	return [score,bonus,circumstance];
}

function Skill(trained,clas,ability,rank,bonus,circumstance){
	if(circumstance == undefined){
		circumstance = [];
	}
	return [trained,clas,ability,rank,bonus,circumstance];
}
function Save(base,ability,magic,misc){
	if(misc == undefined){
		misc = 0;
	}
	if(magic == undefined){
		magic = 0;
	}
	return {Base:base,Ability:ability,Magic:magic,Misc:misc};
}
function Size (name,mod,spmod,fly,stealth,space,reach,height,weight){
	return {Name:name,Mod:mod,SPMod:spmod,Fly:fly,Stealth:stealth,Space:space,Reach:reach,TH:height,TW:weight};
}

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
		this.skill["Craft"] =					new Skill( true,false,"INT",0,0);
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
	this.bab = [];
		this.bab.push(0);
	this.armour = [];
		this.armour["armour"] = 0;
		this.armour["shield"] = 0;
		this.armour["natural"] = 0;
		this.armour["dodge"] = 0;
		this.armour["deflection"] = 0;
		this.armour["misc"] = 0;
		this.armour["stat"] = 'DEX';
		this.armour["max"] = 1000;
	this.SpellResistance = 0;
	this.concentration = 0;
	this.resistance = [];
	for(var i = 0;i< EnergyTypes.length; i++){
		this.resistance[EnergyTypes[i]] = 0;
	}
	this.saves = []
		this.saves['fortitude'] = new Save(0,"CON");
		this.saves['reflex'] = new Save(0,"DEX");
		this.saves['will'] = new Save(0,"WIS");
	this.HP = 0;
	this.Spells = [];
	this.Abilities = [];
	this.CritConfirm = 0;
	this.Crit = "";
	this.level = 0;
	this.mod = "";
}


function Character (name,player,race,clas,al,str,dex,con,intt,wis,cha,deity,HL,g,h,w,s,hair,eye){
	this.Name = name;
	this.Player = player;
	this.Level = function (){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].level;
		}
		return result;
	}
	this.Race = race;
	this.Class = clas;
	this.Note = "";
	this.Alignment = al;
	this.Deity = deity;
	this.Homeland = HL;
	this.Gender = g;
	//need age
	this.Height = h;
	this.Weight = w;
	this.Size = s;
	this.Hair = hair;
	this.Eye = eye;
	this.Money = 0;
	this.stats = [];
	this.stats.push( ['Base Stats',new Stats(str,dex,con,intt,wis,cha),'Base'] );
	
	this.ability_score = function (what){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].ability[what][0];
		}
		//need circumstance bonus
		return result;
	}
	this.ability_mod = function (what){
		if(what == ""||what == undefined){
			return 0;
		}
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
			if(this.stats[ia][1].skill[what][5].length > 0){
				for(var i = 0;i < this.stats[ia][1].skill[what][5].length;i++){
					if(Check_Cirumstance(this.stats[ia][1].skill[what][5][i][0])){
						result += this.stats[ia][1].skill[what][5][i][1];
					}
				}
			}
		}
		result += this.ability_mod(this.stats[0][1].skill[what][2]);
		if(clas || !trained){
			result += resultb;
			if(resultb > 0){
				result += 3;
			}
		}
		if(!clas && trained){
			result = NaN;
		}
		switch(what){
			case "Fly":
				result += characters[current].Size.Fly;
				break;
			case "Stealth":
				result += characters[current].Size.Stealth;
				break;
		}
		//need circumstance bonus
		return result;
	}
	
	this.sr = function (){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].SpellResistance;
		}
		return result;
	}
	this.concentration = function (){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].concentration;
		}
		return result;
	}
	this.resistance = function (data){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].resistance[data];
		}
		return result;
	}
	this.ac = function (flat){
		if(flat == undefined){
			flat = false;
		}
		var result = 10;
		var resultb = 1000;
		var resultc = "DEX";
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].armour["armour"] +
			this.stats[ia][1].armour["shield"] +
			this.stats[ia][1].armour["natural"] +
			this.stats[ia][1].armour["dodge"] +
			this.stats[ia][1].armour["deflection"] +
			this.stats[ia][1].armour["misc"];
			resultb = Math.min(this.stats[ia][1].armour["max"],resultb);
			if(this.stats[ia][1].armour["stat"] != "DEX"){
				resultc = this.stats[ia][1].armour["stat"];
			}
		}
		if(!flat){
			result += Math.min(this.ability_mod(resultc),resultb);
		}
		result += this.Size.Mod;
		return result;
	}
	this.ac_touch = function (flat){
		if(flat == undefined){
			flat = false;
		}
		var result = 10;
		var resultb = 1000;
		var resultc = "DEX";
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].armour["dodge"] +
			this.stats[ia][1].armour["deflection"] +
			this.stats[ia][1].armour["misc"];
			resultb = Math.min(this.stats[ia][1].armour["max"],resultb);
			if(this.stats[ia][1].armour["stat"] != "DEX"){
				resultc = this.stats[ia][1].armour["stat"];
			}
		}
		if(!flat){
			result += Math.min(this.ability_mod(resultc),resultb);		
		}
		result += this.Size.Mod;
		return result;
	}
	
	this.save_fort = function (){
		var result = 0;
		var resultb = "CON";
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].saves['fortitude'].Base;
			result += this.stats[ia][1].saves['fortitude'].Magic;
			result += this.stats[ia][1].saves['fortitude'].Misc;
			if("CON" != this.stats[ia][1].saves['fortitude'].Ability){
				resultb = this.stats[ia][1].saves['fortitude'].Ability;
			}
		}
		result += this.ability_mod(resultb);
		return result;
	}
	this.save_refl = function (){
		var result = 0;
		var resultb = "DEX";
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].saves['reflex'].Base;
			result += this.stats[ia][1].saves['reflex'].Magic;
			result += this.stats[ia][1].saves['reflex'].Misc;
			if("DEX" != this.stats[ia][1].saves['reflex'].Ability){
				resultb = this.stats[ia][1].saves['reflex'].Ability;
			}
		}
		result += this.ability_mod(resultb);
		return result;
	}
	this.save_will = function (){
		var result = 0;
		var resultb = "WIS";
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].saves['will'].Base;
			result += this.stats[ia][1].saves['will'].Magic;
			result += this.stats[ia][1].saves['will'].Misc;
			if("WIS" != this.stats[ia][1].saves['will'].Ability){
				resultb = this.stats[ia][1].saves['will'].Ability;
			}
		}
		result += this.ability_mod(resultb);
		return result;
	}
	this.BAB = function (){
		var result = [];
		for(ia = 0; ia < this.stats.length; ia++){
			for(var i = 0; i < this.stats[ia][1].bab.length; i++){
				if(result[i] == undefined){
					result[i] = 0;
				}
				result[i] += this.stats[ia][1].bab[i];
			}
		}
		return result;
	}
	this.BABmax = function(){
		var result = this.BAB();
		var resultb = 0;
		for(var i = 0; i < result.length; i++){
			resultb = Math.max(result[i],resultb);
		}
		return resultb;
	}
	this.CritConfirm = function(){
		var result = 0;
		for(ia = 0; ia < this.stats.length; ia++){
			result += this.stats[ia][1].CritConfirm;
		}
		return result;
	}
	this.CMB = function (){
		var result = this.BABmax();
		result += this.ability_mod("STR");
		result += this.Size.SPMod;
		return result;
	}
	this.CMD = function (){
		var result = this.BABmax();
		result += this.ability_mod("STR");
		result += this.ability_mod("DEX");
		result += this.Size.SPMod;
		result += 10;
		return result;
	}
	
	this.weapons = [];
	this.items = [];
	this.Equip = function(data){
		//add checks for hands and stuff here
		this.weapons.push(data);
	}
	
	this.Spells = function(){
		var result = [];
		for(var i = 0; i < this.stats.length; i++){
			result = result.concat(this.stats[i][1].Spells);
		}
		return result;
	}
	this.Abilities = function(){
		var result = [];
		for(var i = 0; i < this.stats.length; i++){
			result = result.concat(this.stats[i][1].Abilities);
		}
		return result;
	}
	this.set_CLV = function(id){//Replace this with checking a list//stored class against possessed classes
		this.CasterLV = this.Level();
		this.CasterMod = "";
		var temp = ClassSpells.spell.indexOf(id);
		while(temp > -1){
			for(var i = 0; i < this.stats.length; i++){
				if(this.stats[i][0] == ClassSpells.class[temp]){
					if(this.CasterLV <= this.stats[i][1].level){
						this.CasterLV = this.stats[i][1].level;
						this.CasterMod = this.stats[i][1].mod;
					}
				}
			}
			temp = ClassSpells.spell.indexOf(id,(temp+1));
		}
	}
	this.CasterLV = 0;
	this.CasterMod = "";
}

function Check_Cirumstance(stance){
	var Pat = RegExp("Subtype","i");
	if(Pat.test(stance)){
		Pat = /Subtype (.*)/i;
		Temp = Pat.exec(stance)[1];
		Temp = cStatus[Circumstances.lastIndexOf("Subtype")].toLowerCase() == Temp.toLowerCase();
		return Temp;
	}
	var Pat = RegExp("Source","i");
	if(Pat.test(stance)){
		Pat = /Source (.*)/i;
		Temp = Pat.exec(stance)[1];
		Temp = cStatus[Circumstances.lastIndexOf("Source")].toLowerCase() == Temp.toLowerCase();
		return Temp;
	}
	Pat = RegExp("Opposed","i");
	if(Pat.test(stance)){
		return cStatus[Circumstances.lastIndexOf("Opposed")];
	}
	Pat = RegExp("light|darkness","i");
	if(Pat.test(stance)){
		Pat = /light ([^ ]*) ?(less|more)?/i;
		var Temp = Pat.exec(stance);
		Pat = cStatus[Circumstances.lastIndexOf("light")];
		switch(Temp[1]){
			case "dim":
				if(Pat == "dim"){
					return true;
				}
				if(Temp[2] == "less"){
					if(Pat == "darkness"){
						return true;
					}
					return false;
				}
				if(Temp[2] == "more"){
					if(Pat != "darkness"){
						return true;
					}
					return false;
				}
				return false;
				break;
			case "normal":
				if(Pat == "normal"){
					return true;
				}
				if(Temp[2] == "less"){
					if(Pat != "bright"){
						return true;
					}
					return false;
				}
				if(Temp[2] == "more"){
					if(Pat == "bright"){
						return true;
					}
					return false;
				}
				return false;
				break;
			case "bright":
				if(Pat == "bright"){
					return true;
				}
				if(Temp[2] == "less"){
					if(Pat != "bright"){
						return true;
					}
					return false;
				}
				return false;
				break;
			default:
				if(Pat == "darkness"){
					return true;
				}
				if(Temp[2] == "more"){
					if(Pat != "darkness"){
						return true;
					}
					return false;
				}
				return false;
				break;
		}
	}
	return false;
}


function checkStat(stat,who){
	for(var i = 0; i < who.stats.length;i++){
		if(who.stats[i][0] == stat){
			return true;
		}
	}
	return false;
}