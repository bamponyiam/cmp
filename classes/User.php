<?php
require_once("classes/Database.php");

class User{
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

	public function insertUser($data){
		$sql = "INSERT INTO users VALUES(NULL,
		'".$this->mysqli->real_escape_string($data['crystal_user_id'])."',
		'".$this->mysqli->real_escape_string($data['email'])."',
		'".$this->mysqli->real_escape_string($data['password'])."',
		'".$this->mysqli->real_escape_string($data['firstname'])."',
		'".$this->mysqli->real_escape_string($data['lastname'])."',
		'".$this->mysqli->real_escape_string($data['country'])."',
		'".$this->mysqli->real_escape_string($data['status'])."',NOW())";
		$this->mysqli->query($sql);
	}
	
	public function insertUserBranches($user,$code_br){
		$sql = "INSERT INTO user_branches VALUES(NULL,
		'".$this->mysqli->real_escape_string($user)."',
		'".$this->mysqli->real_escape_string($code_br)."')";
		$this->mysqli->query($sql);
	}
	
	public function updateUserInfo($data){
		$sql = "UPDATE users SET 
		firstname = '".$this->mysqli->real_escape_string($data['firstname'])."',
		lastname = '".$this->mysqli->real_escape_string($data['lastname'])."',
		email = '".$this->mysqli->real_escape_string($data['email'])."' 
		WHERE crystal_user_id = '".$this->mysqli->real_escape_string($data['user'])."'";
		
		$this->mysqli->query($sql);
	}
	
	public function updateUserPassword($pass,$user){
		$sql = "UPDATE users SET 
		password = '".$this->mysqli->real_escape_string($pass)."',
		WHERE crystal_user_id = '".$this->mysqli->real_escape_string($user)."'";
		
		$this->mysqli->query($sql);
	}
	
	public function updateUserLastLogin($date,$id){
		$sql = "UPDATE user SET 
		last_login = '".$this->mysqli->real_escape_string($date)."' WHERE id_user = ".$this->mysqli->real_escape_string($id);
		$this->mysqli->query($sql);
	}
	
	public function deleteUser($id){
		$sql = "DELETE FROM user WHERE id_user=".$id;
		$this->mysqli->query($sql);
	}
	
	public function getUserById($id){
		$sql = "SELECT * FROM users WHERE id_user=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getUserByUsername($user){
		$sql = "SELECT * FROM users WHERE crystal_user_id='".$user."'";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getUserByLoginPass($email,$pass){
		$sql = "SELECT * FROM users WHERE crystal_user_id ='".$email."' AND password = '".sha1($pass)."' ";
		$result = $this->mysqli->query($sql);
		
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}else{
			return 0;
		}
	}
	
	public function getAllUser(){
		
		$sql = "SELECT * FROM users ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllBranches(){
		
		$sql = "SELECT * FROM branches ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getBranchById($id){
		$sql = "SELECT * FROM branches WHERE id_br=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getBranchByUser($id){
		$sql = "SELECT user_branches.code_br,branches.name_br FROM user_branches,branches WHERE user_branches.code_br = branches.id_br AND user_branches.crystal_user_id='".$id."'";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
		public function getBranchByUserTxt($id){
		$sql = "SELECT user_branches.code_br,branches.name_br FROM user_branches,branches WHERE user_branches.code_br = branches.id_br AND user_branches.crystal_user_id='".$id."'";
		$result = $this->mysqli->query($sql);
		$all = "";
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all .= '<span class="badge badge-secondary">'.$row['name_br'].'</span> &nbsp;';
			}
		}
		return $all;
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