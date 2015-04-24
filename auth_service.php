<?php
	// include("curd_lib.php");

	/**
	* 
	*/
	class AuthService {
		private $sql;
		private $table_name = "userprofile";

		function __construct() {
			$this->sql = new MySqlLib();
			$this->sql->connectDB('localhost', 'root', '', 'mydb');		
		}

		function __destruct() {
			$this->sql->close();
		}

		public function register($username, $password) {
			if ($username && $password) {
				$data = ["userName"=>$username, "password"=>$password, "logged"=>0];
				if ($this->sql->insert("userProfile", $data) === true) {
					header("Location:/social-documentation");
				}
			}
		}

		public function login($username, $password) {
			if (!$username || !$password) {
				echo "Invalid userName or Password";
				return false;
			}

			$result = $this->sql->find($this->table_name, "*", "userName='$username'");

			if (!$result) {
				return false;
			}

			$row = mysqli_fetch_assoc($result);
			if($row["password"] === $password) {			
				$this->sql->update($this->table_name, "logged=true", "userName='$username'");
				return true;
			}

			return false;
		}

		function signOut($userName) {
			$this->sql->update($this->table_name, "logged=false", "userName='$userName'");
			header("Location:/social-documentation/");
		}
	}

?>