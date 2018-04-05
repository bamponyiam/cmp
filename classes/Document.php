<?php
require_once("classes/Database.php");

class Document{
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
	
	public function getDocumentByClient($id){
		$sql = "SELECT * FROM client_document WHERE id_client= ".$id;
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
	
	public function insertAttachedFile($data){
		$sql =" INSERT INTO client_document VALUES (NULL,
				".$this->mysqli->real_escape_string($data['id_client']).",
				'".$this->mysqli->real_escape_string($data['name'])."',
				'".$this->mysqli->real_escape_string($data['path'])."',
				NOW())";
		$this->mysqli->query($sql);
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