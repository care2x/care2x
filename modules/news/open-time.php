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
define('LANG_FILE','abteilung.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDOpenHrsTxt);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp()");
 # href for close file
 $smarty->assign('breakfile',$breakfile);
 # href for return file
 //$smarty->assign('pbBack',$returnfile);

 # Window title
 $smarty->assign('title',$LDOpenHrsTxt);

 # Buffer the page output

 $smarty->assign('LDDayTxt', $LDDayTxt); 
 $smarty->assign('LDOpenHrsTxt',$LDOpenHrsTxt);
 $smarty->assign('LDChkHrsTxt',$LDChkHrsTxt);

 $sTemp = '';

 for ($i=0;$i<sizeof($LDOpenDays);$i++){
 
 	$smarty->assign('sOpenDay',$LDOpenDays[$i]);
 	$smarty->assign('sOpenTimes',$LDOpenTimes[$i]);
 	$smarty->assign('sVisitTimes',$LDVisitTimes[$i]);

 	ob_start();
		$smarty->display('common/opentimes_row.tpl');
 		$sTemp = $sTemp.ob_get_contents();
 	ob_end_clean();

}

$smarty->assign('sOpenTimesRows',$sTemp);

$smarty->assign('sBreakFile','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  alt="'.$LDBackTxt.'"></a>');

$smarty->assign('sMainBlockIncludeFile','common/opentimes_table.tpl');

$smarty->display('common/mainframe.tpl');

?>
