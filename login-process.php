<?php
session_start();
include_once("classes/User.php");
$user = User::getInstance();
$my = $user->getUserByLoginPass($_POST['my-email'],$_POST['my-password']);
if($my != 0){
	$_SESSION['user'] = $my['crystal_user_id'];
	header('Location:index.php');
}else{
	header('Location:sign-in?error=1');
}
?>