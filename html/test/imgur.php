<?php
	require_once "/var/www/html/lib.php";
	page();

	
?>
<script>
function get_images_imgur(ofwhat){
	ofwhat.replace(/\s/,"+");
	$.get("https://api.imgur.com/3/topics/"+ofwhat,function(data){
	result = data.match(/\/\/i\.imgur\.com\/[A-Za-z0-9]+\.[A-Za-z]+/mg);
	});
}

function update_image(ofwhat){
get_images_imgur(ofwhat);
$("img.hint").toArray().forEach(function(image){
image.src=result[Math.round(Math.random() * 100 % result.length)];
console.log(image);
});
}
</script>

<img class="hint" src='//i.imgur.com/VL7Iuamb.jpg'>
<img class="hint">
<img class="hint">
<img class="hint">