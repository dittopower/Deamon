<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();
	?>
	
	<script>
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                console.log(charCode);
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
            var words;
            var pic;
            var cword;
            var cscore;
            var hscore;
            var tletters;
            var winfo;
            var cur;
            var fails;
            var playing;
			var score;

            function check (letter){
				if(playing){
					tletters.innerHTML += letter + " ";
					reg = RegExp(letter,"i");
					
					if(words[cur].search(reg)>-1){
						//console.log(letter);
						msg("Right!");
						nword = "";
						for(i = 0; i < words[cur].length;i++){
							l = words[cur][i];
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
							myscore = calc_score(words[cur].length,fails);
							cscore.innerHTML = myscore;
							score += myscore;
							hscore.innerHTML = score;
							document.cookie = "score:"+score;
						}
					}else{
						fails++;
						msg("Wrong!");
						pic.src = fails+".png";
						if(fails > 12){
							msg("Failure! (Your Dead...)<br>The word was "+words[cur]+".");
							playing = false;
							cscore.innerHTML = 0;
						}
					}
				}
            }

            function msg (text){
                winfo.innerHTML = text;
            }

            function setup(){              
                words = ['pie','dog','swaglords','test','jokes','aaaaaah','yoloswag hashtag','pizza','party',"alphabet","mountain dew"];
                cword = document.getElementById("cur_word");
                tletters = document.getElementById("tried");
                winfo = document.getElementById("word_info");
                pic = document.getElementById("hanging");
                cscore = document.getElementById("Currentscore");
                hscore = document.getElementById("Highscore");
				document.getElementsByTagName("body")[0].onkeypress=isNumberKey;
				if(document.cookie.search(/score:([0-9]*)/)>-1){
					score = parseInt(document.cookie.match(/score:([0-9]*)/)[1]);
				}else{
					score = 0;
				}
                reset();
				hscore.innerHTML = score;
            }

            function reset(){
                msg("Can you guess the Word?");
				cscore.innerHTML=0;
                playing = true;
				tletters.innerHTML = " ";
                cur = Math.round(Math.random()*10);
                fails = 0;
                cword.innerHTML = "";
                for(i = 0; i < words[cur].length;i++){
					if(words[cur][i] == "_"){
						cword.innerHTML += " ";
					}else if ((words[cur][i].charCodeAt(0) > 64 && words[cur][i].charCodeAt(0) < 91)||(words[cur][i].charCodeAt(0) > 96 && words[cur][i].charCodeAt(0) < 123)){
						cword.innerHTML += "_";
					}else{
						cword.innerHTML += words[cur][i];
					}
                }
                pic.src = "";
            }
			
			function calc_score (s,m){
				return Math.round(s*Math.pow(s,m*-0.2)*4);
			}
        </script>
	
        <div id="arena" onkeypress="javascript:return isNumberKey(event);">
			<h3 id=scoreboard>Last Score:<span id=Currentscore></span>  High Score:<span id=Highscore></span></h3>
			<h2 id="cur_word" style="letter-spacing: 0.25em;font-size: 3em;">_ _ _ _ _ _ _ _</h2>
            <img id=hanging height=200px width=200px>
			<h1 id="word_info"></h1>
			<hr><p style="font-size: 1.5em;">Letters Tried:</span>
            <h3 id="tried" style="color:rgb(150,0,0);"> </h3>
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
			<span onclick="reset()" class=obj>New Game</span><p style="display:inline-block;font-size: 1.5em;"> or Press 'enter'</p>
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
		</span>