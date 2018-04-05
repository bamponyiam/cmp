<?php
require_once("classes/Database.php");

class BI{
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
	
	public function getAllBI(){
		
		$sql = "SELECT * FROM business_intro ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	public function getCommBi($id){
		
		$sql = "SELECT * FROM comm_bi WHERE id_bi=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
		
	}
	
	public function getBiById($id){
		
		$sql = "SELECT * FROM business_intro WHERE id_bi=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
		
	}

	public function insertBI($data){
		$sql = "INSERT INTO business_intro VALUES(NULL,
		'".$this->mysqli->real_escape_string($data['country'])."',
		'".$this->mysqli->real_escape_string($data['city'])."',
		'".$this->mysqli->real_escape_string($data['firstname'])."',
		'".$this->mysqli->real_escape_string($data['familyname'])."',
		'".$this->mysqli->real_escape_string($data['adr'])."',
		'".$this->mysqli->real_escape_string($data['email'])."',
		'".$this->mysqli->real_escape_string($data['phone'])."',
		'".$this->mysqli->real_escape_string($data['date_join'])."',
		'".$this->mysqli->real_escape_string($data['note'])."',
		'".$this->mysqli->real_escape_string($data['status'])."',NOW())";

		$this->mysqli->query($sql);
	
		return $this->mysqli->insert_id;
	}
	
	public function updateBI($data){
		$sql = "UPDATE business_intro SET
		country = '".$this->mysqli->real_escape_string($data['country'])."',
		city = '".$this->mysqli->real_escape_string($data['city'])."',
		firstname = '".$this->mysqli->real_escape_string($data['firstname'])."',
		familyname = '".$this->mysqli->real_escape_string($data['familyname'])."',
		adr = '".$this->mysqli->real_escape_string($data['adr'])."',
		email = '".$this->mysqli->real_escape_string($data['email'])."',
		phone = '".$this->mysqli->real_escape_string($data['phone'])."',
		date_join = '".$this->mysqli->real_escape_string($data['date_join'])."',
		note = '".$this->mysqli->real_escape_string($data['note'])."',
		status = '".$this->mysqli->real_escape_string($data['status'])."' 
		WHERE id_bi = ".$this->mysqli->real_escape_string($data['id_bi'])." ";

		$this->mysqli->query($sql);

	}
	
	public function insertCommBI($data){
		$sql = "INSERT INTO comm_bi VALUES(NULL,
		".$this->mysqli->real_escape_string($data['id_bi']).",
		".$this->mysqli->real_escape_string($data['id_product']).",
		'".$this->mysqli->real_escape_string($data['type_comm'])."',
		".$this->mysqli->real_escape_string($data['new_biz']).",
		".$this->mysqli->real_escape_string($data['renew_biz']).",
		".$this->mysqli->real_escape_string($data['net_premium']).",
		".$this->mysqli->real_escape_string($data['net_assist']).",
		".$this->mysqli->real_escape_string($data['addi_assist_fee']).",
		".$this->mysqli->real_escape_string($data['admin_fee']).",
		".$this->mysqli->real_escape_string($data['addi_admin_fee']).",
		".$this->mysqli->real_escape_string($data['other_fee']).",NOW())";
		$this->mysqli->query($sql);
	}
	
	public function updateCommBI($data){
		$sql = "UPDATE comm_bi SET 
		type_comm = '".$this->mysqli->real_escape_string($data['type_comm'])."',
		new_biz = ".$this->mysqli->real_escape_string($data['new_biz']).",
		renew_biz = ".$this->mysqli->real_escape_string($data['renew_biz']).",
		net_premium = ".$this->mysqli->real_escape_string($data['net_premium']).",
		net_assist = ".$this->mysqli->real_escape_string($data['net_assist']).",
		addi_assist_fee = ".$this->mysqli->real_escape_string($data['addi_assist_fee']).",
		admin_fee = ".$this->mysqli->real_escape_string($data['admin_fee']).",
		addi_admin_fee = ".$this->mysqli->real_escape_string($data['addi_admin_fee']).",
		other_fee = ".$this->mysqli->real_escape_string($data['other_fee']).",
		last_update = NOW() WHERE id_com_bi = ".$this->mysqli->real_escape_string($data['id_com_bi'])."";

		$this->mysqli->query($sql);
	}
	
	
}
?>