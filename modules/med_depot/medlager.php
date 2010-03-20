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
define('LANG_FILE','products.php');
define('NO_2LEVEL_CHK','1');
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');
require ($root_path.'include/care_api_classes/class_access.php');

$access = new Access($_SESSION['sess_login_userid'],$_SESSION['sess_login_pw']);
$hideOrder = 0;
if(ereg("_a_1_meddepotdbadmin",$access->PermissionAreas()))
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

 $smarty->assign('sToolbarTitle',$LDMedDepot);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDMedDepot')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDMedDepot);
 
 # Add the bot onLoad code

 if(isset($stb) && $stb) $smarty->assign('sOnLoadJs','onLoad="startbot()"');

 ob_start();
?>

<script language="javascript">
<!--
<?php 

if($stb)
echo '
function startbot() {
	medibotwin'.$sid.'=window.open("'.$root_path.'modules/products/products-bestellbot.php'.URL_REDIRECT_APPEND.'&cat=medlager&userck='.$userck.'","medibotwin'.$sid.'","width=200,height=180,menubar=no,resizable=yes,scrollbars=yes");
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

 $aSubMenuIcon=array(createComIcon($root_path,'bestell.gif','0'),
										createComIcon($root_path,'help_tree.gif','0'),
										createComIcon($root_path,'templates.gif','0'),
										createComIcon($root_path,'documents.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'redlist.gif','0')										
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDPharmaOrderTxt,
										$LDHow2OrderTxt,
										$LDOrderCatTxt,
										$LDOrderArchiveTxt,
										$LDPharmaDbTxt,
										$LDOrderBotActivateTxt,
										$LDSupplierTxt,
										$LDSupplyTxt,
					$LDRaporteDepoTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDPharmaOrder' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=order\">$LDPharmaOrder</a>",
										'LDHow2Order' => "<a href=\"javascript:gethelp('products.php','how2','','meddepot')\">$LDHow2Order</a>",
										'LDOrderCat' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=catalog\">$LDOrderCat</a>",
										'LDOrderArchive' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=archive\">$LDOrderArchive</a>",
										'LDPharmaDb' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=dbank\">$LDPharmaDb</a>",
										'LDOrderBotActivate' => "<a href=\"medlager-bestellbot-pass.php".URL_APPEND."\" >$LDMediBotActivate</a>",
					'LDSupplier' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=supplier\">$LDSupplier</a>",
					'LDSupply' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=supply\">$LDSupply</a>",
					'LDRaporteDepo' => "<a href=\"medlager-pass.php".URL_APPEND."&mode=reports\">$LDRaporteDepo</a>"
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

 $smarty->assign('sMainBlockIncludeFile','med_depot/submenu_medlager.tpl');

  /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
?>
