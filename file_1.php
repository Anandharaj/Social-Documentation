<?php
	$file_content = null;
	$file_details = null;
	$file_name = null;
	$file_mode = null;
	if (isset($_POST["fileDetails"])) {
		$file_details = (array)$_POST["fileDetails"];
		$file_name = $file_details['file_name'];
		$file_mode = $file_details['file_mode'];
		$reqFile = fopen($file_name, ($file_mode[0] !== 'r') ? $file_mode[0] . '+' : $file_mode[0]) or die("unble to find the file..!");
		if(filesize($file_name) > 0 && $file_mode === "read") {
			echo fread($reqFile, filesize($file_name));
		} else if ($file_mode === "read") {
			echo "File has no content...!";
		} else if(filesize($file_name) > 0 && $file_mode === "append"){
			echo fread($reqFile, filesize($file_name));
		} else {
			echo "";
		}
		fclose($reqFile);
	} else {
		$fileUpdate = (array)$_POST["fileUpdate"];
		$file_name = $fileUpdate['file_name'];
		$file_mode = $fileUpdate['file_mode'];
		$file_content = $fileUpdate['file_content'];
		if($file_content) {
			$reqFile = fopen($file_name, $file_mode[0]) or die("unble to find the file..!");
			fwrite($reqFile, $file_content);
			echo "Updated";
		} else {
			echo "$file_name, $file_mode, $file_content";
		}
		fclose($reqFile);
	}
?>