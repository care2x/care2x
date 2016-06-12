<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
//require('con_db.php');
//connect_db();
#Load and create paginator object
$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');
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
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}

$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  //$start_timeframe = mktime (0,0,0,$month, 1, $year);
		  //$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);

			//$startdate = date("y.m.d ", $start_timeframe);
		    //$enddate = date("y.m.d", $end_timeframe);

$tmp_table = $rep_obj->SetReportingTable("care_tz_billing_archive_elem");
$tmp_table1 = $rep_obj->SetReportingTable("care_tz_drugsandservices");

//$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");

//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , count( distinct(pid) ) as NEW , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE,count( encounter_nr ) - count( DISTINCT (pid) ) as RET FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$sql="SELECT from_unixtime( date_change, '%d.%m.%y' ) as TEST_DATE FROM $tmp_table where date_change>='$start_timeframe' and date_change <='$end_timeframe' GROUP BY from_unixtime( date_change, '%y.%m.%d' ) ";
//$sql="SELECT DISTINCT(item_description) AS SERVICE  FROM $tmp_table1 WHERE purchasing_class LIKE '%xray' " ;
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();

$sql_d ="DROP TABLE IF EXISTS `tmp_radio`";
		$db_ptr = $db->Execute($sql_d);

$sql1="CREATE  TEMPORARY TABLE tmp_radio SELECT DISTINCT(item_description) AS SERVICE  FROM $tmp_table1 WHERE purchasing_class LIKE '%xray' ORDER BY item_description ASC " ;
$db_ptr1=$db->Execute($sql1);

$sql2="INSERT INTO tmp_radio (SERVICE) VALUES ('TOTAL')";
$db_ptr2=$db->Execute($sql2);

$sql3="SELECT SERVICE  FROM tmp_radio  " ;
$db_ptr3=$db->Execute($sql3);

if ($db_ptr3) {
	$res_array1 = $db_ptr3->GetArray();
} else {
	$res_array1 = FALSE;
	echo "<h1>....nothing to report so far... </h1>";
	die();
}


require_once('gui/gui_radiology_revenue.php');
?>
