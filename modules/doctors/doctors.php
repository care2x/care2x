<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require($root_path.'include/core/inc_2level_reset.php');

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer'] = "";
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
# Erase the cookie 
if(isset($_COOKIE['ck_doctors_dienstplan_user'.$sid])) setcookie('ck_doctors_dienstplan_user'.$sid,'',0,'/');
# erase the user_origin 
if(isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin']='';

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDDoctors);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDDoctors')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDDoctors);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'eye_s.gif','0'),
										createComIcon($root_path,'post_discussion.gif','0'),
										createComIcon($root_path,'forums.gif','0'),
										createComIcon($root_path,'bubble.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDQViewTxt,
										$LDDOCSTxt,
										$LDDocsForumTxt,
										$LDNewsTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDQViewTxt' => '<a href="doctors-dienst-schnellsicht.php'.URL_APPEND.'&retpath=docs">'.$LDQView.'</a>',
										'LDDutyPlanTxt' => '<a href="doctors-main-pass.php'.URL_APPEND.'&target=dutyplan&retpath=menu">'.$LDDOCS.'</a>',
										'LDDocsForumTxt' => '<a href="doctors-main-pass.php'.URL_APPEND.'&target=setpersonal&retpath=menu">'.$LDDocsList.'</a>',
										'LDNewsTxt' => '<a href="'.$root_path.'modules/news/newscolumns.php'.URL_APPEND.'&dept_nr=37&user_origin=dept">'.$LDNews.'</a>',
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

 $smarty->assign('sMainBlockIncludeFile','doctors/submenu_doctors.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

?>
