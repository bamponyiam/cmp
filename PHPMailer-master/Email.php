<?php
require_once("PHPMailer-master/PHPMailerAutoload.php");

class Email{
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
	
	public function mail_to($email,$pass,$namefrom,$recipient,$cc,$name,$subject, $body,$a){
	
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		//$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		//$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = $email;
		$mail->Password = $pass;
		$mail->SetFrom($email);
		
		if(is_array($recipient)){
			foreach($recipient as $vv){                              
				$mail->addAddress($vv[0], $vv[1]);
			}
		}else{
			$mail->addAddress($recipient, $name); 
		}

		
		$mail->From = $email;
		$mail->FromName = $namefrom;
		$mail->addReplyTo('vincent.g@poe-ma.com', 'Information');
		
		if(is_array($cc)){
			foreach($cc as $vv){                              
				$mail->addCC($vv, "");
			}
		}else{
			$mail->addCC($recipient, $name); 
		}
		
		$mail->WordWrap = 50; 
		
		if($a != ""){  
		foreach($a as $v){                              
			$mail->addAttachment($v);
		}
		}                            
		
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			return 1;
		} else {
			return 0;
		}
	}
	
	
}
?>