<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php','departments.php','actions.php','prompt.php');
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
//define('NO_CHAIN',1);
$local_user='aufnahme_user';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');

if(!isset($currDay)||!$currDay) $currDay=date('d');
if(!isset($currMonth)||!$currMonth) $currMonth=date('m');
if(!isset($currYear)||!$currYear) $currYear=date('Y');
if(isset($_SESSION['sess_parent_mod'])) $_SESSION['sess_parent_mod']='';

$thisfile=basename(__FILE__);
$editorfile=$root_path.'modules/registration_admission/show_appointment.php';
require_once($root_path.'include/care_api_classes/class_appointment.php');
$appt_obj=new Appointment();

if(!isset($mode)){
	$mode='show';
}elseif($mode=='appt_cancel'&&!empty($nr)){
	if($appt_obj->cancelAppointment($nr,$reason,$_SESSION['sess_user_name'])){
		header("location:$thisfile".URL_REDIRECT_APPEND."&currYear=$currYear&currMonth=$currMonth&currDay=$currDay");
		exit;
	}else{
		echo "$appt_obj->sql<br>$LDDbNoUpdate";
	}	
}

if($mode=='show'){
	# Clean doc
	if(isset($aux)) $aux=trim($aux);
	# Get the appointments basing on some conditions
	if((isset($dept_nr) && $dept_nr)){
		# Get by department
		$result=&$appt_obj->getAllByDeptObj($currYear,$currMonth,$currDay,$dept_nr);
	}elseif(isset($aux)&&!empty($aux)){
		# Get by doctor
		$result=&$appt_obj->getAllByDocObj($currYear,$currMonth,$currDay,$aux);
	}else{
		# Get all appointments
		$result=&$appt_obj->getAllByDateObj($currYear,$currMonth,$currDay);
	}
}

$_SESSION['sess_parent_mod']='';
$_SESSION['sess_appt_dept_nr']='';
$_SESSION['sess_appt_doc']='';

# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

# load all encounter classes
if($ec_obj=&$enc_obj->AllEncounterClassesObject()){
	# Prepare to an array, technique is used in listing routines
	while($ec_row=$ec_obj->FetchRow()) $enc_class[$ec_row['class_nr']]=$ec_row;
}

# Load departments
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');

# Set the break (return) file
switch($_SESSION['sess_user_origin']){
	case 'amb': $breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND; break;
	default: $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
}
# Create department object
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
# Load all medical departments
$med_arr=&$dept_obj->getAllMedical();

# Prepare the html select options
$options='';
while(list($x,$v)=each($med_arr)){
	if($x==42) continue;
	$buffer=$v['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) $buf2=$$buffer;
		else $buf2=$v['name_formal'];	
	$options.='
	<option value="'.$v['nr'].'"';
	if ($dept_nr==$v['nr']){
		$options.=' selected';
		$curr_dept=$buf2;
	}
	$options.='>'.$buf2.'</option>';
}

# Load the common icons 
$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDAppointments);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('appointment_show.php')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDAppointments);

 # Collect extra javascript code
 
 ob_start();

?>

<script language="javascript">
<!-- 

var urlholder;

function popinfo(l,d){
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");
}

-->
</script>

<?php 

	$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer calendar output

ob_start();
	/*generate the calendar */
	include($root_path.'classes/calendar_jl/class.calendar.php');
	/** CREATE CALENDAR OBJECT **/
	$Calendar = new Calendar;
	/** WRITE CALENDAR **/
	$Calendar -> mkCalendar ($currYear, $currMonth, $currDay,$dept_nr,$aux);

	$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sMiniCalendar',$sTemp);

$smarty->assign('LDListApptByDept',$LDListApptByDept);
$smarty->assign('sByDeptSelect','<select name="dept_nr">
			<option value="">'.$LD_AllMedicalDept.'</option>'.$options.'
			</select>');
$smarty->assign('sByDeptHiddenInputs','<input type="submit" value="'.$LDShow.'">
			<input type="hidden"  name="currYear" value="'.$currYear.'">
			<input type="hidden"  name="currMonth" value="'.$currMonth.'">
			<input type="hidden"  name="currDay" value="'.$currDay.'">
			<input type="hidden"  name="sid" value="'.$sid.'">
			<input type="hidden"  name="lang" value="'.$lang.'">');

$smarty->assign('LDListApptByDoc',$LDListApptByDoc);
$smarty->assign('sByDocSelect','<input type="text" name="aux" size=35 maxlength=40 value="'.$aux.'">');
$smarty->assign('sByDocHiddenInputs','<input type="submit" value="'.$LDShow.'">
			<input type="hidden"  name="name_last" value="">
			<input type="hidden"  name="name_first" value="">
			<input type="hidden"  name="date_birth" value="">
			<input type="hidden"  name="personnel_nr" value="">
			<input type="hidden"  name="currYear" value="'.$currYear.'">
			<input type="hidden"  name="currMonth" value="'.$currMonth.'">
			<input type="hidden"  name="currDay" value="'.$currDay.'">
			<input type="hidden"  name="sid" value="'.$sid.'">
			<input type="hidden"  name="lang" value="'.$lang.'">');

/* show the appointments */
if($appt_obj->count){
	# Buffer output
	ob_start();
		include('./gui_bridge/default/gui_show_appointment.php');
		$sTemp = ob_get_contents();
	ob_end_clean();
	$smarty->assign('sApptList',$sTemp);
}else{
	$smarty->assign('bShowPrompt',TRUE);
	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>');
	$smarty->assign('sPrompt',((date('Y-m-d'))==$currYear.'-'.$currMonth.'-'.$currDay) ? $LDNoPendingApptToday : $LDNoPendingApptThisDay);
}

$smarty->assign('sButton','<img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle',TRUE).'>');
$smarty->assign('sNewApptLink','<a href="'.$root_path.'modules/registration_admission/patient_register_pass.php'.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target=search">'.$LDScheduleNewAppointment.'</a>');

$smarty->assign('pbClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').' alt="'.$LDCloseAlt.'">');

$smarty->assign('sMainBlockIncludeFile','appointment/appt_list.tpl');

 /**
 * show Template
 */

$smarty->display('common/mainframe.tpl');

 ?>
