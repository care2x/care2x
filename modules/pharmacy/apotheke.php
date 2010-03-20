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
define('LANG_FILE','products.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// Erase all cookies used for 2nd level script locking, all following scripst will be locked
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_user_origin')) session_register('sess_user_origin');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
$_SESSION['sess_user_origin']='pharma';
require ($root_path.'include/care_api_classes/class_access.php');
$access = new Access($_SESSION['sess_login_userid'],$_SESSION['sess_login_pw']);
$hideOrder = 0;
if(ereg("_a_1_pharmadbadmin",$access->PermissionAreas()))
	$hideOrder = 1;

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

 $smarty->assign('sToolbarTitle',$LDPharmacy);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDPharmacy')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPharmacy);
 
 # Add the bot onLoad code

 if(isset($stb) && $stb) $smarty->assign('sOnLoadJs','onLoad="startbot()"');

 #Collect extra javascript code

 ob_start();

?>
<script language="javascript">
<!--
function closewin() {
	location.href='startframe.php?sid=<?php echo "$sid&lang=$lang";?>';
}
<?php 

if($stb)
echo '
function startbot() {
	pharmabotwin'.$sid.'=window.open("'.$root_path.'modules/products/products-bestellbot.php'.URL_REDIRECT_APPEND.'&cat=pharma&userck='.$userck.'","pharmabotwin'.$sid.'","width=200,height=180,menubar=no,resizable=yes,scrollbars=yes");
}
';

?>
// -->
</script>

<?php
	
	$sTemp = ob_get_contents();
ob_end_clean();

// Append javascript to JavaScript block

 $smarty->append('JavaScript',$sTemp);

// Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'bestell.gif','0'),
										createComIcon($root_path,'help_tree.gif','0'),
										createComIcon($root_path,'templates.gif','0'),
										createComIcon($root_path,'documents.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0'),
					createComIcon($root_path,'bubble.gif','0'),
					createComIcon($root_path,'redlist.gif','0')										
										);

// Prepare the submenu item descriptions

$aSubMenuText=array($LDPharmaOrderTxt,
										$LDHow2OrderTxt,
										$LDOrderCatTxt,
										$LDOrderArchiveTxt,
										$LDPharmaDbTxt,
										$LDOrderBotActivateTxt,
										$LDNewsTxt
										);

// Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDPharmaOrder' => "<a href=\"apotheke-pass.php".URL_APPEND."&mode=order\">$LDPharmaOrder</a>",
										'LDHow2Order' => "<a href=\"javascript:gethelp('products.php','how2','','pharma')\">$LDHow2Order</a>",
										'LDOrderCat' => "<a href=\"apotheke-pass.php".URL_APPEND."&mode=catalog\">$LDOrderCat</a>",
										'LDOrderArchive' => "<a href=\"apotheke-pass.php".URL_APPEND."&mode=archive\">$LDOrderArchive</a>",
										'LDPharmaDb' => "<a href=\"apotheke-pass.php".URL_APPEND."&mode=dbank\">$LDPharmaDb</a>",
										'LDOrderBotActivate' => "<a href=\"apotheke-bestellbot-pass.php".URL_APPEND."&user_origin=pharmabot\" >$LDOrderBotActivate</a>",
										'LDNews' => "<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=38\">$LDNews</a>"
										);

# Create the submenu rows

$iRunner = 0;

while(list($x,$v)=each($aSubMenuItem)){
	if($hideOrder == 1 && $iRunner == 0) {$hideOrder = 0;continue;}
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

 $smarty->assign('sMainBlockIncludeFile','pharmacy/submenu_pharmacy.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');

?>
