<?php
require_once("classes/Database.php");

class Product{
	private $mysqli;
	private static $_instance; //The single instance
	
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	private function __construct(){
		$db = Database::getInstance();
		$this->mysqli = $db->getConnection();
	}
	
	
	public function getProductById($id){
		$sql = "SELECT * FROM products WHERE id_product='".$id."'";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	
	
	public function getAllProductByInsurer($id){
		
		$sql = "SELECT products.* FROM products,insurers_product WHERE insurers_product.id_product = products.id_product AND  insurers_product.id_insurer = ".$id." ";
		//echo $sql;
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllProduct(){
		
		$sql = "SELECT * FROM products ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getFormularByProduct($id_product){
		
		$sql = "SELECT * FROM formula_product WHERE id_product = '".$id_product."' ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getFormularByCode($formula){
		
		$sql = "SELECT * FROM formula_product WHERE code_formula = '".$formula."' ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getAllPaxByClient($id){
		
		$sql = "SELECT * FROM pax_client WHERE id_client=".$id." ORDER BY is_main DESC";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getMainPaxByClient($id){
		
		$sql = "SELECT * FROM pax_client WHERE id_client=".$id." AND is_main = 1";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
		
	}
	
	
	
	public function getAllStatus(){
		
		$sql = "SELECT * FROM client_status ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	
}
?>