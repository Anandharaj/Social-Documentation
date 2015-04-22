<?php	
	include("curd_lib.php");
	$uname = $_POST["uname"];
	$password = $_POST["pass"];
	$user_info = ["userName"=>"varchar(25) not null", "password"=>"varchar(20) not null", "fileName"=>"varchar(50) not null", "primary key"=>"(userName)"];
	$sql = new MySqlLib();
	$sql->connectDB("localhost", "root", "", "mydb");
	$createDB = $sql->create("userProfile", $user_info);
	if ( $createDB === true) {
		echo "Table Created...!";
	} else {
		echo "Err-> $createDB";
	}
	// $sql->drop("table", "userProfile");
	$sql->close();
?>