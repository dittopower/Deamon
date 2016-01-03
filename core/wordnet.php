<?php 
	global $wordsql;
	$wordsql = new mysqli('localhost', 'deamon_site', 'OL.qc6G?&W_bSwQ~', 'deamon_wordnet');

	if ($wordsql->connect_error) {
		die('Connect Error (' . $wordsql->connect_errno . ') ' . $wordsql->connect_error);
		echo '<script>alert("Database Connection Failure!");</script>';
	}
	
	function wn_closeCon(){
		global $wordsql;
		mysqli_close($wordsql);
	}
	register_shutdown_function('wn_closeCon');
	
///Functions	
	function wn_singleSQL($sql){
		global $wordsql;
		$p = mysqli_query($wordsql,$sql);
		$result = 0;
		if($p != NULL){
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$result = $t[0];
		}
		return $result;
	}//runs an sql statement and returns only a single result
	
	function wn_rowSQL($sql){
		global $wordsql;
		$p = mysqli_query($wordsql,$sql);
		$row = mysqli_fetch_array($p,MYSQLI_BOTH);
		if($row != NULL){
			return $row;
		}
		else{
			return 0;
		}
	}//runs a command that will give a result as an single row
	
	function wn_multiSQL($sql){
		global $wordsql;
		$p = mysqli_query($wordsql,$sql);
		if($p != NULL){
			return $p;
		}//while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
		else{
			return 0;
		}
	}//runs a command that will give a result as an array
	
	function wn_runSQL($sql){
		global $wordsql;
		return mysqli_query($wordsql,$sql);	
	}//run a command that either passes or failes (doesn't have an output)
	
	function wn_escapeSQL($text){
		global $wordsql;
		return mysqli_real_escape_string($wordsql,$text);
	}
	
	function wn_dump_table($table){
		table("Select * from $table");
	}

	function wn_arraySQL($sql){
		global $wordsql;
		$result = mysqli_query($wordsql,$sql);
		if($result != NULL){
			$a=array();
			while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
				array_push($a,$row);
			}
			
			return $a;
			
		}
		else{
			return 0;
		}
	}//runs a command that will give a result as an array (for real)
	
	function wn_table($sql){
		//Display Table Contents
		echo json_encode(wn_arraySQL($sql));
	}
	
	function wn_syn(){
		wn_table('SELECT a.`word` FROM wn_synset a JOIN wn_synset b ON a.`synset_id` = b.synset_id WHERE a.word != "dog" and b.word = "dog"');
	}
	
	function wn_hyp(){
		wn_table('SELECT a.`word` FROM wn_synset a JOIN wn_hypernym h on a.synset_id = `synset_id_1` JOIN wn_synset b ON b.synset_id = `synset_id_2` WHERE a.word != "dog" and b.word = "dog" UNION SELECT a.`word` FROM wn_synset a JOIN wn_hypernym h on a.synset_id = `synset_id_2` JOIN wn_synset b ON b.synset_id = `synset_id_1` WHERE a.word != "dog" and b.word = "dog" ORDER BY a.`word` ASC');
	}
	
	function wn_words($wordlength=0, $numberwords=100, $wordorder=0){
		$sql = "SELECT word FROM `wn_synset`";
		if($wordlength > 0){
			$sql .= " WHERE Length(word) <= $wordlength";
		}
		switch($wordorder){
			case 1:
				$sql .= " ORDER by word asc";
				break;
			case 2:
				$sql .= " ORDER by word desc";
				break;
			default:
				$sql .= " ORDER by RAND()";
				break;
		}
		if($numberwords > 0){
			$sql .= " LIMIT $numberwords";
		}
		wn_table($sql);
	}
?>