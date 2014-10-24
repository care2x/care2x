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
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
require($root_path.'include/care_api_classes/class_ecombill.php');
$core=new Core;
$eComBill=new eComBill;

while (list($cle, $val) = each($_POST)) {
	if (substr($cle,0,6) == "itemnm") {
		$no =$no."#".$val;
	}
	if (substr($cle,0,6) =="itemcs") {
		$no1 =$no1."#".$val;
	}
	if (substr($cle,0,6) =="itemdc") {
		$no2 =$no2."#".$val;
	}
}
$no=explode("#",$no);
$no1=explode("#",$no1);
$no2=explode("#",$no2);

$itemcd="#".$itemcd;

$j=1;
while(strlen($itemcd)!=1) {
	$itemcd=substr($itemcd,1);
	$oneitem=substr($itemcd,0,strpos($itemcd,"#"));
	 
	$itemcd=strstr($itemcd,"#");
	$eComBill->updateServiceItem($no[$j],$no1[$j],$no2[$j],$oneitem);
	$j=$j+1;
}

$billmenu="billingmenu.php";
header('Location:'.$billmenu.URL_REDIRECT_APPEND);
exit;
?>
