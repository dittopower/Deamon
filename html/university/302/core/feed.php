<?php //Load Template
	
	lib_database();
	lib_code();
	lib_perms();
	lib_files();
	lib_group();

	
	function post($feed,$title,$content){
		global $mysqli;
		$sql = mysqli_prepare($mysqli, "INSERT INTO `D_Articles` (`user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES (?, NOW(), NOW(), ?, ?, ?)");
		$feed .= "|";
		mysqli_stmt_bind_param($sql,"ssss",$_SESSION['person'],$feed,$title,$content);

		if(mysqli_stmt_execute($sql)){
			note('newsfeed',"Posted::$_POST[Title]");
		} else {
			note('newsfeed',"Failed::$_POST[Title]");
		}
		mysqli_stmt_close($sql);
		unset($sql);
	}
	
	
//`D_Articles`  `art_id``user_id``post_date``mod_date``tags` title`contents`
function feed($topic, $name=""){
	$max_page = 6;
	
	$cardcont = "<span id=newfeed >";
	
	//posting
	if(isset($_POST['feed'])){
		if($_POST['feed'] == 'Post'){
			global $mysqli;
			$sql = mysqli_prepare($mysqli, "INSERT INTO `D_Articles` (`user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES (?, NOW(), NOW(), ?, ?, ?)");
			$tags = $topic."|@$topic";
			$content = d_text($_POST['Content']);
			
			mysqli_stmt_bind_param($sql,"ssss",$_SESSION['person'],$tags,$_POST['Title'],$content);
		
			if(mysqli_stmt_execute($sql)){
				$cardcont .= '<div>Article Posted.</div>';
				note('newsfeed',"Posted::$_POST[Title]");
			} else {
				$cardcont .= '<div>Posting Failed.</div>';
				note('newsfeed',"Failed::$_POST[Title]");
			}
			mysqli_stmt_close($sql);
			unset($tags);
			unset($sql);
		}
	}
	$cardcont .= "<span class='wideinput'><h4>Create new post</h4><form name='newpost' id='feed_post' method='POST'>";
	//$cardcont .= "<label for='nft'>Title</label>";
	$cardcont .= "<input name='Title' id='nft' type='text' placeholder='Post title' class='bump'>";
	$cardcont .= "<br><textarea name='Content' cols=50 rows=2 placeholder='Post content...'></textarea>";
	$cardcont .= "<br><input name='feed' type='submit' value='Post' class='button button1'>";
	$cardcont .= "</form></span><div class='clear'></div>";
	
	//listing
	global $nsql;
	$nsql = "Select art_id, Username, user_id, DATE_FORMAT(post_date, '%H:%i %d %b %y') as postd, DATE_FORMAT(mod_date, '%H:%i %d %b %y') as modd, tags, title, contents from D_Articles a join D_Accounts u on user_id = UserId";
	$w = 0;
	
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
		$cardcont .= "<article>";
	//Title
		$cardcont .= "<h1>$row[title]</h1>";
		
	//Author, Dates
		$cardcont .= "<div class='info'>";
		$cardcont .= "$row[postd] by ";
		$cardcont .= "<a class='author' href='http://$_SERVER[HTTP_HOST]/user?u=$row[Username]'>$row[Username]</a>";
		if ($row['postd'] != $row['modd']){
			$cardcont .= " Modified $row[modd]";
		}
		$cardcont .= "</div><hr>";
		
	//contents
		$cardcont .= "<div class='contents'>";
		$cardcont .= $row['contents'];
		$cardcont .= "</div>";
		
		$cardcont .= "</article>";
	}
	$cardcont .= "<script>page=/([\?\&]p=)([0-9]+)/.exec(window.location.search);";
	$cardcont .= "function paget(val){
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
	$cardcont .= "<br><button onclick='paget(-1)'";
	if(!is_numeric($_GET['p']) || $_GET['p'] < 1){
		$cardcont .= " disabled";
	}
	$cardcont .= " class='button button1'> < </button>";
	$cardcont .= "<button onclick='paget(1)' class='button button1 floatright'> > </button>";
	$cardcont .= "</span>";
	
	card($name,$cardcont);
}

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
//
?>