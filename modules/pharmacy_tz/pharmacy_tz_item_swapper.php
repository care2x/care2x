<?php
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');

	require($root_path.'include/core/inc_environment_global.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	$multi= new multi;

	extract($_GET);

	if ($Q>=0){
		$g=($D>0)?1:0;
	    $check = ($g==1)?'checked=\"checked\"':'';
		$r     = ($D>0)?'OOS':'IS';
		$r     = "<input type=\"checkbox\" id=\"itemx".$Q."\" value=\"itemx".$Q."\" ".$check." onclick=\"sendQest(".$Q.")\" >".$r;
		$sql   = 'UPDATE `care_tz_drugsandservices` SET `not_in_use` = '.$g.' WHERE `item_id` ='.$Q;
		print ($db->Execute($sql))?$r:'Error: #'.mysql_errno();
	}


	?>
