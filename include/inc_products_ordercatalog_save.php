<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_ordercatalog_save.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$saveok=false;
if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok) 
		{
				$sql="INSERT INTO ".$dbtable." 
						(	
							dept_nr,
							hit,
							artikelname,
							minorder,
							maxorder,
							proorder,
							bestellnum ) 
						VALUES (
							'$dept_nr',
							'$hit',
							'$artname',
							'$minorder',
							'$maxorder',
							'$proorder',
							'$bestellnum')";
        		if($ergebnis=$db->Execute($sql))
				{
				//print $sql;
					$saveok=true;
				}
			//print $sql;
	}
  	 else 
		{ print "$LDDbNoLink<br>"; }
?>
