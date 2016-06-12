<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
//require('con_db.php');
//connect_db();
#Load and create paginator object

$lang_tables[]='aufnahme.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


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
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	//$start_timeframe = mktime (0,0,0,$month, 1, $year);
	//$end_timeframe = mktime (0,0,0,$month+1, 0, $year);
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);

// how many rows to show per page
$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


$sql = "SELECT distinct(pid) AS PID ,encounter_nr as ENR FROM care_encounter where pid not in(select distinct(pid) from care_tz_diagnosis) and encounter_date >= '$startdate' AND encounter_date <= '$enddate' LIMIT $offset, $rowsPerPage";
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();


// how many rows we have in database
$query   = "SELECT COUNT(distinct(pid)) AS numrows  FROM care_encounter where pid not in(select distinct(pid) from care_tz_diagnosis)
            and encounter_date >= '$startdate' AND encounter_date <= '$enddate' LIMIT $offset, $rowsPerPage";
$result  = $db->Execute($query);
$row     = $result->FetchRow();
$numrows = $row[0];



require_once('gui/gui_OPD_summary_withoutdiagnosis.php');

?>
