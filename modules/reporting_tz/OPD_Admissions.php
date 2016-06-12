<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
//require('con_db.php');
//connect_db();
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;


/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();
$medical_depts=$dept_obj->getAllMedical();
$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once('include/core/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);







if ($printout) {

	$start = $_GET['start'];
	$end = $_GET['end'];
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start_timeframe);
	$enddate = date("y.m.d", $end_timeframe);
} else {
	$start = mktime(0,0,0,$month, 1, $year);
	$end = mktime(0,0,0,$month+1,1, $year);

	//$start_timeframe = mktime (0,0,0,$month, 1, $year);
	//$end_timeframe = mktime (0,0,0,$month+1, 0, $year);

	$startdate = date("Y-m-d ", $start);
	$enddate = date("Y-m-d", $end);

}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);








require_once('gui/gui_OPD_Admission.php');
?>
