<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
 * eComBill 1.0.04 for Care2002 beta 1.0.8
 * (2003-04-30)
 * adapted from eComBill beta 0.2
 * developed by ecomscience.com http://www.ecomscience.com
 */
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
require($root_path.'include/care_api_classes/class_encounter.php');
$eComBill = new eComBill;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);

$presdatetime=date("Y-m-d H:i:s");

$ybr=date(Y)-2000;

$ergebnis = $eComBill->listPayments();

if(is_object($ergebnis)){
	$cntergebnis = $ergebnis->FetchRow();

	$receipt_no=$cntergebnis['payment_receipt_no'];
	// add one to receipt number for new bill
	$receipt_no++;

	//check for empty set
}else{
	//generate new bill number
	$ybr="6".$ybr."000000";
	$receipt_no=(int)$ybr;
}


if($receipt_no==10000000000) $receipt_no="6".$ybr."000000";
// limit to 10 digit, reset variables


$breakfile='patient_payment_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patient_payment_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDBillPayment);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','payments')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDBillPayment);

 # Collect extra javascrit code

 ob_start();
?>
<SCRIPT language="JavaScript">
<!--
function submitform() {
	if(isNaN(document.payment.amtcash.value)) {
		alert("<?php echo $LDalertEnterNumericValueforCashAmount; ?>");
	} else if(isNaN(document.payment.cdno.value)) {
		alert("<?php echo $LDalertEnterNumericValueforCreditCardNo; ?>");
	} else if(isNaN(document.payment.amtcc.value)) {
		alert("<?php echo $LDalertEnterNumericValueforCreditCardAmount; ?>");
	} else if(isNaN(document.payment.chkno.value)) {
		alert("<?php echo $LDalertEnterNumericValueforChequeNo; ?>");
	} else if(isNaN(document.payment.amtcheque.value)) {
		alert("<?php echo $LDalertEnterNumericValueforChequeAmount; ?>");
	} else {
		var sel = new Array(document.payment.elements.length);
		var temp;
		var tempstr;
		var counter;
		str=document.payment.hidden.value;
		querystr = "confirmpayment.php?";
	
		counter = 1;
		for(i=0;i<document.payment.elements.length;i++) {	
			temp = str.indexOf("#");
			if(document.payment.elements[i].type=="checkbox") {
				tempstr = str.substring(0,temp);
				str=str.substring(temp+1,str.length);					
				if(document.payment.elements[i].checked == true)
					querystr=querystr+"mode"+counter+"="+tempstr+"&";
				counter = counter + 1;					
			}		
		}
		
		if(querystr == "confirmpayment.php?") {
			alert("<?php echo $LDalertPleaseSelectatleastOneModeofPayment; ?>");
		} else {
			document.payment.action = querystr;
			document.payment.submit();
		}
	}
}
//-->
</SCRIPT>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDPaymentReceipt . ' - ' . $full_en);

$smarty->assign('sFormTag','<form name="payment" method="POST">');

$smarty->assign('LDGeneralInfo',$LDGeneralInfo);
$smarty->assign('LDPatientName',$LDPatientName);
$smarty->assign('LDPatientNameData',$Encounter->encounter['title'] . ' - ' . $Encounter->encounter['name_first'].' '.$Encounter->encounter['name_last']);
$smarty->assign('LDReceiptNumber',$LDReceiptNumber);
$smarty->assign('LDReceiptNumberData',$receipt_no);
$smarty->assign('LDPatientAddress',$LDPatientAddress);
$smarty->assign('LDPatientAddressData',$Encounter->encounter['addr_str'].' '.$Encounter->encounter['addr_str_nr'].'<br>'.$Encounter->encounter['addr_zip'].' '.$Encounter->encounter['addr_citytown_nr']);

$smarty->assign('LDPaymentDate', $LDBillDate);

if($receiptid=="") {
	$billDate = formatDate2Local($presdatetime,$date_format,1);
} else {
	$oldbillqueryresult = $eComBill->listCurrentPaymentsByRecipeNr($receipt_no);
	if(is_object($oldbillqueryresult)){
		if($oldbillqueryresult->RecordCount()){
			$ob=$oldbillqueryresult->FetchRow();
			$billDate = formatDate2Local($ob['payment_date'],$date_format,1);
		}
	}
}

$smarty->assign('LDPaymentDateData', $billDate);
$smarty->assign('LDPatientType', $LDPatientType );
$smarty->assign('LDPatientTypeData', $Encounter->encounter['encounter_class_nr'] );
$smarty->assign('LDDateofBirth', $LDDateofBirth );
$smarty->assign('LDDateofBirthData', formatDate2Local($Encounter->encounter['date_birth'],$date_format) );
$smarty->assign('LDSex', $LDSex );
$smarty->assign('LDSexData', $Encounter->encounter['sex'] );
$smarty->assign('LDPatientNumber', $LDPatientNumber);
$smarty->assign('LDPatientNumberData', $full_en);
$smarty->assign('LDDateofAdmission', $LDDateofAdmission);
$smarty->assign('LDDateofAdmissionData', formatDate2Local($Encounter->encounter['encounter_date'],$date_format));
$smarty->assign('LDPaymentInformation', $LDPaymentInformation);

$smarty->assign('LDEnterPayment', TRUE);

$smarty->assign('LDSelecttheModeofCurrentPayment', $LDSelecttheModeofCurrentPayment);
$smarty->assign('LDCash', $LDCash);
$smarty->assign('LDAmount', $LDAmount);
$smarty->assign('LDCreditCard', $LDCreditCard);
$smarty->assign('LDCardNumber', $LDCardNumber);
$smarty->assign('LDCCType', $LDCCType);
$smarty->assign('LDCheck', $LDCheck);
$smarty->assign('LDCheckNumber', $LDCheckNumber);

$smarty->assign('pbSubmit','<a href="javascript:submitform();"><input type="image"  '.createLDImgSrc($root_path,'continue.gif','0','middle').'></a>');

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
								<input type="hidden" name="hidden" value="C6#C7#C8#"> 
								<input type="hidden" name="receipt_no" value="'. $receipt_no .'">
								<input type="hidden" name="lang" value="'. $lang .'">
								<input type="hidden" name="sid" value="'. $sid .'">
								<input type="hidden" name="full_en" value="'. $full_en .'">');

/**
* show Template
*/
$smarty->assign('sMainBlockIncludeFile','ecombill/bill_payment_header.tpl');

$smarty->display('common/mainframe.tpl');
?>