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

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

/* Set initial session environment for this module */
$dept_nr=2;// 2= cafeteria dept
$title=$LDCafeNews;

if(!session_is_registered('sess_file_editor')) session_register('sess_file_editor');
if(!session_is_registered('sess_file_reader')) session_register('sess_file_reader');

$_SESSION['sess_file_break']=basename(__FILE__);
$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_file_editor']='cafenews-edit-select.php';
$_SESSION['sess_file_reader']='cafenews-read.php';
$_SESSION['sess_dept_nr']=$dept_nr; 
$_SESSION['sess_title']=$title;

require_once($root_path.'include/inc_cafe_get_menu.php');

$readerpath='cafenews-read.php'.URL_APPEND;

# Load the news display configs
require_once($root_path.'include/inc_news_display_config.php');

/* Get the maximum number of headlines to be displayed */
$config_type='news_headline_max_display';
require($root_path.'include/inc_get_global_config.php');

if(!$news_headline_max_display) $news_headline_max_display=3; /* default is 3 */

$news_num_stop=$news_headline_max_display;  // The maximum number of news article to be displayed
//require($root_path.'include/inc_news_get.php'); // now get the current news

require_once($root_path.'include/care_api_classes/class_news.php');
$newsobj=new News;
$news=&$newsobj->getHeadlinesPreview($dept_nr,$news_num_stop);

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
 $smarty->assign('LDHeadline',$title);

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
$smarty->assign('sTitle', $title);

 $editor_path='cafenews-edit-pass.php'.URL_APPEND.'&title='.$LDCafeNews;

   /**
 * Routine to display the news preview
 */
for($j=1;$j<=$news_num_stop;$j++){

	$picalign=($j==2)? 'right' : 'left';

	 ob_start();
		include($root_path.'include/inc_news_preview.php');
		($j==2)? $smarty->display('news/headline_newslist_item2.tpl') : $smarty->display('news/headline_newslist_item.tpl');
		$sTemp = ob_get_contents();
	ob_end_clean();

	$smarty->assign('sNews_'.$j,$sTemp);
}

$smarty->assign('LDMenuToday',$LDMenuToday);
$smarty->assign('sTodaysMenu', nl2br($menu['menu']));

$smarty->assign('sAskIcon','<img '.createComIcon($root_path,'frage.gif','0').' border=0>');
$smarty->assign('sMenuAllLink','<A HREF="cafenews-menu.php'.URL_APPEND.'">'.$LDMenuAll.'</A>');
$smarty->assign('sPricesLink','<A HREF="cafenews-prices.php'.URL_APPEND.'">'.$LDPrices.'</A>');
$smarty->assign('sCafeEditorialLink','<a href="cafenews-edit-pass.php'.URL_APPEND.'">'.$LDCafeEditorial.'</a>');

# Assign the include file to the cafenews subframe
$smarty->assign('sCafeNewsIncludeFile','cafeteria/cafenews_list.tpl');

# Assign the subframe template file name to mainframe

$smarty->assign('sMainBlockIncludeFile','cafeteria/cafenews.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

 ?>