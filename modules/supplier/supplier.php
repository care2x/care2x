<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

define('LANG_FILE','products.php');
$local_user='ck_supplier_db_user';
$breakfile=$root_path.'modules/med_depot/medlager.php'.URL_APPEND;
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Create products object
require_once($root_path.'include/care_api_classes/class_supplier.php');
$supplier_obj=new Supplier();
$title=$LDNewSupplier;
//$db->debug=1;

$thisfile='supplier.php';

# Save data routine
if($mode=='save') include('includes/inc_supplier_db_save_mod.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$LDSupplier::$title");

 # href for the back button
 $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products_db.php','inputsupplier','$mode','$cat')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$title::$LDSupplier::$LDNewSupplier");

 # Assign Body Onload javascript code
 if($mode!='save'&&$mode!='update') $smarty->assign('sOnLoadJs','onLoad="document.inputform.bestellnum.focus()"');

 # Collect javascript code

ob_start();

	 # Load the javascript code
	 require('includes/inc_js_products.php'); 

	$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

 # Assign prompt messages
if($saveok){
	$smarty->assign('LDDataSaved',$LDDataSaved);
}

if($error=="supplier_exists"){
	$smarty->assign('sMascotImg',"<img ".createMascot($root_path,'mascot1_r.gif','0','absmiddle').">");
	$smarty->assign('LDOrderNrExists',$LDOrderNrExists);
}

if($update&&(!$updateok)&&($mode=='save')) 
	$smarty->assign('sNoSave',$LDDataNoSaved.'<a href="supplier.php'.URL_APPEND.'&cat='.$cat.'"><u>'.$LDClk2EnterNewSupplier.'</u></a>');

 $smarty->assign('sFormStart','<form ENCTYPE="multipart/form-data" action="'.$thisfile.'" method="post" name="inputform" onSubmit="return prufform(this)">');
 $smarty->assign('sFormEnd','</form>');

 # Assign form elements
$smarty->assign('LDSupplier',$LDSupplier);
$smarty->assign('LDAddress',$LDAddress);
$smarty->assign('LDTelephone',$LDTelephone);
$smarty->assign('LDFax',$LDFax);
$smarty->assign('LDKodiPostar',$LDKodiPostar);
$smarty->assign('LDRepresentative',$LDRepresentative);

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
	$smarty->assign('sSupplier',$supplier.'<input type="hidden" name="supplier" value="'.$supplier.'">');
	$smarty->assign('sAddress',nl2br($address).'<input type="hidden" name="adresa" value="'.$address.'">');
	$smarty->assign('sTelephone',$telephone.'<input type="hidden" name="telephone" value="'.$telephone.'">');
	$smarty->assign('sFax',$fax.'<input type="hidden" name="fax" value="'.$fax.'">');
	$smarty->assign('sKodiPostar',$kodipostar.'<input type="hidden" name="kodipostar" value="'.$kodipostar.'">');
	$smarty->assign('sRepresentative',$representative.'<input type="hidden" name="representative" value="'.$representative.'">');
}else{
	$smarty->assign('sSupplier','<input type="text" name="supplier" value="'.$supplier.'">');
	$smarty->assign('sAddress','<textarea name="address" cols=35 rows=4 >'.$address.'</textarea>');
	$smarty->assign('sTelephone','<input type="text" name="telephone" value="'.$telephone.'">');
	$smarty->assign('sFax','<input type="text" name="fax" value="'.$fax.'">');
	$smarty->assign('sKodiPostar','<input type="text" name="kodipostar" value="'.$kodipostar.'">');
	$smarty->assign('sRepresentative','<input type="text" name="representative" value="'.$representative.'">');

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
  <input type="hidden" name="mode" value="<?php if($saveok) echo "update"; else echo "save"; ?>">
  <input type="hidden" name="encoder" value="<?php echo  str_replace(" ","+",$HTTP_COOKIES_VARS[$local_user.$sid])?>">
  <input type="hidden" name="dstamp" value="<?php echo  str_replace("_",".",date(Y_m_d))?>">
  <input type="hidden" name="tstamp" value="<?php echo  str_replace("_",".",date(H_i))?>">
  <input type="hidden" name="lockflag" value="<?php echo  $lockflag?>">
  <input type="hidden" name="update" value="<?php if($saveok) echo "1"; else echo $update;?>">
<?php 

$sTemp = ob_get_contents();
ob_end_clean();

if($saveok){
	
	$smarty->assign('sNewSupplier',"<a href=\"".$thisfile.URL_APPEND."&cat=$cat&userck=$userck&update=0\">$LDNewSupplier</a>");
	
	# Show update button
	$smarty->assign('sUpdateButton','<input type="image" '.createLDImgSrc($root_path,'update.gif','0').'>');
	
	$sBreakImg ='close2.gif';

}else{

	$sBreakImg ='cancel.gif';
}
$smarty->assign('sHiddenInputs',$sTemp);

$smarty->assign('sBreakButton','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,$sBreakImg,'0','left').' alt="'.$LDBack2Menu.'"></a>');

# Assign the form template to mainframe

 $smarty->assign('sMainBlockIncludeFile','products/supplier.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>