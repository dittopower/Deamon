<html><body>
<?php

/* Load Document */
	session_start();
	function cleantext($str){
	//Clear the unnecessary parts of a html document
		$str = preg_replace('#<head(.*?)>(.*?)</head>#is'," ",$str);
		$str = preg_replace('#<script(.*?)>(.*?)</script>#is'," ",$str);
		$str = preg_replace('#<style(.*?)>(.*?)</style>#is'," ",$str);
		$str = preg_replace('#<header(.*?)>(.*?)</header>#is'," ",$str);
		$str = preg_replace('#<footer(.*?)>(.*?)</footer>#is'," ",$str);
		$str = preg_replace('#<nav(.*?)>(.*?)</nav>#is'," ",$str);
		$str = preg_replace("/<img[^>]*>/"," ",$str);
		$str = preg_replace("/<[^>]+>/"," ",$str);
		
		$_SESSION['doctext'] = $str;
		return $str;
	}
	
	if (isset($_POST["del"])){
	//Clear your set text document
		$_SESSION['doctext'] = '';
		$_SESSION['docname'] = '';
		session_destroy();
	
	} else if (isset($_FILES["doc"])&& $_FILES["doc"]['name'] != $_SESSION['docname'] && isset($_POST["set"])){
	//Load your text document
		$_SESSION['docname'] = $_FILES["doc"]['name'];
		$str = file_get_contents($_FILES["doc"]["tmp_name"]);
		
		$str = cleantext($str);
		
	}else if (isset($_POST['get'])&&isset($_POST['url'])){
	//Get a webpage as a text document
		$url = $_POST['url'];
		
		$_SESSION['docname'] = $url;
		$str = file_get_contents($url);
		
		$str = cleantext($str);
		
	}else{
	//Use pre set text
		$str = $_SESSION['doctext'];
	}
/* End Loading */


/* Language Detection */
	//Default
	$french = false;
	
	//Count some English stop words
	$en = preg_match_all("/\W(in|on|at|it|do|of|the)/",$str,$eng);
	//Count some French stop word
	$fr = preg_match_all("/\W(le|de|du|en|un|et|la|il|les)/",$str,$fre);
	
	//Set Language
	$french = $fr > $en;
/* End Language */


//Strip punctuation
	$strs = preg_replace("/[[:punct:]\n]/"," ",$str);
//Put the words in an array
	$words = explode(' ',$strs);


/* Porter Stemmer */
	if (isset($_GET['stem'])){
		include 'Porter Stemmer.php';
		
		$stem = array();
		
		foreach($words as $word){
		//Swap on Language
			if(!$french){
			//English or NON-French languages
			//Check for disabled steps
				if (!(isset($_GET['1ab'])||isset($_GET['1c'])||isset($_GET['2'])||isset($_GET['3'])||isset($_GET['4'])||isset($_GET['5']))){
				//Run all steps as normal
					$stem[] = PorterStemmer::Stem($word);
				}else{
				//Get step states
					$a = !isset($_GET['1ab']);
					$c = !isset($_GET['1c']);
					$d = !isset($_GET['2']);
					$e = !isset($_GET['3']);
					$f = !isset($_GET['4']);
					$g = !isset($_GET['5']);
					
				//Run Stemmer disabling steps
					$stem[] = PorterStemmer::DStem($word,$a,$c,$d,$e,$f,$g);
				}
	
			}else{
			//French
			//Get Stemmer step states
				$a = !isset($_GET['1ent']);
				$d = !isset($_GET['2s']);
				
			//Run Stemmer with appropriate steps.
				$stem[] = PorterStemmer::FStem($word,$a,$d);
			}
		}
//Collapse the array into a string.
	$new = implode($stem," ");
	unset($stem);
	}
	$str = implode($words," ");
	unset($words);
/* End Stemmer */
	
	
/* POS Tagger */
	if (isset($_GET['pos'])){
		include 'POSTagger.php';
		$tagger = new PosTagger('lexicon.txt');
		
		if (isset($_GET['stem'])){
			$tags = $tagger->tag($new);
		}else{
			$tags = $tagger->tag($str);
		}
		$new = textTag($tags);
	}
/* End Tagger */

/* Information Extraction -- currently requires pos tagger*/
	if (isset($_GET['info'])){
		preg_match_all('/([^\s]*_JJ)(\s|\n)([^\s]*_NN)/',$new,$info);
		$myinfo = $info[0];
		unset($info);
		preg_match_all('/([^\s]*_NN)/',$new,$info);
		$myinfo = array_merge($myinfo,$info[0]);
		unset($info);
		$myinfo = array_unique($myinfo);
		unset($new);
		$new = "";
		for ($i=0;$i < count($myinfo);$i++){
			if (isset($_GET['about']) && $_GET['about'] != ''){
				if (preg_match("/$_GET[about]/",$myinfo[$i])){
					$new .= $myinfo[$i];
					$new .= "<br>";
				}
			}else{
				$new = implode($myinfo," <br>");
			}
		}
		unset($myinfo);
	}
/* End Extraction */

/* Wordnet - Note the data base must be set-up prior to running.*/
	if (isset($_GET['wnet'])){
	
		/* Connect To the Database (address, user, password, schema)*/
		$mysqli = new mysqli('mysql7.000webhost.com', 'a4561011_deamon', 'Overide0', 'a4561011_core');
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
			echo "Please check your database setup";
		}
		
		/* Run an sql command return the result pointer or 0 if an error occurs*/
		function multiSQL($sql){
			global $mysqli;
			$p = mysqli_query($mysqli,$sql);
			if($p != NULL){
				return $p;
			}
			else{
				return 0;
			}
		}
		
		$wn_id="SELECT * FROM `wn_synset` WHERE ss_type = 'n' and word = ";
		function getSynonym($text){
			$sql = "SELECT distinct s.word, d.sense_number FROM `wn_synset` s join `wn_synset` d on s.synset_id = d.synset_id and d.word != s.word and d.word = '$text' order by d.sense_number";
			$result = multiSQL($sql);
			$out = "[S";
			if($result->num_rows != 0){
				$last = 10;
				while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
					if ($last == 10){
						$out .= "(";
						$last = $row['sense_number'];
					}else if ($row['sense_number'] != $last){
						$out .= ")(";
						$last = $row['sense_number'];
					}else{
						$out .= ", ";
					}
					$out .= "$row[word]";
				}
				$out .= ")";
			}
			$out .= "]";
			return $out;
		}
		function getHypernym($text){
			$sql = "SELECT distinct d.word,s.sense_number  FROM wn_hypernym h join wn_synset s on h.synset_id_1 = s.synset_id join wn_synset d on h.synset_id_2 = d.synset_id WHERE s.word = '$text' order by s.sense_number";
			$result = multiSQL($sql);
			$out = "[H";
			if($result->num_rows != 0){
					$last = 10;
				while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
					if ($last == 10){
						$out .= "(";
						$last = $row['sense_number'];
					}else if ($row['sense_number'] != $last){
						$out .= ")(";
						$last = $row['sense_number'];
					}else{
						$out .= ", ";
					}
					$out .= "$row[word]";
				}
				$out .= ")";
			}
			$out .= "]";
			return $out;
		}
		
		$strs = explode(' ',preg_replace("/<br>/"," ",$new));
		$new = "";
		foreach($strs as $thing){
			if (preg_match("/([^\s]*)_NN/",$thing,$text)){
				$new .= $text[1]."_NN";
				$new .= getSynonym($text[1]);
				$new .= getHypernym($text[1]);
				$new .= " <br> ";
			}else{
				$new .= $thing." ";
			}
		}
	}
/* End Wordnet */

?>


<script>
document.title = "Natural Language Processing";
s=document.createElement('link');
s.rel="icon";
s.href="http://deamon.netau.net/res/site.ico";
document.head.appendChild(s);
</script>


<style>
.div{
	width:48%;
	background:rgba(0,0,0,0.2);
	margin:1%;
}
.stem{
	background:yellow;
}
.word{
	background:cyan;
}
</style>


<div class='controls'>
<!-- Text Selection -->
	<form method="POST" enctype="multipart/form-data">
		<fieldset>
			<h3>Current Document: <?php echo $_SESSION['docname']; ?></h3> 
			<fieldset>
				<input type='file' name='doc'>
				<input type='submit' name='set' value='Set Text'>
			</fieldset>
			<fieldset>
				<input type='text' name='url' value=''>
				<input type='submit' name='get' value='Get Text'>
				<?php if (isset($url)){ echo "<a href='$url' target='_newtab'>Source Doc</a>";}?>
			</fieldset>
			<input type='submit' name='del' value='Clear Text'>
		</fieldset>
	</form>


<!-- Processing form -->
	<form method='GET'>
		<fieldset>
	<!-- Enable Functions -->
			<fieldset>
				<label><b>Functions: </b></label>
				<input type='checkbox' name='stem' id='porter' <?php if(isset($_GET['stem'])){echo "checked";} ?>>
				<label for='porter'>Porter Stemmer</label> | 
				<input type='checkbox' name='pos' id='tagger' <?php if(isset($_GET['pos'])){echo "checked";} ?>>
				<label for='tagger'>POS Tagger</label> | 
				<input type='checkbox' name='info' id='exi' <?php if(isset($_GET['info'])){echo "checked";} ?>>
				<label for='exi'>Extract Information:</label>
				<label for='about'>Specific? </label><input type='text' name='about' id='about' value='<?php echo $_GET['about'];?>' placeholder='I.e. fish, blank is everything'> | 
				<input type='checkbox' name='wnet' id='wnet' <?php if(isset($_GET['wnet'])){echo "checked";} ?>>
				<label for='wnet'>Wordnet</label>
				<br><p>Information extraction and Wordnet currently require POS tagging...</p>
			</fieldset>
			
	<!-- Porter Stemmer Steps -->
			<fieldset>
				<label><b>Disable Porter Stemmer Steps:</b></label>
				<input type='checkbox' name='1ab' value="off" <?php if(isset($_GET['1ab'])){echo "checked";} ?>>
				<label>1ab</label> | 
				<input type='checkbox' name='1c' value="off" <?php if(isset($_GET['1c'])){echo "checked";} ?>>
				<label>1c</label> | 
				<input type='checkbox' name='2' value="off" <?php if(isset($_GET['2'])){echo "checked";} ?>>
				<label>2</label> | 
				<input type='checkbox' name='3' value="off" <?php if(isset($_GET['3'])){echo "checked";} ?>>
				<label>3</label> | 
				<input type='checkbox' name='4' value="off" <?php if(isset($_GET['4'])){echo "checked";} ?>>
				<label>4</label> | 
				<input type='checkbox' name='5' value="off" <?php if(isset($_GET['5'])){echo "checked";} ?>>
				<label>5</label>
			</fieldset>
	
	<!-- French Stemmer Steps -->
			<fieldset>
				<label><b>Disable French Stemmer Steps:</b></label>
				<input type='checkbox' name='1ent' value="off" <?php if(isset($_GET['1ent'])){echo "checked";} ?>>
				<label>1 'ent'</label> | 
				<input type='checkbox' name='2s' value="off" <?php if(isset($_GET['2s'])){echo "checked";} ?>>
				<label>2 's'</label>
			</fieldset>
			<input type='submit' value='Process'>
		</fieldset>
	</form></div>
	
<!-- Original && Process Text Display Area -->
<div class='div' style="float:left;"><h2> Original Text <?php if($french){echo " - Detected French";}?></h2><hr><?php echo $_SESSION['doctext'];?></div>
<div class='div' style="float:right;"><h2> Processed Text</h2><hr><?php if (isset($new)){ echo $new;}else{ echo "No Functions Selected.";}?></div>

</body>
