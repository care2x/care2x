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

define('MODERATE_NEWS',0);  // define to 1 if news is moderated

$lang_tables=array('departments.php');
define('LANG_FILE','newscolumns.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/inc_front_chain_lang.php');

# reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 

$subtitle=$LDSubTitle[$target];

# Set default values
$default_editor_script='modules/news/editor-4plus1-select-art.php';
$default_start_page='main/startframe.php';
$thisfile=basename(__FILE__);

$_SESSION['sess_file_break']=$top_dir.$thisfile;

if(isset($dept_nr) && $dept_nr) $_SESSION['sess_dept_nr']=$dept_nr;
    else  $dept_nr=$_SESSION['sess_dept_nr'];
	
//if(!isset($user_origin)||empty($user_origin)) $user_origin=$_SESSION['sess_user_origin'];
if(empty($user_origin)) $user_origin=$_SESSION['sess_user_origin'];
# Set the return paths 

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');


if($dblink_ok) {

	$sql_2= "SELECT dept.name_formal, dept.LD_var AS \"LD_var\", reg.module_start_script, reg.news_editor_script FROM care_department as dept LEFT JOIN care_registry AS reg  ON dept.id=reg.registry_id WHERE dept.nr=$dept_nr";
    
	if(isset($user_origin) && !empty($user_origin)) {
	    
		$sql= "SELECT dept.name_formal, dept.LD_var AS \"LD_var\", reg.module_start_script, reg.news_editor_script FROM care_registry AS reg, care_department AS dept  WHERE reg.registry_id='$user_origin' AND dept.nr=$dept_nr";
		
	}else{
	
		$sql=$sql_2;
	}
	
    if($result=$db->Execute($sql)) {
		if($result->RecordCount()){
		    $row=$result->FetchRow();
		}else{
    		if($result=$db->Execute($sql_2)) {
				if($result->RecordCount()){
		    		$row=$result->FetchRow();
				}
			} else echo "<p>$sql<p>$LDDbNoRead<p>";
		}	
	} else echo "<p>$sql<p>$LDDbNoRead<p>";

	/* Check the start script as break destination*/
	if (!empty($_SESSION['sess_path_referer'])){
		$breakfile=$_SESSION['sess_path_referer'];
	} elseif(isset($row['module_start_script']) && !empty($row['module_start_script'])){
		$breakfile =$row['module_start_script'];
	} else {
		 /* default startpage */
		$breakfile = $default_start_page;
	}
	$breakfile=$root_path.$breakfile.URL_APPEND;
	/* Check the title */
	if(!isset($$row['LD_var'])||empty($$row['LD_var'])) {
		$title=$row['name_formal'];
	}else {
		$title=$$row['LD_var'];
	}	
	 # Save to session
	$_SESSION['sess_title']=$title;
	
/*	# Check the editor script as forward file
	if(isset($row['news_editor_script']) && (trim($row['news_editor_script'])!='')) {
		$_SESSION['sess_file_forward'] =$root_path.$row['news_editor_script'];
		$_SESSION['sess_file_editor'] =$root_path.$row['news_editor_script'];
	} else {
		 # default file forward
		$_SESSION['sess_file_forward'] = $root_path.$default_editor_script;
		$_SESSION['sess_file_editor'] = $root_path.$default_editor_script;
	}
*/
	$_SESSION['sess_file_forward'] = $root_path.$default_editor_script;
	$_SESSION['sess_file_editor'] = $root_path.$default_editor_script;
	
	# Now get the news articles
    include_once($root_path.'include/inc_date_format_functions.php');
	
    $dbtable='care_news_article';

	# Get the maximum number of headlines to be displayed 
    $config_type='news_dept_max_display';
    include($root_path.'include/inc_get_global_config.php');

    if(!$news_dept_max_display) $news_num_stop=4; // default is 3
        else $news_num_stop=$news_dept_max_display;  // The maximum number of news article to be displayed
	
	//include($root_path.'include/inc_news_get.php'); // now get the current news	
	
	# Now set the sql query for article # 5 or the achived news 
	
	require_once($root_path.'include/care_api_classes/class_news.php');
    $newsobj=new News;
    $news=&$newsobj->getHeadlinesPreview($dept_nr,$news_num_stop);
	
	/* Now get the archived news articles */
	//echo $dept_nr;
	$news_archive=&$newsobj->getArchiveList($dept_nr,$news);
	$rows=$newsobj->LastRecordCount();
}
$returnfile=$breakfile;
$readerpath='editor-4plus1-read.php'.URL_REDIRECT_APPEND;
$editorpath='editor-pass.php'.URL_APPEND;
$today=date('Y-m-d');
//$_SESSION['sess_dept_nr']=$dept_nr;
$_SESSION['sess_file_return']=$top_dir.basename(__FILE__);

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
 # href for return file
 $smarty->assign('pbBack',$returnfile);

 # Window title
 $smarty->assign('title',$title);

 /* Get the news global configurations */
$config_type='news_%';
include($root_path.'include/inc_get_global_config.php');

if(!$news_normal_preview_maxlen) $news_normal_preview_maxlen=300;

/* Load editor functions */
require_once($root_path.'include/inc_editor_fx.php');

$picalign='left';

for($j=1;$j<=$news_num_stop;$j++){

	ob_start();
		include($root_path.'include/inc_news_preview.php');
		$smarty->display('news/headline_newslist_item.tpl');
		$sTemp = ob_get_contents();
	ob_end_clean();

	# Assign to news item number
	$smarty->assign('sNews_'.$j,$sTemp);
}

if($rows) {

	# If news category #5 exits, show the list
	$smarty->assign('bShowArchiveList',TRUE);

	$smarty->assign('subtitle',$subtitle);
	$smarty->assign('LDArticle',$LDArticle);
	$smarty->assign('LDWrittenBy',$LDWrittenBy);
	$smarty->assign('LDWrittenOn',$LDWrittenOn);

	#  Buffer news archive rows

	ob_start();

		while($artikel=$news_archive->FetchRow()){

			echo '<tr bgcolor="#ffffff">
				<td><a href="#"><a href="'.$readerpath.'&nr='.$artikel['nr'].'&news_type=headline"> '.$artikel['title'].'</a></td>
				<td><a href="'.$readerpath.'&nr='.$artikel['nr'].'&news_type=headline"><img '.createComIcon($root_path,'info.gif','0','',TRUE).' alt="'.$LDClk2Read.'"></a></td>
				<td> '.$artikel['author'].'</td>
				<td><nobr> '.formatDate2Local($artikel['publish_date'],$date_format,1).'
				</td>
				</tr>';
			echo "\r\n";
		}

		$sTemp = ob_get_contents();

	ob_end_clean();

	$smarty->assign('sNewsArchiveList',$sTemp);

}

$smarty->assign('sMainEditorLink','<a href="'.$editorpath.'">'.$LDClk2Compose.'</a>');

$smarty->assign('sMainBlockIncludeFile','news/headline_dept_newslist.tpl');

$smarty->display('common/mainframe.tpl');

?>
