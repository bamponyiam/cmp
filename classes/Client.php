<?php
require_once("classes/Database.php");

class Client{
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

	public function insertClient($data){
		$sql = "INSERT INTO clients VALUES(NULL,
		0,
		'',
		".$this->mysqli->real_escape_string($data['crystal_client_branche_id']).",
		NOW(),
		'".$this->mysqli->real_escape_string($data['title'])."',
		'".$this->mysqli->real_escape_string($data['firstname'])."',
		'".$this->mysqli->real_escape_string($data['lastname'])."',
		'".$this->mysqli->real_escape_string($data['nationality'])."',";
		if($data['dob'] == ""){
			$sql .= " NULL, ";
		}else{
			$sql .= "'".$this->mysqli->real_escape_string($data['dob'])."',";
		}
		$sql .= "'".$this->mysqli->real_escape_string($data['resident'])."',
		'".$this->mysqli->real_escape_string($data['city'])."',
		'".$this->mysqli->real_escape_string($data['status'])."',
		NOW(),
		'".$this->mysqli->real_escape_string($data['email'])."',
		'".$this->mysqli->real_escape_string($data['phone'])."',
		'".$this->mysqli->real_escape_string($data['adr'])."',
		'".$this->mysqli->real_escape_string($data['adr2'])."',
		".$this->mysqli->real_escape_string($data['dpi_code']).",
		'".$this->mysqli->real_escape_string($data['zipcode'])."','".$this->mysqli->real_escape_string($data['note'])."',NOW()
		)";
		echo $sql;
		$this->mysqli->query($sql);
		return $this->mysqli->insert_id;
	}
	
	public function insertPax($data){
		
		$sql = "INSERT INTO pax_client VALUES(NULL,
		'".$this->mysqli->real_escape_string($data['gender'])."',
		'".$this->mysqli->real_escape_string($data['familyname'])."',
		'".$this->mysqli->real_escape_string($data['firstname'])."',
		'".$this->mysqli->real_escape_string($data['nationality'])."',
		'".$this->mysqli->real_escape_string($data['dob'])."',
		".$this->mysqli->real_escape_string($data['is_main']).",
		".$this->mysqli->real_escape_string($data['id_client']).")";
		//echo $sql;
		$this->mysqli->query($sql);

	}
	
	public function getBranchById($id){
		$sql = "SELECT * FROM branches WHERE id_br=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function updateClientInfo($data){
		
		
		
		$sql = "UPDATE clients SET 
		crystal_client_id = ".$this->mysqli->real_escape_string($data['crystal_client_id']).",
		crystal_client_code = '".$this->mysqli->real_escape_string($data['crystal_client_code'])."' ,
		title = '".$this->mysqli->real_escape_string($data['title'])."',
		firstname = '".$this->mysqli->real_escape_string($data['firstname'])."',
		lastname = '".$this->mysqli->real_escape_string($data['lastname'])."',
		nationality = '".$this->mysqli->real_escape_string($data['nationality'])."',
		resident = '".$this->mysqli->real_escape_string($data['resident'])."',
		city = '".$this->mysqli->real_escape_string($data['city'])."',
		status = '".$this->mysqli->real_escape_string($data['status'])."',
		email = '".$this->mysqli->real_escape_string($data['email'])."',
		phone = '".$this->mysqli->real_escape_string($data['phone'])."',
		adr = '".$this->mysqli->real_escape_string($data['adr'])."',
		adr2 = '".$this->mysqli->real_escape_string($data['adr2'])."',
		dpi_code = ".$this->mysqli->real_escape_string($data['dpi_code']).",
		note = '".$this->mysqli->real_escape_string($data['note'])."',";
		
		if($data['dob'] == ""){
			$sql .= " dob = NULL, ";
		}else{
			$sql .= " dob = '".$this->mysqli->real_escape_string($data['dob'])."',";
		}
		
		$sql .= " zipcode = ".$this->mysqli->real_escape_string($data['zipcode']).", last_update = NOW() WHERE id_client = ".$this->mysqli->real_escape_string($data['id_client']);
		
		//echo $sql;

		$this->mysqli->query($sql);
		
	}
	
	public function activateClientCrystal($data){
		
		$sql = "UPDATE clients SET 
		
		crystal_client_id = ".$this->mysqli->real_escape_string($data['crystal_client_id']).",
		crystal_client_code = '".$this->mysqli->real_escape_string($data['crystal_client_code'])."',
		status = 'ACTIVE',	last_update = NOW()  WHERE id_client = ".$this->mysqli->real_escape_string($data['id_client']);
		
		echo $sql;

		$this->mysqli->query($sql);
		
	}

	public function deletePax($id){
		$sql = "DELETE FROM pax_client WHERE id_client=".$id;
		$this->mysqli->query($sql);
	}
	
	public function getClientById($id){
		$sql = "SELECT * FROM clients WHERE crystal_client_id=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getClientByMyIs($id){
		$sql = "SELECT * FROM clients WHERE id_client=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getClientByPolicy($id_policy){
		$sql = "SELECT clients.* FROM clients,policy WHERE policy.id_client = clients.crystal_client_id AND policy.id_policy_crystal =".$id_policy." ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getAllClient(){
		
		$sql = "SELECT * FROM clients ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllTitle(){
		
		$sql = "SELECT DISTINCT(title) FROM clients ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllClientByBr($id_br){
		
		$sql = "SELECT * FROM clients WHERE crystal_client_branche_id =".$id_br;
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllClientByUser($id_user){
		
		$sql = "SELECT clients.* FROM clients,user_branches WHERE clients.crystal_client_branche_id = user_branches.code_br AND user_branches.crystal_user_id = '".$id_user."' ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllClientByUserBrStatus($id_user,$br,$status){
		
		$sql = "SELECT clients.* FROM clients,user_branches WHERE clients.crystal_client_branche_id = user_branches.code_br AND user_branches.crystal_user_id = '".$id_user."' ";
		
		if($status != 'all' ){
			$sql .= " AND clients.status = '".$status."' ";
		}
		if($br != 'all' ){
			$sql .= " AND clients.crystal_client_branche_id = ".$br." ";
		}
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllClientTemp(){
		
		$sql = "SELECT * FROM clients_temp ";
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
	
	public function getAllPaxByClientTemp($id){
		
		$sql = "SELECT * FROM pax_client_temp WHERE id_client=".$id." ORDER BY is_main DESC";
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
	
	public function getMainPaxByClientTemp($id){
		
		$sql = "SELECT * FROM pax_client_temp WHERE id_client=".$id." AND is_main = 1";
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