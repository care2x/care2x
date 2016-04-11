<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');
require($root_path.'language/en/lang_en_reporting.php');
require($root_path.'language/en/lang_en_date_time.php');
require($root_path.'include/core/inc_date_format_functions.php');

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


require_once('include/core/inc_timeframe.php');
/**
 * Getting the timeframe...
 */
 $debug=FALSE;
$PRINTOUT=FALSE;
if (empty($_GET['printout'])) { 
	
			if ($debug) echo "no time value is set, we´re using now the current month<br>";
			$day=date("d",time());
			$month=date("n",time());
			$year=date("Y",time());
			$start_timeframe = mktime (0,0,0,$month, $day, $year);
			$end_timeframe = mktime (23,59,59,$month, $day, $year);			
			$admission = "";

			
			if(isset($selected_date)&&!empty($selected_date)) 
			{
					$f_date = strtotime($selected_date);       
					$day = date("d",$f_date); 
					$month = date("n",$f_date);
					$year = date("Y",$f_date);
			}
			
			$start_timeframe =  mktime (0,0,0,$month, $day, $year);
			$end_timeframe =   mktime (23,59,59,$month, $day, $year);
			$admission = $_POST['admission_id'];
		
	
} else  {
	$PRINTOUT=TRUE;
} // end of if (empty($_GET['printout']))


require_once('gui/gui_reporting_services.php');
?>
