<?php
	require_once "/home3/deamon/public_html/lib.php";
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
                        eval(last);
                    }
                }
                if(charCode == 13){
                    eval(last);
                }
            }

            var data;
			var last;
			var colour;
			var dicefeed;

            function setup(){              
                data = Array();
				data['red'] = Array();
				data['green'] = Array();
				data['blue'] = Array();
				colour = '';
				last = "dice_roll(6)";
				dicefeed = $("#roll_feed")[0];
				loaddata();
            }
			
			function savedata(){
				if(typeof(Storage) !== "undefined") {
					localStorage.setItem("dice-green", JSON.stringify(data['green']));
					localStorage.setItem("dice-red", JSON.stringify(data['red']));
					localStorage.setItem("dice-blue", JSON.stringify(data['blue']));
				} else {
					console.log("Local Storage not avalible.....");
				}
			}
			window.onunload = savedata;
			
			function loaddata(){
				if(typeof(Storage) !== "undefined") {
					if(localStorage.getItem("dice-green") != null){
						data['green']=JSON.parse(localStorage.getItem("dice-green"));
					}
					if(localStorage.getItem("dice-red") != null){
						data['red']=JSON.parse(localStorage.getItem("dice-red"));
					}
					if(localStorage.getItem("dice-blue") != null){
						data['blue']=JSON.parse(localStorage.getItem("dice-blue"));
					}
				} else {
					console.log("Local Storage not avalible.....");
				}
			}
			
			function random (max,min){
				if (min === undefined){
					  min = 0;
				}
				return Math.floor(Math.random()*max+min);
			}
			
			function dice(num){
				return random(num,1);
			}
			
			function dice_roll (num){
				d = dice(num);
				msg("Rolled a d"+num+": "+d);
				display(d);
				last = "dice_roll("+num+")";
			}
			
			function coin(){
				if(random(1)){
					d = "Heads";
				}else{
					d = "Tails";
				}
				msg("Flipped a coin: "+d);
				display(d);
				last = "coin()";
			}
			
			function msg(what){
				if(colour != ""){
					data[colour].push(what);
				}
				dicefeed.innerHTML += "<div>" + what + "</div>";
				dicefeed.lastChild.scrollIntoViewIfNeeded();
			}
			
			function display (what){
				$("#roll_result")[0].innerHTML = what;
			}
			
			function color(which){
				colour = which;
				dicefeed.innerHTML = "";
				switch(which){
					case 'green':
						$('#roll_feed').css('background-color','rgba(0,255,0,0.4)');
						break;
					case 'blue':
						$('#roll_feed').css('background-color','rgba(0,0,255,0.4)');
						break;
					case 'red':
						$('#roll_feed').css('background-color','rgba(255,0,0,0.4)');
						break;
					default:
						$('#roll_feed').css('background-color','rgba(0,0,0,0.1)');
						break;
				}
				data[colour].forEach(function(what){dicefeed.innerHTML += "<div>" + what + "</div>";})
				dicefeed.lastChild.scrollIntoViewIfNeeded();
			}
			
			function dice_clear(which){
				if(confirm("Erase "+which + " dice log?")){
					if(colour == which){
						dicefeed.innerHTML = "";
					}
					data[which] = Array();
				}
			}
			
        </script>
	
        <div id="arena" onkeypress="javascript:return isNumberKey(event);">
			<div id=button_array class='half'>
			<h2>What do you want to roll?</h2>
			<span class='obj dice' onclick="coin()">Coin</span>
			<span class='obj dice' onclick="dice_roll(3)">3</span>
			<span class='obj dice' onclick="dice_roll(4)">4</span>
			<span class='obj dice' onclick="dice_roll(6)">6</span>
			<span class='obj dice' onclick="dice_roll(8)">8</span>
			<span class='obj dice' onclick="dice_roll(10)">10</span>
			<span class='obj dice' onclick="dice_roll(12)">12</span>
			<span class='obj dice' onclick="dice_roll(20)">20</span>
			<span class='obj dice' onclick="dice_roll(100)">100</span>
			<span class='obj dice'>
				<input id='custom_dice' type='number' value=50>
				<button onclick="dice_roll($('#custom_dice').val())">Custom Roll</button>
			</span>
			</div>
			<hr>
			<div id="dice_feed" class='half'>
				<h2>Dice Log</h2>
				<span class='clear log_color' onclick='color("")'></span>
				<span class='green log_color' onclick='color("green")'></span>
				<span class='blue log_color' onclick='color("blue")'></span>
				<span class='red log_color' onclick='color("red")'></span>
				<p>Coloured Logs will remember what you rolled between sessions.</p>
				<div id='roll_feed'></div>
				<p style="display:inline-block;">Clear Log:</p>
				<span class='clear log_color c' onclick='dice_clear("")'></span>
				<span class='green log_color c' onclick='dice_clear("green")'></span>
				<span class='blue log_color c' onclick='dice_clear("blue")'></span>
				<span class='red log_color c' onclick='dice_clear("red")'></span>
				<div id="roll_result"></div>
			</div>
        </div>
        <script>setup();</script>