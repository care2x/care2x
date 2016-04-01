<?php
function TimeZoneHelper() {
	$all = timezone_identifiers_list();

	$i = 0;
	foreach($all AS $zone) {
		$zone = explode('/',$zone);
		$zonen[$i]['continent'] = isset($zone[0]) ? $zone[0] : '';
		$zonen[$i]['city'] = isset($zone[1]) ? $zone[1] : '';
		$zonen[$i]['subcity'] = isset($zone[2]) ? $zone[2] : '';
		$i++;
	}

	asort($zonen);
	$structure = '';
	foreach($zonen as $zone) {
	  extract($zone);
	  if($continent == 'Africa' || $continent == 'America' || $continent == 'Antarctica' || $continent == 'Arctic' || $continent == 'Asia' || $continent == 'Atlantic' || $continent == 'Australia' || $continent == 'Europe' || $continent == 'Indian' || $continent == 'Pacific') {

		if(isset($city) != ''){
		  if (!empty($subcity) != ''){
			$city = $city . '/'. $subcity;
		  }
		  $structure[] = $continent.'/'.$city;
		} else {
		  if (!empty($subcity) != ''){
			$city = $city . '/'. $subcity;
		  }
		}
	  }
	}
	return $structure;
}

?>
