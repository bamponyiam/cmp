<?php

$serveur_adress = "http://crystal.edgetahiti.net:5622/poemaservices?wsdl";

echo "test1<br>";

echo file_get_contents($serveur_adress);

echo "test22<br>";

$host = '27.254.63.182';
$ports = array(80, 5640);

foreach ($ports as $port)
{

		$connection = @fsockopen($host, $port);

    if (is_resource($connection))
    {
        echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

        fclose($connection);
    }

    else
    {
        echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
    }
}



//phpinfo(INFO_MODULES);

echo "test3<br>";




$query = "select 1";
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
	$options = array(
    'cache_wsdl' => 0,
    'trace' => 1,
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
          )
    ))
	);
  $webconnect = new SoapClient($serveur_adress,$options);
  $call = $webconnect->$service($array);
  $data = get_json_svc($call);
  //$data = $call;
} catch (Exception $e) {
  print_r($e);
}

print_r($data);


function get_json_svc($texte)
{
  $string = serialize($texte);
  $string = str_replace(":[", ":\"", $string);
  $string = str_replace("],", "\",", $string);
  $debut = strripos($string, "[");
  $fin = (strripos($string, "]") - $debut) + 1;
  $json = substr($string, $debut, $fin);
  //echo $json;
  return json_decode($json, true);
}
