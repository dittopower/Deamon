<?php
	require_once "/var/www/html/lib.php";
	page();
	?>
	
	<script>
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                //console.log(charCode);
                if(playing){
                    if ((charCode > 64 && charCode < 91)||(charCode > 96 && charCode < 123)) {
                        check(String.fromCharCode(charCode));
                    }else{
                        msg("Invalid Character");
                    }
                }else{
                    if(charCode == 32){
                        reset();
                    }
                }
                if(charCode == 13){
                    reset();
                }
            }
			function getwords(q,l){
				p = new XMLHttpRequest();
				address = "/wordnet?op=words" + "&limit="+q + "&mine="+l;//q is quantity of words, l is max length of words
				p.open("GET",address,false);
				p.send(null);
				timer = window.setInterval(applywords,500);
			}
			function applywords(){
				if(p.status == 200){
					mybool = words.length < 1;
					words=words.concat(JSON.parse(p.responseText));
					window.clearInterval(timer);
					console.log("got words!");
					if(mybool){
						reset();
					}
				}else if(p.status == 404){
					window.clearInterval(timer);
					console.log("404");
					getwords(100,maxlength);
				}
			}
            var words;
            var pic;
            var cword;
            var cscore;
            var hscore;
            var tletters;
			var myletters;
            var winfo;
            var cur;
            var fails;
            var playing;
			var score;
			var maxlength;
			var rql;

            function check (letter){
				if(playing){
					reg = RegExp(letter,"i");
					result = "";
					
					if(words[cur].word.search(reg)>-1){
						//console.log(letter);
						msg("Right!");
						nword = "";
						for(i = 0; i < words[cur].word.length;i++){
							l = words[cur].word[i];
							if(l.toUpperCase() == letter.toUpperCase()){
								nword += l;
							}else{
								nword += cword.innerHTML[i];
							}
						}
						cword.innerHTML = nword;
						if(cword.innerHTML.search(/_/) < 0){
							msg("You win!!");
							pic.src = "win.png";
							playing = false;
							myscore = calc_score(words[cur].word.length,fails);
							cscore.innerHTML = myscore;
							score += myscore;
							hscore.innerHTML = score;
						}
						result = "sucess";
					}else{
						fails++;
						msg("Wrong!");
						pic.src = fails+".png";
						if(fails > 12){
							msg("Failure! (Your Dead...)<br>The word was "+words[cur].word+".");
							playing = false;
							cscore.innerHTML = 0;
						}
						result = "failure";
					}
					
					
					for(i = 0; i < tletters.children.length; i++){
						if(tletters.children[i].innerHTML.search(reg)> -1){
							tletters.children[i].className += " " + result;
						}
					}
					
				}
            }
			
			function reveal(){
				if(score >= 10){
					score -= 10;
					hscore.innerHTML = score;
					check(words[cur].word[Math.round( Math.random()*100) % words[cur].word.length]);
					msg("Letter revealed!");
				}else{
					msg("Not enough points you need 10 Points");
				}
			}
			
			function chancereveal (){
				if(score >= (words[cur].word.length*5)){
					score -= (words[cur].word.length*5);
					hscore.innerHTML = score;
					mycounter = 0;
					chancefor = 0;
					revealler = window.setInterval(crevealing,200);
				}else{
					msg("Not enough points you need " + (words[cur].word.length*10) + " Points");
				}
			}
			
			function crevealing(){
				if(Math.random() > 0.85){
					check(words[cur].word[chancefor]);
					mycounter++;
				}
				chancefor++;
				if(chancefor >= words[cur].word.length){
					msg(mycounter + " of " + words[cur].word.length + " letters revealed!");
					window.clearInterval(revealler);
				}else{
					msg("Random Revealing");
				}
			}

            function msg (text){
                winfo.innerHTML = text;
            }

            function setup(){              
                words = Array();
				maxlength = 12;
                cword = document.getElementById("cur_word");
                tletters = document.getElementById("button_array");
                winfo = document.getElementById("word_info");
                pic = document.getElementById("hanging");
                cscore = document.getElementById("Currentscore");
                hscore = document.getElementById("Highscore");
				rql = document.getElementById("rql");
				document.getElementsByTagName("body")[0].onkeypress=isNumberKey;
				if(document.cookie.search(/score:([0-9]*)/)>-1){
					score = parseInt(document.cookie.match(/score:([0-9]*)/)[1]);
				}else{
					score = 0;
				}
				hscore.innerHTML = score;
				reloadwords();
                reset();
            }

            function reset(){
				words.pop();
				if(words.length < 15){
					getwords(100,maxlength);
				}
                msg("Can you guess the Word?");
				cscore.innerHTML=0;
                playing = true;
				myletters = [];
                cur = words.length-1;
                fails = 0;
                cword.innerHTML = "";
                for(i = 0; i < words[cur].word.length;i++){
					if(words[cur].word[i] == "_"){
						cword.innerHTML += " ";
					}else if ((words[cur].word[i].charCodeAt(0) > 64 && words[cur].word[i].charCodeAt(0) < 91)||(words[cur].word[i].charCodeAt(0) > 96 && words[cur].word[i].charCodeAt(0) < 123)){
						cword.innerHTML += "_";
					}else{
						cword.innerHTML += words[cur].word[i];
					}
                }
                pic.src = "";
				
				for(i = 0; i < tletters.children.length; i++){
					tletters.children[i].className = "obj";
				}
            }
			
			function calc_score (s,m){
				return Math.round(s*Math.pow(s,m*-0.1)*4);
			}
			
			function setmaxlength(l){
				maxlength = l.value;
				rql.innerHTML = "Maximum word length: "+maxlength;
				words = [words[cur]];
				cur = 0;
				getwords(100,maxlength);
			}
			
			function savewords(){
				if(typeof(Storage) !== "undefined") {
					localStorage.setItem("mywords", JSON.stringify(words));
					localStorage.setItem("maxlength", maxlength);
				} else {
					console.log("Local Storage not avalible.....");
				}
				document.cookie = "score:"+score;
			}
			
			function reloadwords(){
				if(typeof(Storage) !== "undefined") {
					if(localStorage.getItem("mywords") != null){
						words=JSON.parse(localStorage.getItem("mywords"));
					}
					if(localStorage.getItem("maxlength") != null){
						maxlength=JSON.parse(localStorage.getItem("maxlength"));
						rql.innerHTML = "Maximum word length: "+maxlength;
					}
				} else {
					console.log("Local Storage not avalible.....");
				}
			}
			
			window.onunload = savewords;
        </script>
	
        <div id="arena" onkeypress="javascript:return isNumberKey(event);">
			<span onclick="reset()" class=obj>New Game</span><p style="display:inline-block;font-size: 1.5em;"> or Press 'enter'.   <label id=rql for=rqlength>Maximum word length: 12</label></p><input id=rqlength type=range min=4 max=50 value=12 step=1 onchange="setmaxlength(this)">
			<hr>
			<h3 id=scoreboard>Last Score:<span id=Currentscore></span>  Overall Score:<span id=Highscore></span></h3>
			<h2 id="cur_word" style="letter-spacing: 0.25em;font-size: 3em;">_ _ _ _ _ _ _ _</h2>
            <img id=hanging height=200px width=200px>
			<h1 id="word_info"></h1>
			<hr><p style="font-size: 1.5em;">Pick a letter or use your Keyboard.</span>
			<div id=button_array>
			<span class=obj onclick="check(this.innerHTML)">A</span>
			<span class=obj onclick="check(this.innerHTML)">B</span>
			<span class=obj onclick="check(this.innerHTML)">C</span>
			<span class=obj onclick="check(this.innerHTML)">D</span>
			<span class=obj onclick="check(this.innerHTML)">E</span>
			<span class=obj onclick="check(this.innerHTML)">F</span>
			<span class=obj onclick="check(this.innerHTML)">G</span>
			<span class=obj onclick="check(this.innerHTML)">H</span>
			<span class=obj onclick="check(this.innerHTML)">I</span>
			<span class=obj onclick="check(this.innerHTML)">J</span>
			<span class=obj onclick="check(this.innerHTML)">K</span>
			<span class=obj onclick="check(this.innerHTML)">L</span>
			<span class=obj onclick="check(this.innerHTML)">M</span>
			<span class=obj onclick="check(this.innerHTML)">N</span>
			<span class=obj onclick="check(this.innerHTML)">O</span>
			<span class=obj onclick="check(this.innerHTML)">P</span>
			<span class=obj onclick="check(this.innerHTML)">Q</span>
			<span class=obj onclick="check(this.innerHTML)">R</span>
			<span class=obj onclick="check(this.innerHTML)">S</span>
			<span class=obj onclick="check(this.innerHTML)">T</span>
			<span class=obj onclick="check(this.innerHTML)">U</span>
			<span class=obj onclick="check(this.innerHTML)">V</span>
			<span class=obj onclick="check(this.innerHTML)">W</span>
			<span class=obj onclick="check(this.innerHTML)">X</span>
			<span class=obj onclick="check(this.innerHTML)">Y</span>
			<span class=obj onclick="check(this.innerHTML)">Z</span>
			</div>
			<hr>
			<h1>Cheats</h1>
			<span onclick="reveal()" class=obj>1 Letter: 10 Score</span>
			<span onclick="chancereveal()" class=obj>Random Letters: x5 Score</span>
			<hr>
			<p>Words are drawn from <a href="https://wordnet.princeton.edu/">WordNet</a>, a lexical database of the english language. The Database was created by Princeton University and contains some phrases, abreviations & scientific terminology. As such you may not be familar with some words.</p>
        </div>
        <script>setup();</script>
		<span hidden>
		<img src="1.png">
		<img src="2.png">
		<img src="3.png">
		<img src="4.png">
		<img src="5.png">
		<img src="6.png">
		<img src="7.png">
		<img src="8.png">
		<img src="9.png">
		<img src="10.png">
		<img src="11.png">
		<img src="12.png">
		<img src="13.png">
		<img src="win.png">
		</span>