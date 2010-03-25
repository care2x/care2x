<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require('./roots.php');
$local_user='aufnahme_user';
define('NO_CHAIN',1);
require($root_path.'include/core/inc_environment_global.php');
include_once($root_path."classes/fpdf/fpdf.php");
include_once($root_path."classes/PHPJasperXML/PHPJasperXML.inc");

require_once($root_path.'include/core/inc_front_chain_lang.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
require($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
//$db->debug=true;


$eComBill = new eComBill;
$glob_obj = new GlobalConfig;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);

$oldbdqueryresult = $eComBill->checkBillByBillId($receiptid);
if(is_object($oldbdqueryresult)) $billitemcount = $oldbdqueryresult->RecordCount();
$oldbd = $oldbdqueryresult->FetchRow();
$oldbd['bill_item_unit_cost'] = intval($oldbd['bill_item_unit_cost']);
$insurance_nr = $Encounter->encounter['insurance_nr'];
if($Encounter->encounter['insurance_class_nr'] == 2 && $Encounter->encounter['admit_type'] == 1) {
	$moneyToWords = 'zero';
} else { 
	$moneyToWords = int_to_words($oldbd['bill_item_unit_cost']);	
}

$hospitalname = substr($glob_obj->getConfigValue('main_info_address') , 0, 30);

$xml = simplexml_load_file("printouts/.your-xml-file.jrxml");

$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->setImagePath ($root_path . "modules/ecombill/printouts");
$PHPJasperXML->arrayParameter = array("billno"=>$receiptid, 
									  "encounterid"=>$patientno, 
									  "moneywords" => $moneyToWords,
									  "hospitalname" => $hospitalname,
									  "insurance_nr" => $insurance_nr);
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($dbhost,$dbusername,$dbpassword,$dbname);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
