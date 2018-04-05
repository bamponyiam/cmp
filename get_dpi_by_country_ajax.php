<?php 
include_once("classes/Country.php");
$country = Country::getInstance();

$dpi = $country->getAllDepByCountry($_POST['id']);

if(sizeof($dpi) > 0){
	echo '<option value="0"> Select </option>';
	foreach($dpi as $p){
		echo '<option value="'.$p['crystal_dpi_code'].'">'.$p['dpi_name'].'</option>';
	}
}


?>