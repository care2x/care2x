<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
$breakfile='technik.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']='technik.php';

if($repair=='ask'){
 	$target=$LDRequest;
	$returnfile='technik-reparatur-anfordern.php?sid='.$sid.'&lang='.$lang;
}else{
  $target=$LDReport;
  $returnfile='technik-reparatur-melden.php?sid='.$sid.'&lang='.$lang;
}

# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDTechSupport);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('tech_ack.php')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

$smarty->assign('sButton','<img '.createComIcon($root_path,'varrow.gif','0').'>');

$smarty->assign('LDAck',$LDAck);
$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align=left>');
$smarty->assign('LDThanksSir',$LDThanksSir); 
$smarty->assign('reporter',$reporter); 
$smarty->assign('LDYour',$LDYour); 
$smarty->assign('target',$target);
$smarty->assign('LDReceived',$LDReceived); 
$smarty->assign('sDate',@formatDate2Local($tdate,$date_format)); 
$smarty->assign('LDAt',$LDAt);
$smarty->assign('sTime',@convertTimeToLocal($ttime));
$smarty->assign('LDAtTech',$LDAtTech); 

$smarty->assign('pbOK','<FORM action="'.$returnfile.'" >
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<INPUT type="submit"  value="  OK  "></font></FORM>');

$smarty->assign('sRepairLink','<a href="technik-reparatur-anfordern.php'.URL_APPEND.'">'.$LDReRepairTxt.'</a>');
$smarty->assign('sReportLink','<a href="technik-reparatur-melden.php'.URL_APPEND.'">'.$LDRepairReportTxt.'</a>');
$smarty->assign('sQuestionLink','<a href="technik-questions.php'.URL_APPEND.'">'.$LDQuestionsTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile','tech/acknowledge.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>