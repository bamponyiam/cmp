<?php
include_once("classes/Client.php");
$client = Client::getInstance();

print_r($_POST);

$data = array();
foreach($_POST as $p=>$v){
	$data[$p] = $v;
	
}

$client->updateClientInfo($data);

header('Location:info-clients?id='.$_POST['id_client']);

?>