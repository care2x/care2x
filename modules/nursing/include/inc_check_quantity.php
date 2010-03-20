<?php
$root_path = '../../../';
require($root_path.'/include/inc_environment_global.php');
global $db;
extract($_POST);

# clean input data
$keyword=addslashes(trim($_POST['bestellnum']));
//$db->debug=true;
$totalQuantity = $times * $dose;

//how many of bestellnum do i have on the pharmacy ?
$sql="SELECT care_pharma_products_main.bestellnum,
       care_pharma_products_main.artikelname,
       sum(care_pharma_products_main_sub.pcs) AS pharma
    FROM care_pharma_products_main
         INNER JOIN care_pharma_products_main_sub ON (
         care_pharma_products_main.bestellnum =
          care_pharma_products_main_sub.bestellnum)
    WHERE care_pharma_products_main_sub.bestellnum = '$keyword'
    GROUP BY care_pharma_products_main.bestellnum";

$pharmaStock=$db->Execute($sql);
	
if (!$pharmaStock) {
	echo "<li>Could not successfully run query ($sql) from DB: " . mysql_error(). "</li>";
	exit;
}	
$pharmaQuantity = 0;
while($zeile=$pharmaStock->FetchRow()) { 
	$pharmaQuantity = $zeile["pharma"];
}

//how many of bestellnum do i have waiting to be ordered ?
$sql="SELECT sum(care_encounter_prescription_sub.quantity) AS presc,
          care_encounter_prescription_sub.bestellnum,
          care_encounter_prescription_sub.article
    FROM care_encounter_prescription_sub
    WHERE care_encounter_prescription_sub.`status` = 'saved'
    AND care_encounter_prescription_sub.bestellnum = '$keyword'
    GROUP BY care_encounter_prescription_sub.bestellnum,
      	care_encounter_prescription_sub.article";

$requests=$db->Execute($sql);
	
if (!$requests) {
	echo "<li>Could not successfully run query ($sql) from DB: " . mysql_error(). "</li>";
}
	
$requestQuantity = 0;
while($zeile=$requests->FetchRow()) {
	$requestQuantity = $zeile["presc"];
}

if ( ( $pharmaQuantity - $requestQuantity ) < $totalQuantity ) 
	echo "0";
else 
	echo "1";
?>
