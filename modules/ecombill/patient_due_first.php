<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*
* 19.Oct.2003 Daniel Hinostroza: Switch language implemented, but... What is the translation of outstanding?
*/
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('NO_CHAIN',1);

define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
require($root_path.'include/care_api_classes/class_encounter.php');
$eComBill = new eComBill;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);

$breakfile='patient_bill_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patient_bill_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

//$db->debug=true;

$ergebnis = $eComBill->listAllBills();
if(is_object($ergebnis)) $cntergebnis=$ergebnis->RecordCount();

$ybb=1;

//check for empty set
if($cntergebnis) {
	$result=$ergebnis->FetchRow();
	$bill_no=$result['bill_bill_no'];
	// add one to bill number for new bill
	$bill_no = $bill_no + 1;
} else {
	//generate new bill number
	$bill_no="00000001";
}

if($bill_no==100000000) $bill_no="00000001";
// limit to 9 digit, reset variables
$bill_no = str_pad($bill_no, 8,0,STR_PAD_LEFT);
//exit();
$billno=$bill_no;
$presdatetime=date("Y-m-d H:i:s");

$resultlabquery = $eComBill->listBillsByEncounter($patientno);
$cntLT=0;

if(is_object($resultlabquery)){
	$itemcnt=$resultlabquery->RecordCount();
	while($labresult=$resultlabquery->FetchRow()){
		$resultlbqry=$eComBill->listServiceItemsByCode($labresult['bill_item_code']);
		if(is_object($resultlbqry)){
			$buffer=$resultlbqry->FetchRow();
			if($buffer['item_type']=="LT") {
				$cntLT=$cntLT+1;
			} if($buffer['item_type']=="HS") {
				$cntHS=$cntHS+1;
			}
		}
	}
}

if($cntLT>$cntHS)
	$itemcnt=$cntLT;
if($cntLT<=$cntHS)
	$itemcnt=$cntHS;

$itemcnt1=$cntLT+$cntHS;

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
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','payments')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDBill);

 # Collect extra javascrit code

 ob_start();
?>
<script language="javascript">
<!--
	function popitup(patientno, receiptid) {
		var win = 'print_bill.php?patientno=' + patientno + '&receiptid='  + receiptid;
		window.open( win , 'print_bill' , 'height=400,width=700' );
		return false;
	}

	
	function savebill() {
		document.patientbill.action="patientbill_printsave.php";
		document.patientbill.submit();
	}
	
//-->
</script>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDPatientNumber . ' - ' . $full_en);

$smarty->assign('sFormTag','<form name="patientbill" method="POST">');

$smarty->assign('LDGeneralInfo',$LDGeneralInfo);
$smarty->assign('LDPatientName',$LDPatientName);
$smarty->assign('LDPatientNameData',$Encounter->encounter['title'] . ' - ' . $Encounter->encounter['name_first'].' '.$Encounter->encounter['name_last']);
$smarty->assign('LDReceiptNumber',$LDBillNo);
if($billid == "currentbill") { $receiptid =  $billno; } else { $receiptid = $billid; }
$smarty->assign('LDReceiptNumberData',$receiptid);
$smarty->assign('LDPatientAddress',$LDPatientAddress);
$smarty->assign('LDPatientAddressData',$Encounter->encounter['addr_str'].' '.$Encounter->encounter['addr_str_nr'].'<br>'.$Encounter->encounter['addr_zip'].' '.$Encounter->encounter['addr_citytown_nr']);

$smarty->assign('LDPaymentDate', $LDBillDate);

if($billid == "currentbill") {
	$billDate = formatDate2Local($presdatetime,$date_format,1);
} else {
	$oldbillqueryresult = $eComBill->checkBillByBillId($billid);
	$buffer = $oldbillqueryresult->FetchRow();
	$oldbilldate = $buffer['bill_item_date'];

	$billDate = formatDate2Local($oldbilldate,$date_format,1);
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
$smarty->assign('LDPaymentInformation', $LDBillingInformation);

$smarty->assign('LDBillList', TRUE);

$smarty->assign('LDDescription', $LDDescription);
$smarty->assign('LDCostPerUnit', $LDCostPerUnit);
$smarty->assign('LDUnits', $LDUnits);
$smarty->assign('LDTotalCost', $LDTotalCost);
$smarty->assign('LDItemType', $LDItemType);

if($billid == "currentbill") {
	$smarty->assign('pbSubmit','<a href="javascript:savebill();"><input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'></a>');
} else {
	$smarty->assign('pbSubmit','<a href="#" onclick=" return popitup(' .$patientno . ' , \'' .$receiptid . '\' );"><input type="image"  '.createLDImgSrc($root_path,'printout.gif','0','middle').'></a>');  
}

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$sListRows='';
//current bill listing
if($billid == "currentbill") {
	$resultlabquery->MoveFirst();
	$HStotal=0;$LTtotal=0;
	
	for($i=0;$i<$itemcnt1;$i++) {
		
		$labres = $resultlabquery->FetchRow();
		$resultlbqry1=$eComBill->listServiceItemsByCode($labres['bill_item_code']);
		if(is_object($resultlbqry1)) $lb1=$resultlbqry1->FetchRow();

		$nounits=$labres['bill_item_units'];
		$cpu=$labres['bill_item_unit_cost'];		
		$totcost=$cpu*$nounits;
		$type=$lb1['item_type'];
				
		$smarty->assign('DescriptionData', $lb1['item_description']);
		$smarty->assign('CostPerUnitData', $labres['bill_item_unit_cost']);
		$smarty->assign('UnitsData', $labres['bill_item_units']);
		$smarty->assign('TotalCostData', $totcost);

		if($type=="HS") { 
			$smarty->assign('ItemTypeData', $LDMedicalServices);
		} else if($type=="LT") { 
			$smarty->assign('ItemTypeData', $LDLaboratoryTests); 
		}

		if($lb1['item_type']=="HS") { $HStotal=$HStotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']); }  
		if($lb1['item_type']=="LT") { $LTtotal=$LTtotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']); }
		
		ob_start();
		$smarty->display('ecombill/bill_payment_header_line.tpl');
		$sListRows = $sListRows.ob_get_contents();
		ob_end_clean(); 		

	}

	$total=$HStotal+$LTtotal;
	$smarty->assign('ItemLine',$sListRows);

//bill payed, so print it	
} else {

	$oldbilltotal=0;

	$oldbdqueryresult=$eComBill->checkBillByBillId($billid);
	if(is_object($oldbdqueryresult)) $billitemcount=$oldbdqueryresult->RecordCount();
	
	for ($obc=0;$obc<$billitemcount;$obc++) {

		$oldbd=$oldbdqueryresult->FetchRow();

		$itemdescresult = $eComBill->listServiceItemsByCode($oldbd['bill_item_code']);
		if(is_object($itemdescresult)) $it=$itemdescresult->FetchRow();

		$smarty->assign('DescriptionData', $it['item_description']);
		$smarty->assign('CostPerUnitData', $oldbd['bill_item_unit_cost']);
		$smarty->assign('UnitsData', $oldbd['bill_item_units']);
		$smarty->assign('TotalCostData', $totcost);

		if($it['item_type']=="HS") { 
			$smarty->assign('ItemTypeData', $LDMedicalServices);
		} else if($it['item_type']=="LT") { 
			$smarty->assign('ItemTypeData', $LDLaboratoryTests); 
		}

		if($lb1['item_type']=="HS") { $HStotal=$HStotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']); }  
		if($lb1['item_type']=="LT") { $LTtotal=$LTtotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']); }
		
		ob_start();
		$smarty->display('ecombill/bill_payment_header_line.tpl');
		$sListRows = $sListRows.ob_get_contents();
		ob_end_clean(); 		
		
		$oldbilltotal=$oldbilltotal+$oldbd['bill_item_amount'];
	}
	
	$smarty->assign('ItemLine',$sListRows);
}

$billedamit=0;
$billqry="SELECT SUM(bill_amount) FROM care_billing_bill WHERE bill_encounter_nr=$patientno";

$resultbillqry=$db->Execute($billqry);
if(is_object($resultbillqry)){

	$buffer=$resultbillqry->FetchRow();
	$billedamt=$buffer['bill_amount'];
}
$paidamt=0;
$paymentqry="SELECT SUM(payment_amount_total) FROM care_billing_payment WHERE payment_encounter_nr=$patientno";

$resultpaymentqry=$db->Execute($paymentqry);
if(is_object($resultpaymentqry)){

	$buffer=$resultpaymentqry->FetchRow();
	$paidamt=$buffer['payment_amount_total'];
}

$outstanding = $billedamt-$paidamt;
$totaldue = $total + $outstanding;


$oldbillotherqry="SELECT bill_outstanding FROM care_billing_bill where bill_bill_no='$billid'";
$oldbillotherqryresult=$db->Execute($oldbillotherqry);
if(is_object($oldbillotherqryresult)){
	$obo = $oldbillotherqryresult->FetchRow();
	$oldbilloutstanding=$obo['bill_outstanding'];
}

$smarty->assign('LDTotalBillAmount',$LDTotalBillAmount);
if($billid=="currentbill") { $LDTotalBillAmountData = $total; } else { $LDTotalBillAmountData = $oldbilltotal; }
$smarty->assign('LDTotalBillAmountData',$LDTotalBillAmountData);
$smarty->assign('LDOutstandingAmount',$LDOutstandingAmount);
if($billid == "currentbill") $LDOutstandingAmountData  = $outstanding; else $LDOutstandingAmountData = $oldbilloutstanding; 
if($LDOutstandingAmountData < 0) $LDOutstandingAmountData = 0; else $LDOutstandingAmountData = $outstanding;
$smarty->assign('LDOutstandingAmountData',$LDOutstandingAmountData);
$smarty->assign('LDAmountDue',$LDAmountDue);
if($billid=="currentbill") $LDAmountDueData = $totaldue; else $LDAmountDueData = ($oldbilltotal + $oldbilloutstanding);
$smarty->assign('LDAmountDueData',$LDAmountDueData);

$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
								<input type="hidden" name="billno" value="'. $billno .'">
								<input type="hidden" name="total" value="'. $total .'">
								<input type="hidden" name="outstanding" value="'. $outstanding .'">
								<input type="hidden" name="lang" value="'. $lang .'">
								<input type="hidden" name="sid" value="'. $sid .'">
								<input type="hidden" name="full_en" value="'. $full_en .'">');

/**
* show Template
*/
$smarty->assign('sMainBlockIncludeFile','ecombill/bill_payment_header.tpl');

$smarty->display('common/mainframe.tpl');
?>