<?php	
	include("curd_lib.php");
	$uname = $_POST["uname"];
	$password = $_POST["pass"];
	// $user_info = ["userName"=>"varchar(25) not null", "password"=>"varchar(20) not null", "primary key"=>"(userName)"];
	$sql = new MySqlLib();
	$sql->connectDB("localhost", "root", "tiger", "mydb");
	// $sql->create("userProfile", $user_info);
	// if ( $createDB === true) {
	// 	echo "Table Created...!";
	// } else {
	// 	echo "Err-> $createDB";
	// }
	if ($uname && $password) {
		$data = ["userName"=>$uname, "password"=>$password, "logged"=>0];
		if ($sql->insert("userProfile", $data) === true) {
			header("Location:/social-documentation/index.php");
		}
	}
	// $sql->drop("table", "userProfile");
	$sql->close();
?>