<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
//require('con_db.php');
//connect_db();
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once('include/core/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);

if ($printout) {
	$start = $_GET['start'];
	$end =$_GET['end'];
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start_timeframe);
	$enddate = date("y.m.d", $end_timeframe);
} else {
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	$start_timeframe = mktime (0,0,0,$month, 1, $year);
	$end_timeframe = mktime (0,0,0,$month+1, 0, $year);
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);



$tmp_table = $rep_obj->SetReportingTable("care_encounter");

$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");

$sql_d ="DROP TEMPORARY TABLE IF EXISTS `tmp_ward`";
$db->Execute($sql_d);

$sql_tmp_ward = "CREATE TEMPORARY TABLE tmp_ward  (SELECT nr,ward_id,name,is_temp_closed,status FROM care_ward)";
$db->Execute($sql_tmp_ward);

$sql_e ="DROP TEMPORARY TABLE IF EXISTS `tmp_table`";
$db->Execute($sql_e);

$sql_tmp_enc = "CREATE TEMPORARY TABLE tmp_table  (SELECT encounter_nr,current_ward_nr,discharge_date FROM care_encounter
WHERE UNIX_TIMESTAMP(discharge_date) >= '$start' AND UNIX_TIMESTAMP(discharge_date) <= '$end')";
$db->Execute($sql_tmp_enc);


require_once('gui/gui_IPD_discharge.php');
?>
