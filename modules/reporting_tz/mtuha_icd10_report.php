<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');




#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting the amunt of different Diagnostic Codes
 */

$rep_obj = new selianreport();

require_once('include/core/inc_timeframe.php');

$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);
$PRINTOUT=FALSE;
if ($_GET['printout']) {
	$start = $_GET['start'];
	$end = $_GET['end'];
	$PRINTOUT=TRUE;
} else {
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	
}


$lang_tables[]='reporting.php';
$lang_tables[]='date_time.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once('gui/gui_mtuha_icd10_report.php');
?>
