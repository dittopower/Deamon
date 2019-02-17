<?php
	require_once "/var/www/html/lib.php";
	page();
if($debug){
bugs();
} else{
echo "POST: ";
var_dump($_POST);
?>
<hr>
<script>
/*Validating a number form
* with jQuery
*/

var msg = $("<div id=formmsg>");
var min = 1;
var max = 10;

function checform(){
//Get input
var input = $('#mynum');
//get value
var num = input.val();

//msg reset
input.after(msg);
msg.empty();
msg.slideUp();

//min
if(num < min){
msg.text("The Minimum Number is " + min + ".");
msg.slideDown();
return false;
}

//max
if(num > max){
msg.text("The Maximum Number is " + max + ".");
msg.slideDown();
return false;
}

return true;
}
</script>
<form method=POST onsubmit='return checform();'>
<input id=mynum name=hi type="NUMBER" value='3' pattern="[0-9]*">
<br><input type='submit'>
</form>
<?php }?>