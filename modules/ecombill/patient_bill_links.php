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
//$db->debug=true;
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$eComBill = new eComBill;

$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $BillList);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','bills')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $BillList);

 # Collect extra javascrit code

 ob_start();
?>
<Script language=Javascript>
function showbill(billid) {	
	document.billlinks.action="patient_due_first.php?billid="+billid;
	document.billlinks.submit();
}
function showfinalbill() {	
	document.billlinks.action="showfinalbill.php";
	document.billlinks.submit();
}
</script>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDPatientNumber . ' - ' . $full_en);

$smarty->assign('LDReceiptNumber',$LDBillNo);
$smarty->assign('LDReceiptDateTime',$LDBillDate);

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

/**
* show Template
*/
$sListRows='';
$billqueryresult = $eComBill->listCurrentBills($patientno);
if(is_object($billqueryresult)) {
	while ($result=$billqueryresult->FetchRow()) { 
	    $smarty->assign('itemNr',"<a href=javascript:showbill('".$result['bill_bill_no']."')>".$result['bill_bill_no']."</a>" ); 	
	    $smarty->assign('date', formatDate2Local($result['bill_date_time'],$date_format));
	
	    ob_start();
		$smarty->display('ecombill/bill_payment_line.tpl');
		$sListRows = $sListRows.ob_get_contents();
		ob_end_clean(); 
	}
}

//$chkfinalresult = $eComBill->checkFinalBillExist($patientno);
$chkfinalresult = $eComBill->listBillsByEncounter($patientno);
$finaldate = '';   
$finalno = '';
if(is_object($chkfinalresult)) {

	$chkexists = $chkfinalresult->RecordCount();	
	if($chkexists == 0) {
		$result=$chkfinalresult->FetchRow();
		$finaldate=$result['final_date'];
		$finalno=$result['final_bill_no'];
		
		$smarty->assign('itemNr', '<a href=javascript:showfinalbill()>'. $LDFinalBill .'</a>');
		$smarty->assign('date', formatDate2Local($result['final_date'],$date_format));

	} else {
		$smarty->assign('itemNr', '<a href=javascript:showbill(\'currentbill\')>'.$LDCurrentBill.'</a>');
		$smarty->assign('date', formatDate2Local(date("Y-m-d"),$date_format));
	}	

	ob_start();
	$smarty->display('ecombill/bill_payment_line.tpl');
	$sListRows = $sListRows.ob_get_contents();
	ob_end_clean(); 
}
 
$smarty->assign('ItemLine',$sListRows);

$smarty->assign('sFormTag','<form name="billlinks" method="POST">');
$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
								<input type="hidden" name="finalbilldate" value="'. $finaldate .'">
								<input type="hidden" name="finalbillno" value="' . $finalno .'">
								<input type="hidden" name="full_en" value="'. $full_en .'">
								<input type="hidden" name="lang" value="'. $lang .'">
								<input type="hidden" name="sid" value="'. $sid .'">');

$smarty->assign('sMainBlockIncludeFile','ecombill/bill_payment.tpl');

$smarty->display('common/mainframe.tpl');
?>