<?php
class Divers{
	private static $_instance; //The single instance
	
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function removeqsvar($url, $varname) {
		list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
		parse_str($qspart, $qsvars);
		unset($qsvars[$varname]);
		$newqs = http_build_query($qsvars);
		return $urlpart . '?' . $newqs;
	}
	
	public function get_currency_symbol($string)
	{
		$symbol = '';
		$length = mb_strlen($string, 'utf-8');
		for ($i = 0; $i < $length; $i++)
		{
			$char = mb_substr($string, $i, 1, 'utf-8');
			if (!ctype_digit($char) && !ctype_punct($char))
				$symbol .= $char;
		}
		return $symbol;
	}
	
	public function slug($string, $spaceRepl = "-") {
	  // Replace "&" char with "and"
	  $string = str_replace("&", "and", $string);

	  // Delete any chars but letters, numbers, spaces and _, -
	  $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);

	  // Optional: Make the string lowercase
	  $string = strtolower($string);

	  // Optional: Delete double spaces
	  $string = preg_replace("/[ ]+/", " ", $string);

	  // Replace spaces with replacement
	  $string = str_replace(" ", $spaceRepl, $string);

	  return $string;
	}
	
public function getLines($text, $start, $end = false)
	{
		$devices = explode("</p>", $text);
		$append  = "";

		$output = "";
		foreach ($devices as $key => $line)
		{
			if ($key+1 < $start) continue;
			if ($end && $key+1 > $end) break;
			$output .= $append.$line."<br />";
		}
		return $output;
}

public function getTimeZoneFromIpAddress(){
    $clientsIpAddress = $this->get_client_ip();

    $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress));

    $clientsLatitude = $clientInformation['geoplugin_latitude'];
    $clientsLongitude = $clientInformation['geoplugin_longitude'];
    $clientsCountryCode = $clientInformation['geoplugin_countryCode'];

    $timeZone = $this->get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode) ;

    return $timeZone;

}
	
public function getLangByip(){
	$clientsIpAddress = $this->get_client_ip();

    $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress));
	
	//print_r($clientInformation);
	/*
	.
    [geoplugin_city] => Bangkok
    [geoplugin_region] => Bangkok
    [geoplugin_areaCode] => 0
    [geoplugin_dmaCode] => 0
    [geoplugin_countryCode] => TH
    [geoplugin_countryName] => Thailand
    [geoplugin_continentCode] => AS
    [geoplugin_latitude] => 13.8167
    [geoplugin_longitude] => 100.75
    [geoplugin_regionCode] => 40
    [geoplugin_regionName] => Bangkok
    [geoplugin_currencyCode] => THB
    [geoplugin_currencySymbol] => ฿
    [geoplugin_currencySymbol_UTF8] => ฿
    [geoplugin_currencyConverter] => 35.0548
)

	*/
	
	return strtolower($clientInformation['geoplugin_countryCode']);
}

	public function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

public function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
    $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code)
        : DateTimeZone::listIdentifiers();

    if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

        $time_zone = '';
        $tz_distance = 0;

        //only one identifier?
        if (count($timezone_ids) == 1) {
            $time_zone = $timezone_ids[0];
        } else {

            foreach($timezone_ids as $timezone_id) {
                $timezone = new DateTimeZone($timezone_id);
                $location = $timezone->getLocation();
                $tz_lat   = $location['latitude'];
                $tz_long  = $location['longitude'];

                $theta    = $cur_long - $tz_long;
                $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat)))
                    + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                $distance = acos($distance);
                $distance = abs(rad2deg($distance));
                // echo '<br />'.$timezone_id.' '.$distance;

                if (!$time_zone || $tz_distance > $distance) {
                    $time_zone   = $timezone_id;
                    $tz_distance = $distance;
                }

            }
        }
        return  $time_zone;
    }
    return 'unknown';
}

public function getDateTimeFormat($date_time){
		$p = explode(" ",$date_time);
		$d = explode("-",$p[0]);
		return $d[2].'/'.$d[1].'/'.$d[0].' '.$p[1];
}
	
public function getDateFormat($date){
		$d = explode("-",$date);
		return $d[2].'/'.$d[1].'/'.$d[0];
}
	
public function getDateFormatDB($date){
		$d = explode("/",$date);
		return $d[2].'-'.$d[1].'-'.$d[0];
}
	
public function remove_format($text){
    $text = str_replace(",", "", $text);
    return $text;
}

public function encrype_pass($string){
		
		$key="kolfers1720";
		$iv = mcrypt_create_iv(
		mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
		MCRYPT_DEV_URANDOM
	);

	$encrypted = base64_encode(
		$iv .
		mcrypt_encrypt(
			MCRYPT_RIJNDAEL_128,
			hash('sha256', $key, true),
			$string,
			MCRYPT_MODE_CBC,
			$iv
		)
	);

return $encrypted;
}

public function decrype_pass($string){
	$key="kolfers1720";
	$data = base64_decode($string);
	$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

	$decrypted = rtrim(
		mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			hash('sha256', $key, true),
			substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
			MCRYPT_MODE_CBC,
			$iv
		),
		"\0"
	);

	return $decrypted;
}
}
?>