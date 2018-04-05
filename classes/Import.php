<?php

class Import{
	private $mysqli;
	private static $_instance; //The single instance
	
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}



		public function updateDataCrystal($br,$query){
    //const SERVICES_URL_ASI = '27.254.63.182:5610';
    //const SERVICES_URL_KHM = '27.254.63.182:5610';
    //const SERVICES_URL_THA = '27.254.63.182:5620';
    //const SERVICES_URL_WLF = '27.254.63.182:5630';
    //const SERVICES_URL_MYS = '27.254.63.182:5640'
    //const SERVICES_URL_MG = '193.253.112.51:5633';
    
    switch ($br) {
      case "21":
          $serveur_adress = "http://27.254.63.182:5620/poemaservices?wsdl";
          break;
      case "KHM":
          $serveur_adress = "http://27.254.63.182:5610/poemaservices?wsdl";
          break;
      case "WLS":
          $serveur_adress = "http://27.254.63.182:5630/poemaservices?wsdl";
          break;
      case "22" :
          $serveur_adress = "http://27.254.63.182:5640/poemaservices?wsdl";
          break;
          
  }

		$array = array(
					"page"   => $_SERVER['REQUEST_URI'],
					"ip"     => $_SERVER['REMOTE_ADDR'],
					"user"   => "test utilisateur",
					"server" => "db_crystal",
					"query"  => $query
				);

		$data = array();
		try {
		  $service = "RunSelect";
		  $webconnect = new SoapClient($serveur_adress);
		  $call = $webconnect->$service($array);
		  $data = $this->get_json_svc($call);
		 return($data);
		} catch (Exception $e) {
			print_r($e);
			return($data);
		}
	}
	public function importDataCrystalByType($type='th',$query){
    
    switch ($type) {
      case "THA":
          $serveur_adress = "http://27.254.63.182:5620/poemaservices?wsdl";
          break;
      case "KHM":
          $serveur_adress = "http://27.254.63.182:5610/poemaservices?wsdl";
          break;
      case "WLS":
          $serveur_adress = "http://27.254.63.182:5630/poemaservices?wsdl";
          break;
      case "ADM":
          $serveur_adress = "http://crystal.edgetahiti.net:5622/poemaservices?wsdl";
          break;
      case "MMR":
          $serveur_adress = "http://27.254.63.182:5640/poemaservices?wsdl";
          break;
  }
    
		//$query = "select distinct usrbdep_user_code from usr_users_branches_departments where usrbdep_branch_id in (15,16,21,22)";
		$array = array(
					"page"   => $_SERVER['REQUEST_URI'],
					"ip"     => $_SERVER['REMOTE_ADDR'],
					"user"   => "test utilisateur",
					"server" => "db_crystal",
					"query"  => $query
				);

		$data = array();
		try {
		  $service = "RunSelect";
		  $webconnect = new SoapClient($serveur_adress);
		  $call = $webconnect->$service($array);
		  $data = $this->get_json_svc($call);
		 return($data);
		} catch (Exception $e) {
			print_r($e);
			return($data);
		}
	}
	
	public function get_json_svc($texte){
	  $string = serialize($texte);
	  $string = str_replace(":[", ":\"", $string);
	  $string = str_replace("],", "\",", $string);
	  $debut = strripos($string, "[");
	  $fin = (strripos($string, "]") - $debut) + 1;
	  $json = substr($string, $debut, $fin);
	  //echo $json;
	  return json_decode($json, true);
	}
}
?>