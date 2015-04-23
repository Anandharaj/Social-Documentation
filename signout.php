<?php
	function signOut() {
		$sql->update($table_name, "logged=false", "userName=" . "'" . $userName . "'");
		header("Location:/social-documentation/index.php");
	}
?>