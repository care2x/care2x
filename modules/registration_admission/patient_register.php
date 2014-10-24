<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
$lang_tables[]='emr.php';
$lang_tables[]='person.php';
$lang_tables[]='date_time.php';
define('LANG_FILE','aufnahme.php');

$local_user='aufnahme_user';
require($root_path.'include/core/inc_front_chain_lang.php');

//$db->debug=true;

$thisfile=basename(__FILE__);
$default_filebreak=$root_path.'main/startframe.php'.URL_APPEND;

if(empty($_SESSION['sess_path_referer']) || !file_exists($root_path.$_SESSION['sess_path_referer'])) {
    $breakfile=$default_filebreak;
} else {
    $breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
}

if(!isset($_SESSION['sess_pid'])) $_SESSION['sess_pid'] = "";
if(!isset($insurance_show)) $insurance_show=true;

$newdata=1;
$target='entry';

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

 $smarty->assign('sOnLoadJs',"if (window.focus) window.focus();");

 $smarty->assign('pbHelp',"javascript:gethelp('person_reg_newform.php','".$error."','".$error_person_exists."')");

 # Hide the return button
 $smarty->assign('pbBack',FALSE);

/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patreg.php');


require_once($root_path.'include/care_api_classes/class_gui_input_person.php');

$inperson = new GuiInputPerson;

$inperson->setPID($pid);
$inperson->pretext = $sTemp;
$inperson->setDisplayFile('patient_register_show.php');

$sRegForm=$inperson->create();

$smarty->assign('sRegForm',$sRegForm);

$smarty->assign('sSearchLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="patient_register_search.php'.URL_APPEND.'">'.$LDPatientSearch.'</a>');
$smarty->assign('sArchiveLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="patient_register_archive.php'.URL_APPEND.'&newdata=1&from=entry">'.$LDArchive.'</a>');

$sCancel="<a href=";
if($_COOKIE['ck_login_logged'.$sid]) $sCancel.=$breakfile;
else $sCancel.='aufnahme_pass.php';
$sCancel.=URL_APPEND.'><img '.createLDImgSrc($root_path,'cancel.gif','0').' alt="'.$LDCancelClose.'"></a>';

$smarty->assign('pbCancel',$sCancel);

$smarty->assign('sMainBlockIncludeFile','registration_admission/reg_input.tpl');

$smarty->display('common/mainframe.tpl');

?>

