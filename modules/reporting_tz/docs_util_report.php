<?php

error_reporting(E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR);
require('./roots.php');
require($root_path . 'include/core/inc_environment_global.php');
//require($root_path . 'include/core/inc_front_chain_lang.php');
//require($root_path . 'language/en/lang_en_reporting.php');
require($root_path . 'language/en/lang_en_date_time.php');
require($root_path . 'include/core/inc_date_format_functions.php');

#Load and create paginator object
require_once($root_path . 'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();

$lang_tables[] = 'date_time.php';
$lang_tables[] = 'reporting.php';
require($root_path . 'include/core/inc_front_chain_lang.php');
require_once('include/core/inc_timeframe.php');
$month = array_search(1, $ARR_SELECT_MONTH);
$year = array_search(1, $ARR_SELECT_YEAR);

if ($printout) {
    $startdate = $_GET['start'];
    $enddate = $_GET['end'];
//    $start_timeframe = $start;
//    $end_timeframe = $end;
//    $startdate = date("y.m.d ", $start_timeframe);
//    $enddate = date("y.m.d", $end_timeframe);
    $amount_per_person = $_GET['amount_per_person'];
} else {
    $startdate = @formatDate2STD($_POST['date_from'], "dd/mm/yyyy");
    (!isset($_POST['date_to']) || $_POST['date_to'] == '') ? $enddate = @formatDate2STD(date('Y-m-d'), "yyyy-mm-dd") : $enddate = @formatDate2STD($_POST['date_to'], "dd/mm/yyyy");
}


if (!isset($_POST['amount_per_person']) || $_POST['amount_per_person'] == '') {
    $amount_per_person = 0;
} else {
    $amount_per_person = $_POST['amount_per_person'];
}


$debug = FALSE;
($debug) ? $db->debug = TRUE : $db->debug = FALSE;


//Get the doctors list and the number of patients they have attended.

$docs_patients = "SELECT name, doctor, sum(attend) AS no_of_patients 
                  FROM care_tz_hospital_doctor_history, care_users
                  WHERE care_tz_hospital_doctor_history.doctor = care_users.login_id
                  AND date >= '$startdate' AND date <= '$enddate' 
                  GROUP BY doctor ORDER BY name asc";
$db_docs_patients = $db->Execute($docs_patients);

require_once('gui/gui_docs_util.php');
?>
