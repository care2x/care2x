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
   $date_from_timestamp = strtotime(str_replace('/', '-', $_GET['start'].' '.'00:00:00'));
   $date_to_timestamp   = strtotime(str_replace('/', '-', $_GET['end'].' '.'23:59:59'));
   $insurance_type=$_GET['insurance_type'];
   
   
  

}

require_once('gui/gui_reporting_ortho.php');
?>
