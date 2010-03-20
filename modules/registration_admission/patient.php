<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_pid')) session_register('sess_pid');
if(!session_is_registered('sess_full_pid')) session_register('sess_full_pid');
if(!session_is_registered('sess_en')) session_register('sess_en');
if(!session_is_registered('sess_full_en')) session_register('sess_full_en');
if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$_SESSION['sess_path_referer'] = 'modules/registration_admission/patient.php';

/**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);


 # Toolbar title
 $smarty->assign('sToolbarTitle',$LDPerson );

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('person_reg.php','$LDDoctors')");

# Window title
 $smarty->assign('sWindowTitle',$LDPerson);
 
 # Prepare the icons
 $aSubMenuIcon = array(createComIcon($root_path,'post_discussion.gif','0') ,
										createComIcon($root_path,'bn.gif','0') ,
										createComIcon($root_path,'discussions.gif','0'),
										createComIcon($root_path,'waiting.gif','0'),
										createComIcon($root_path,'bubble.gif','0'),
										createComIcon($root_path,'eye_s.gif','0'),
										createComIcon($root_path,'discussions.gif','0'),
										createComIcon($root_path,'prescription.gif','0'),
										createComIcon($root_path,'new_group.gif','0'),
										createComIcon($root_path,'people_search_online.gif','0'),
										createComIcon($root_path,'people_search_online.gif','0'),
										createComIcon($root_path,'man-whi.gif','0'),
										createComIcon($root_path,'new_address.gif','0')
										);

# Prepare the submenu links indexed with their template tags

$aSubMenuItem = array('LDPatientRegister' => "<a href=\"patient_register_pass.php".URL_APPEND."&retpath=docs\">$LDPatientRegister</a>",
										'LDAdmission'  => "<a href=\"aufnahme_pass.php".URL_APPEND."&target=dutyplan&retpath=menu\">$LDAdmission</a>",
										'LDVisit'  => "<a href=\"aufnahme_pass.php".URL_APPEND."&target=entry&retpath=docs\">$LDVisit</a>",
										'LDAppointments'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDAppointments</a>",
										'LDDiagXResults'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDDiagXResults</a>",
										'LDDRG'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDDRG</a>",
										'LDProcedures'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDProcedures</a>",
										'LDPrescriptions'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDPrescriptions</a>",
										'LDReports'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDReports</a>",
										'LDImmunization'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDImmunization</a>",
										'LDMeasurements'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDMeasurements</a>",
										'LDPregnancies'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDPregnancies</a>",
										'LDBirthDetails'  => "<a href=\"patient_register_pass.php".URL_APPEND."&target=search&retpath=docs\">$LDBirthDetails</a>"
										);


$aSubMenuText = array($LDPatientRegisterTxt,
										$LDAdmissionTxt,
										$LDVisitTxt,
										$LDAppointmentsTxt,
										$LDDiagXResultsTxt,
										$LDDRGTxt,
										$LDProceduresTxt,
										$LDPrescriptionsTxt,
										$LDPatientDevTxt,
										$LDImmunizationTxt,
										$LDWtHtTxt,
										$LDPregnanciesTxt,
										$LDBirthDetailsTxt
										);


# Create the submenu rows

$iRunner = 0;

while(list($x,$v)=each($aSubMenuItem)){
	$sTemp='';
	ob_start();
		if($cfg['icons'] != 'no_icon') $smarty2->assign('sIconImg','<img '.$aSubMenuIcon[$iRunner].'>');
		$smarty2->assign('sSubMenuItem',$v);
		$smarty2->assign('sSubMenuText',$aSubMenuText[$iRunner]);
		$smarty2->display('common/submenu_row.tpl');
 		$sTemp = ob_get_contents();
 	ob_end_clean();
	$iRunner++;
	$smarty->assign($x,$sTemp);
}


# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','registration_admission/person_submenu.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

?>
