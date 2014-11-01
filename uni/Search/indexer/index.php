<html><body>
<?php

/* Load Document */
	session_start();
	include "database.php";
	$a = false;
	
	if (isset($_POST['clear'])){
		runSQL("TRUNCATE TABLE `344_web`;");
		runSQL("TRUNCATE TABLE `344_sites`;");
		runSQL("TRUNCATE TABLE `344_words`;");
		unset($_SESSION['core']);
	}else if (isset($_POST['get'])&&isset($_POST['url'])){
	//Get a webpage as a text document
		$url = $_POST['url'];

		//Domain
		preg_match_all('#(http|https)?\/?\/?([^\s\;\,\"\'\:]+\.[^\s\;\,\"\'\:]+)#is', $url, $urls);

		$url = $urls[2][0];
		preg_match('/([^\/]+\.)*[^\/?#]+/',$url,$core);
		$_SESSION['core'] = $core[0];
		//End Domain
		
		unset($urls);
		unset($core);
		$a = true;
	}else if (isset($_GET['next']) || isset($_POST['next'])){
	//Visit next and mark as visited
		if (isset($_POST['domain']) || isset($_GET['domain'])){
			$url = singleSQL("SELECT address FROM `344_sites` where visited = 0 and address like '".$_SESSION['core']."%' order by id limit 1");
		}else{
			$url = singleSQL("SELECT address FROM `344_sites` where visited = 0 order by id limit 1");
		}
		if ($url){
			$a = true;
		}
	}
	
	if ($a){
		$str = file_get_contents("http://".$url);
		preg_match_all('#(http|https)?\/\/([^\s\;\,\"\'\:\<\>]+\.[^\s\;\,\"\'\:\<\>]+)#is', $str, $links);
		preg_match_all('#["\'](\.?(\/[^\s\;\,\"\'\:\<\>]+))["\']#is', $str, $virtuallinks);

		unset($links[1]);unset($virtuallinks[0]);
		unset($links[0]);unset($virtuallinks[2]);
	/* End Loading */


	/* Page Tracking - Mark current page as visited and get it's ID */
		$idsql = "SELECT id FROM `344_sites` where address = '$url'";
		$pageid = singleSQL($idsql);
		if ($pageid){
			runSQL("UPDATE 344_sites SET visited =  1 WHERE id = $pageid LIMIT 1");
		}else{
			runSQL("INSERT INTO 344_sites (`id`, `address`, `visited`) VALUES (LAST_INSERT_ID(), '$url', '1');");
			$pageid = singleSQL($idsql);
		}
	/* End Page Tracking */
		
	/* Get all links */
		$n = count($links[2]);
		$id = singleSQL("SELECT max(id) FROM 344_sites");
		
		for ($i = 0; $i < $n; $i++){
			if (preg_match('/\.(jpg|jpeg|png|gif|webm|ico|css|js|htc)/i',$links[2][$i])){
				unset($links[2][$i]);
			}else{
				$test = "SELECT id FROM 344_sites where address = '".$links[2][$i]."'";
				$siteid = singleSQL($test);
				if(!$siteid){
					$id++;
					$sql = "INSERT INTO 344_sites (`id`, `address`, `visited`) VALUES ($id, '".$links[2][$i]."', '0');";
					runSQL($sql);
					runSQL("INSERT INTO `a4561011_core`.`344_web` (`id_link_src`, `id_link_dst`) VALUES ('$pageid', '$id');");
				}else{
					runSQL("INSERT INTO `a4561011_core`.`344_web` (`id_link_src`, `id_link_dst`) VALUES ('$pageid', '$siteid');");
				}
			}
		}
		unset($links[2]);
		
	/* Get Virtuals links */
		$n = count($virtuallinks[1]);
		$temp = explode("/",$url);
		for ($i = 0; $i < $n; $i++){
			if (preg_match('/(\.(jpg|jpeg|png|gif|webm|ico|css|js|htc)|\/\/)/i',$virtuallinks[1][$i])){
				unset($virtuallinks[1][$i]);
			}else{
				if($virtuallinks[1][$i][0] === "."){
					$virtuallinks[1][$i][0] = "";
					if(strpos($temp[count($temp)-1],".") !== False){
						unset($temp[count($temp)-1]);
						$link = implode("/", $temp).$virtuallinks[1][$i];
					}else{
						$link = $url.$virtuallinks[1][$i];
					}
				}else{
					$link = $_SESSION['core'].$virtuallinks[1][$i];
				}
				$test = "SELECT id FROM 344_sites where address = '".$link."'";
				$siteid = singleSQL($test);
				if(!$siteid){
					$id++;
					$sql = "INSERT INTO 344_sites (`id`, `address`, `visited`) VALUES ($id, '".$link."', '0');";
					runSQL($sql);
					runSQL("INSERT INTO `a4561011_core`.`344_web` (`id_link_src`, `id_link_dst`) VALUES ('$pageid', '$id');");
				}else{
					runSQL("INSERT INTO `a4561011_core`.`344_web` (`id_link_src`, `id_link_dst`) VALUES ('$pageid', '$siteid');");
				}
			}
		}
		unset($links[2]);
	/* End links */
		
		
		
	/* Process Content */

		
		//Clear the unnecessary parts of a html document
			$str = preg_replace('#<head(.*?)>(.*?)</head>#is'," ",$str);
			$str = preg_replace('#<script(.*?)>(.*?)</script>#is'," ",$str);
			$str = preg_replace('#<style(.*?)>(.*?)</style>#is'," ",$str);
			$str = preg_replace('#<nav(.*?)>(.*?)</nav>#is'," ",$str);
			$str = preg_replace("/<[^>]+>/"," ",$str);
		
		//Strip punctuation
			$str = preg_replace("/[^A-Za-z0-9\s]/"," ",$str);
			$str = preg_replace("/\s+/"," ",$str);
			$str = strtolower($str);
		//Put the words in an array
			$words = explode(' ',$str);
			unset($str);
			
		include 'Porter Stemmer.php';
		$stem = array();
		include 'POSTagger.php';
		$tagger = new PosTagger('lexicon.txt');
		
		$check = array();
		for ($i = 0; $i < count($words); $i++ ){
			$stem = PorterStemmer::Stem($words[$i]);
			
			$tags = $tagger->tag($stem);
			
			if (preg_match("/NN.*|VB.*|JJ.*]/",$tags[0]['tag'])){
				if (isset($check[$stem])){
					$check[$stem]["pos"] .= ";".$i;
					$check[$stem]["count"]++;
				}else{
					$check[$stem]["count"] = 1;
					$check[$stem]["pos"] = $i;
				}
			}
		}
		$n = count($words);
		unset($words);
		unset($tagger);
		foreach($check as $word=>$line){
			$line['count'] = (($line['count'] / $n) * 1000);
			$sql = "INSERT INTO `a4561011_core`.`344_words` (`word`, `page`, `num`, `positions`) VALUES ('".$word."', '".$pageid."', '".$line['count']."', '".$line['pos']."');";
			runSQL($sql);
		}
	}

?>


<script>
document.title = "Search Indexer";
s=document.createElement('link');
s.rel="icon";
s.href="http://deamon.netau.net/res/site.ico";
document.head.appendChild(s);
</script>

<h1>Index Builder</h1>
<div class='controls'>
<!-- Text Selection -->
	<form method="POST" enctype="multipart/form-data">
		<fieldset>
			<h3>Current Document: <?php if (isset($url)){ echo "<a href='//$url' target='_newtab'>$url</a>";}?></h3>
			<h4>Indexing from Domain: <?php if (isset($_SESSION['core'])){ echo "<a href='//".$_SESSION['core']."' target='_newtab'>".$_SESSION['core']."</a>";}?></h4>
			<input type='text' name='url' value=''>
			<input type='submit' name='get' value='Get Text'>
			<input type='checkbox' name='domain' value='same' <?php if (isset($_POST['domain']) || isset($_GET['domain'])){echo "checked";}?>>
			<input type='submit' name='clear' value='Wipe DB'>
			<input type='submit' name='next' value='Next in Queue'>
		</fieldset>
	</form>
			<button onclick="location='./auto.php'">Auto Crawler</button>


</div>
	
<!-- Display Area -->
<div class='div'><h2> Word Positions</h2><hr><?php if (isset($check)){ var_dump($check);}else{ echo "No Page Selected.";}?></div>

</body>
