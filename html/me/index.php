<?php //Load Template
require_once "/var/www/html/lib.php";
page();
lib_register();

//START content
if(isUser()){
echo "user info page coming sometime.<br>";
echo "Dont like my colour scheme <a href='./customise'>customise</a> it.";
}else{
//register
reg_form();
}
//END content
?>