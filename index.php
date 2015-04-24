<?php
	if (!session_id()) {
		session_start();
	}
	include("curd_lib.php");
	include('auth_service.php');

	$auth = new AuthService();
	if (isset($_POST['submit']) && $_POST['submit'] === 'login') {
		if ($auth->login($_POST['uname'], $_POST['pass'])) {		
			$_SESSION['userName'] = $_POST['uname'];
		} else {
			echo "Failed";
		}
	}
	if (isset($_GET["userName"]) && isset($_SESSION['userName'])) {
		session_destroy();
		$auth->signOut($_GET["userName"]);
	}	
	if (isset($_POST['submit']) && $_POST['submit'] === 'Register') {
		$auth->register($_POST['uname'], $_POST['pass']);
	}

	if (!isset($_SESSION['userName'])) {
		include 'login.php';
	} else {
		include 'welcome_page.php';
	}
?>
