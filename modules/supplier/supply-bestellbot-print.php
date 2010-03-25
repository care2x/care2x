<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');


# Initializations 
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_supply_db_user';

require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

$thisfile=basename(__FILE__);

if ($_COOKIE[$local_user.$sid]=='') $cat='';  

$title="$LDPharmacy - $LDOrderBotActivate $LDAck";
$dbtable='care_supply';


///$db->debug=1;
/* Start the main work */

$rows=0;
$stat2seen=false;
$mov2arc=false;
$deltodo=false;
  

# Load the date formatter
include_once($root_path.'include/core/inc_date_format_functions.php');

# Get the data first
$sql="SELECT * FROM $dbtable WHERE idcare_supply='$idcare_supply'";
if($ergebnis=$db->Execute($sql)) {
	if($rows=$ergebnis->RecordCount())  $content=$ergebnis->FetchRow();
} else { 
   echo "$LDDbNoRead<br>$sql"; 
   $mode='';
} 
	

		 switch($mode) {
			case 'ack_print':
				$history_txt=" by ".$_COOKIE[$local_user.$sid]." on ".date('Y-m-d H:i:s')."\n\r";

				$sql="UPDATE $dbtable SET status='ack_print',
                            history='".$content['history']." Received ".$history_txt."',
                            process_datetime='".date('Y-m-d H:i:s')."'
                            WHERE idcare_supply='$idcare_supply'";

					if($ergebnis=$core->Transact($sql))  {
						$status=""; 
						$stat2seen=true;
					}
					else { echo "$LDDbNoUpdate<br>$sql"; }
					$title="$LDMedDepot - $LDOrderBotActivate $LDAck";
					$dbtableupdate='care_med_products_main_sub';
					$dbsupplyhistory='care_supply_movements';
					//gjergji:save data in the movements table
					$artikeln=explode(' ',$content['articles']);
					for($n=0;$n<sizeof($artikeln);$n++)	{
						parse_str($artikeln[$n],$r);
						$dstmp = explode('/',$r['expiry_date']);
						$expiry_date = $dstmp[2] . '-' . $dstmp[1] . '-' . $dstmp[0];
						$sql = "INSERT INTO $dbsupplyhistory(id_supplier, data, bill_nr, medicament, qty, price, value, expiry_date) ";
						$sql .= "VALUES ( " . $supplier_nr. ",'" . $content['order_date'] . "','" . $content['bill_nr'] . "','" . $r['bestellnum'] . "'," . $r['pcs'] . ",". $r['price'] . "," . $r['value'] . ",'" . $expiry_date . "')";
						if($ergebnis=$core->Transact($sql)){
								$status=""; 
								$stat2seen=true;
							}
							else { echo "$LDDbNoUpdate<br>$sql"; }
				 	}
				 	//end:gjergji
				 						
					//gjergji:update the quantity in the depot
					$artikeln=explode(' ',$content['articles']);
					for($n=0;$n<sizeof($artikeln);$n++)	{
						parse_str($artikeln[$n],$r);
						$dstmp = explode('/',$r['expiry_date']);
						$expiry_date = $dstmp[2] . '-' . $dstmp[1] . '-' . $dstmp[0];						
						$sql = "INSERT INTO $dbtableupdate( pcs, expiry_date, price, bestellnum, idcare_supply ) ";
						$sql .= "VALUES ( " . $r[pcs] . ",'" . $expiry_date. "',". $r[price]. ",'" . $r['bestellnum'] . "'," . $idcare_supply . ")";
						if($ergebnis=$core->Transact($sql)){
								$status=""; 
								$stat2seen=true;
							}
							else { echo "$LDDbNoUpdate<br>$sql"; }
				 	}
					//end:gjergji
				 	break;

			case 'archive':
			   	    $history_txt=" by ".$clerk." on ".date('Y-m-d H:i:s')."\n\r";
				    $sql="UPDATE $dbtable SET status='archive',
                                   history='".$content['history'].' Archived '.$history_txt."',
                                   process_datetime='".date('Y-m-d H:i:s')."'
                                   WHERE idcare_supply='$idcare_supply'";
					if($ergebnis=$core->Transact($sql)) {
						
						$status='';
						$deltodo=true;
														
					}
						else { echo "$LDDbNoRead<br>$sql"; } 
					 break;
					
		 		}


/*}*/
?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $title ?></title>

<script language=javascript>
function ack_print() {
	this.print()
	this.location.replace("supply-bestellbot-print.php<?php echo URL_REDIRECT_APPEND."&userck=$userck&mode=ack_print&cat=$cat&supplier_nr=$supplier_nr&idcare_supply=$idcare_supply&status=$status"; ?>");
}
function move2arch() {
	if(document.opt3.clerk.value=="")
	{
		alert("<?php echo $LDAlertEnterName ?>");
		return;
	}
	c=document.opt3.clerk.value;
	this.location.replace("supply-bestellbot-print.php<?php echo URL_REDIRECT_APPEND."&userck=$userck&mode=archive&cat=$cat&supplier_nr=$supplier_nr&idcare_supply=$idcare_supply&status=$status&clerk="; ?>"+c);
}
function parentref(n) {
    if(n==1) window.opener.location.replace("supply-orderlist-final.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&nofocus="+n+"&showlist=1");
    else window.opener.location.replace("supply-orderlist-final.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&showlist=1");
    //
	<?php
	if($statseen || $deltodo) {
	?>
		setTimeout("parentref('')",10000);
    <?php
	}
	?>
	return true;
}

</script>

</head>
<html>
<body  topmargin=20 leftmargin=30  marginwidth=30 marginheight=20  bgcolor=#fefefe onLoad="if (window.focus) window.focus();  if(parentref('1')) 1;">
<p>

<?php
if($rows){
	 # Create supplier object
     include_once($root_path.'include/care_api_classes/class_supplier.php');
	 $supplier=new Supplier;
	 echo $supplier->FormalName($supplier_nr);
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;

echo '<p>
		<font face="Verdana, Arial" size=2 >'.$LDNrFature.' : '.$content['bill_nr'].'</font><p>
		<font face="Arial" size=2> Date : ';
		echo formatDate2Local($content['order_date'],$date_format). ' '.$LDAt.': '.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'<p>';
		echo'
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666" width="100%">
		<tr><td>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDIndexBillPrint);$i++)
	echo '
		<td><font face=Verdana,Arial size=2 >'.$LDIndexBillPrint[$i].'</font></td>';
	echo '</tr>';	

$i=1;
$totali=0;
$artikeln=explode(' ',$content['articles']);
for($n=0;$n<sizeof($artikeln);$n++)	{
	parse_str($artikeln[$n],$r);
	if($tog) { echo '<tr bgcolor="#ffffff">'; $tog=0; }
	else{ echo '<tr bgcolor="#ffffff">'; $tog=1; }
	echo'<td><font face=Arial size=2 >'.$i.'</font></td>
		<td><font face=Verdana,Arial size=2> &nbsp;'.$r['artikelname'].' &nbsp;</font></td>
		<td><font face=Verdana,Arial size=2>'.$r[pcs].'</font></td>
		<td ><font face=Verdana,Arial size=2><nobr>X '.$r['proorder'].'</nobr></font></td>
		<td><font face=Verdana,Arial size=2> &nbsp;'.$r['price'].'</font></td>
		<td><font face=Verdana,Arial size=2> &nbsp;'.$r['value'].'</font></td>			
		<td><font face=Verdana,Arial size=2> &nbsp;'.$r['expiry_date'].'</font></td>						
				</tr>';
	$i++;
	$totali = $totali + $r['value'];
}
	echo "<tr bgcolor=\"#ffffff\"><td colspan=7>&nbsp;</td></tr>";
	echo "<tr bgcolor=\"#ffffff\"><td colspan=4></td><td><b>Totali : </b></td><td><b>".$totali."</b></td><td colspan=2><b> Lek</b></td></tr>";	
 	echo '</table></td></tr></table>';
	echo'<p>'.$LDCreatedBy.': '.$content['modify_id'].'<p><hr>';
			
	switch($status)	{
		case 'pending':{ echo '
						     <form name="opt" action="'.$thisfile.'" method="post" onSubmit="window.print()">	
					        <input type="submit" value="GO"> '.$LDOrderAck.'<p>
                             <input type="hidden" name="mode" value="ack_print">
							<input type="hidden" name="cat" value="'.$cat.'">
                             <input type="hidden" name="userck" value="'.$userck.'">
                             <input type="hidden" name="supplier_nr" value="'.$supplier_nr.'">
                             <input type="hidden" name="idcare_supply" value="'.$idcare_supply.'">
                             <input type="hidden" name="sid" value="'.$sid.'">
                             <input type="hidden" name="lang" value="'.$lang.'">
							 </form><p>';
							break;
						}
		case 'ack_print':{ echo '
							<form name="opt2" action="'.$thisfile.'">	
							<input type="button" value="GO" onClick="window.print()"> <b>'.$LDBillPrint.'</b><p>
							</form>
							
							<form name="opt3" action="'.$thisfile.'" method="post" >	
							'.$LDProcessedBy.':<input type="text" name="clerk" size=25 maxlength=40><br>
							<input type="button" value="GO"  onClick="move2arch()"> <b>'.$LDOrder2Archive.'</b>   
							</form>
                            <p>';
                            break;
						}
	}//end of switch(status)
} // end of if(rows)
else {
    echo' <img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>'.$LDDataNoFoundTxt.$sql;
}
?>
<form name="opt4">
	<p align=right><input type="button" value="<?php echo $LDClose ?>" onClick="if(parentref('')) window.close();"></p>
</form>
</font>
</body>
</html>
