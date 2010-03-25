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
define('NO_CHAIN',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
require($root_path.'include/care_api_classes/class_encounter.php');
$eComBill = new eComBill;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);

$amtwithdisc=$totalbill-($discount*$totalbill/100);
$amtdue=$amtwithdisc-$paidamt;

if($discount=="") $discount=0;
$presdate=date("Y-m-d");

$breakfile='final_bill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='final_bill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDFinalBillPreview);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','final-bill')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDFinalBillPreview);

 # Collect extra javascrit code

 ob_start();
?>
<SCRIPT language="JavaScript">
<!--
	function submitform() {
		document.confirmfrmfinal.action = "postfinalbill.php";
		document.confirmfrmfinal.submit();
	}
//-->
</SCRIPT>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDFinalBillPreview . ' - ' . $full_en);

$smarty->assign('sFormTag','<form name="confirmfrmfinal" method="POST" action="postfinalbill.php">');

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

$smarty->assign('LDConfirmBill', TRUE);

$smarty->assign('LDTotal', $LDTotal);
$smarty->assign('totalbill', $totalbill);
$smarty->assign('LDDiscountonTotalAmount', $LDDiscountonTotalAmount);
$smarty->assign('discount', $discount);
$smarty->assign('LDAmountAfterDiscount', $LDAmountAfterDiscount);
$smarty->assign('totpayment', $amtwithdisc);
$smarty->assign('LDAmountPreviouslyReceived', $LDAmountPreviouslyReceived);
$smarty->assign('paidamt', $paidamt);
$smarty->assign('LDAmountDue', $LDAmountDue);
$smarty->assign('amtdue', $amtdue);
$smarty->assign('LDCurrentPaidAmount', $LDCurrentPaidAmount);

$smarty->assign('pbSubmit','<a href="javascript:submitform();"><input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'></a>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
							      <input type="hidden" name="totalbill" value="'. $totalbill .'">
							      <input type="hidden" name="discount" value="'.$discount .'">
							      <input type="hidden" name="paidamt" value="'. $paidamt .'">
							      <input type="hidden" name="amtdue" value="'.$amtdue .'">
							      <input type="hidden" name="final_bill_no" value="'. $final_bill_no .'">
							      <input type="hidden" name="lang" value="'. $lang .'">
							      <input type="hidden" name="sid" value="'. $sid .'">');

/**
* show Template
*/
$smarty->assign('sMainBlockIncludeFile','ecombill/bill_payment_header.tpl');

$smarty->display('common/mainframe.tpl');
?>