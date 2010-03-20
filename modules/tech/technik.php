<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_file_return')) session_register('sess_file_return');
if(!session_is_registered('sess_file_forward')) session_register('sess_file_forward');

$breakfile=$root_path.$_SESSION['sess_path_referer'];

if(!file_exists($breakfile)) {
    $breakfile=$root_path.'main/startframe.php';
}

$breakfile=$breakfile.URL_APPEND;
$returnfile=$breakfile;

$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);

if(!isset($stb)) $stb=0;

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

 $smarty->assign('sToolbarTitle',$LDTechSupport);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDTechSupport')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

  # Add the bot onLoad code
 if(isset($stb)){
 	if($stb==1) $smarty->assign('sOnLoadJs','onLoad="startbot(\'r\')"');
 	else if($stb==2) $smarty->assign('sOnLoadJs','onLoad="startbot(\'f\')"');
 }
 
 # Collect extra javascript code

 ob_start();

?>

<script language="javascript" >
<!--
<?php  

if($stb)
echo '
function startbot(d)
{
	if(d=="r") repabotwin=window.open("technik-repabot.php'.URL_REDIRECT_APPEND.'","repabotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
	else if(d=="f") fragebotwin=window.open("technik-fragebot.php'.URL_REDIRECT_APPEND.'","fragebotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
}
';
?>
// -->
</script>

<?php

	$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'settings_tree.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0'),
										createComIcon($root_path,'icn_rad.gif','0'),
										createComIcon($root_path,'eyeglass.gif','0'),
										createComIcon($root_path,'discussions.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDReRepairTxt,
										$LDRepabotActivateTxt,
										$LDRepairReportTxt,
										$LDReportsArchiveTxt,
										$LDQuestionsTxt,
										$LDQBotActivateTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDPharmaOrder' => "<a href=\"technik-reparatur-anfordern.php".URL_APPEND."\">$LDReRepair</a>",
										'LDHow2Order' => "<a href=\"technik-bot-pass.php".URL_APPEND."&mode=repabot\">$LDRepabotActivate</a>",
										'LDOrderCat' => "<a href=\"technik-reparatur-melden.php".URL_APPEND."\">$LDRepairReport</a>",
										'LDOrderArchive' => "<a href=\"technik-report-arch.php".URL_APPEND."\">$LDReportsArchive</a>",
										'LDPharmaDb' => "<a href=\"technik-questions.php".URL_APPEND."\">$LDQuestions</a>",
										'LDOrderBotActivate' => "<a href=\"technik-bot-pass.php".URL_APPEND."&mode=fragebot\">$LDQBotActivate</a>",
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

 $smarty->assign('sMainBlockIncludeFile','tech/submenu_technik.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
?>
