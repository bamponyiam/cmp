<?php
require_once("classes/Database.php");

class Country{
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
	
	public function getAllCountry(){
		
		$sql = "SELECT * FROM apps_countries ORDER BY country_name ASC ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllDepByCountry($country){
		
		$sql = "SELECT * FROM provinces WHERE country_code = '".$country."' order by dpi_name asc ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function insertProvinces($data){
    $sql = "INSERT INTO provinces VALUES(NULL,'".$data['country_code']."',".$data['crystal_dpi_code'].",'".$data['dpi_name']."') ";
		$this->mysqli->query($sql);
	}
	
	public function getDPINameById($id,$country){
		
		$sql = "SELECT * FROM provinces WHERE crystal_dpi_code = ".$id." AND country_code = '".$country."' ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	public function getCountryNameByCode($code){
		
		$sql = "SELECT country_name FROM apps_countries WHERE country_code = '".$code."' ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	public function getCountryNameById($id){
		
		$sql = "SELECT country_name FROM apps_countries WHERE id = ".$id." ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	
}
?>