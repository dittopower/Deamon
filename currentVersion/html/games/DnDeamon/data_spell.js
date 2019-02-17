ClassSpells = {spell:[],class:[],level:[]};
function classspell(spell,clas,lv){
	ClassSpells.spell.push(find_Castable(spell));
	ClassSpells.class.push(clas);
	ClassSpells.level.push(lv);
}
function castable(name,type,range,targets,area,dmg,school, sub, sp, saves, ct, duration,effect,des,comp,classlv){
	Castable.push([name,type,range,targets,area,dmg,school,sub,sp,saves,ct,duration,effect,des,comp]);
	for(var i = 0; i < classlv.length; i++){
		classspell(name,classlv[i][0],classlv[i][1]);
	}
}

//Castable.push(["Name","Type",["range"],["targets"],["area"],["dmg"],"School", "Subschool","spell resistance",["saves"],"cast time","duration","effect","Description","Components"]);
castable("Magic Missile","Spell",
	scale(100,10,"Level",1),
	scale(1,1,"Level",2,1,5),
	null,
	[[scale(1),scale(4),scale(1),"Force"]],
	"Evocation", "Force",
	true,
	null,
	[1,"standard"],
	null,
	null,
	"A missile of magical energy darts forth from your fingertip and strikes its target, dealing 1d4+1 points of force damage.<br>The missile strikes unerringly, even if the target is in melee combat, so long as it has less than total cover or total concealment. Specific parts of a creature can't be singled out. Objects are not damaged by the spell.<br>For every two caster levels beyond 1st, you gain an additional missile - two at 3rd level, three at 5th, four at 7th, and the maximum of five missiles at 9th level or higher. If you shoot multiple missiles, you can have them strike a single creature or several creatures. A single missile can strike only one creature. You must designate targets before you check for spell resistance or roll damage.",
	"V, S",
	[["bloodrager",1],["magus",1],["sorcerer",1],["wizard",1]]
);
castable("Acid Splash","Spell",
	scale(25,5,"Level",2),
	scale(1),
	null,
	[[scale(1),scale(3),scale(), "acid"]],
	"Conjuration", "Acid",
	false,
	null,
	[1,"standard"],
	scale(1),
	null,
	"You fire a small orb of acid at the target. You must succeed on a ranged touch attack to hit your target. The orb deals 1d3 points of acid damage. This acid disappears after 1 round.",
	"V, S",
	[["inquisitor",0],["magus",0],["sorcerer",0],["wizard",0],["summoner",0],["unchained summoner",0],["witch",0]]
);


castable("Dancing Lights","Spell",
	scale(100,10,"Level",1),
	null,
	null,
	null,
	"Evocation", "light",
	false,
	null,
	[1,"standard"],
	scale(10),
	null,
	"You create up to four lights that resemble lanterns or torches (and cast that amount of light), or up to four glowing spheres of light (which look like will-o'-wisps), or one faintly glowing, vaguely humanoid shape. The dancing lights must stay within a 10-foot-radius area in relation to each other but otherwise move as you desire (no concentration required): forward or back, up or down, straight or turning corners, or the like. The lights can move up to 100 feet per round. A light winks out if the distance between you and it exceeds the spell's range.",
	"V, S",
	[["bard",0],["magus",0],["shaman",0],["sorcerer",0],["wizard",0],["witch",0]]
);
castable("Darkness","Spell",
	"touch",
	null,
	scale(20),
	null,
	"Evocation", "darkness",
	false,
	null,
	[1,"standard"],
	scale(0,1,"Level",1),
	null,
	"This spell causes an object to radiate darkness out to a 20-foot radius. This darkness causes the illumination level in the area to drop one step, from bright light to normal light, from normal light to dim light, or from dim light to darkness. This spell has no effect in an area that is already dark. Creatures with light vulnerability or sensitivity take no penalties in normal light. All creatures gain concealment (20% miss chance) in dim light. All creatures gain total concealment (50% miss chance) in darkness. Creatures with darkvision can see in an area of dim light or darkness without penalty. Nonmagical sources of light, such as torches and lanterns, do not increase the light level in an area of darkness. Magical light sources only increase the light level in an area if they are of a higher spell level than darkness.",
	"V, M/DF (bat fur and a piece of coal)",
	[["antipaladin",2],["bard",2],["cleric",2],["oracle",2],["inquisitor",2],["magus",2],["shaman",2],["sorcerer",2],["wizard",2]]
);
castable("Faerie Fire","Spell",
	scale(400,40,"Level",1),
	null,
	scale(5),
	null,
	"Evocation", "light",
	true,
	null,
	[1,"standard"],
	scale(10),
	null,
	"A pale glow surrounds and outlines the subjects. Outlined subjects shed light as candles. Creatures outlined by faerie fire take a -20 penalty on all Stealth checks. Outlined creatures do not benefit from the concealment normally provided by darkness (though a 2nd-level or higher magical darkness effect functions normally), blur, displacement, invisibility, or similar effects. The light is too dim to have any special effect on undead or dark-dwelling creatures vulnerable to light.",
	"V, S, DF",
	[["druid",1]]
);