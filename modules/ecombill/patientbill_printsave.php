<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require('./roots.php');
define('NO_CHAIN',1);
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;
//$db->debug=true;
$presdate=date("Y-m-d");

$savebillquery="UPDATE care_billing_bill_item SET bill_item_status='1',bill_item_bill_no='$billno' where bill_item_encounter_nr='$patientno' and bill_item_status='0'";

$core->Transact($savebillquery);

$billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding) VALUES ('$billno',$patientno,'$presdate',$total,$outstanding)";

$core->Transact($billquery);

$patmenu="patient_bill_links.php".URL_REDIRECT_APPEND."&patientno=$patientno&full_en=$full_en";

header('Location:'.$patmenu);
exit;

?>
