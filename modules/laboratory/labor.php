<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Module title in the toolbar

 $smarty->assign('sToolbarTitle',$LDLab);

 # Help button href
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDLab')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDLab);

 # Medical lab submenu block

 $smarty->assign('LDMedLab',$LDMedLab);

 $smarty->assign('LDMedLabTestRequest',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=chemlabor&user_origin=lab\">$LDTestRequest</a>");
 $smarty->assign('LDTestRequestChemLabTxt',$LDTestRequestChemLabTxt);

  $smarty->assign('LDMedLabTestReception',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=admin&subtarget=chemlabor&user_origin=lab\">$LDTestReception</a>");
  $smarty->assign('LDTestReceptionTxt',$LDTestReceptionTxt);

  $smarty->assign('LDSeeData',"<a href=\"labor_datasearch_pass.php?sid=$sid&lang=$lang&route=validroute\">$LDSeeData </a>");
  $smarty->assign('LDSeeLabData',$LDSeeLabData);

  $smarty->assign('LDNewData',"<a href=\"labor_datainput_pass.php?sid=$sid&lang=$lang\">$LDNewData</a>");
  $smarty->assign('LDEnterLabData',$LDEnterLabData);

  # Pathology lab submenu block

  $smarty->assign('LDPathLab',$LDPathLab);

  $smarty->assign('LDPathLabTestRequest',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=patho&user_origin=lab\">$LDTestRequest</a>");
  $smarty->assign('LDTestRequestPathoTxt',$LDTestRequestPathoTxt);

  $smarty->assign('LDPathLabTestReception',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=admin&subtarget=patho&user_origin=lab\">$LDTestReception</a>");

  # Bacteriology lab submenu block

  $smarty->assign('LDBacLab',$LDBacLab);

  $smarty->assign('LDBacLabTestRequest',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=baclabor&user_origin=lab\">$LDTestRequest</a>");
  $smarty->assign('LDTestRequestBacterioTxt',$LDTestRequestBacterioTxt);

  $smarty->assign('LDBacLabTestReception',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=admin&subtarget=baclabor&user_origin=lab\">$LDTestReception</a>");

  # Blood lab submenu block

  $smarty->assign('LDBloodBank',$LDBloodBank);

  $smarty->assign('LDBloodRequest',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=blood&user_origin=lab\">$LDBloodRequest</a>");
  $smarty->assign('LDBloodRequestTxt',$LDBloodRequestTxt);

  $smarty->assign('LDBloodTestReception',"<a href=\"labor_test_request_pass.php?sid=$sid&lang=$lang&target=admin&subtarget=blood&user_origin=lab\">$LDTestReception</a>");

  # Test parameters admin submenu block

  $smarty->assign('LDAdministration',$LDAdministration);

  $smarty->assign('LDTestParameters',"<a href=\"labor_test_param_edit_pass.php?sid=$sid&lang=$lang&user_origin=lab\">$LDTestParameters</a>");
  $smarty->assign('LDTestParametersTxt',$LDTestParametersTxt);
  $smarty->assign('LDTestGroups',"<a href=\"labor_test_group_edit_pass.php?sid=$sid&lang=$lang&user_origin=lab\">$LDTestGroups</a>");
  $smarty->assign('LDTestGroupsTxt',$LDTestGroupsTxt);

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','laboratory/submenu_lab.tpl');

 /**
 * show  Mainframe Template
 */

 $smarty->display('common/mainframe.tpl');

?>
