<?php
	require_once "/var/www/html/lib.php";
	page();
?>
<script src="https://alexgibson.github.io/notify.js/js/notify.js" type="text/javascript"></script>

<script>
var myNotification = new Notify('Yo dawg!', {
    body: 'This is an awesome notification',
    notifyShow: onNotifyShow
});

function onNotifyShow() {
    console.log('notification was shown!');
}
function showme(){
myNotification.show();
}
setTimeout(showme,1000);
</script>