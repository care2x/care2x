<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('NO_CHAIN',1);
define('LANG_FILE','billing.php');

$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$eComBill=new eComBill;

//$db->debug=true;

if($patnum==""){
	$patient_no=$patientno;
}else{
	$patient_no=$patnum;
}
$breakfile='search.php'.URL_APPEND;
$returnfile='search.php'.URL_APPEND;

// Check if final bill is available, if yes hide new entry of bills and make payment menu items

$chkexists = 0;
$chkfinalresult = $eComBill->checkFinalBillExist($patient_no);

if(is_object($chkfinalresult)) $chkexists = $chkfinalresult->RecordCount();
// Check if bill(s) exist, if yes show view bill and generate final bill menu items

$billexists = 0;
$billqueryresult = $eComBill->checkBillExist($patient_no);
if(is_object($billqueryresult))  $billexists = $billqueryresult->RecordCount();
// Check if payment(s) exist, if yes show view payment menu item

$payexists = 0;
$payqueryresult = $eComBill->checkPaymentExist($patient_no);
if(is_object($payqueryresult))	$payexists = $payqueryresult->RecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');
 $smarty2 = new smarty_care('common', FALSE);
# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDPatientNumber . ' : ' . $full_en);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','select-service')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling);

 # Collect extra javascrit code

 ob_start();
?>

<Script language=Javascript>
<!--
function subbill() {
	document.patientfrm.action="patient_bill_links.php";
	document.patientfrm.submit();
}

function subpayment() {
	document.patientfrm.action="patient_payment_links.php";
	document.patientfrm.submit();
}

function subLT() {
	document.patientfrm.action="select_services.php?service=LT";
	document.patientfrm.submit();
}

function subHS() {
	document.patientfrm.action="select_services.php?service=HS";
	document.patientfrm.submit();
}

function show() {
	document.patientfrm.action="patient_payment.php";
	document.patientfrm.submit();
}

function finalbill() {
	document.patientfrm.action="final_bill.php";
	document.patientfrm.submit();
}


//-->
</script>
<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('sFormTag','<form name="patientfrm"  method="POST" action="" >');

$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patient_no .'">	
	<input type="hidden" name="lang" value="'. $lang .'">
	<input type="hidden" name="sid" value="'. $sid .'">
	<input type="hidden" name="full_en" value="'. $full_en .'">');

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'cancel.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');


 # Prepare the submenu icons
$aSubMenuIcon=array(createComIcon($root_path,'settings_tree.gif','0'),
					createComIcon($root_path,'settings_tree.gif','0'),
					createComIcon($root_path,'settings_tree.gif','0'),
					createComIcon($root_path,'settings_tree.gif','0'),
					createComIcon($root_path,'settings_tree.gif','0'),
					createComIcon($root_path,'settings_tree.gif','0'),
				);


# Prepare the submenu item descriptions

$aSubMenuText=array($LDSelectHospitalServicesTxt,
					$LDSelectLaboratoryTestsTxt,
					$LDViewBillTxt,
					$LDViewPaymentTxt,
					$LDMakeNewPaymentTxt,
					$LDGenerateFinalBillTxt,
					$LDPatienthasclearedallthebillsTxT
					);
				
					
# Prepare the submenu item links indexed by their template tags
$aSubMenuItem=array();					
if(!$chkexists) {
	$aSubMenuItem['LDSelectHospitalServices'] = '<a href="javascript:subHS()"">'.$LDSelectHospitalServices.'</a>';
	$aSubMenuItem['LDSelectLaboratoryTests'] = '<a href="javascript:subLT()"">'.$LDSelectLaboratoryTests.'</a>';
}

if(!$chkexists && $billexists) {
	$aSubMenuItem['LDViewBill'] = '<a href="javascript:subbill()"">'.$LDViewBill.'</a>';	
	$aSubMenuItem['LDViewPayment'] = '<a href="javascript:subpayment()"">'.$LDViewPayment.'</a>';	
	$aSubMenuItem['LDMakeNewPayment'] = '<a href="javascript:show()"">'.$LDMakeNewPayment.'</a>';	
	$aSubMenuItem['LDGenerateFinalBill'] = '<a href="javascript:finalbill()"">'.$LDGenerateFinalBill.'</a>';	
}

if($chkexists>0) { 
	$aSubMenuItem['LDPatienthasclearedallthebills'] = $LDPatienthasclearedallthebills;	
}

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


$smarty->assign('sMainBlockIncludeFile','ecombill/billing_menu_ecombill.tpl');
 /**
 * show Template
 */

$smarty->display('common/mainframe.tpl');
// $smarty->display('debug.tpl');
?>