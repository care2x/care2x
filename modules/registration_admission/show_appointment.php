<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);
require_once($root_path.'include/care_api_classes/class_appointment.php');
$obj=new Appointment();
//$db->debug=true;

$bPastDateError = FALSE;

#
# Save PID to session. Patch as result of bug report from Francesco and Marco.
#
if((!isset($pid)||!$pid)&&$_SESSION['sess_pid']) $pid=$_SESSION['sess_pid'];
	elseif(isset($pid)&&$pid) $_SESSION['sess_pid']=$pid;

if(!isset($mode)){
	$mode='show';
} else{
	
	#
	# Validate date against past date
	#
	if($mode=='create'||$mode=='update') {
		include_once($root_path.'include/core/inc_date_format_functions.php');
		$_POST['date']=@formatDate2STD($_POST['date'],$date_format);
		$sBufDate = (int) str_replace('-','',$_POST['date']);
		$sBufToday = (int) date('Ymd');
		$sBufDate = ($sBufDate - $sBufToday);
		#
		# If date in the past, force mode to "select" and erase date data
		#
		if($sBufDate < 0 ){
			$bPastDateError = TRUE;
			$mode = 'select';
			$date = '';
		}
	}

	if($mode=='create'||$mode=='update') {

		$_POST['time']=@convertTimeToStandard($_POST['time']);
		if($mode=='update'){
			if(!isset($_POST['remind_mail'])) $_POST['remind_mail']='0';
			if(!isset($_POST['remind_email'])) $_POST['remind_email']='0';
			if(!isset($_POST['remind_phone'])) $_POST['remind_phone']='0';
            $_POST['modify_id']=$_SESSION['sess_user_name'];
            $_POST['modify_time'] = date('YmdHis');
			$_POST['history']= $obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." : ".$_SESSION['sess_user_name']."\n");
		}else{
			$_POST['appt_status']='pending';
            $_POST['create_id']=$_SESSION['sess_user_name'];
            $_POST['create_time'] = date('YmdHis');
            $_POST['history'] = "Created: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
		}
		include('./include/save_admission_data.inc.php');
	}elseif(($mode=='select')&&!empty($nr)){
		$appt_row=$obj->getAppointment($nr);
		if(is_array($appt_row)){
			extract($appt_row);
			//while(list($x,$v)=each($appt_row)) $$x=$v;
		}
	}elseif($mode=='appt_cancel'&&!empty($nr)){
			$_POST['history']=$obj->ConcatHistory("Cancel: ".date('Y-m-d H:i:s')." : ".$_SESSION['sess_user_name']."\n");
			$_POST['appt_status']='cancelled';
			$_POST['cancel_reason']=$reason;
            $_POST['modify_id']=$_SESSION['sess_user_name'];
            $_POST['modify_time'] = date('YmdHis');
			$mode='update';
		include('./include/save_admission_data.inc.php');
	}
	
}
$lang_tables=array('prompt.php','departments.php');
require('./include/init_show.php');

if($result=&$obj->getPersonsAppointmentsObj($pid)){
	$rows=$result->RecordCount();
}

# Load the encounter classes
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

/* Get all encounter classes */
$encounter_classes=&$enc_obj->AllEncounterClassesObject();

$subtitle=$LDAppointments;
$_SESSION['sess_file_return']=$thisfile;

/* Load departments */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordYet);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
