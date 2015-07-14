<?php //Load Template
	$layers = substr_count($_SERVER["PHP_SELF"],"/");
	$home = "";
	if($layers <= 1){
		$home = "./";
	}else{
		for($i = 1;$i < $layers;$i++){
			$home .= "../";
		}
	}
	require $home."hidden/deamon.php";
	require $home."hidden/start.php";
	require $home."hidden/nav.php";
?>
<!-- START content -->

	<?php if(canUser("edit")){
		$base_dir = getUserPerm("edit");
		if($base_dir == ''){
			$base_dir = "this_guy_doesn't_have_a_base";
		}
			
		if(isset($_POST['url'])){
			$url = $_POST['url'];
		}else if(isset($_GET['url'])){
			$url = $_GET['url'];
		}else{
			$url = $base_dir;
		}
		$text="";
		
		function loadpage($url){
			if (file_exists($url)){
				$text = file_get_contents($url);
				$text = htmlescape($text);
			}else{
				$text = "Page Not Found";
			}
			return $text;
		}
		
		
	//can use this directory?
		$pattern = "/^".preg_replace("/\//","\\/",$base_dir)."([\/#\?].*|)$/";
		debug($pattern);
		debug($url);
		if(preg_match($pattern, $url)){
			
		//save
			if($_POST['action']=='Save'&&isset($_POST['content'])){
				$content = $_POST['content'];
				$content = stripslashes($content);
				$content = htmlunescape($content);
				
				$handle = fopen($home.$url, "w");
				fwrite($handle,$content);
				fclose($handle);
				//file_put_contents($url,$content);
			}else if($_POST['action']=='Delete'){
				unlink($home.$url);
			}
		
		//load
			if(isset($_POST['url']) || isset($_GET['url'])){
				$text = loadpage($home.$url);
			}
			
			$url2 = $home.$url;
			
		}else{
			$text = "Forbidden Directory";
			$url2 = "//deamon.info/error.php?e=403&u=$url";
		}
	?>
		<div id="console" class="horizonal_half">
			<div id="controlbox">
				<form class="controls" name="controls" method="GET">
					<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>" >
					<input type="submit" id="file_button" value="Load">
					<a href="<?php echo $url;?>" target="_newtab">Open</a>
				</form> 
				<form class="controls" name="Delete" method="POST">
					<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>">
					<input type="submit" id="del_button" name="action" value="Delete">
				</form>
				
				<hr>
				<form name="save" method="POST">
					<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>">
					<input type="submit" id="save_button" name="action" value="Save">
					<hr class='spacer'>
					<?php debug($_POST['content']);?>
					<textarea id="coding_area" name="content" autofocus><?php echo $text; ?></textarea>
				</form>
			</div>
			
		</div>
		
		
		<div id="viewer" class="horizonal_half">

			<iframe src="<?php echo "$url2"; ?>" name="current_page" id="current_page" sandbox="allow-same-origin allow-forms allow-scripts">
			
		</div>

	<?php }else echo "<META http-equiv='refresh' content='0;URL=/error.php?e=403'>"; ?>

<!-- END content -->
<?php
	require $home."hidden/end.php";
?>