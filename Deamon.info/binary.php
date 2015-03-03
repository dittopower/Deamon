<?php /* Deamon Lib - Binary */

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
		
	function benhear ($datain)
		{
		$pie = unpack("c*", $datain);

		$out = base_convert($pie[1], 10, 30);
		return $out;
		}
	
	function bensay ($datain)
		{
		$pie = base_convert($datain, 10, 30);

		$out = pack("c*", $pie);
		return $out;
		}
	$a = benhear("pie");
	var_dump($a);echo "\n";
	var_dump(bensay($a));
