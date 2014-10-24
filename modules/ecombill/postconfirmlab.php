<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
 * eComBill 1.0.04 for Care2002 beta 1.0.04
 * (2003-04-30)
 * adapted from eComBill beta 0.2
 * developed by ecomscience.com http://www.ecomscience.com
 * Dilip Bharatee
 * Abrar Hazarika
 * Prantar Deka
 * GPL License
 */
require('./roots.php');
define('NO_CHAIN',1);
require($root_path.'include/core/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$eComBill = new eComBill;
$core= new Core;

//$db->debug=true;
$presdatetime=date("Y-m-d G:i:s");
$labcod=$labcod."#";
$noOfunits="#".$noOfunits;

$j=$j+1;
while(strlen($noOfunits) !=1) {
	$noOfunits=substr($noOfunits,1);
	$noOfunits1 = substr($noOfunits,0,strpos($noOfunits,"#"));
	$noOfunits=substr($noOfunits,strpos($noOfunits,"#"));
	$no_units[$j]=$noOfunits1;
	$j=$j+1;
}
$cnt=1;
$resultchkpatqry = $eComBill->getBilledItemsByEncounter($patientno);
if(is_object($resultchkpatqry)) $chkcnt=$resultchkpatqry->RecordCount();
$totalBillAmount = 0;
$doQuery = FALSE; 
while(strlen($labcod) !=1) {
	$flag=0;
	$labcod=substr($labcod,1);
	$labcod1 = substr($labcod,0,strpos($labcod,"#"));

	$resultlabitemqry = $eComBill->listServiceItemsByCode($labcod1);
	if(is_object($resultlabitemqry)){
		$labitem=$resultlabitemqry->FetchRow();
		$unitcost=$labitem['item_unit_cost'];
		$discount=$labitem['item_discount_max_allowed'];
	}

	$unitcost=($unitcost-($discount*$unitcost/100));

	$totalamt=$unitcost*$no_units[$cnt];
	$totalBillAmount += $totalamt;
	$labcod=substr($labcod,strpos($labcod,"#"));

/*	for($i=0;$i<$chkcnt;$i++) {
		$doQuery = TRUE;
		//$eComBill->createBillItem($patientno, $labcod1, $unitcost, $no_units[$cnt], $totalamt,$presdatetime );
	}
*/
	$eComBill->createBillItem($patientno, $labcod1, $unitcost, $no_units[$cnt], $totalamt,$presdatetime );
	$cnt=$cnt+1;
}
$patmenu="patientbill.php".URL_REDIRECT_APPEND."&patnum=$patientno&full_en=$full_en&service=$service";
header('Location:'.$patmenu);
exit;
?>
