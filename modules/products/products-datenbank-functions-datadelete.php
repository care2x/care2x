<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

$thisfile=basename(__FILE__);

switch($cat){

	case "pharma":
							$title=$LDPharmacy;
							$dbtable="care_pharma_products_main";
							$imgpath=$root_path."uplodas/pharma/img/";
							$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$dbtable="care_med_products_main";
							$imgpath=$root_path."uplodas/med_depot/img/";
							$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php?sid=$sid&lang=$lang&userck=$userck";
							break;
	
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;};

}

if(($mode=='delete')&&($sure)&&($keyword!='')&&($keytype!='')) {
	
	$deleteok=false;

    $sql="DELETE  FROM $dbtable WHERE  $keytype='$keyword'";

	if($ergebnis=$core->Transact($sql)){
		header ("location:products-datenbank-functions-manage.php".URL_REDIRECT_APPEND."&from=deleteok&cat=$cat&userck=$userck");
		$deleteok=true;
	}
	//echo $sql;
}

//simulate update to search the keyword
$update=true;

# Load search routine
require("includes/inc_products_search_mod_datenbank.php");

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$title $LDPharmaDb $LDManage");

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products_db.php','delete','$from','$cat')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$title $LDPharmaDb $LDManage");


 # Buffer page output
 ob_start()

?>

<a name="pagetop"></a>

<ul>
<p>
<br>

<?php 
if(!$sure)
{
	 echo '
	 	<table border=0>
     <tr>
       <td><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDConfirmDelete.'</font><br>
		<font size=2>'.$LDAlertDelete.'</font><p>
		<a href="products-datenbank-functions-manage.php'.URL_APPEND.'&keyword='.$keyword.'&userck='.$userck.'&cat='.$cat.'&mode=search"><b><font color="#ff0000"><< '.$LDNoBack.'</font></b></a></td>
     </tr>
   </table>	';
}
else
{
	if(!$deleteok) echo'
			<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'><FONT face="Verdana,Helvetica,Arial" size=3  color="#800000">
		'.$LDNoDelete.'</font><p>';
}

//simulate saved condition to force the static display of data
$saveok=true;

# Workaround to force display of form template
$bShowThisForm = TRUE;

# Load search results display routine
require("includes/inc_products_search_result_mod.php");

?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','right') ?>></a>

<?php 

if(!$sure) echo'
	<form action="'.$thisfile.'" method="get" name=delform>
 <input type="hidden" name="sure" value="1">
 <input type="hidden" name="sid" value="'.$sid.'">
 <input type="hidden" name="lang" value="'.$lang.'">
 <input type="hidden" name="mode" value="delete">
 <input type="hidden" name="cat" value="'.$cat.'">
 <input type="hidden" name="userck" value="'.$userck.'">
 <input type="hidden" name="keyword" value="'.$keyword.'">
 <input type="hidden" name="keytype" value="'.$keytype.'">
  <input type="submit" value="'.$LDYesDelete.'">
 </form>
';
?>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the form template to mainframe

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>
