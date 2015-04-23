<?php	
	$folder = "files";
	$search_result = glob($folder . "/*");
	$i = 0;
	$files = null;
	foreach ($search_result as $key => $value) {
		$files[$i++] = substr($value, "6");	
	}
	echo implode(",", $files);
?>