function radioGUI(data){

	var options = data.parentElement.children;

	var a;

	for(i = 0; i < options.length; i++){

		if(options[i].checked){

			a=options[i].id;

		}

		if(options[i].tagName == "LABEL"){

			if(options[i].attributes.getNamedItem("for").value == a){

				options[i].style.background="rgba(100,100,200,0.7)";

			}else{

				options[i].style.background="white";

			}

		}

	}

}

function checkGUI(data){

	if(data.checked){

		var options = data.parentElement.children;

		for(i = 0; i < options.length; i++){

			if(/tick.png/.test(options[i].src)){

				options[i].style.background="rgba(100,100,200,0.7)";

			}else if(/cross.png/.test(options[i].src)){

				options[i].style.background="white";

			}

		}

	}else{

		var options = data.parentElement.children;

		for(i = 0; i < options.length; i++){

			if(/tick.png/.test(options[i].src)){

				options[i].style.background="white";

			}else if(/cross.png/.test(options[i].src)){

				options[i].style.background="rgba(100,100,200,0.7)";

			}

		}

	}

}

function check(data){

	var options = data.parentElement.children;

	for(i = 0; i < options.length; i++){

		if(options[i].tagName == "INPUT"){

			options[i].checked=(/tick.png/.test(data.src));

			checkGUI(options[i]);

		}

	}

}

function tally(thing){

	tall=document.getElementsByName(thing.id)[0];

	tall.value= parseInt(tall.value) + parseInt(thing.children[0].innerHTML);

}





function slide(thing){

	var quest = /q[0-9]+/.exec(thing.id);

	var value = /v([0-9])+/.exec(thing.id)[1];

	slider=document.getElementsByName(quest)[0];

	slider.value= parseInt(value);

	slideto(document.getElementsByName(quest)[0]);

}



function slideto(thing){

	var quest = thing.id + 'v' + thing.value;

	for(i=0;i < thing.parentElement.childElementCount;i++){

		if(thing.parentElement.children[i].tagName == 'DIV'){

			if(thing.parentElement.children[i].id == quest){

				thing.parentElement.children[i].className = "radioactive";

			}else{

				thing.parentElement.children[i].className = "radio";

			}

		}

	}

}