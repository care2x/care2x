<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');


#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
*/ 
$rep_obj = new selianreport();

$lang_tables[]='reporting.php';
$lang_tables[]='date_time.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once('include/core/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);

if ($printout) {
	$start = $_GET['start'];
	$end = $_GET['end'];
} else {
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
}

$arr_ret = $rep_obj->Display_OPD_Summary($start,$end);


require_once('gui/gui_OPD_summary.php');
?>
