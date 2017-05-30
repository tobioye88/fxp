<?php

class Utilities {
	public static function reArrayFiles(&$file_post) {

	    $file_ary = array();
	    $file_count = count($file_post['name']);
	    $file_keys = array_keys($file_post);

	    for ($i=0; $i<$file_count; $i++) {
	        foreach ($file_keys as $key) {
	            $file_ary[$i][$key] = $file_post[$key][$i];
	        }
	    }

	    return $file_ary;
	}

	public static function formatMoney($number, $fractional = false ){
		$number = preg_replace('#[^0-9]#i','', $number);
		if($fractional){
			$number = sprintf('%.2f', $number);	
		}
		while(true){
		$replaced = preg_replace("/(-?\d+)(\d\d\d)/", "$1,$2" , $number);
		if($replaced != $number){
			$number = $replaced;
		}else{
			break;	
		}
		}
		return $number;
	}
	
	public function triphoto_getGPS($fileName, $assoc = false){
		//get the EXIF
		$exif = exif_read_data($fileName);
		$result['latitude'] = false;
		$result['longitude'] = false;
	
		//get the Hemisphere multiplier
		$LatM = 1; $LongM = 1;
		if(isset($exif["GPSLatitudeRef"]) && $exif["GPSLatitudeRef"] == 'S'){
			$LatM = -1;
		}
		if(isset($exif["GPSLongitudeRef"]) && $exif["GPSLongitudeRef"] == 'W'){
			$LongM = -1;
		}
	
		//get the GPS data
		if(!isset($exif["GPSLatitude"][0]))
			return $result;
		$gps['LatDegree'] = $exif["GPSLatitude"][0];
		$gps['LatMinute'] = $exif["GPSLatitude"][1];
		$gps['LatgSeconds'] = $exif["GPSLatitude"][2];
		$gps['LongDegree'] = $exif["GPSLongitude"][0];
		$gps['LongMinute'] = $exif["GPSLongitude"][1];
		$gps['LongSeconds'] = $exif["GPSLongitude"][2];
	
		//convert strings to numbers
		foreach($gps as $key => $value){
			$pos = strpos($value, '/');
			if($pos !== false){
				$temp = explode('/',$value);
				$gps[$key] = $temp[0] / $temp[1];
			}
		}
	
		//calculate the decimal degree
		$result['latitude'] = $LatM * ($gps['LatDegree'] + ($gps['LatMinute'] / 60) + ($gps['LatgSeconds'] / 3600));
		$result['longitude'] = $LongM * ($gps['LongDegree'] + ($gps['LongMinute'] / 60) + ($gps['LongSeconds'] / 3600));
	
		if($assoc)
		{
		return $result;
		}
	
		return json_encode($result);
	}
	public static function dateFormat($date, $format="d M Y h:i a"){
		$date = date_create($date);
		return date_format($date, $format);
	}

}