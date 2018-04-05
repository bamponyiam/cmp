<?php

include_once("PHPMailer-master/PHPMailerAutoload.php");

include_once("classes/Client.php");
$client = Client::getInstance();

include_once("classes/Country.php");
$country = Country::getInstance();

include_once("classes/Divers.php");
$divers = Divers::getInstance();

include_once("classes/User.php");
$user = User::getInstance();

$data = array();
$data['resident'] 	= $_POST['resident'];
$data['city'] 		= $_POST['city'];
$data['crystal_client_branche_id'] 		= $_POST['crystal_client_branche_id'];
$data['status'] 	= $_POST['status'];
$data['title'] 		= $_POST['title'];
$data['firstname'] 	= $_POST['firstname'];
$data['lastname'] 	= $_POST['lastname'];
$data['join_date'] 	= $_POST['join_date'];
$data['email'] 		= $_POST['email'];
$data['phone'] 		= $_POST['phone'];
$data['adr'] 		= $_POST['adr'];
$data['adr2'] 		= $_POST['adr2'];
$data['note'] 		= $_POST['note'];
$data['dob'] 		= $_POST['dob'];
$data['nationality'] 		= $_POST['nationality'];

if($_POST['zipcode'] == ""){
	$data['zipcode'] 	= 0;
}else{
	$data['zipcode'] 	= $_POST['zipcode'];
}

$data['dpi_code'] 	= $_POST['dpi_code'];
$data['date_add'] 	= date('Y-m-d');

$id = $client->insertClient($data);

$dpi = $country->getDPINameById($_POST['dpi_code'],$_POST['resident']);
$cc_code = $country->getCountryNameByCode($_POST['resident']);

$br = $user->getBranchById($_POST['crystal_client_branche_id']);

$subject = "New client crystal[CMP]";

$body = "<p> 
<table>
	<tr>
    <td><b>Office</b></td>
    <td>:</td>
    <td>".$br['name_br']."</td>
  </tr>
  <tr>
    <td><b>Title</b></td>
    <td>:</td>
    <td>".$_POST['title']."</td>
  </tr>
  <tr>
    <td><b>Firstname</b></td>
    <td>:</td>
    <td>".$_POST['firstname']."</td>
  </tr>
  <tr>
    <td><b>Lastname</b></td>
    <td>:</td>
    <td>".$_POST['lastname']."</td>
  </tr>
  <tr>
    <td><b>Email</b></td>
    <td>:</td>
    <td>".$_POST['email']."</td>
  </tr>
  <tr>
    <td><b>Phone</b></td>
    <td>:</td>
    <td>".$_POST['phone']."</td>
  </tr>
  <tr>
    <td><b>Address</b></td>
    <td>:</td>
    <td>".$_POST['adr']."</td>
  </tr>
  <tr>
    <td><b>Address 2</b></td>
    <td>:</td>
    <td>".$_POST['adr2']."</td>
  </tr>
  <tr>
    <td><b>City</b></td>
    <td>:</td>
    <td>".$_POST['city']."</td>
  </tr>
  <tr>
    <td><b>Zipcode</b></td>
    <td>:</td>
    <td>".$_POST['zipcode']."</td>
  </tr>
<tr>
    <td><b>Province</b></td>
    <td>:</td>
    <td>".$dpi['dpi_name']."</td>
  </tr>
  <tr>
    <td><b>Country</b></td>
    <td>:</td>
    <td>".$cc_code['country_name']."</td>
  </tr>
</table>
</p>";

$body .= '<br /><p> After complete insert to Crystal, please click here to update ID to CMP : <a href="https://www.cmp.puma-management.com/active-user-crystal.php?id='.$id.'"> UPDATE </a></p>';

//echo $body;

$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; 
$mail->IsHTML(true);
$mail->Username = 'crystalbroker@poe-ma.com';
$mail->Password = 'H0rs3P03m@';
$mail->SetFrom('crystalbroker@poe-ma.com');
$mail->addAddress('it@poe-ma.com', 'IT POE-MA');
$mail->From = 'crystalbroker@poe-ma.com';
$mail->FromName = 'IT CRYSTAL';
$mail->WordWrap = 50; 
$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
$mail->send();

header('Location:info-clients?id='.$id);

?>