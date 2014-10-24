<?php if(checkFilePermission(__FILE__, $mysqli)){?>
<br><hr><br><center><input type="button" value="Export data to PDF" onclick="window.location='./exporttopdf.php?id=<?php echo $_GET['id']; ?>'"></center>
<?php } ?>