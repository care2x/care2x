<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require($root_path.'include/inc_2level_reset.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');

$returnfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;

$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_user_origin']='it';
/* Set this file as the referer */
$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);

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

 # Title in the title bar
 $smarty->assign('sToolbarTitle',$LDEDP);

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDEDP')");
 
 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDEDP);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'lockfolder.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'pers_tree.gif','0'),
										createComIcon($root_path,'bubble.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDManageAccessTxt,
										//$LDSqlDbTxt,
										$LDSysOpLoginTxt,
										$LDNewsTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDQViewTxt' => '<a href="edv-main-pass.php'.URL_APPEND.'&target=adminlogin">'.$LDManageAccess.'</a>',
										//'LDDutyPlanTxt' => '<a href="edv-main-pass.php'.URL_APPEND.'&target=sqldb">'.$LDSqlDb.'</a>',
										'LDDocsForumTxt' => '<a href="edv-main-pass.php'.URL_APPEND.'&target=adminlogin">'.$LDSysOpLogin.'</a>',
										'LDNewsTxt' => '<a href="'.$root_path.'modules/news/newscolumns.php'.URL_APPEND.'&dept_nr=27">'.$LDNews.'</a>',
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

 $smarty->assign('sMainBlockIncludeFile','system_admin/submenu_edv.tpl');

  /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
