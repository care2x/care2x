<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_products_search_mod.php',$_SERVER['SCRIPT_NAME'])) 
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
if($cat=='pharma') {
	$dbtable='care_pharma_products_main';
	$dbtablejoin='care_pharma_products_main_sub';	
	$dbtablecatalog='care_pharma_ordercatalog';
}else{
	$dbtable='care_med_products_main';
	$dbtablejoin='care_med_products_main_sub';
	$dbtablecatalog='care_med_ordercatalog';
}

# clean input data
$keyword=addslashes(trim($keyword));
///$db->debug=true;

#this is the search module
if((($mode=='search')||$update)&&($keyword!='')){
		if($cat=='pharma'){
			$sql="SELECT DISTINCT $dbtable.* FROM $dbtable RIGHT JOIN $dbtablejoin ON $dbtable.bestellnum = $dbtablejoin.bestellnum 
						WHERE $dbtablejoin.pcs > 0 AND $dbtablejoin.idcare_pharma = $pharma_nr[pharma_dept_nr] AND ( $dbtable.bestellnum='$keyword'
						OR $dbtable.artikelnum $sql_LIKE '$keyword'
						OR $dbtable.industrynum $sql_LIKE '$keyword'
						OR $dbtable.artikelname $sql_LIKE '$keyword'
						OR $dbtable.generic $sql_LIKE '$keyword'
						OR $dbtable.description $sql_LIKE '$keyword')
						AND $dbtablejoin.bestellnum NOT IN (SELECT bestellnum FROM $dbtablecatalog WHERE dept_nr = $dept_nr)";
	        	$ergebnis=$db->Execute($sql);

			if(!$linecount=$ergebnis->RecordCount()){
				$sql="SELECT DISTINCT $dbtable.* FROM $dbtable RIGHT JOIN $dbtablejoin ON $dbtable.bestellnum = $dbtablejoin.bestellnum 
						WHERE $dbtablejoin.pcs > 0 AND $dbtablejoin.idcare_pharma = $pharma_nr[pharma_dept_nr] AND ($dbtable.bestellnum $sql_LIKE '$keyword%'
						OR $dbtable.artikelnum $sql_LIKE '$keyword%'
						OR $dbtable.industrynum $sql_LIKE '$keyword%'
						OR $dbtable.artikelname $sql_LIKE '$keyword%'
						OR $dbtable.generic $sql_LIKE '$keyword%'
						OR $dbtable.description $sql_LIKE '$keyword%')
						AND $dbtablejoin.bestellnum NOT IN (SELECT bestellnum FROM $dbtablecatalog WHERE dept_nr = $dept_nr)";
	        	$ergebnis=$db->Execute($sql);
				$linecount=$ergebnis->RecordCount();
			}		
		}elseif($cat=='supply'){
			$sql="SELECT * FROM $dbtable 
						WHERE $dbtable.bestellnum='$keyword'
						OR $dbtable.artikelnum $sql_LIKE '$keyword'
						OR $dbtable.industrynum $sql_LIKE '$keyword'
						OR $dbtable.artikelname $sql_LIKE '$keyword'
						OR $dbtable.generic $sql_LIKE '$keyword'
						OR $dbtable.description $sql_LIKE '$keyword'";
	        	$ergebnis=$db->Execute($sql);
			
			if(!$linecount=$ergebnis->RecordCount()){
				$sql="SELECT * FROM $dbtable 
						WHERE $dbtable.bestellnum $sql_LIKE '$keyword%'
						OR $dbtable.artikelnum $sql_LIKE '$keyword%'
						OR $dbtable.industrynum $sql_LIKE '$keyword%'
						OR $dbtable.artikelname $sql_LIKE '$keyword%'
						OR $dbtable.generic $sql_LIKE '$keyword%'
						OR $dbtable.description $sql_LIKE '$keyword%'";
	        	$ergebnis=$db->Execute($sql);
				$linecount=$ergebnis->RecordCount();
			}			
		}else{
			$sql="SELECT DISTINCT $dbtable.* FROM $dbtable RIGHT JOIN $dbtablejoin ON $dbtable.bestellnum = $dbtablejoin.bestellnum 
						WHERE $dbtablejoin.pcs > 0 AND ( $dbtable.bestellnum='$keyword'
						OR $dbtable.artikelnum $sql_LIKE '$keyword'
						OR $dbtable.industrynum $sql_LIKE '$keyword'
						OR $dbtable.artikelname $sql_LIKE '$keyword'
						OR $dbtable.generic $sql_LIKE '$keyword'
						OR $dbtable.description $sql_LIKE '$keyword')
						 -- AND $dbtablejoin.bestellnum NOT IN (SELECT bestellnum FROM $dbtablecatalog WHERE dept_nr = $dept_nr)";
	        	$ergebnis=$db->Execute($sql);
			
			if(!$linecount=$ergebnis->RecordCount()){
				$sql="SELECT DISTINCT $dbtable.* FROM $dbtable RIGHT JOIN $dbtablejoin ON $dbtable.bestellnum = $dbtablejoin.bestellnum 
						WHERE $dbtablejoin.pcs > 0 AND ($dbtable.bestellnum $sql_LIKE '$keyword%'
						OR $dbtable.artikelnum $sql_LIKE '$keyword%'
						OR $dbtable.industrynum $sql_LIKE '$keyword%'
						OR $dbtable.artikelname $sql_LIKE '$keyword%'
						OR $dbtable.generic $sql_LIKE '$keyword%'
						OR $dbtable.description $sql_LIKE '$keyword%')
						 -- AND $dbtablejoin.bestellnum NOT IN (SELECT bestellnum FROM $dbtablecatalog WHERE dept_nr = $dept_nr)";
	        	$ergebnis=$db->Execute($sql);
				$linecount=$ergebnis->RecordCount();
			}
		}
	//} //end of if $update else
	//if parent is order catalog
	if(($linecount==1)&&$bcat){
		$ttl=$ergebnis->FetchRow();
		$ergebnis->MoveFirst();
		$title_art=$ttl['artikelname'];
	}
//print "from table ".$linecount;
}
?>