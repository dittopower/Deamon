<?php //Load Template
	$home = $_SERVER['DOCUMENT_ROOT']."/";
	require_once $home."page.php";
	require_once $home."../core/files.php";
?>
<!-- START content -->

<?php
	enforce_perm("access");
	$base_dir = getUserPerm("access");
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
	//$pattern = "/^".preg_replace("/\//","\\/",$base_dir)."([\/#\?].*|)$/";
	//debug($pattern);
	debug($url);
	if(dir_access("access", $url)){
		
	//save
		if($_POST['action']=='Save'&&isset($_POST['content'])){
			dir_Ensure($home.$url);
			$content = $_POST['content'];
			
			Ndebug("input1",substr_count($content,"\n"));
			
			$content = htmlunescape($content);
			$content = d_text($content);
			
			Ndebug("input2",substr_count($content,"\n"));
			
			note('edit', "Save::$home$url");
			write($home.$url, $content);

		}else if($_POST['action']=='Delete'){
			if(delete($home.$url)){
				note('edit', "Delete::$home$url");
			}else{
				note('edit', "Error::Delete failed::$home$url");
			}
		}
	
	//load
		if(isset($_POST['url']) || isset($_GET['url'])){
			$text = loadpage($home.$url);
		}
		
		$url2 = "//deamon.info/".$url;
		
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
	
<?php
	echo "<div id='viewer' class='horizonal_half'>";
	if(!($url[0] == "." && $url[1] == ".")){
		echo "<iframe src='$url2' name='current_page' id='current_page' sandbox='allow-same-origin allow-forms allow-scripts'></iframe>";
	}else{
		echo "Preview not available.";
	}
	echo "</div>";
?>