<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr ( 'inc_products_search_mod_datenbank.php', $_SERVER['SCRIPT_NAME'] ))
	die ( '<meta http-equiv="refresh" content="0; url=../">' );
	/*------end------*/
///$db->debug = true;
/**
 * CARE 2002 Integrated Hospital Information System
 * GNU General Public License
 * Copyright 2002 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
if ($cat == 'pharma') {
	$dbtable = 'care_pharma_products_main';
	$dbtablesub = 'care_pharma_products_main_sub';
} else {
	$dbtable = 'care_med_products_main';
	$dbtablesub = 'care_med_products_main_sub';
}
// clean input data
$keyword = addslashes ( trim ( $keyword ) );

// this is the search module
if ((($mode == 'search') || $update) && ($keyword != '')) {
	
	if ($update) {
		$sql = "SELECT  * FROM $dbtable WHERE  bestellnum='$keyword'";
		$ergebnis = $db->Execute ( $sql );
		$linecount = $ergebnis->RecordCount ();
	} else {
		$sql = "SELECT $dbtable.*, sum(pcs) as qty FROM $dbtable 
					LEFT OUTER JOIN $dbtablesub ON (
                    $dbtablesub.bestellnum = $dbtable.bestellnum )
					WHERE  $dbtable.bestellnum='$keyword'
					OR artikelnum $sql_LIKE '$keyword'
					OR industrynum $sql_LIKE '$keyword'
					OR artikelname $sql_LIKE '$keyword'
					OR generic $sql_LIKE '$keyword'
					OR description $sql_LIKE '$keyword' 
					GROUP BY $dbtable.bestellnum";

		if ($ergebnis = $db->Execute ( $sql ))
			if (!$linecount = $ergebnis->RecordCount ()) {
				$sql = "SELECT * FROM $dbtable WHERE  bestellnum $sql_LIKE '$keyword%'
						OR artikelnum $sql_LIKE '$keyword%'
						OR industrynum $sql_LIKE '$keyword%'
						OR artikelname $sql_LIKE '$keyword%'
						OR generic $sql_LIKE '$keyword%'
						OR description $sql_LIKE '$keyword%'";
				$ergebnis = $db->Execute ( $sql );
				$linecount = $ergebnis->RecordCount ();
			}
	} //end of if $update else
	//if parent is order catalog
	if (($linecount == 1) && $bcat) {
		$ttl = $ergebnis->FetchRow ();
		$ergebnis->MoveFirst ();
		$title_art = $ttl ['artikelname'];
	}
}

?>
