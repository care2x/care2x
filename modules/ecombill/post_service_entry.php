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
require($root_path.'include/core/inc_environment_global.php');
//define('NO_CHAIN',1);
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$core=new Core;
$eComBill=new eComBill;

$eComBill->createBillableItem($TestCode,$LabTestName,$LabPrice,$type,$Discount);

$billmenu="billingmenu.php";

header('Location:'.$billmenu.URL_REDIRECT_APPEND);
exit;
?>
