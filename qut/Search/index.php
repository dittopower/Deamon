<html>
<?php
	$s=isset($_GET['Q']);
	$D=isset($_GET['D']);
	
	function debug($what){
	global $D;
		if ($D){
			echo "<br>";
			var_dump($what);
		}
	}
	function detag($what){
	global $D;
		if ($D){
			echo "<h4>$what</h4>";
		}
	}
	
	if ($s){
		$t = $_GET['Q'];
	}
?>
<head>
	<title><?php if($s){ echo "DS: ";}else{ echo "Deamon Search";}?></title>
	<script>
	s=document.createElement('link');
	s.rel="icon";
	s.href="http://deamon.netau.net/res/site.ico";
	document.head.appendChild(s);
	</script>
</head>

<body>
<h1>Deamon Search</h1>
<form method='GET'>
	<input type='search' name='Q' maxlength="30" <?php if($s){echo "value='$t'";}?>>
	<input type='submit' value="Search">
	<input type='checkbox' name=D <?php if($D){echo "checked";}?>>Debug
</form>
<hr>

<div id='res'>
<?php
	if ($s){
	
//Stemmer and POS
		detag("Stemmer and POS");
		
	//	if(!$sy){
			$words = explode(' ',$t);
			include './indexer/Porter Stemmer.php';
			
			for ($i = 0; $i < count($words); $i++ ){
				$words[$i] = PorterStemmer::Stem($words[$i]);
			}
			debug($words);
			$t = implode(" ",$words);
//		}
		
		include './indexer/POSTagger.php';
		$tagger = new PosTagger('./indexer/lexicon.txt');
		$words = $tagger->tag($t);
		debug($words);
		$t = "";
		for ($i = 0; $i < count($words); $i++ ){
			if (preg_match("/NN.*|VB.*|JJ.*/",$words[$i]['tag'])){
				$t .= " " . $words[$i]['token'];
			}
		}
		unset($tagger);
		debug($t);
		$words = explode(" ",trim($t));unset($t);
		debug($words);
		if(count($words) === 1 && $words[0] === ""){
			echo "<h1>Sorry no searchable words were input</h1>";
		}else{
			
	//Get pages with words
			detag("SQL get pages with words");
			include "./indexer/database.php";
			$nums = array();
			$bonus = array();
			
			function score($thsql){
				global $words;
				global $nums;
				global $bonus;
				$results = array();
				$pos = array();
				
				for ($i = 0; $i < count($words); $i++ ){
					$tsql = "$thsql = '$words[$i]' order by num limit 60";
					debug($tsql);
					$sql = multiSQL($tsql);
					$results[$i] = array();
					while($rows = mysqli_fetch_array($sql,MYSQLI_BOTH)){
						debug($rows);
						$results[$i][$rows['page']] = $rows['page'];
						
						if (isset($pos[$i][$rows['page']])){
							$pos[$i][$rows['page']] .= ";".$rows['positions'];
						}else{
							$pos[$i][$rows['page']] = $rows['positions'];
						}
						if (isset($nums[$rows['page']])){
							$nums[$rows['page']] += $rows['num'];
						}else{
							$nums[$rows['page']] = $rows['num'];
						}
					}
				}
				detag("2Pages grouped by words:");
				debug($results);
				detag("2importance of words on page");
				debug($nums);
				
				
				detag("Giving words a bonus based on a page containing multiple of the words");
				$prev = " ";
				foreach ($results as $key=>$res){
					if($prev === " "){
						$prev = $key;
					}else{
						foreach($results[$prev] as $ke=>$page){
							$b = array_search($page,$res);
							if ($b){
								$add = 1;
								$a = explode(";",$pos[$prev][$ke]);
								$c = explode(";",$pos[$key][$b]);
								foreach($a as $mpos){
									if(in_array($mpos+1,$c) || in_array($mpos-1,$c)){
										$add++;
									}
								}
								if (isset($bonus[$page])){
									$bonus[$page] += $add;
								}else{
									$bonus[$page] = $add;
								}
							}
							$prev = $key;
						}
					}
				}
				unset($results);
				unset($pos);
			}
			
			score("SELECT positions,page,num FROM `344_words` where word");
			score("SELECT distinct positions,page,num FROM 344_words a join `wn_synset` b on a.word = b.word join wn_synset c on b.synset_id = c.synset_id where c.word");
			score("SELECT distinct positions,page,num FROM 344_words a join `wn_synset` b on a.word = b.word join wn_hypernym d on b.synset_id = d.synset_id_2 join wn_synset c on c.synset_id = d.synset_id_1 where c.word");
			
			echo "<br>";
			debug($bonus);
			
			
		//Ranking culmination and priority queue
			detag("Ranking + Priority que");
			
			include "./queue.php";
			$que = new PriorityQueue();
			if(count($nums) > 0){
				$max = max($nums);
				foreach ($nums as $page=>$count){
					$value = ($bonus[$page] * $max) + $count;
					debug("$page: $value");
					$que->insert($page,$value);
				}
				unset($bonus);
				unset($num);
				
			//Reorder the queue so the highest ranking is
				detag("ordering");
				$i = $que->count();
				$final = new PriorityQueue();
				$que->setExtractFlags(3);
				while ($que->valid() && $i > 0) {
					$final->insert($que->extract(),$i);
					$i--;
				}
			//Print the items to the page
				detag("Displaying");
				$i = 0;
				if($D){echo "<hr>";}
				echo "<h1> Results: </h1><table><tr><th>Score:</th><th>Page</th></tr>";
				while ($final->valid() && $i < 15) {
					$res = explode(" - ",$final->extract());
					$link = singleSQL("Select address from 344_sites where id = '".$res[0]."' Limit 1");
					echo  "<tr><td>$res[1]</td><td><a href='//$link' target='_newtab'>$link</a></td></tr>";
					$i++;
				}
				echo "</table>";
			}else{ 
				echo "<h1>No Results</h1>";
			}
		}
	}
?>
</div>

</body>