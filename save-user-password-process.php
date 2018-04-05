<?php 
	session_start();
	include_once("classes/User.php");
	$user = User::getInstance();

	$u = $user->getUserByLoginPass($_SESSION['user'],$_POST['current_pass']);

	

	if($u == 0){
		header('Location:setting-user?update=pass_incorrect');
	}else{
		$user->updateUserPassword(sha1($_POST['new_pass']),$_SESSION['user'] );
		header('Location:setting-user?update=pass_ok');
	}

	/*if($u != 0){
		
	}else{
		
	}*/

?>