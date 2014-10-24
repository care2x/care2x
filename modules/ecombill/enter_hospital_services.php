<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*
*  Daniel Hinostroza: originally was: $TP_item_name=$NameLT; changed to: $TP_item_name=$NameHS;
*  Changed alert functions for language recognition
*  Almost irrelevant changes to the tables at tp_enter_hs.htm
*  Shouldn't all references to LabTest change to HospitalService in this page?
*/
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');

$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='billingmenu.php'.URL_APPEND;
$returnfile='billingmenu.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','create-service')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling);

 # Collect extra javascrit code

 ob_start();
?>

<Script language=JavaScript>

<!--
function check() {
	var LTN,TC,LP;
	LTN=document.hos.LabTestName.value;
	TC=document.hos.TestCode.value;
	LP=document.hos.LabPrice.value;
	DC=document.hos.Discount.value;
	if(LTN=="") {
		alert("<?php echo $LDalertNameHospitalService; ?>"); 
		return false;
	} else if(TC=="") {
		alert("<?php echo $LDalertEnterServiceCodeNo; ?>");
		return false; 
	} else if(LP=="") {
		alert("<?php echo $LDalertEnterPriceperUnit; ?>");
		return false; 
	} else if(DC=="") {
		alert("<?php echo $LDalertEnterDiscountallowed; ?>");
		return false; 
	} else if(isNaN(LP)) {
		alert("<?php echo $LDalertEnterNumericValueforPrice; ?>");
		return false; 
	} else if(isNaN(DC)) {
		alert("<?php echo $LDalertEnterNumericValueforDiscount; ?>");
		return false; 
	} else {
		document.hos.action="post_service_entry.php?type=HS";
		document.hos.submit();
	}
}

//-->
</Script>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDBilling . ' - ' . $LDCreateHospitalServiceItem);

$smarty->assign('sFormTag','<form  action="" method="post" name="hos" onSubmit="return check(this)">');
$smarty->assign('LDName',$LDNameHS);
$smarty->assign('LDCode',$LDCode);
$smarty->assign('LDPriceUnit',$LDPriceUnit);
$smarty->assign('LDEnterValueDiscount',$LDEnterValueDiscount);

$smarty->assign('sHiddenInputs','<input type="hidden" name="lang" value="'. $lang .'">
		<input type="hidden" name="sid" value="'. $sid .'">');

$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'cancel.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sMainBlockIncludeFile','ecombill/create_item.tpl');
 /**
 * show Template
 */

$smarty->display('common/mainframe.tpl');
// $smarty->display('debug.tpl');
?>