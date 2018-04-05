<?php 
	session_start();
	include_once("classes/User.php");
	$user = User::getInstance();

	$data = array();
	$data['firstname'] 	= $_POST['firstname'];
	$data['lastname'] 	= $_POST['lastname'];
	$data['email'] 		= $_POST['email'];
	$data['user']		= $_SESSION['user'];

	$user->updateUserInfo($data);
	header('Location:setting-user?update=ok');
	
?>