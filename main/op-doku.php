<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

setcookie(firstentry,''); // The cookie "firsentry" is used for switching the cat image

/* Check the start script as break destination*/
if (!empty($_SESSION['sess_path_referer'])&&($_SESSION['sess_path_referer']!=$top_dir.$thisfile)){
	if(file_exists($root_path.$_SESSION['sess_path_referer'])){
		$breakfile=$_SESSION['sess_path_referer'];
	}else {
		 /* default startpage */
		$breakfile = 'main/startframe.php';
	}
} else {
		 /* default startpage */
		$breakfile = 'main/startframe.php';
}
$breakfile=$root_path.$breakfile.URL_APPEND;

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$_SESSION['sess_path_referer']=$top_dir.$thisfile;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Module title in the toolbar

 $smarty->assign('sToolbarTitle',$LDOr);

 # Help button href
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDOr')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDOr);
 
 # Append javascript code to javascript block

  $sTemp = '<SCRIPT language="JavaScript" src="'. $root_path.'js/sublinker-nd.js"></SCRIPT>';

  $smarty->append('JavaScript',$sTemp);

  # Create the submenu blocks

  # OR Surgeons submenu block

  $smarty->assign('LDOrDocs',"<img ".createLDImgSrc($root_path,'arzt2.gif','0','absmiddle')."  alt=\"$LDDoctor\">");

  $smarty->assign('LDOrDocument',"<a href=\"".$root_path."modules/op_document/op-doku-pass.php".URL_APPEND."\" onmouseover=\"ssm('ALog'); clearTimeout(timer)\"
		onmouseout=\"timer=setTimeout('hsm()',1000)\" >$LDOrDocument</a>");
  $smarty->assign('LDOrDocumentTxt',$LDOrDocumentTxt);

  $smarty->assign('LDQviewDocs',"<a href=\"".$root_path."modules/doctors/doctors-dienst-schnellsicht.php".URL_APPEND."&retpath=op\">$LDDOC $LDQuickView</a>");
  $smarty->assign('LDQviewTxtDocs',$LDQviewTxtDocs);

# OR Nursing submenu block

 $smarty->assign('LDOrNursing',"<img ".createLDImgSrc($root_path,'pflege2.gif','0','absmiddle')."  alt=\"$LDNursing\">");

 $smarty->assign('LDOrLogBook',"<a href=\"".$root_path."modules/or_logbook/op-pflege-logbuch-pass.php".URL_APPEND."\" onmouseover=\"ssm('PLog'); clearTimeout(timer)\"
      onmouseout=\"timer=setTimeout('hsm()',1000)\" >$LDOrLogBook</a>");
 $smarty->assign('LDOrLogBookTxt',$LDOrLogBookTxt);

  $smarty->assign('LDORNOCQuickView',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienst-schnellsicht.php".URL_APPEND."\">$LDORNOC $LDQuickView</a>");
  $smarty->assign('LDQviewTxtNurse',$LDQviewTxtNurse);

  $smarty->assign('LDORNOCScheduler',"<a href=\"".$root_path."modules/nursing_or/nursing-or-main-pass.php".URL_APPEND."&retpath=menu&target=dutyplan\" onmouseover=\"ssm('PDienstplan'); clearTimeout(timer)\"
      onmouseout=\"timer=setTimeout('hsm()',1000)\">$LDORNOC $LDScheduler </a>");
  $smarty->assign('LDDutyPlanTxt',$LDDutyPlanTxt);

  $smarty->assign('LDOnCallDuty',"<a href=\"spediens-bdienst-zeit-erfassung.php".URL_APPEND."&retpath=op&encoder=".$_COOKIE['ck_login_username'.$sid]."\">$LDOnCallDuty</a>");
  $smarty->assign('LDOnCallDutyTxt',$LDOnCallDutyTxt);

  # OR Anesthesia submenu block

  $smarty->assign('LDORAnesthesia',"<img ".createLDImgSrc($root_path,'anaes.gif','0','absmiddle')."  alt=\"$LDAna\">");

  $smarty->assign('LDORAnaQuickView',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienst-schnellsicht.php".URL_APPEND."&retpath=menu&hilitedept=39\">$LDQuickView</a>");
  $smarty->assign('LDQviewTxtAna',$LDQviewTxtAna);

  $smarty->assign('LDORAnaNOCScheduler',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienstplan.php".URL_APPEND."&dept_nr=39&retpath=menu\" onmouseover=\"ssm('AnaDienstplan'); clearTimeout(timer)\"
      onmouseout=\"timer=setTimeout('hsm()',1000)\">$LDORNOC $LDScheduler</a>");


 # Collect div codes for  on-mouse-hover pop-up menu windows

$sTemp='';
ob_start();

	require('op-doku-onhover-div-menu.php');
	$sTemp = ob_get_contents();

ob_end_clean();

  $smarty->assign('sOnHoverMenu',$sTemp);

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','or/submenu_or.tpl');

 /**
 * show  Mainframe Template
 */

 $smarty->display('common/mainframe.tpl');
?>