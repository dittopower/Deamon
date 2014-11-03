<?php
	include '../page.php';
	$sql = "Select code_edit from user_priv where username='$_SESSION[User]'";
	if (singleSQL($sql, $mysqli)){
?>
<style>
	.horizonal_half{
		width:100%;
	}

	#coding_area{
		width:100%;
		height:50%;
		border:0;
		padding:0;
	}

	#controlbox{
		background:#FCF5B8;
		width:100%;
	}
	
	.controls{
		display:inline;
	}

	#current_page{
		width:100%;
		height:50%%;
		padding:0;
		margin-bottom:1%;
		border:0;
		background:grey;
	}
</style>
<?php
	$url="";
	$text="";
	
	if($_POST['action']=='Save'&&isset($_POST['content'])&&isset($_POST['url'])){
		$url = $_POST['url'];
		$content = $_POST['content'];
		$content = str_replace("&lt","<",$content);
		$content = str_replace("&gt",">",$content);
		$content = preg_replace('/\\\/',"",$content);
		
		$handle = fopen($url, "w");
		fwrite($handle,$content);
		fclose($handle);
		//file_put_contents($url,$content);
	}else if ($_POST['action']=='Delete'&&isset($_POST['url'])){
		$url = $_POST['url'];
		unlink($url);
	}
	
	function loadpage($url){
		if (file_exists($url)){
			$text = file_get_contents($url);
			$text = str_replace("<","&lt",$text);
			$text = str_replace(">","&gt",$text);
		}else{
			$text = "Page Not Found";
		}
		return $text;
	}
	
	if (isset($_POST['url'])){
		$url = $_POST['url'];
		$text = loadpage($_POST['url']);
	
	}else if(isset($_GET['url'])){
		$url = $_GET['url'];
		$text = loadpage($_GET['url']);
	}
?>
	<div id="console" class="horizonal_half">
		<div id="controlbox">
			<hr class='spacer'>
			<form class="controls" name="controls" method="GET">
				<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>" >
				<input type="submit" id="file_button" value="Load">
				<a href="<?php echo $url;?>" target="_newtab">Open</a>
			</form>
			|
			<form class="controls" name="Delete" method="POST">
				<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>">
				<input type="submit" id="del_button" name="action" value="Delete">
			</form>
			
			<hr>
			<form name="save" method="POST">
				<input id="input_url" type="text" placeholder="file.html" name="url" value="<?php echo $url;?>">
				<input type="submit" id="save_button" name="action" value="Save">
				<hr>
				<textarea id="coding_area" name="content"><?php echo $text; ?></textarea>
			</form>
		</div>
		
	</div>
	
	
	<div id="viewer" class="horizonal_half">

		<iframe src="<?php echo "$url"; ?>" name="current_page" id="current_page" sandbox="allow-same-origin allow-forms allow-scripts">
		
	</div>
	</div>
</body>

<?php }else include "../error.php";

?>