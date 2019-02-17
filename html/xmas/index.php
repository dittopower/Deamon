<?php
	require_once "/var/www/html/lib.php";
	page();
if(isset($_POST['ans'])){
if($_POST['ans'] == 3){
echo "<h2 style='color:green;'>Congratulations</h2><p>Merry Christmas Grandma, this one's for you.</p>";
}else{
echo "<h2 style='color:red;'>Wrong!!</h2><p>Naughty, naughty... I guess you don't want anyone to get their presents.</p>";
}
}else{
echo "<h1>Naughty||Nice Test</h1>";
}
echo "<img src='https://lh3.googleusercontent.com/tQkFmPtuagRfcbb_AKxX_Ot1sfYj-c3DXFl0bkKUp2yXmfDDY4AqI0P-I-obg5aRdggRR7CQiBf6rzY1MP5bA6AvFFekvEuc_XPHzOKBmt0sKNoMtpZN85keK2N6cCOhFEvvszttEdWzgMmTWzHP3PaGc166B9tQhDr12xZUj5kElqCZJo7c-2T8oKRo9i1zfbuX0yTVGrgBDNj1eJrvGW-t9LcK3eTZ9XgJaU_pjuHFgksQh0xBZXhRii90wXylZecVI_6eTAMe20VsmDyKAfrrR-l2uShJEZzmM_5mSrgfkFG0V1fDChaYt_Qhc-udV6lpt40dLKM1funq7TtMDhB9RAExhU03-oFfzjpcflTOjJFlB7ly2gt5f2Dyj9FJfe66_Rxt1ZbHjsgcAGFA8l3Zgdi9z95AaKDEzb_sx2wuS8xH2Kdmstu1VBAMqiVIZXkNjlc_Ky8S_oY3LaYSVl9trITMUudFQwfZB2X-dPxsfxtwJ2Xb1LH9CQtH3-M7DzY0dZ_HK1BGKg95z6jEgKQdEBB4_10Fwi02_qCxoHH4KR5-X6tSki1UdTSI55Wn63cg271ajp09UG8ptvpQRHEBD6KQ2pDnAyEngpqZz6lf2Ls5FMjXiSzcFV9E__DK7NNhd2xybqzSvPmkbc_AjY-iT370MQ6adN1Q8rgR6g=w713-h951-no'  height='40%'/>";
if(($_POST['ans'] != 3)){
?>
<hr>
<form method=post>
<label for=question>What is the first prime digit of pi?</label><br><br>
<input type=text id=question name=ans placeholder='66'>
<input type=submit>
</form>

<?php
}
?>
	<div id="space">
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
		<div class="stars"></div>
	</div>
<style>
#page{
background:none;
}
html{
background:white;
}
	#space, .stars {
		overflow: hidden;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
	}
#space{
position:fixed;
}

	.stars {
		/*z-index: -30;*/
		background-image: 
			radial-gradient(2px 2px at 20px 30px, #8bc34a, rgba(0,0,0,0)),
			radial-gradient(2px 2px at 40px 70px, #f44336, rgba(0,0,0,0)),
			radial-gradient(2px 2px at 50px 160px, #4caf50, rgba(0,0,0,0)),
			radial-gradient(2px 2px at 90px 40px, #ff5722, rgba(0,0,0,0)),
			radial-gradient(2px 2px at 130px 80px, #689f38, rgba(0,0,0,0)),
			radial-gradient(2px 2px at 160px 120px, #e64a19, rgba(0,0,0,0));
		background-repeat: repeat;
		background-size: 200px 200px;
		animation: zoom 5s infinite;
		-webkit-animation: zoom 5s infinite;
		opacity: 0;
	}

	.stars:nth-child(1) {
		background-position: 50% 50%;
		animation-delay: 0s;
		-webkit-animation-delay: 0s;
	}

	.stars:nth-child(2) {
		background-position: 20% 60%;
		animation-delay: 1s;
		-webkit-animation-delay: 1s;
	}

	.stars:nth-child(3) {
		background-position: -20% -30%;
		animation-delay: 2s;
		-webkit-animation-delay: 2s;
	}

	.stars:nth-child(4) {
		background-position: 40% -80%;
		animation-delay: 3s;
		-webkit-animation-delay: 3s;
	}

	.stars:nth-child(5) {
		background-position: -20% 30%;
		animation-delay: 4s;
		-webkit-animation-delay: 4s;
	}

	@keyframes zoom {
		100% {
		opacity: 0;
		transform: scale(0.5);
		animation-timing-function: ease-in;
		} 
		45% {
		opacity: 1;
		transform: scale(2.8);
		animation-timing-function: linear;
		}
		0% {
		opacity: 0;
		transform: scale(3.5);
		}
	}

	@-webkit-keyframes zoom {
		100% {
		opacity: 0;
		transform: scale(0.5);
		-webkit-animation-timing-function: ease-in;
		} 
		45% {
		opacity: 1;
		transform: scale(2.8);
		-webkit-animation-timing-function: linear;
		}
		0% {
		opacity: 0;
		transform: scale(3.5);
		}
	}
</style>
