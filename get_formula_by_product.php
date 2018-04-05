<?php 
include_once("classes/Product.php");
$product = Product::getInstance();

$pro = $product->getFormularByProduct($_POST['id']);

if(sizeof($pro) > 0){
	foreach($pro as $p){
		echo '<option value="'.$p['code_formula'].'">'.$p['name_formula'].'</option>';
	}
}


?>