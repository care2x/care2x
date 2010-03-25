<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables[]='prompt.php';
define('LANG_FILE','products.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

if(!isset($supplier_nr)||!$supplier_nr){

		if($cfg['bname']=='mozilla'){
			#
			# Bug patch for Mozilla, I know its not automatic but Mozilla seems to have problems with two consecutive header redirects
			#
			require('includes/inc_mozillapatch_redirect_supplier.php');
		}else{
			header("Location:select-supplier.php".URL_REDIRECT_APPEND."&cat=$cat&target=supply&retpath=$retpath");
		}
		exit;
	}
//}
//$db->debug=1;
/**
* if order nr is not available,   get the highest item number in the db and add 1
*/
if(!isset($idcare_supply) || !$idcare_supply) {

	$dbtable='\'care_supply\'';
 
	//gjergji:16.01.2007
	//bug with getting the max order_nr...patched for mysql 5.x
	//don't know if it works on postgres :(	
	//$sql="SELECT order_nr FROM $dbtable ORDER BY order_nr DESC";
	//$sql="SELECT MAX(idcare_supply) AS idcare_supply FROM $dbtable";
	$sql="SHOW TABLE STATUS FROM $dbname WHERE Name LIKE $dbtable";
    // if($ergebnis=$db->SelectLimit($sql,1)){
     if($ergebnis=$db->Execute($sql)){
		//reset result
		if ($rows=$ergebnis->RecordCount())	{
			$content=$ergebnis->FetchRow();
			$idcare_supply=$content['Auto_increment'];
		}else{
			$idcare_supply=1;
		} 
	}else{
		echo "$sql<br>$LDDbNoRead<br>";
		exit;
	} 
}
/**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common',TRUE,FALSE,FALSE);

 # Window bar title
 $smarty->assign('sWindowTitle','');

# Assign frameset source file

$smarty->assign('sHeaderSource',"src=\"supply-hf.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck\"");
$smarty->assign('sBasketSource',"src=\"supply-bestellkorb.php?sid=$sid&lang=$lang&supplier_nr=$supplier_nr&idcare_supply=$idcare_supply&itwassent=$itwassent&cat=$cat&userck=$userck\"");
$smarty->assign('sCatalogSource',"src=\"supply-bestellkatalog.php?sid=$sid&lang=$lang&supplier_nr=$supplier_nr&idcare_supply=$idcare_supply&cat=$cat&userck=$userck\"");

$smarty->assign('sBaseFramesetTemplate','products/ordering_frameset.tpl');

$smarty->display('common/baseframe.tpl');
?>

