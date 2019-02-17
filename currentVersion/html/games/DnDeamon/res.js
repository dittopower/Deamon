/*
Resources - Files, Images, Sound, Data
*/

//files

//audio
audio_crit_sucess = "yay.m4a";
audio_crit_failure = "fail.m4a";

//Data
Abilities = ["STR","DEX","CON","INT","WIS","CHA"];
Skills = ["Acrobatics", "Appraise", "Bluff", "Climb", "Craft", "Diplomacy", "Disable Device", "Disguise", "Escape Artist", "Fly", "Handle Animal", "Heal", "Intimidate", "Knowledge Arcana", "Knowledge Dungeoneering", "Knowledge Engineering", "Knowledge Geography", "Knowledge History", "Knowledge Local", "Knowledge Nature", "Knowledge Nobility", "Knowledge Planes", "Knowledge Religion", "Linguistics", "Perception", "Perform", "Profession", "Ride", "Sense Motive", "Sleight of Hand", "Spellcraft", "Stealth", "Survival", "Swim", "Use Magic Device"];
Sizes = [];
Sizes.push(new Size("Fine",			8,	-8,	8,	16,		0.5,	0,	[0.5,">"],	[0.125,">"]));
Sizes.push(new Size("Diminutive",	4,	-4,	6,	12,		1,		0,	[1,">"],	[1,">"]));
Sizes.push(new Size("Tiny",			2,	-2,	4,	8,		2.5,	0,	[2,">"],	[8,">"]));
Sizes.push(new Size("Small",		1,	-1,	2,	4,		5,		5,	[4,">"],	[60,">"]));
Sizes.push(new Size("Medium",		0,	0,	0,	0,		5,		5,	[8,">"],	[500,">"]));
Sizes.push(new Size("Large",		-1,	1,	-2,	-4,		10,		10,	[16,">"],	[4000,">"]));
Sizes.push(new Size("Huge",			-2,	2,	-4,	-8,		15,		15,	[32,">"],	[32000,">"]));
Sizes.push(new Size("Gargantuan",	-4,	4,	-6,	-12,	20,		20,	[64,">"],	[250000,">"]));
Sizes.push(new Size("Colossal",		-8,	8,	-8,	-16,	30,		30,	[64,"<"],	[250000,"<"]));

EnergyTypes = ["damage", "positive", "negative", "acid", "cold", "electricity", "fire", "sonic"];

//Potential Circumstances
Circumstances = []; cStatus = [];
Circumstances.push("light"); cStatus.push("normal");
Circumstances.push("Subtype"); cStatus.push("");
Circumstances.push("Opposed"); cStatus.push(false);
Circumstances.push("Source"); cStatus.push("");

//spell & abilities
/*
name - 
type - ability, spell-like ability, spell
range -  base, rate, stat, per (100 + 10 level / 2)
targets - base, rate, stat, per
area - base, rate, stat, per
dmg - base, number, dice, base per dice
	base - base, rate, stat, per
	number - base, rate, stat, per 
	per dice - base, rate, stat, per 
schools - [main, subschool]
spell resistance - y/n
saves - [type,result],...
cast time - time
duration - time
*/

