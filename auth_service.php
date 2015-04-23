<?php	
	include("curd_lib.php");
	$uname = $_POST["uname"];
	$password = $_POST["pass"];
	$table_name = "userProfile";
	$sql = new MySqlLib();
	$sql->connectDB("localhost", "root", "", "mydb");
	$result = $sql->find($table_name, "*", "userName=" . "'" . $uname . "'");
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if($row["password"] === $password) {
			$sql->update($table_name, "logged=true", "userName=" . "'" . $uname . "'");
			header("Location:/social-documentation/welcome_page.php");
		} else {
			echo "Enter Valid Password....!";
		}
	} else {
		echo "Enter Valid User Name and Password....!";
	}
	$sql->close();
?>