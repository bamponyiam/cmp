<?php
require_once("classes/Database.php");

class Insurer{
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

	public function insertInsurer($data){
		$sql = "INSERT INTO insurers VALUES(
		".$this->mysqli->real_escape_string($data['id_insurer']).",
		'".$this->mysqli->real_escape_string($data['name'])."')";
		$this->mysqli->query($sql);
		//return $this->mysqli->insert_id;
	}
	
	public function insertInsurerProduct($data){
		$sql = "INSERT INTO insurers_product VALUES(NULL,
		".$this->mysqli->real_escape_string($data['id_insurer']).",
		'".$this->mysqli->real_escape_string($data['id_product'])."','ACTIVE')";
		$this->mysqli->query($sql);
		//return $this->mysqli->insert_id;
	}
	
		public function insertFormularProduct($data){
		$sql = "INSERT INTO formula_product VALUES(NULL,
		'".$this->mysqli->real_escape_string($data['id_product'])."',
		'".$this->mysqli->real_escape_string($data['code_formula'])."',
		'".$this->mysqli->real_escape_string($data['name_formula'])."')";
		$this->mysqli->query($sql);
		//return $this->mysqli->insert_id;
	}
	
	public function insertProduct($data){
		$sql = "INSERT INTO products VALUES(
		'".$this->mysqli->real_escape_string($data['id_product'])."',
		'".$this->mysqli->real_escape_string($data['name_product'])."')";
		$this->mysqli->query($sql);
		//echo $sql;
		//return $this->mysqli->insert_id;
	}
	
	
	
	public function deleteClient($id){
		$sql = "DELETE FROM clients WHERE id_client=".$id;
		$this->mysqli->query($sql);
	}
	
	public function getInsurerById($id){
		$sql = "SELECT * FROM insurers WHERE id_insurer=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getAllInsurer(){
		
		$sql = "SELECT * FROM insurers ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllInsurerByProduct($id_product){
		
		$sql = "SELECT * FROM insurers,insurers_product WHERE insurers.id_insurer = insurers_product.id_insurer AND insurers_product.id_product = '".$id_product."' ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
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