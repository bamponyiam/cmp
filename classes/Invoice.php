<?php
require_once("classes/Database.php");

class Invoice{
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

	public function insertInvoice($data){
		$sql = "INSERT INTO invoices VALUES(NULL,
		".$this->mysqli->real_escape_string($data['id_policy']).",
		".$this->mysqli->real_escape_string($data['inv_invoice_id']).",
		'".$this->mysqli->real_escape_string($data['inv_db_date'])."',
		'".$this->mysqli->real_escape_string($data['inv_start_date'])."',
		'".$this->mysqli->real_escape_string($data['inv_end_date'])."',
		'".$this->mysqli->real_escape_string($data['inv_ec_date'])."',
		'".$this->mysqli->real_escape_string($data['date_created'])."',
		'".$this->mysqli->real_escape_string($data['currency'])."',
		".$this->mysqli->real_escape_string($data['ttc']).",
		".$this->mysqli->real_escape_string($data['net']).",
		".$this->mysqli->real_escape_string($data['commissions']).",
		".$this->mysqli->real_escape_string($data['taxes']).",
		".$this->mysqli->real_escape_string($data['feese']).",
		".$this->mysqli->real_escape_string($data['feese_cie']).",
		'".$this->mysqli->real_escape_string($data['status'])."')";
		
		echo $sql;
		$this->mysqli->query($sql);
		//return $this->mysqli->insert_id;
	}
	
	public function insertPayment($data){
		$sql = "INSERT INTO payment VALUES(NULL,
		".$this->mysqli->real_escape_string($data['id_inv']).",
		".$this->mysqli->real_escape_string($data['amount']).",
		'".$this->mysqli->real_escape_string($data['currency'])."',
		'".$this->mysqli->real_escape_string($data['method'])."',
		'".$this->mysqli->real_escape_string($data['payment_with'])."',
		'".$this->mysqli->real_escape_string($data['note'])."',
		'".$this->mysqli->real_escape_string($data['date_paid'])."',NOW(),'PENDING','".$this->mysqli->real_escape_string($data['attachement'])."')";
		//echo $sql;
		$this->mysqli->query($sql);
	}
	
	public function updatePayment($freq,$method,$id_policy){
		
		$sql = "UPDATE policy SET 
		frequency = '".$this->mysqli->real_escape_string($freq)."',
		payment = '".$this->mysqli->real_escape_string($method)."'
		WHERE id_policy = ".$this->mysqli->real_escape_string($id_policy);
		$this->mysqli->query($sql);
	}
	
	
	public function deleteClient($id){
		$sql = "DELETE FROM clients WHERE id_client=".$id;
		$this->mysqli->query($sql);
	}
	
	
	public function getInvoiceById($id){
		$sql = "SELECT * FROM invoices WHERE id_inv=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getInvoiceByIdCrystal($id){
		$sql = "SELECT * FROM invoices WHERE inv_invoice_id=".$id."";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
	}
	
	public function getCollectedByInvoice($id){
		
		$sql = "SELECT SUM(amount) as collected FROM payment WHERE id_inv = ".$id;
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row['collected'];
	}
	
	public function getSumInvoicedByCurrency($currency){
		
		$sql = "SELECT SUM(ttc) as collected FROM invoices WHERE currency = '".$currency."'";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row['collected'];
	}
	
	public function getSumPaidByCurrency($currency){
		
		$sql = "SELECT SUM(ttc) as collected FROM invoices WHERE status = 'EC' AND currency = '".$currency."' ";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row['collected'];
	}
	
	public function getPaymentByInvoice($id){
		
		$sql = "SELECT * FROM payment WHERE id_inv = ".$id;
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function updatePaymentCrystal($id){
		$sql = "UPDATE payment SET status = 'COMPLETED' WHERE id_inv=".$id;
		$this->mysqli->query($sql);
	}
	
	public function getInvoiceByPolicy($id){
		
		$sql = "SELECT * FROM invoices WHERE id_policy = ".$id;
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllInvoices(){
		
		$sql = "SELECT * FROM invoices ";
		$result = $this->mysqli->query($sql);
		$all = array();
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$all[] = $row;
			}
		}
		return $all;
	}
	
	public function getAllInvoicePaid(){
		
		$sql = "SELECT * FROM invoices WHERE status ='PAID' ";
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