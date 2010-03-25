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
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

if(!isset($dept_nr)||!$dept_nr){
	if($cfg['thispc_dept_nr']){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		header("Location:select_dept.php".URL_REDIRECT_APPEND."&cat=$cat&target=catalog&retpath=$retpath");
		exit;
	}
}

require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;

$thisfile=basename(__FILE__);

$invalid=0; // Set a toggler flag
if(isset($cat))
{
    switch($cat)
    {
	case 'pharma':	$title=$LDPharmacy;
							$breakfile=$root_path."modules/pharmacy/apotheke.php".URL_APPEND;
							break;
	case 'medlager':$title=$LDMedDepot;
							$breakfile=$root_path."modules/med_depot/medlager.php".URL_APPEND;
							break;
	default:  $invalid=1;
    }
}
else $invalid=1;

if ($invalid) 
{
    header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); 
	exit;
}

if(($mode=='search')&&($keyword!='')&&($keyword!='%')){
 	if($keyword=="*%*") $keyword="%";
 	 include('includes/inc_products_search_mod_datenbank.php');
 }elseif(($mode=='save')&&($bestellnum!='')&&($artikelname!='')){
		$saveok=$product_obj->SaveCatalogItem($_GET,$cat);
}

if(($mode=='delete')&&($keyword!='')) 
{
	$delete_ok=$product_obj->DeleteCatalogItem($keyword,$cat);
}

# Prepare title
$sTitle="$title::$LDCatalog::";
$buff=$dept_obj->LDvar($dept_nr);
if(isset($$buff)&&!empty($$buff)) $sTitle=$sTitle.$$buff;
	else $sTitle=$sTitle.$dept_obj->FormalName($dept_nr);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('products.php','maincat','','$cat')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # Body OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.smed.keyword.focus()"');

 # Buffer page output
 ob_start();
?>

<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

</script>
<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output
ob_start();

?>

<ul>

<form action="<?php echo $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchWordPrompt ?>:
<br>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="cat" value="<?php echo $cat ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="submit" value="<?php echo $LDSearchArticle ?>">
</font>
</form>
<font face="Verdana, Arial" size=2>
<?php 
if (($mode=='search')&&($keyword!='')) {
	//set order catalog flag
	
	# Workaround to force the form template to be shown
	$bShowThisForm = TRUE;

	$bcat=true;
	include('includes/inc_products_search_result_mod.php');
}

if($linecount==1)
echo '
	<form action="'.$thisfile.'" method="get" name="tocatform">
 	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
  <input type="hidden" name="artikelname" value="'.$zeile['artikelname'].'">
  <input type="hidden" name="bestellnum" value="'.$zeile['bestellnum'].'">
  <input type="hidden" name="proorder" value="'.$zeile['proorder'].'">
  <input type="hidden" name="hit" value="0">
  <input type="hidden" name="mode" value="save">
  <input type="hidden" name="cat" value="'.$cat.'">
  <input type="hidden" name="dept_nr" value="'.$dept_nr.'">
  <input type="submit" value="'.$LDPut2Catalog.'">
   </form>';
?>

</font>
<hr>
<?php
# get the actual order catalog
$ergebnis=&$product_obj->ActualOrderCatalog($dept_nr,$cat);
$rows= $product_obj->LastRecordCount();

# show the actual order catalog
require("includes/inc_products_ordercatalog_show.php");
?>
<p>

<p>
<a href="<?php echo "$breakfile" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>
<p>
</ul>

<?php
$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the data  to the main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
