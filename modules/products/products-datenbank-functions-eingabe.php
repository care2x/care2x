<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Create products object
require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

///$db->debug=1;

switch($cat) {
	case "pharma":	
					$title=$LDPharmacy;
					$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php".URL_APPEND."&userck=$userck";
					$imgpath=$root_path."uplodas/pharma/img/";
					break;
	case "medlager":
					$title=$LDMedDepot;
					$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php".URL_APPEND."&userck=$userck";
					$imgpath=$root_path."uplodas/med_depot/img/";
					break;
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}


$thisfile='products-datenbank-functions-eingabe.php';

# Save data routine
if($mode=='save') include('includes/inc_products_db_save_mod.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$title::$LDPharmaDb::$LDNewProduct");

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products_db.php','input','$mode','$cat')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$title::$LDPharmaDb::$LDNewProduct");

 # Assign Body Onload javascript code
 if($mode!='save'&&$mode!='update') $smarty->assign('sOnLoadJs','onLoad="document.inputform.bestellnum.focus()"');

 # Collect javascript code

ob_start();

// Load the javascript code
require('includes/inc_js_products.php');

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

 # Assign prompt messages
if($saveok){
	if($update) $smarty->assign('LDUpdateOk',$LDUpdateOk);
 		else $smarty->assign('LDDataSaved',$LDDataSaved);
}

if($error=="order_nr_exists"){
	$smarty->assign('sMascotImg',"<img ".createMascot($root_path,'mascot1_r.gif','0','absmiddle').">");
	$smarty->assign('LDOrderNrExists',$LDOrderNrExists);
}

if($update&&(!$updateok)&&($mode=='save')) $smarty->assign('sNoSave',$LDDataNoSaved.'<a href="products-datenbank-functions-eingabe.php'.URL_APPEND.'&cat='.$cat.'"><u>'.$LDClk2EnterNew.'</u></a>');

 $smarty->assign('sFormStart','<form ENCTYPE="multipart/form-data" action="'.$thisfile.'" method="post" name="inputform" onSubmit="return prufform(this)">');
 $smarty->assign('sFormEnd','</form>');

 # Assign form elements
 $smarty->assign('LDOrderNr',$LDOrderNr);
 $smarty->assign('LDArticleName',$LDArticleName);
 $smarty->assign('LDGeneric',$LDGeneric);
 $smarty->assign('LDDescription',$LDDescription);
 $smarty->assign('LDPacking',$LDPacking);
 $smarty->assign('LDDose',$LDDose);
 $smarty->assign('LDCAVE',$LDCAVE);
 $smarty->assign('LDCategory',$LDCategory);
 $smarty->assign('LDMinOrder',$LDMinOrder);
 $smarty->assign('LDMaxOrder',$LDMaxOrder);
 $smarty->assign('LDPcsProOrder',$LDPcsProOrder);
 $smarty->assign('LDIndustrialNr',$LDIndustrialNr);
 $smarty->assign('LDLicenseNr',$LDLicenseNr);
 $smarty->assign('LDMinPieces',$LDMinPieces);
 $smarty->assign('LDPicFile',$LDPicFile);

 # Assign the preview picture

 if(($saveok||$update)&&($picfilename!="")){
	$smarty->assign('LDPreview',$LDPreview);
	$smarty->assign('sProductImage','<img src="'.$imgpath.$picfilename.'" border=0 name="prevpic">');
}else{
	$smarty->assign('sProductImage','<img src="../../gui/img/common/default/pixel.gif" border=0 name="prevpic">');
}

 # Assign form inputs (or values)

 if ($saveok||$update) $smarty->assign('sOrderNrInput',$bestellnum.'</b><input type="hidden" name="bestellnum" value="'.$bestellnum.'">');
 	else $smarty->assign('sOrderNrInput','<input type="text" name="bestellnum" value="'.$bestellnum.'" size=20 maxlength=20>');

if ($saveok){
	$smarty->assign('sArticleNameInput',$artname.'<input type="hidden" name="artname" value="'.$artname.'">');
	$smarty->assign('sGenericInput',$generic.'<input type="hidden" name="generic" value="'.$generic.'">');
	$smarty->assign('sDescriptionInput',nl2br($besc).'<input type="hidden" name="besc" value="'.$besc.'">');
	$smarty->assign('sPackingInput',$pack.'<input type="hidden" name="pack" value="'.$pack.'">');
	$smarty->assign('sDoseInput',$dose.'<input type="hidden" name="dose" value="'.$dose.'">');
	$smarty->assign('sCAVEInput',$caveflag.'<input type="hidden" name="caveflag" value="'.$caveflag.'">');
	$smarty->assign('sCategoryInput',$medgroup.'<input type="hidden" name="medgroup" value="'.$medgroup.'">');
	$smarty->assign('sMinOrderInput',$minorder.'<input type="hidden" name="minorder" value="'.$minorder.'">');
	$smarty->assign('sMaxOrderInput',$maxorder.'<input type="hidden" name="maxorder" value="'.$maxorder.'">');
	$smarty->assign('sPcsProOrderInput',$proorder.'<input type="hidden" name="proorder" value="'.$proorder.'">');
	$smarty->assign('sIndustrialNrInput',$artnum.'<input type="hidden" name="artnum" value="'.$artnum.'">');
	$smarty->assign('sLicenseNrInput',$indusnum.'<input type="hidden" name="indusnum" value="'.$indusnum.'">');
	$smarty->assign('sMinPiecesInput',$minpcs.'<input type="hidden" name="minpcs" value="'.$minpcs.'">');	
	$smarty->assign('sPicFileInput',$picfilename.'<input type="hidden" name="bild" value="'.$picfilename.'">');
}else{
	$smarty->assign('sArticleNameInput','<input type="text" name="artname" value="'.$artname.'" size=40 maxlength=40>');
	$smarty->assign('sGenericInput','<input type="text" name="generic" value="'.$generic.'" size=40 maxlength=60>');
	$smarty->assign('sDescriptionInput','<textarea name="besc" cols=35 rows=4>'.$besc.'</textarea>');
	$smarty->assign('sPackingInput','<input type="text" name="pack" value="'.$pack.'"  size=40 maxlength=40>');
	$smarty->assign('sDoseInput','<input type="text" name="dose" value="'.$dose.'"  size=40 maxlength=40>');
	$smarty->assign('sCAVEInput','<input type="text" name="caveflag" value="'.$caveflag.'" size=40 maxlength=80>');
	$smarty->assign('sCategoryInput','<input type="text" name="medgroup" value="'.$medgroup.'" size=20 maxlength=40>');
	$smarty->assign('sMinOrderInput','<input type="text" name="minorder" value="'.$minorder.'" size=20 maxlength=9>');
	$smarty->assign('sMaxOrderInput','<input type="text" name="maxorder" value="'.$maxorder.'" size=20 maxlength=9>');
	$smarty->assign('sPcsProOrderInput','<input type="text" name="proorder" value="'.$proorder.'" size=20 maxlength=40>');
	$smarty->assign('sIndustrialNrInput','<input type="text" name="artnum" value="'.$artnum.'" size=20 maxlength=20>');
	$smarty->assign('sLicenseNrInput','<input type="text" name="indusnum" value="'.$indusnum.'" size=20 maxlength=20>');
	$smarty->assign('sMinPiecesInput','<input type="text" name="minpcs" value="'.$minpcs.'" size=20 maxlength=20>');	
	$smarty->assign('sPicFileInput','<input type="file" name="bild" onChange="getfilepath(this)">');

	$smarty->assign('LDReset','<input type="reset" value="'.$LDReset.'" onClick="document.inputform.bestellnum.focus()" >');
	$smarty->assign('LDSave','<input type="hidden" name="picref" value="'.$picfilename.'"><input type="submit" value="'.$LDSave.'">');
}

# Collect hidden inputs

ob_start();
$sTemp='';
 ?>

  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="lang" value="<?php echo $lang?>">
  <input type="hidden" name="cat" value="<?php echo $cat?>">
  <input type="hidden" name="userck" value="<?php echo $userck?>">
  <input type="hidden" name="picfilename" value="<?php echo  $picfilename ?>">
  <input type="hidden" name="mode" value="<?php if($saveok) echo "update"; else echo "save"; ?>">
  <input type="hidden" name="encoder" value="<?php echo  str_replace(" ","+",$HTTP_COOKIES_VARS[$local_user.$sid])?>">
  <input type="hidden" name="dstamp" value="<?php echo  str_replace("_",".",date(Y_m_d))?>">
  <input type="hidden" name="tstamp" value="<?php echo  str_replace("_",".",date(H_i))?>">
  <input type="hidden" name="lockflag" value="<?php echo  $lockflag?>">
  <input type="hidden" name="update" value="<?php if($saveok) echo "1"; else echo $update;?>">
  <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?php 

$sTemp = ob_get_contents();
ob_end_clean();

# Append more hidden inputs acc. to mode

if($update){
	if($mode!="save"){ 
		$sTemp = $sTemp.'
	  <input type="hidden" name="ref_bnum" value="'.$bestellnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$artname.'">
 	 ';
	}else{ 
		$sTemp = $sTemp.'
 	 <input type="hidden" name="ref_bnum" value="'.$ref_bnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$ref_artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$ref_indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$ref_artname.'">
	  ';
	}
}

if($saveok){
	
	$smarty->assign('sNewProduct',"<a href=\"".$thisfile.URL_APPEND."&cat=$cat&userck=$userck&update=0\">$LDNewProduct</a>");
	
	# Show update button
	$smarty->assign('sUpdateButton','<input type="image" '.createLDImgSrc($root_path,'update.gif','0').'>');
	
	$sBreakImg ='close2.gif';

}else{

	$sBreakImg ='cancel.gif';
}
$smarty->assign('sHiddenInputs',$sTemp);

 $smarty->assign('sBreakButton','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,$sBreakImg,'0','left').' alt="'.$LDBack2Menu.'"></a>');

# Assign the form template to mainframe

 $smarty->assign('sMainBlockIncludeFile','products/form.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>