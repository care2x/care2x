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
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_cafe_get_menu.php');

$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$breakfile=$_SESSION['sess_file_break'].URL_APPEND;

$dept_nr=2; /* 2= cafeteria */

if(!isset($mode)) $mode='';

/* Get the news article */
require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getNews($nr);


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

 $smarty->assign('news_normal_display_width',$news_normal_display_width);

 # Headline title
 $smarty->assign('LDHeadline',$LDCafeNews);

 # Collect javascript code

 ob_start();
?>

<script language="javascript" >
function editcafe()
{
		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}
}
		
</script>

<style type="text/css" name="s2">
.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

<?php 

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);


$smarty->assign('sBasketImg','<img '.createComIcon($root_path,'basket.gif','0').'>');
$smarty->assign('sTitle', $LDCafeNews);

if($mode=="preview4saved"){

	$smarty->assign('bShowPrompt',TRUE);

	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0').'>');
    $smarty->assign('LDArticleSaved', $LDArticleSaved);

	$sTemp = $returnfile;

}else{
	$sTemp =  $breakfile;
}

$smarty->assign('sBackLink','<a href="'.$sTemp.'"><img '.createComIcon($root_path,'l-arrowgrnlrg.gif','0').'> <font face="arial" color="#006600">'.$LDBackTxt.'</a>');

require($root_path.'include/inc_news_display_one.php');

$smarty->assign('LDMenuToday',$LDMenuToday);
$smarty->assign('sTodaysMenu', nl2br($menu['menu']));

$smarty->assign('sAskIcon','<img '.createComIcon($root_path,'frage.gif','0').' border=0>');
$smarty->assign('sMenuAllLink','<A HREF="cafenews-menu.php'.URL_APPEND.'">'.$LDMenuAll.'</A>');
$smarty->assign('sPricesLink','<A HREF="cafenews-prices.php'.URL_APPEND.'">'.$LDPrices.'</A>');
$smarty->assign('sCafeEditorialLink','<a href="cafenews-edit-pass.php'.URL_APPEND.'">'.$LDCafeEditorial.'</a>');

# Assign the cafenews include file to subframe template

if(!isset($picalign) || empty($picalign)) {
	$smarty->assign('sCafeNewsIncludeFile','news/headline_newslist_item.tpl');
}else{
	if(!($news['art_num']%2)) $smarty->assign('sCafeNewsIncludeFile','news/headline_newslist_item2.tpl');
		else $smarty->assign('sCafeNewsIncludeFile','news/headline_newslist_item.tpl');
}


# Assign the subframe template file name to mainframe

$smarty->assign('sMainBlockIncludeFile','cafeteria/cafenews.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

 ?>