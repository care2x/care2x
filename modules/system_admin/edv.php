<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
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
require_once($root_path.'include/core/inc_front_chain_lang.php');

require($root_path.'include/core/inc_2level_reset.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer'] = "";

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
 require_once($root_path.'include/core/inc_default_smarty_values.php');

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
$smarty->assign('sTitleImage','<img '.createComIcon($root_path,'padlock.gif','0').'>');
 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'lockfolder.gif','0'),
										createComIcon($root_path,'bubble.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDSysOpLoginTxt,
										$LDNewsTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDQViewTxt' => '<a href="edv-main-pass.php'.URL_APPEND.'&target=adminlogin">'.$LDManageAccess.'</a>',
										'LDNewsTxt' => '<a href="'.$root_path.'modules/news/newscolumns.php'.URL_APPEND.'&dept_nr=27">'.$LDNews.'</a>',
										);

# Create the submenu rows

$iRunner = 0;

foreach($aSubMenuItem as $x => $v){
	$sTemp='';
	ob_start();
		if(!isset($cfg['icons']) or $cfg['icons'] != 'no_icon') $smarty2->assign('sIconImg','<img '.$aSubMenuIcon[$iRunner].'>');
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
