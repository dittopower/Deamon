Deamon
======

My Personal Site for hosting stuff and Coding Projects

Use the folowing to import defualt functions and style stuff:
<?php
  $layers = substr_count($_SERVER["PHP_SELF"],"/");
  $home = "";
  for($i = 1;$i < $layers;$i++){
    $home .= "../";
  }
  include $home."page.php";
?>

