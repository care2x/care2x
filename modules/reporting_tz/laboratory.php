<?php
/*
 * Created on 05.04.2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_lab.php');
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');

/**
 * Getting the timeframe...
 */
 $debug=false;
$PRINTOUT=FALSE;
if (empty($_GET['printout'])) {
	if (empty($_POST['month']) && empty($_POST['year'])) {

		if ($debug) echo "no time value is set, we�re using now the current month<br>";

		$month=date("n",time());
		$year=date("Y",time());

		$start_timeframe = mktime (0,0,0,$month, 1, $year);
		$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
	} else {

		if ($debug) echo "Getting an new time range...<br>";
		$start_timeframe = mktime (0,0,0,$_POST['month'], 1, $_POST['year']);
		$end_timeframe = mktime (0,0,0,$_POST['month']+1, 0, $_POST['year']);
	}
} else  {
	$PRINTOUT=TRUE;
} // end of if (empty($_GET['printout']))

if (empty($_POST['group_id']) && empty($_GET['group_id'])) {
	if ($debug) echo "--->Ignition call, setting the requested laboratory group to 1<br>";
	$group_id="";
} else {
	if ($debug) echo "--->getting an post variable about the requested group id<br>";
	if (empty($_GET['group_id']))
		$group_id=$_POST['group_id'];
	else
		$group_id=$_GET['group_id'];
}


/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();
$lab_obj=new Lab();
$db->debug=false;

$sql_l ="DROP  TABLE IF EXISTS `tmp_laboratory`";
$db->Execute($sql_l);

$sql="CREATE TEMPORARY TABLE tmp_laboratory (SELECT
  group_id as GroupID,
  id as GroupName,
  nr as TestNr,
  nr as TestID,
  shortname as TestName,
  name as FullTestName
FROM care_tz_laboratory_param
WHERE status!='hidden')";

/*
$sql="CREATE TABLE tmp_laboratory  (SELECT
  care_tz_laboratory_tests.id as GroupID,
  care_tz_laboratory_tests.name as GroupName,
  care_tz_laboratory_param.id as TestID,
  care_tz_laboratory_param.shortname as TestName
FROM care_tz_laboratory_tests
INNER JOIN care_tz_laboratory_param ON care_tz_laboratory_param.group_id=care_tz_laboratory_tests.id WHERE is_enabled=1)";
*/
$db->Execute($sql);

$sql="CREATE  TEMPORARY TABLE tmp_laboratory_tests (TestID INT NOT NULL,is_positive INT NOT NULL, date INT NOT NULL ) ";
//$sql="ALTER tmp_laboratory_tests INDEX test_id(`TestID`)";
$db->Execute($sql);

//$sql="Select * from care_test_findings_chemlab where encounter_nr=2006500443";

$sql="Select nr,paramater_name as serial_value, parameter_value as add_value ,UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) as date 
from care_test_findings_chemlabor_sub INNER JOIN care_tz_laboratory_param
ON care_test_findings_chemlabor_sub.paramater_name = care_tz_laboratory_param.id 
WHERE UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) >=$start_timeframe 
AND UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) <= '$end_timeframe' 
ORDER BY care_test_findings_chemlabor_sub.create_time DESC";

//echo $sql;

$db_obj=$db->Execute($sql);
$row=$db_obj->GetArray();
while (list($u,$v)=each($row)){
	//$a =  unserialize($v['serial_value']); // Here we can find the value given to each test-id
	//$b =  unserialize($v['add_value']); // Here we can find the information if it was a check box or not
	//echo "array a:"; print_r($a); echo "<br>";
	//echo "array b:"; print_r($b); echo "<br>";

	$nr = $v['nr'];
	$a = $v['serial_value'];
	$b = $v['add_value'];
	
			if (strpos($a,'+')===0)
			$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$nr.",1,".$v['date'].")";
		else
			$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$nr.",0,".$v['date'].")";
		$db->Execute($sql);

//echo $sql;
	
		if ($debug) echo date("F j, Y, g:i a", $v['date'])."<br>";
	
		//echo (strpos($av,'check'))."<br>";
		if (strpos($a,'check')===0)
			$sql="update tmp_laboratory_tests set is_positive=1 where TestID=$nr AND date='$v[date]'";
			//$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$au.",1,".$v['date'].")";
		else
			$sql="update tmp_laboratory_tests set is_positive=0 where TestID=$nr AND date='$v[date]'";
			//$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$au.",0,".$v['date'].")";
		$db->Execute($sql);
		if ($debug) echo date("F j, Y, g:i a", $v['date'])."<br>";
	}



$sql_number_of_columns = "SELECT count(TestID) FROM tmp_laboratory";
$db_prt = $db->Execute($sql_number_of_columns);
$db_row = $db_prt->FetchRow();
$number_of_columns = $db_row[0];
//echo "Amount of available tests: ".$db_row[0];

function Display_TestGroupSelectItems($group_id) {
	global $db; 
	$sql ="SELECT DISTINCT GroupID, GroupName, FullTestName FROM tmp_laboratory WHERE  GroupID=-1  ORDER BY GroupID";
	$db_obj=$db->Execute($sql); 
	
		echo "<option value=''></option>";
	$row = $db_obj->GetArray();	
	while (list($u,$v)=each($row)) {

		if ($group_id == $v['GroupName'])
			echo "<option value=".$v['GroupName']." selected>".$v['FullTestName']."</option>";
		else
			echo "<option value=".$v['GroupName'].">".$v['FullTestName']."</option>";
	}
}



function DisplayLaboratoryTableHead($group_id) {
	global $db;   
	global $PRINTOUT;
	// Table definition will be organized by the variable $table_head from here:
	$table_head = "<tr>\n";   
	if ($PRINTOUT)
		$table_head .= "<td>&nbsp;</td>\n";
	else
		$table_head .= "<td bgcolor=\"#ffffaa\">&nbsp;</td>\n";

	// Line of all groups
	$sql_groups = "SELECT count(GroupID) as colspan, GroupID,FullTestName FROM tmp_laboratory WHERE GroupID='".$group_id."' GROUP BY GroupID";
	$db_prt = $db->Execute($sql_groups); 
	$db_array = $db_prt->GetArray();

	while (list($u,$v)=each($db_array)) {
		$table_head .= "<td colspan=\"".$v['colspan']."\" bgcolor=\"#ffffaa\" id=\"".$v['GroupID']."\"> <div align=\"center\"><h1>".$v['GroupID']."</h1></div></td>\n" ;
	}
	$table_head.="</tr>\n<tr>";
	if ($PRINTOUT)
		$table_head .= "<td>day</td>\n";
	else
		$table_head .= "<td bgcolor=\"#CC9933\">Date</td>\n";
	$sql_tests = "SELECT TestID, TestName, FullTestName FROM tmp_laboratory WHERE GroupID='".$group_id."'"; 
	$db_prt=$db->Execute($sql_tests); 
	$db_row=$db_prt->GetArray();
	while (list($u,$v)=each($db_row)) {
		if (empty($v['FullTestName']))
			$testname=$v['TestName'];
		else
			$testname=$v['FullTestName'];
		
		if ($PRINTOUT)
			$table_head .= "<td id=\"".$v['TestID']."\">".$testname."</td>\n" ;
		else
			$table_head .= "<td bgcolor=\"#CC9933\" id=\"".$v['TestID']."\">".$testname."</td>\n" ;
	}

	echo $table_head;
}

function NumberOfTests($TestID,$day_as_timestamp) {
	global $db;
	$debug=false;
	// getting the day: start_time_frame plus day is what we need:
	$start_time = $day_as_timestamp;
	$end_time   = $day_as_timestamp+(24*60*60-1);
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$day_as_timestamp)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(TestID) as number_of_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." )";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_tests']."<br><br>";

	$return_value = $row['number_of_tests'];
	if ($pos=NumberOfPositiveTests($TestID,$day_as_timestamp)) {
	  $return_value .= "($pos+)";
	}
	return $return_value;
}

function NumberOfPositiveTests($TestID,$day_as_timestamp) {
	global $db;
	$debug = false;
	// getting the day: start_time_frame plus day is what we need:
	$start_time = $day_as_timestamp;
	$end_time   = $day_as_timestamp+(24*60*60-1);
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$day_as_timestamp)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(is_positive) as number_of_positive_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." ) AND is_positive=1";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_positive_tests']."<br><br>";
	return $row['number_of_positive_tests'];
}

function NumberOfTestsOfMonth($TestID,$start_time) {
	global $db;
	$debug=FALSE;
	if (empty($TestID)) return "-1";
	$end_time = mktime(0,0,0,date("n",$start_time)+1,1,date("Y",$start_time))-1;
	// getting the day: start_time_frame plus day is what we need:
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$start_time)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(TestID) as number_of_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." )";
	if ($debug) echo $sql."<br>";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_tests']."<br><br>";
	$return_value = $row['number_of_tests'];
	if ($pos=NumberOfPositiveTestsOfMonth($TestID,$start_time)) {
	  $return_value .= "($pos+)";
	}
	return $return_value;
}

function NumberOfPositiveTestsOfMonth($TestID,$start_time) {
	global $db;
	$debug = FALSE;
	$end_time = mktime(0,0,0,date("n",$start_time)+1,1,date("Y",$start_time))-1;
	// getting the day: start_time_frame plus day is what we need:
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$start_time)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(is_positive) as number_of_positive_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." ) AND is_positive=1";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_positive_tests']."<br><br>";
	return $row['number_of_positive_tests'];
}


function _get_requested_day($start_time_frame, $day) {
	/**
	 * Private function: getting the exact date, beginning with start_time_frame (UNIX timestamp)
	 * adding the value given in the variable "day"
	 * Return value is an UNIX-Timestamp
	 */
	 $sec_to_add = $day * 24 * 60 * 60;
	 return $requested_day = $start_time_frame + $sec_to_add;
}

function DisplayLaboratoryTestSummary($group_id, $start_time_frame, $end_time_frame) {
	global $db;
	global $PRINTOUT;
	global $LDShowentriesinthetimeof, $LDtill;

	$table ="<tr>\n";
	echo $LDShowentriesinthetimeof." <b>".date("F j, Y",$start_time_frame)."</b> ".$LDtill." <b>".date("F j, Y",$end_time_frame)."</b><br>";

	$first_day_of_req_month = date ("d",$start_time_frame);
	$last_day_of_req_month = date ("d",$end_time_frame);

	// is "today" between start_time_frame and end_time_frame - or even older??
	$SHOW_ITALIC=FALSE;
	if (($start_time_frame<time() && $end_time_frame) || $start_time_frame>time())
		$SHOW_ITALIC=TRUE; // Yes, then we should might display it in italic ...

	for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
		$current_day = _get_requested_day($start_time_frame, $day-1);

		$table.="<tr>\n";
		if ($current_day > time())
			if ($PRINTOUT)
				$table .= "<td><i>".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</i></td>\n";
			else
				$table .= "<td bgcolor=\"#ffffff\"><i>".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</i></td>\n";
		else
			$table .= "<td bgcolor=\"#ffffaa\">".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</td>\n";

		$sql = "SELECT TestID FROM tmp_laboratory WHERE GroupID='".$group_id."'";  

		$db_ptr=$db->Execute($sql);
		$arr_ret = $db_ptr -> GetArray();
		while (list($u,$v)=each($arr_ret)) {
			if (empty($v['TestID'])) {
				$number_of_hits = "-1";
			} else {
				$number_of_hits = NumberOfTests($v['TestID'],_get_requested_day($start_time_frame, $day-1));
			}
			$amount_string = "0";
			if ($number_of_hits>0)
				$amount_string = "<b>$number_of_hits</b>";
			else
				$amount_string = "0";

			if ($current_day > time())
				if ($PRINTOUT)
					$table .= "<td id=\"".$v['TestID']."\" align=\"center\">--</td>\n";
				else
					$table .= "<td bgcolor=\"#ffffff\" id=\"".$v['TestID']."\" align=\"center\">--</td>\n";
			else
				$table .= "<td bgcolor=\"#ffffaa\" id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
		}
		$table .="</tr>\n";
	}

	echo $table;
}

function DisplayResultRow($group_id, $start_time_frame, $end_time_frame) {
	global $db;
	global $PRINTOUT;
	$table ="<tr>\n";
	$first_day_of_req_month = date ("d",$start_time_frame);
	$last_day_of_req_month = date ("d",$end_time_frame);

	$table.="<tr>\n";
	$table .= "<td bgcolor=\"#CC9933\" align = \"center\"><strong>&sum;</strong></td>\n";
	$sql = "SELECT TestID FROM tmp_laboratory WHERE GroupID='".$group_id."'";  
	$db_ptr=$db->Execute($sql);
	$arr_ret = $db_ptr -> GetArray();
	while (list($u,$v)=each($arr_ret)) {
		$number_of_hits = NumberOfTestsOfMonth($v['TestID'],$start_time_frame);
		$amount_string = "0";
		if ($number_of_hits>0)
			$amount_string = "<b>$number_of_hits</b>";
		if ($PRINTOUT)
			$table .= "<td id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
		else
			$table .= "<td bgcolor=\"#CC9933\" id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
	}
	$table .="</tr>\n";

	echo $table;

}

require_once('include/core/inc_timeframe.php');

require_once('gui/gui_laboratory.php');
?>
