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
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');
switch($cat)
{
	case "pharma": $breakfile=$root_path."modules/pharmacy/apotheke.php".URL_APPEND;
	                       break;
    case "medlager": $breakfile=$root_path."modules/med_depot/medlager.php".URL_APPEND;
	                       break;
}

/**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common',TRUE,FALSE);
 
 # Hide title bar
 $smarty->assign('bHideTitleBar',TRUE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('products.php','head','main','$cat')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle','');

  $smarty->assign('LDCatalog',$LDCatalog);
 $smarty->assign('LDBasket',$LDBasket);
/*
$smarty->assign('$LDBasket ?></b></td>
    <td align=center valign=top class="prompt"><?php echo $LDCatalog ?></td>
	 <td align=right valign=top><nobr><a href="javascript:gethelp('products.php','head','main','<?php echo $cat ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile; ?>" target=_parent><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>
	<?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
  </font></tr>
</table>
*/
$smarty->assign('sMainBlockIncludeFile','products/ordering_header.tpl');

$smarty->display('common/mainframe.tpl');
?>
