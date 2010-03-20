<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('startframe.php');
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$returnfile='headline-edit-select-art.php'.URL_APPEND;
$breakfile=$root_path.$_SESSION['sess_file_break'].URL_APPEND;

//$_SESSION['sess_file_return']='start_page.php';

# Get the news article
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getNews($nr);

# Get the news global configurations

require_once($root_path.'include/inc_news_display_config.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Hide the title bar
 $smarty->assign('bHideTitleBar',TRUE);

 # Window title
 $smarty->assign('title',$title);

 $smarty->assign('news_normal_display_width',$news_normal_display_width);

 # Headline title
 $smarty->assign('LDHeadline',$LDHeadline);


if($mode=="preview4saved"){

	$smarty->assign('bShowPrompt',TRUE);

	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0').'>');
    $smarty->assign('LDArticleSaved', $LDArticleSaved);
}

require($root_path.'include/inc_news_display_one.php');

if(!isset($picalign) || empty($picalign)) {
	$smarty->assign('sNewsBodyTemplate','news/headline_newslist_item.tpl');
}else{
	if(!($news['art_num']%2)) $smarty->assign('sNewsBodyTemplate','news/headline_newslist_item2.tpl');
		else $smarty->assign('sNewsBodyTemplate','news/headline_newslist_item.tpl');
}


# Collect html for the submenu blocks

ob_start();

	include($root_path.'include/inc_rightcolumn_menu.php');

	# Stop buffering, get contents

	$sTemp = ob_get_contents();
ob_end_clean();

# assign contents to subframe

$smarty->assign('sSubMenuBlock',$sTemp);

# Assign the subframe template file name to mainframe

$smarty->assign('sMainBlockIncludeFile','news/headline_news.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

?>
