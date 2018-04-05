<?php
require_once("classes/Database.php");

class Policy{
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

	public function insertPolicy($data){
		$sql = "INSERT INTO policy VALUES(NULL,
		".$this->mysqli->real_escape_string($data['id_policy_crystal']).",
		".$this->mysqli->real_escape_string($data['id_br']).",
		'".$this->mysqli->real_escape_string($data['id_product'])."',
		".$this->mysqli->real_escape_string($data['id_client']).",
		".$this->mysqli->real_escape_string($data['id_insurer']).",
		".$this->mysqli->real_escape_string($data['id_situation']).",
		'".$this->mysqli->real_escape_string($data['effective_date'])."',
		'".$this->mysqli->real_escape_string($data['expired_date'])."',
		'".$this->mysqli->real_escape_string($data['movement_detail'])."',
		'".$this->mysqli->real_escape_string($data['policy_number'])."',
		'".$this->mysqli->real_escape_string($data['ref'])."',
		'".$this->mysqli->real_escape_string($data['frequency'])."',
		'".$this->mysqli->real_escape_string($data['payment'])."',
		'".$this->mysqli->real_escape_string($data['payment_with'])."',
		'".$this->mysqli->real_escape_string($data['movement_date'])."',".$this->mysqli->real_escape_string($data['last']).")";
		//echo $sql;
		$this->mysqli->query($sql);
		return $this->mysqli->insert_id;
	}
	
	public function insertRisk($data){
		$sql = "INSERT INTO risks VALUES(NULL,
		".$this->mysqli->real_escape_string($data['crystal_risk_id']).",
		".$this->mysqli->real_escape_string($data['crystal_risk_situation_id']).",
		'".$this->mysqli->real_escape_string($data['crystal_policy_id'])."',
		".$this->mysqli->real_escape_string($data['id_policy_cmp']).",
		".$this->mysqli->real_escape_string($data['crystal_policy_situation_id']).",
		'".$this->mysqli->real_escape_string($data['movement_code'])."',
		'".$this->mysqli->real_escape_string($data['movement_date'])."',
		'".$this->mysqli->real_escape_string($data['entrance_date'])."',";
		
		if($data['retire_date'] == ""){
			$sql .= "NULL,";
		}else{
			$sql .= "'".$this->mysqli->real_escape_string($data['retire_date'])."',";
		}

		$sql .= "'".$this->mysqli->real_escape_string($data['risk_number'])."',
		'".$this->mysqli->real_escape_string($data['nature'])."',
		'".$this->mysqli->real_escape_string($data['formule'])."','".$this->mysqli->real_escape_string($data['description'])."')";
		//echo $sql;
		$this->mysqli->query($sql);
		//return $this->mysqli->insert_id;
	}
	
	public function getRiskByPolicy($id_policy){
		$sql = "SELECT * FROM risks WHERE crystal_policy_id = ".$id_policy;
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function updatePolicy($data){
		
		$sql = "UPDATE policy SET 
		id_insurer = '".$this->mysqli->real_escape_string($data['id_insurer'])."',
		start_date = '".$this->mysqli->real_escape_string($data['start_date'])."',
		end_date = '".$this->mysqli->real_escape_string($data['end_date'])."',
		plan = '".$this->mysqli->real_escape_string($data['plan'])."',
		policy_num = '".$this->mysqli->real_escape_string($data['policy_num'])."',
		ref = '".$this->mysqli->real_escape_string($data['ref'])."',
		currency = '".$this->mysqli->real_escape_string($data['currency'])."',
		premium = ".$this->mysqli->real_escape_string($data['premium'])." 
		WHERE id_policy = ".$this->mysqli->real_escape_string($data['id_policy']);
		//echo $sql;
		$this->mysqli->query($sql);
	}
	
	public function updatePayment($freq,$method,$id_policy){
		
		$sql = "UPDATE policy SET 
		frequency = '".$this->mysqli->real_escape_string($freq)."',
		payment = '".$this->mysqli->real_escape_string($method)."'
		WHERE id_policy_crystal = ".$this->mysqli->real_escape_string($id_policy);
		
		$this->mysqli->query($sql);
	}
	
	
	public function updateCrystalPolicyNo($data){
		$sql = "UPDATE policy SET id_policy_crystal =".$data['crystal_policy_id'].", id_situation = ".$data['crystal_policy_id']." WHERE id_policy = ".$data['id_policy'];
		//echo $sql;
		$this->mysqli->query($sql);
	}
	
	public function updateCrystalRiskNo($data){
		$sql = "UPDATE risks SET 
				crystal_risk_id =".$data['crystal_risk_id'].", 
				crystal_risk_situation_id = ".$data['crystal_risk_id'].",
				crystal_policy_id = ".$data['crystal_policy_id'].", 
				crystal_policy_situation_id = ".$data['crystal_policy_id']." 
				WHERE id_policy_cmp = ".$data['id_policy'];
		//echo $sql;
		$this->mysqli->query($sql);
	}
	
	
	public function getPolicyById($id){
		$sql = "SELECT * FROM policy WHERE id_policy=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getPolicyCrystalById($id){
		$sql = "SELECT * FROM policy WHERE id_policy_crystal=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	
	public function getAllPolicyByClient($id){
		
		$sql = "SELECT policy.* FROM policy,clients WHERE policy.id_client = clients.crystal_client_id AND clients.id_client = ".$id." AND last = 1 ";
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
	
	public function getAllPolicy(){
		
		$sql = "SELECT * FROM policy WHERE last = 1";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllPolicyByUser($id_user,$year){
		
		if($year != ""){
			$sql = "SELECT policy.* FROM policy,user_branches WHERE last = 1 AND policy.id_br = user_branches.code_br AND user_branches.crystal_user_id = '".$id_user."' AND YEAR(policy.effective_date) = '".$year."'";
		}else{
			$sql = "SELECT policy.* FROM policy,user_branches WHERE last = 1 AND policy.id_br = user_branches.code_br AND user_branches.crystal_user_id = '".$id_user."'";
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
	
	public function getAllPolicyByUserBrYear($id_user,$br,$year){
		
		$sql = "SELECT policy.* FROM policy,user_branches WHERE last = 1 AND policy.id_br = user_branches.code_br AND user_branches.crystal_user_id = '".$id_user."' ";
		if($br != 'all'){
			$sql .= " AND policy.id_br = ".$br."  ";
		}
		if($year != 'all'){
			$sql .= " AND YEAR(policy.effective_date) = '".$year."'  ";
		}
		echo $sql;
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllPolicyByYear($year){
		
		$sql = "SELECT * FROM policy WHERE last = 1 AND YEAR(effective_date) = '".$year."' ";
		echo $sql;
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
	
	public function uploadFile($file,$destination){
		
		$target_dir = $destination;
		$target_file = $target_dir . basename($file["name"]);
		$uploadOk = 1;
		$extension = pathinfo($target_file,PATHINFO_EXTENSION);
		$actual_name = pathinfo($target_file,PATHINFO_FILENAME);
		$original_name = $actual_name;
		$namefile = $destination.$file["name"];
	
		$i = 1;
		while(file_exists($destination.$actual_name.".".$extension))
		{           
			$actual_name = (string)$original_name.$i;
			$namefile = $destination.$actual_name.".".$extension;
			$i++;
			//echo $namefile;
		}
		if (move_uploaded_file($file["tmp_name"], $namefile)) {
			return $namefile;
		} else {
			return 0;
		}
		
	}
	
	
}
?>