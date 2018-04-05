<?php 
include_once("classes/Product.php");
$product = Product::getInstance();

$pro = $product->getAllProductByInsurer($_POST['id']);

if(sizeof($pro) > 0){
	foreach($pro as $p){
		echo '<option value="'.$p['id_product'].'">'.$p['name_product'].'</option>';
	}
}


?>