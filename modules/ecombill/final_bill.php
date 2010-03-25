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
define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
require($root_path.'include/care_api_classes/class_encounter.php');
$eComBill = new eComBill;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);
	
$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

$presdate=date("Y-m-d");
    
//-----------------------------------------------------------
$chkpendbillres = $eComBill->listBillsByEncounter($patientno);
if(is_object($chkpendbillres))
	$chkcnt=$chkpendbillres->RecordCount();
           
if($chkcnt>0)    {
	html_rtl($lang); 
	echo "<table border=0 width=101% bgcolor=#99ccff>";
	echo "<tr>";
	echo "<td width=101%><font color=#330066 size=+3 face=Arial><strong>" . $LDBilling . "</strong></font></td>";
	echo "</tr>";
	echo "</table>";
	echo "<center><h4>". $LDBillPending . "</center></h4>";
	echo "<center><h4>".$LDSavePartial."</center></h4>";
	echo "<form>";
	echo "<center><input type=button name=back value=Back onclick=javascript:history.back(1)></center>";
	echo "</form>";
	echo "</HTML>";    	
	exit;
}
    
    //-----------------------------------------------------------

//$sql="SELECT final_bill_no FROM care_billing_final ORDER BY final_bill_no DESC LIMIT 1";
$ergebnis = $eComBill->listFinalBills();
//if($ergebnis=$db->Execute($sql))
if(is_object($ergebnis))
	$cntergebnis=$ergebnis->RecordCount();

$actMil=2000;
$ybf=date(Y)-$actMil;

//check for empty set

if($cntergebnis){
	$result=$ergebnis->FetchRow();
	$final_bill_no=$result['final_bill_no'];

	// add one to receipt number for new bill
	$final_bill_no+=1;
}else{
	//generate new final bill number

	$ybf="7".$ybf."000000";
	$final_bill_no=(int)$ybf;
}


if($final_bill_no==10000000000) $final_bill_no="7".$ybf."000000";
// limit to 10 digit, reset variables


/*$finalqry="SELECT SUM(bill_amount) AS total_amount, SUM(bill_outstanding) AS total_outstanding FROM care_billing_bill WHERE bill_encounter_nr=$patientno";
$resultfinalqry=$db->Execute($finalqry);*/
$resultfinalqry = $eComBill->billAmountByEncounter($patientno);
if(is_object($resultfinalqry)){
	$buffer=$resultfinalqry->FetchRow();
	$totalbill=$buffer['total_amount'];
}else{
	$totalbill=0;
}

/*$totalpaymentamtqry="SELECT SUM(payment_amount_total) AS total_payment_amount FROM care_billing_payment WHERE payment_encounter_nr=$patientno";
$totalpaymentresult=$db->Execute($totalpaymentamtqry);*/
$totalpaymentresult = $eComBill->billAmountPaymentbyEncounter($patientno);
if(is_object($totalpaymentresult)){
	$buffer=$totalpaymentresult->FetchRow();
	$totpayment=$buffer['total_payment_amount'];
}else{
	$totpayment=0;
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDFinalBill);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','final-bill')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDFinalBill);

 # Collect extra javascrit code

 ob_start();
?>
<SCRIPT language="JavaScript">
<!--
	function submitform() {
		document.frmfinal.action = "confirmfinalbill.php";
		document.frmfinal.submit();
	}
//-->
</SCRIPT>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDFinalBill . ' - ' . $full_en);

$smarty->assign('sFormTag','<form name="frmfinal" method="POST">');

$smarty->assign('LDGeneralInfo',$LDGeneralInfo);
$smarty->assign('LDPatientName',$LDPatientName);
$smarty->assign('LDPatientNameData',$Encounter->encounter['title'] . ' - ' . $Encounter->encounter['name_first'].' '.$Encounter->encounter['name_last']);
$smarty->assign('LDReceiptNumber',$LDBillNo);

$smarty->assign('LDReceiptNumberData',$final_bill_no);
$smarty->assign('LDPatientAddress',$LDPatientAddress);
$smarty->assign('LDPatientAddressData',$Encounter->encounter['addr_str'].' '.$Encounter->encounter['addr_str_nr'].'<br>'.$Encounter->encounter['addr_zip'].' '.$Encounter->encounter['addr_citytown_nr']);
$smarty->assign('LDPaymentDate', $LDBillDate);
$smarty->assign('LDPaymentDateData', formatDate2Local($presdate,$date_format));
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
$smarty->assign('LDPaymentInformation', $LDBillInfo);

$smarty->assign('LDFinalBillShow', TRUE);

$smarty->assign('LDTotal', $LDTotal);
$smarty->assign('totalbill', $totalbill);
$smarty->assign('LDDiscountonTotalAmount', $LDDiscountonTotalAmount);
$smarty->assign('LDAmountAfterDiscount', $LDAmountAfterDiscount);
$smarty->assign('totpayment', $totpayment);

$smarty->assign('pbSubmit','<a href="javascript:submitform();"><input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'></a>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sHiddenInputs','<input type="hidden" name="totalbill" value="'. $totalbill .'">
								<input type="hidden" name="outstding" value="'. $outstding .'">
								<input type="hidden" name="paidamt" value="'. $totpayment .'">
								<input type="hidden" name="patientno" value="'.$patientno .'">
								<input type="hidden" name="final_bill_no" value="'. $final_bill_no .'">
								<input type="hidden" name="lang" value="'.$lang .'">
								<input type="hidden" name="sid" value="'. $sid . '">
								<input type="hidden" name="full_en" value="'.$full_en .'">');

/**
* show Template
*/
$smarty->assign('sMainBlockIncludeFile','ecombill/bill_payment_header.tpl');

$smarty->display('common/mainframe.tpl');
?>