<!doctype html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<form action="auth_service.php" method="post">
		<h3>Registeration Page</h3>
		<ul>
			<li>
				<label>User Name:</label><input type="text" id="uname" name="uname" />
			</li>
			<li>
				<label>Password:</label><input type="password" id="pass" name="pass" />
			</li>
			<li>
				<label>Enter your Password again:</label><input type="password" id="pass" name="pass" />
			</li>
			<li>	
				<input type="submit" value="Submit">
			</li>
		</ul>
	</form>
	<a href="/register.html">Register</a>
</body>
</html>