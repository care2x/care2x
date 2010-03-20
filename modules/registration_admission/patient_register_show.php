<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
//$breakfile='patient.php';

if($_COOKIE["ck_login_logged".$sid]) $breakfile=$root_path."main/startframe.php".URL_APPEND;
	else $breakfile="patient.php".URL_APPEND."&target=entry";

$admissionfile='aufnahme_start.php'.URL_APPEND;

# Resolve PID
if((!isset($pid)||!$pid)&&$_SESSION['sess_pid']) $pid=$_SESSION['sess_pid'];

# Save session data
$_SESSION['sess_path_referer']=$top_dir.$thisfile;
$_SESSION['sess_file_return']=$thisfile;
$_SESSION['sess_pid']=$pid;
//$_SESSION['sess_full_pid']=$pid+$GLOBAL_CONFIG['person_id_nr_adder'];
$_SESSION['sess_parent_mod']='registration';
$_SESSION['sess_user_origin']='registration';
# Reset the encounter number
$_SESSION['sess_en']=0;

# Create the person show GUI
require_once($root_path.'include/care_api_classes/class_gui_person_show.php');
$person = & new GuiPersonShow;

# Set PID to load the data
$person->setPID($pid);

# Import the current encounter number
$current_encounter = $person->CurrentEncounter();

# Import the death date
$death_date = $person->DeathDate();

# Load GUI page
//include('./gui_bridge/default/gui_person_reg_show.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in the toolbar
 $smarty->assign('sToolbarTitle',$LDPatientRegister);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDPatientRegister')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPatientRegister);

 # Onload Javascript code
 $smarty->assign('sOnLoadJs',"if (window.focus) window.focus();");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('person_admit.php')");

 # Hide the return button
 $smarty->assign('pbBack',FALSE);

# Loads the standard gui tags for the registration display page
require('./gui_bridge/default/gui_std_tags.php');

# Collect additional javascript code
ob_start();
?>

<script  language="javascript">
<!--
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}
-->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Append the extra javascript to JavaScript block
$smarty->append('JavaScript',$sTemp);

# Load the tabs
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patreg.php');

# Display the data
$sRegForm = $person->create();

$smarty->assign('sRegForm',$sRegForm);

# Load and display the options table
ob_start();
	require('./gui_bridge/default/gui_patient_reg_options.php');
	$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sRegOptions',$sTemp);

# If the data is not new , show new search button

if (!$newdata) { 

	if($target=="search") $newsearchfile='patient_register_search.php'.URL_APPEND;
		else $newsearchfile='patient_register_archive.php'.URL_APPEND;

	$smarty->assign('pbNewSearch',"<a href=\"$newsearchfile\"><img ".createLDImgSrc($root_path,'new_search.gif','0','absmiddle')."></a>");
}

$smarty->assign('pbUpdateData',"<a href=\"patient_register.php".URL_APPEND."&pid=$pid&update=1\"><img ".createLDImgSrc($root_path,'update_data.gif','0','absmiddle')."></a>");

# If currently admitted show button link to admission data display
if($current_encounter){

	$smarty->assign('pbShowAdmData',"<a href=\"aufnahme_daten_zeigen.php".URL_APPEND."&encounter_nr=$current_encounter&origin=patreg_reg\"><img ".createLDImgSrc($root_path,'admission_data.gif','0','absmiddle')."></a>");

# Else if person still living, show button links to admission
}elseif(!$death_date||$death_date==$dbf_nodate){

	$smarty->assign('pbAdmitInpatient',"<a href=\"$admissionfile&pid=$pid&origin=patreg_reg&encounter_class_nr=1\"><img ".createLDImgSrc($root_path,'admit_inpatient.gif','0','absmiddle')."></a>");
	$smarty->assign('pbAdmitOutpatient',"<a href=\"$admissionfile&pid=$pid&origin=patreg_reg&encounter_class_nr=2\"><img ".createLDImgSrc($root_path,'admit_outpatient.gif','0','absmiddle')."></a>");
}
//gjergji
//$smarty->assign('pbAdmitPrintout',"<a href=". $root_path."modules/pdfmaker/registration/regdata_admit.php".URL_APPEND."&pid=".$pid ." target=_blank><img ".createLDImgSrc($root_path,'printout.gif','0','absmiddle')."></a>'");
$smarty->assign('pbAdmitPrintout',"<a href=". $root_path."modules/registration_admission/reports/sample.php".URL_APPEND."&pid=".$pid . "><img ".createLDImgSrc($root_path,'printout.gif','0','absmiddle')."></a>'");
//end :  gjergji
# Create new button to fresh input form
$sNewRegBuffer='
<form action="patient_register.php" method=post>
<input type=submit value="'.$LDRegisterNewPerson.'">
<input type=hidden name="sid" value="'.$sid.'">
<input type=hidden name="lang" value="'.$lang.'">
</form>';

$smarty->assign('pbRegNewPerson',$sNewRegBuffer);

# Assign help links
$smarty->assign('sSearchLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="patient_register_search.php'.URL_APPEND.'">'.$LDPatientSearch.'</a>');
$smarty->assign('sArchiveLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="patient_register_archive.php'.URL_APPEND.'&newdata=1&from=entry">'.$LDArchive.'</a>');

$sCancel="<a href=";
if($_COOKIE['ck_login_logged'.$sid]) $sCancel.=$breakfile;
	else $sCancel.='aufnahme_pass.php';
$sCancel.=URL_APPEND.'><img '.createLDImgSrc($root_path,'cancel.gif','0').' alt="'.$LDCancelClose.'"></a>';

$smarty->assign('pbCancel',$sCancel);

# Assign the page template to mainframe block
$smarty->assign('sMainBlockIncludeFile','registration_admission/reg_show.tpl');

# Show main frame
$smarty->display('common/mainframe.tpl');

?>
