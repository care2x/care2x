<?php

/**
*  signalNewDiagnosticsReportEvent will set an event instance in the 
*  care_nursing_station_patients_diagnostics_report table
*  signalling the availability of a report.
*  param $report_date = the date (in local format) of the creation of the report
*  param $script_name = the script string that will be used to run the display of the report
*  return 
*/
function signalNewDiagnosticsReportEvent($report_date='', $script_name='labor_test_findings_printpop.php')
{
   global $db, $local_user, $sid, $batch_nr, $pn, $_SESSION, $target,$dept_nr,$formtitle,
   				$subtarget, $LDDbNoRead, $LDDbNoSave, $date_format, $entry_date,$root_path;
   
	# Check if the formatDate2Local function is loaded 
	if(!function_exists('formatDate2Local'))   include_once($root_path.'include/inc_date_format_functions.php');

	# Load the visual signalling defined constants
	if(!function_exists('setEventSignalColor')) include_once($root_path.'include/inc_visual_signalling_fx.php');
	
	# Create a core object
	include_once($root_path.'include/care_api_classes/class_core.php');
	$core = & new Core;


    $entry_table='care_encounter_diagnostics_report';
									
    $report_exits=0; # assume that report does not exist yet
	
	if(empty($report_date)){
		$report_date=date('Y-m-d');
	}else{
		$report_date=formatDate2Std($report_date,$date_format);
	}
									
    # Check first if a copy is already existing. If yes = update entry, no = insert new entry
									
    $sql="SELECT item_nr FROM $entry_table WHERE report_nr=$batch_nr";
									
    if($ergebnis=$db->Execute($sql))
    {
										
        if($ergebnis->RecordCount())  
		{
										
			 $report=$ergebnis->FetchRow();
											 
			$sql="UPDATE $entry_table SET
						report_date='".$report_date."',
						report_time='".date('H:i:s')."',
						status='pending',
						history=".$core->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."'
						WHERE item_nr='".$report['item_nr']."'";
		}
		else
		{
			$sql="INSERT INTO  $entry_table
					(
						report_nr,
						report_date,
						report_time,
						reporting_dept,
						reporting_dept_nr,
						encounter_nr,
						script_call,
						status,
						history,
						create_id,
						create_time
					)
					VALUES
					(
						'$batch_nr',
						'".$report_date."',
						'".date('H:i:s')."',
						'$formtitle',
						'$dept_nr',
						'$pn',
						'".$script_name."?entry_date=".$entry_date."&target=".$target."&subtarget=".$subtarget."&dept_nr=".$dept_nr."&batch_nr=".$batch_nr."&pn=".$pn."',
						'pending',
						'Initial report: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n\r',
						'".$_SESSION['sess_user_name']."',
						'".date('YmdHis')."'
					)";
																						
		}
		 //echo $sql;
									    
		if($ergebnis=$core->Transact($sql))
		{
		    /* If the findings are succesfully saved, make an entry into the care_encounter_diagnostics_report table
		    *  for signalling purposes
		    */	
			setEventSignalColor($pn, SIGNAL_COLOR_DIAGNOSTICS_REPORT, SIGNAL_COLOR_LEVEL_FULL);
		
		   return true;
		
		 }
		 else
		 {
		    echo "$sql $LDDbNoSave"; // for debugging. comment out for normal runs
			return false;
	     }
 
 }else{
	echo "$sql $LDDbNoRead"; // for debugging. comment out for normal runs
	return false;
	}

}
