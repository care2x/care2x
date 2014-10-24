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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
//if($edit&&!$_COOKIE[$local_user.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once($root_path.'include/core/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);
$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit";

$bgc1='#fefefe'; 

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 
 # We set the 3rd parameter to FALSE to prevent initiliazing the copyright footer

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing',TRUE,FALSE);

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDReports [ ".ucwords($header)." ]");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('diagnostic_report.php','$LDReports','','$station','$LDReports')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # target for close button
 $smarty->assign('sCloseTarget','target="_top"');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
