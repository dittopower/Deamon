// Initialize Firebase
var config = {
	apiKey: "AIzaSyBuJNvcscqzbIJ2mc_ZV3_IkNQULJJVIYw",
	authDomain: "dndeamon.firebaseapp.com",
	databaseURL: "https://dndeamon.firebaseio.com",
	storageBucket: "dndeamon.appspot.com",
};
firebase.initializeApp(config);

database = firebase.database();

function race_list(){
	firebase.database().ref('/old/Race').once('value').then(function(snapshot) {
		chars_races.append("<tr><th>Race</th><th>Ability</th><th>Size</th><th>Speed</th><th>Senses</th><th>Skills</th><th>Traits</th><th>Feats</th><th>Spell-like<b>|</b>Supernatural Abilities</th></tr>");
		var Races = snapshot.val();
		for(var i in Races){
			var temprow = $("<tr>");
			//race
			temprow.append("<td><b>"+i+"</b><br>"+Races[i].Type+": "+Races[i].Subtype+"</td>");
			//ability scores
			var tt = $("<ul class='outer Stats'>");
			for(var things in Races[i].Stats){
				tt.append("<li><b>"+things+":</b> "+Races[i].Stats[things]+"</li>");
			}
			var temp = $("<td>");
			temp.append(tt);
			temprow.append(temp);
			//size
			temprow.append("<td>"+Races[i].Size+"</td>");
			//speed
			temprow.append("<td>"+distance(Races[i].Speed,pref_unit)+pref_unit+"</td>");
			//senses
			var temp = $("<td>");
			if(Races[i].Darkvision != undefined){
				temp.append("<div><b>Dark Vision:</b> "+distance(Races[i].Darkvision,pref_unit)+pref_unit+"</div>");
			}
			if(Races[i].LowLightvision != undefined){
				temp.append("<div><b>Low-Light Vision:</b> "+distance(Races[i].Darkvision,pref_unit)+pref_unit+"</div>");
			}
			temprow.append(temp);
			//Skills
			var temp = $("<td>");
			if(Races[i].Skills != undefined){
				var tt = $("<ul class='outer Skills'>");
				for(var things in Races[i].Skills){
					tt.append("<li><b>"+things+":</b> "+Races[i].Skills[things]+"</li>");
				}
				temp.append(tt);
			}
			temprow.append(temp);
			//Traits - other things
			var temp = $("<td>");
			if(Races[i].conditions != undefined){
				var tt = $("<div class='outer conditions'>");
				for(var things in Races[i].conditions){
					tt.append("<b>"+things+":</b>");
					var tttt = $("<ul class='inner "+things+"'>");
					for(var thin in Races[i].conditions[things]){
						tttt.append("<li>"+thin+": "+Races[i].conditions[things][thin]+"</li>");
					}
					tt.append(tttt);
				}
				temp.append(tt);
			}
			temprow.append(temp);
			//Feats
			var temp = $("<td>");
			if(Races[i].Feats != undefined){
				var tt = $("<ul class='outer Feats'>");
				for(var things in Races[i].Feats){
					tt.append("<li><b>"+things+":</b> "+Races[i].Feats[things]+"</li>");
				}
				temp.append(tt);
			}
			temprow.append(temp);
			//Abilies SU
			var temp = $("<td>");
			if(Races[i].Abilities != undefined){
				var tt = $("<ul class='outer Abilities'>");
				for(var things in Races[i].Abilities){
					tt.append("<li><b>"+things+":</b> "+Races[i].Abilities[things]+"</li>");
				}
				temp.append(tt);
			}
			if(Races[i].Spells != undefined){
				var tt = $("<ul class='outer Spells'>");
				for(var things in Races[i].Spells){
					tt.append("<li><b>"+things+":</b> "+Races[i].Spells[things]+"</li>");
				}
				temp.append(tt);
			}
			temprow.append(temp);
			
			chars_races.append(temprow);
		}
	});
}



///Not Database but still loads/saves data
function load_stuff(){
	for(var i = 0; i < Circumstances.length;i++){
		cStatus[i] = localLoad(Circumstances[i],cStatus[i]);
	}
}

function save_stuff(){
	for(var i = 0; i < Circumstances.length;i++){
		localSave(Circumstances[i],cStatus[i]);
	}
}

function localLoad(what,alt){
	if(typeof(Storage) !== "undefined") {
		var temp = JSON.parse(localStorage.getItem("DnDeamon_"+what));
		if(temp != null && temp !== undefined){
			alt = temp;
		}
	} else {
		console.log("Local Storage not avalible.....");
	}
	return alt;
}
		
function localSave(what,value){
	if(typeof(Storage) !== "undefined") {
		localStorage.setItem("DnDeamon_"+what, JSON.stringify(value));
	} else {
		console.log("Local Storage not avalible.....");
	}
}

window.onunload = function(){save_stuff();};