ItemId = 0;
function Money(cp,sp,gp,pp){
	if(cp == undefined){cp = 0;}
	if(sp == undefined){sp = 0;}
	if(gp == undefined){gp = 0;}
	if(pp == undefined){pp = 0;}
	return cp + sp*100 + gp*100 + pp*100;
}
//convert money
function cMoney(dist,too,from){
var result = 0;
	switch(from){
		case "cp":
			result = dist / 100;
			break;
		case "sp":
			result = dist / 10;
			break;
		case "pp":
			result = dist * 10;
			break;
		default:
			result = dist;
		}
	switch(too){
		case "cp":
			result *= 100;
			break;
		case "sp":
			result *= 10;
			break;
		case "pp":
			result *= 0.1;
			break;
		}
	return result;
}
//print money
function pMoney(data,unit){
	if(unit == undefined){
		unit = "cp";
	}
	var data = cMoney(data,"cp",unit);
	var result = "";
	if(data/1000 >= 1){
		result += Math.floor(data/1000) + "P ";
		data %= 1000;
	}
	if(data/100 >= 1){
		result += Math.floor(data/100) + "G ";
		data %= 100;
	}
	if(data/10 >= 1){
		result += Math.floor(data/10) + "S ";
		data %= 10;
	}
	if(data >= 1){
		result += data + "C ";
	}
	result += "Coin";
	return result;
}

function Item(name, w, cost,des){
	this.Name = name;
	this.Id = ItemId;
	ItemId++;
	this.Weight = w;
	this.Cost = cost;
	this.Description = des;
}
//weapons
function Weapon(name, hands, proficency, use, dmg, typ, crit, range, ammo, w, cost, master, bonus, cb, des){
	this.Item = new Item(name, w, cost, des);
	this.Name = this.Item.Name;
	this.Id = this.Item.ItemId;
	this.Hands = hands;
	this.Masterwork = master;
	this.DMG = dmg;
	this.Proficency = proficency;
	this.Use = use;
	this.Type = typ;
	this.Crit = crit;
	this.CritBonus = cb||0;
	this.Bonus = bonus;
	this.Range = range;
	this.Ammo = ammo;
	this.Weight = this.Item.Weight;
	this.Cost = this.Item.Cost;
}
//ammo

//armour

