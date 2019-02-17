<?php //Load Template
	require_once "$_SERVER[DOCUMENT_ROOT]/lib.php";
	lib_database();
	lib_perms();
	lib_files();
?>
<!-- START content -->

<?php //`D_Articles`  `art_id``user_id``post_date``mod_date``tags` title`contents`
function feed($topic){
	$max_page = 10;
	$edit = 0;
	$permision = 'post';
	
	echo "<section id=newfeed >";
	
	if(canUserPerm($permision,$topic)){
		$edit = 1;
		if(isset($_POST['feed'])){
			if($_POST['feed'] == 'Post'){
				global $mysqli;
				$sql = mysqli_prepare($mysqli, "INSERT INTO `deamon_core`.`D_Articles` (`user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES (?, NOW(), NOW(), ?, ?, ?)");
				$tags = "";
				if(isset($_POST['Topic']) && $_POST['Topic'] != ""){
					$tags .= $_POST['Topic']."|";
				}
				$tags .= preg_replace("/, |,/", "|", $_POST['Tags']);
				$content = d_text($_POST['Content']);
				
				mysqli_stmt_bind_param($sql,"ssss",$_SESSION['person'],$tags,$_POST['Title'],$content);
			
				if(mysqli_stmt_execute($sql)){
					echo '<div>Article Posted.</div>';
					note('newsfeed',"Posted::$_POST[Title]");
				} else {
					echo '<div>Posting Failed.</div>';
					note('newsfeed',"Failed::$_POST[Title]");
				}
				mysqli_stmt_close($sql);
				unset($tags);
				unset($sql);
			}
		}
		
		echo "<form name='newpost' id='feed_post' method='POST'>";
		echo "<input name='Topic' type='text' value='$topic' hidden>";
		echo "<label for='nft'>Title: </label><br>";
		echo "<input name='Title' id='nft' type='text' placeholder='Something Awesome...'><br>";
		echo "<label for='nfta'>Tags: </label><br>";
		echo "<input name='Tags' id='nfta' type='text' placeholder='Pie, Swag, Badger, etc.'><br>";
		echo "<label for='nfc'>Content: </label><br>";
		echo "<textarea id='nfc' name='Content' placeholder='Post content...'></textarea><br>";
		echo "<input name='feed' id='postbutton' type='submit' value='Post'>";
		echo "</form>";
	}
	
	global $nsql;
	$nsql = "Select art_id, Username, user_id, DATE_FORMAT(DATE_ADD(`post_date`, INTERVAL 16 DAY_HOUR), '%H:%i %d %b %y') as postd, DATE_FORMAT(DATE_ADD(mod_date, INTERVAL 16 DAY_HOUR), '%H:%i %d %b %y') as modd, tags, title, contents from D_Articles a join D_Accounts u on user_id = UserId";
	$w = 0;
	function where(){
		global $w;
		global $nsql;
		if(!$w){
			$nsql .= " where";
			$w = 1;
		}else{
			$nsql .= " and";
		}
	}
	
	if(isset($_GET['feed'])){
		echo "<form name='searchpost' id='feed_post' method='GET'>";
	//	echo "<input name='feed' type='text' hidden>";
		echo "<label for='s_tags'>Tags: </label>";
		echo "<input name='tag' id='s_tags' type='text' placeholder='I.e. coding, php'>";
		echo "<label for='s_author'>Author: </label>";
		echo "<input name='u' id='s_author' type='text' placeholder='I.e. deamon'>";
		echo "<input name='feed' type='submit' value='Search'>";
		echo "</form>";
		
		if(isset($_GET['u']) && $_GET['u'] != ''){
			where();
			$nsql .= " Username = '".escapeSQL($_GET['u'])."'";
		}
		if(isset($_GET['tag']) && $_GET['tag'] != ''){
			$tags=preg_split("/, |,/",escapeSQL($_GET['tag']));
			foreach ($tags as $key=>$val){
				where();
				$nsql .= " tags like '%".$val."|%'";
			}
		}
	}
	
	if(strlen($topic) > 0){
		where();
		$nsql .= " tags like '%$topic|%'";
	}
	
	$nsql .= " order by post_date desc limit $max_page";
	
	if(is_numeric($_GET['p'])){
		$w = $_GET['p'] * $max_page;
		$nsql .= " offset $w";
	}
	
	debug($nsql);
	$result = multiSQL($nsql);
	
	while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		echo "<article>";
	//Title
		echo "<h1>$row[title]</h1>";
	
	//Can edit?
		if($edit){
			if(getUserLevel($permision) > 1 || $_SESSION['person'] == $row['user_id']){
				echo "<form name='editpost' class='edit'>";
				echo "<input name='art' type='text' value='$art_id' hidden>";
				echo "<input name='feed' type='button' value='Edit' onclick=\"alert('You haven`t made this feature yet.')\">";
				echo "</form>";
			}
		}
		
	//Author, Dates
		echo "<div class='info'>";
		echo "<a class='author' href='?feed&u=$row[Username]'>$row[Username]</a>";
		echo " <a class='profileL' href='/me?u=$row[Username]'><i>P</i></a>";
		echo "<div>Posted $row[postd]</div>";
		if ($row['postd'] != $row['modd']){
			echo "<div>Modified $row[modd]</div>";
		}
		echo "</div>";
		
	//tags
		echo "<div class='tags'>";
		echo preg_replace("/([^|]+)\|?/", "<a href='?feed&tag=$1'>$1</a>, ", $row['tags']);
		echo "</div>";
		
	//contents
		echo "<div class='contents'>";
		echo $row['contents'];
		echo "</div>";
		
		echo "</article>";
	}
	echo "<script>page=/([\?\&]p=)([0-9]+)/.exec(window.location.search);";
	echo "function paget(val){
		if(page==null){
			if(window.location.search.search(/\?/)+1){
				window.location=window.location.href + '&p=1';
			}else{
				window.location=window.location.href + '?p=1'
			}
		}else{
			page[2]=Number(page[2])+val;
			window.location=window.location.href.replace(page[0],page[1]+page[2]);
		}}</script>";
	echo "<button onclick='paget(-1)'";
	if(!is_numeric($_GET['p']) || $_GET['p'] < 1){
		echo " disabled";
	}
	echo "> < </button>";
	echo "<button onclick='paget(1)'> > </button>";
	echo "</section>";
}
//
?>

<!-- END content -->