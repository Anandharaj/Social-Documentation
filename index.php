<!doctype html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<form action="auth_service.php" method="post">
		<ul>
			<li>
				<label>User Name:</label><input type="text" id="uname" name="uname" />
			</li>
			<li>
				<label>Password:</label><input type="password" id="pass" name="pass" />
			</li>
			<li>	
				<input type="submit" value="Submit">
			</li>
		</ul>
	</form>
	<a href="/social-documentation/register.php">Register</a>
	<?php
		include("curd_lib.php");
		if(isset($_GET["userName"])) {
			signOut($_GET["userName"], $_GET["table_name"]);
		}
		function signOut($userName, $table_name) {
			$sql = new MySqlLib();
			$sql->connectDB("localhost", "root", "", "mydb");
			$sql->update($table_name, "logged=false", "userName=" . "'" . $userName . "'");
			$sql->close();
		}
	?>
</body>
</html>