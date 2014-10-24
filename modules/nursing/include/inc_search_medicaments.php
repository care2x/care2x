<?php
$root_path = '../../../';
require($root_path.'/include/core/inc_environment_global.php');
global $db;

$dbtable='care_pharma_products_main';
$dbtablejoin='care_pharma_products_main_sub';	
extract($_POST);
$tmpBestellNum = '';
for($i=0;$i<=$maxelements;$i++){
	if($_POST['b'.$i])
		$tmpBestellNum .=  "'" . $_POST['b'.$i] .'\',';
}
if($tmpBestellNum) $tmpBestellNum = substr($tmpBestellNum, 0, -1);  
# clean input data
$keyword=addslashes(trim($_POST['search']));
///$db->debug=true;

$sql="SELECT DISTINCT $dbtable.* FROM $dbtable RIGHT JOIN $dbtablejoin ON $dbtable.bestellnum = $dbtablejoin.bestellnum 
		WHERE $dbtablejoin.pcs > 0 AND ( $dbtable.bestellnum='%$keyword%'
		OR $dbtable.artikelnum LIKE '%$keyword%'
		OR $dbtable.industrynum LIKE '%$keyword%'
		OR $dbtable.artikelname LIKE '%$keyword%'
		OR $dbtable.generic LIKE '%$keyword%'
		OR $dbtable.description LIKE '%$keyword%')";
if($tmpBestellNum) $sql .= " AND  $dbtable.bestellnum NOT IN ($tmpBestellNum)";
$ergebnis=$db->Execute($sql);
	
if (!$ergebnis) {
	echo "<li>Could not successfully run query ($sql) from DB: " . mysql_error(). "</li>";
	exit;
}	

?>

<ul>
<?php while($zeile=$ergebnis->FetchRow()) { ?>
	<li id="<?php echo stripslashes($zeile["bestellnum"]);?>">
<div class="sx"><?php echo stripslashes($zeile["artikelname"]);echo " - ";echo stripslashes($zeile["generic"]); ?></div><span > / <?php echo stripslashes($zeile["packing"]);echo " - ";echo stripslashes($zeile["dose"]);?></span></li>
				<?php } ?>
</ul>