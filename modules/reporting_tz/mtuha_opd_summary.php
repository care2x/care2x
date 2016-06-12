<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);


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
	$end = mktime (0,0,0,$month+1, 1,$year);
}

$tmp_tbl_admissions=$rep_obj->SetReportingLink_Admissions("care_encounter","pid","encounter_date","care_person","pid",$start,$end,"2");


$arr_reg = $rep_obj->Get_Visits_Count();
$arr_new = $rep_obj->Get_FirstTime_Reg_Count();
$arr_newreg = $rep_obj->Get_New_Reg_Count();
$arr_ret = $rep_obj->Get_Return_Reg_Count();

require_once('gui/gui_mtuha_opd_summary.php');
?>
