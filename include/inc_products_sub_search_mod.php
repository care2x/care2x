<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_sub_search_mod.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/**
* CARE 2002 Integrated Hospital Information System
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
if($cat=='pharma') $dbtable='care_pharma_products_main_sub';
	else $dbtable='care_med_products_main_sub';
# clean input data
$keyword=addslashes(trim($keyword));
//$db->debug=true;

#this is the search module
//if((($mode=='search')||$update)&&($content['bestellnum']!='')){
		$sql="SELECT  * FROM $dbtable WHERE  bestellnum='$content[bestellnum]'";
        	$ergebnis=$db->Execute($sql);
		$linecount=$ergebnis->RecordCount();
//	} 
/*	if(($linecount==1)&&$bcat){
		$ttl=$ergebnis->FetchRow();
		$ergebnis->MoveFirst();
		$title_art=$ttl['artikelname'];
	}
*/
print "from table ".$linecount;


?>
