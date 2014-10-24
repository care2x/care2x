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
require_once($root_path.'include/care_api_classes/class_core.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$eComBill = new eComBill;
$core= new Core;

if($currentamt=="")
$currentamt=0;

$presdate=date("Y-m-d");
$presdatetime=date("Y-m-d H:i:s");

$ergebnis = $eComBill->listPayments();
if(is_object($ergebnis)) $cntergebnis=$ergebnis->RecordCount();

$actMil=2000;
$ybr=date(Y)-$actMil;



//check for empty set
if($cntergebnis !=0) {
	$result=$ergebnis->FetchRow();
	$receipt_no=$result['payment_receipt_no'];

	// add one to receipt number for new bill
	$receipt_no+=1;
} else {
	//generate new bill number
	$ybr="6".$ybr."000000";
	$receipt_no=(int)$ybr;

}


if($receipt_no==10000000000) $receipt_no="6".$ybr."000000";
// limit to 10 digit, reset variables

$chkfinalresult = $eComBill->checkFinalBillExist($patientno);
print_r($chkfinalresult);
if(!is_object($chkfinalresult)) {
	$eComBill->createFinalBill($patientno, $final_bill_no, $presdate, $totalbill,$discount, $paidamt,$amtdue,$currentamt);
}

$eComBill->createPaymentItem($patientno,$receipt_no,$presdatetime,$currentamt,'0','0','0','0',$currentamt);

$patmenu="patientbill.php".URL_REDIRECT_APPEND."&patnum=$patientno&full_en=$full_en&service=$service";

header('Location:'.$patmenu);
exit;
?>