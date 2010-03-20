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
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

/* Set the return paths */
$returnfile='editor-4plus1-select-art.php'.URL_APPEND;
$breakfile='newscolumns.php'.URL_APPEND;

if($mode=="preview4saved") $sReturn = $returnfile; else $sReturn = $breakfile;

/* Set the return file to this file*/
//$_SESSION['sess_file_return']=basename(__FILE__);
/* get the title = name of department */
$title=$_SESSION['sess_title'];

/* Get the news article */
require($root_path.'include/inc_news_get_one.php');

/* Get the news table width */
$config_type='news_normal_display_width';
include_once($root_path.'include/inc_get_global_config.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Toolbar title
 $smarty->assign('sToolbarTitle',$title);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('dept_news.php')");
 # href for close file
 $smarty->assign('breakfile',$breakfile);
 
 if($mode!="preview4saved"){
 	# href for return file
 	$smarty->assign('pbBack',$sReturn);
 }

 # Window title
 $smarty->assign('title',$title);

if($mode=="preview4saved"){

	$smarty->assign('bShowPrompt',TRUE);

	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0').'>');
    $smarty->assign('LDArticleSaved', $LDArticleSaved);
}

if(isset($news_normal_display_width) && !empty($news_normal_display_width)){
	$smarty->assign('news_normal_display_width',$news_normal_display_width);
}else{
	$smarty->assign('news_normal_display_width','400');
}

$palign='left';  // Set the image alignment

include($root_path.'include/inc_news_display_one.php');

$smarty->assign('sBackLink','<a href="'.$sReturn.'"><img '.createComIcon($root_path,'l-arrowgrnlrg.gif','0').'><font SIZE=-1 color="#006600"> '.$LDBackTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile','news/headline_dept_news.tpl');

$smarty->display('common/mainframe.tpl');

?>