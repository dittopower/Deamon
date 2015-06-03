<?php

//Binary to string http://php.net/manual/en/function.pack.php#93085
	function bin2str($input)
	// Convert a binary expression into a binary-string. ("1100100" to "d")
		{
		  if (!is_string($input)) return null; // Sanity check

		  // Pack into a string
		  return pack('H*', base_convert($input, 2, 16));
		}

	function str2bin($input)
	// Binary representation of a binary-string
		{
		  if (!is_string($input)) return null; // Sanity check

		  // Unpack as a hexadecimal string
		  $value = unpack('H*', $input);
		  
		  // Output binary representation
		  return base_convert($value[1], 16, 2);
		}
		
	$masterCheck = str2bin("Lord ").str2bin("Deamon");
	function Dfile($filename, $name){
		global $masterCheck;
		if (file_exists($file)){
			//log error goes here
		}else{
			$file = fopen($filename,'w');
			
			$name = substr($name,0,4);
			$fnm = str_pad(str2bin($name),32,'0',STR_PAD_LEFT);
			
			var_dump(fwrite($file,$fnm));echo "</br>";
			var_dump(fwrite($file,$masterCheck));
			
			fclose($file);
		}
	}
	function Dcheck($filename, $name, $target, $who){
		global $masterCheck;
		$out = false;
		if (!file_exists($file)){
			Dfile($filename, $name);
		}
		$file = fopen($filename,'r');
		
		$name = substr($name,0,4);
		$target = substr($target,0,8);
		
		$chck = $name === bin2str(fread($file,32));
		$master = $masterCheck === fread($file,86);
		
		if($chck && $master){
			$current = fread($file,64);
			fseek bindec
			while($current != $target){
				
			}
		}
		
		fclose($file);
		return $out;
	}
	
Dfile("test.deamon","Perm");
Dcheck("test.deamon","Perm",4);
?>