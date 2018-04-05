<?php 
include_once("classes/Client.php");
$client = Client::getInstance();

$cli = $client->getAllClientByBr($_POST['id']);

if(sizeof($cli) > 0){
	foreach($cli as $p){
		echo '<option value="'.$p['crystal_client_id'].'">'.$p['title'].'.'.$p['lastname'].' '.$p['firstname'].'</option>';
	}
}


?>