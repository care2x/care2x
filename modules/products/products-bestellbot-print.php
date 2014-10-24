<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# Initializations 
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');

if(!isset($userck)) 
  if(isset($_GET['userck'])) $userck=$_GET['userck'];
    elseif(isset($_POST['userck'])) $userck=$_POST['userck'];
$local_user=$userck;
require_once($root_path.'include/core/inc_front_chain_lang.php');

# Create core object
require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

$thisfile=basename(__FILE__);

if ($_COOKIE[$local_user.$sid]=='') $cat='';  

switch($cat) {
	case 'pharma':	
				$title="$LDPharmacy - $LDOrderBotActivate $LDAck";
				$dbtable='care_pharma_orderlist';
				$dbtablesub='care_pharma_orderlist_sub';
				break;
	case 'medlager':
				$title="$LDMedDepot - $LDOrderBotActivate $LDAck";
				$dbtable='care_med_orderlist';
				$dbtablesub='care_med_orderlist_sub';
				break;
	default:   {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
}

///$db->debug=1;

/* Start the main work */
if($order_nr&&$dept_nr){
	$rows=0;
	$stat2seen=false;
	$mov2arc=false;
	$deltodo=false;

     # Load the date formatter
     include_once($root_path.'include/core/inc_date_format_functions.php');
  
     # Get the data first
	$sql="SELECT * FROM $dbtable INNER JOIN $dbtablesub ON ( $dbtablesub.order_nr_sub = $dbtable.order_nr) WHERE order_nr='$order_nr'";					
    if($ergebnis = $db->Execute($sql)) {
		if($rows = $ergebnis->RecordCount())  
			$content = $ergebnis->FetchRow();
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
                            WHERE order_nr='$order_nr'";
    						
    			if($updateHistory=$core->Transact($sql)) {
    				$status=""; 
    				$stat2seen=true;
    			} else { echo "$LDDbNoUpdate<br>$sql"; }
    			//begin : gjergji
    			switch($cat) {
    				case 'pharma':	
								$title="$LDPharmacy - $LDOrderBotActivate $LDAck";
								$dbtableupdate='care_pharma_products_main_sub';
								$dbmovements='care_pharma_products_main_movements';
								break;
    				case 'medlager':
								$title="$LDMedDepot - $LDOrderBotActivate $LDAck";
								$dbtableupdate='care_med_products_main_sub';
								$tableupdatepharmacy='care_pharma_products_main_sub';
								$dbmovements='care_med_products_main_movements';												
								break;
    				default:   {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
    			}
    
    			//gjergji:
    			$ergebnis->MoveFirst();
    			while ($meds = $ergebnis->FetchRow()) { 
    				if($cat == 'pharma') {
    					$sql = "UPDATE $dbtableupdate SET pcs = pcs - " . $meds['pcs'] . " WHERE id = '".$meds['idsub']. "'";
    				}else{
    					$sql = "UPDATE $dbtableupdate SET pcs = pcs - " . $meds['pcs'] . " WHERE id = '".$meds['idsub']. "'";	
    				}
					if($updatePcs=$core->Transact($sql)){
						$status=""; 
						$stat2seen=true;
					}
					else { echo "$LDDbNoUpdate<br>$sql"; }
    		 	}
    			//end:gjergji
    			
    		 	//gjergji:
    		 	if($cat=='medlager'){
    		 		$ergebnis->MoveFirst();
    		 		while ($dept = $ergebnis->FetchRow()) { 
    					$dstmp = explode('/',$dept['expiry_date']);
    					$expiry_date = $dstmp[2] . '-' . $dstmp[1] . '-' . $dstmp[0];						
    					$sqlpharmacy = "";	
    					$sqlpharmacy = "INSERT INTO $tableupdatepharmacy(pcs,expiry_date,price,bestellnum,idcare_pharma) VALUES (" . $dept['pcs'] . ",'". $dept['expiry_date']. "','". $dept['price']. "','".$dept['bestellnum']. "','" . $dept_nr . "')";
						if($updateMedlager=$core->Transact($sqlpharmacy)){
							$status=""; 
							$stat2seen=true;
						}else { echo "$LDDbNoUpdate<br>$sqlpharmacy"; }
    					
    			 	}
    		 	}				 	
    		 	// end : gjergji
    
    			//gjergji:
    			$ergebnis->MoveFirst();
    			while ($meds = $ergebnis->FetchRow()) { 
    				if($cat == 'pharma') {
    					$sql = "INSERT INTO $dbmovements(dept_id, data, bill_nr, medicament, qty, price, value, expiry_date, id_sub) ";
    					$sql .= "values ( " . $dept_nr. ",'" . $meds['order_date'] . "'," . $order_nr . ",'" . $meds['bestellnum'] . "'," . $meds['pcs'] . ",". $meds['price'] . "," . $meds['pcs'] * $meds['price'] . ",'" . $meds['expiry_date'] . "'," . $meds['idsub']. ")";
    				} else {
    					$sql = "INSERT INTO $dbmovements(pharmacy_id, data, bill_nr, medicament, qty, price, value, expiry_date, id_sub) ";
    					$sql .= "values ( " . $dept_nr. ",'" . $meds['order_date'] . "'," . $order_nr . ",'" . $meds['bestellnum'] . "'," . $meds['pcs'] . ",". $meds['price'] . "," . $meds['pcs'] * $meds['price'] . ",'" . $meds['expiry_date'] . "'," . $meds['idsub']. ")";
    				}
    				if($historic=$core->Transact($sql)){
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
                                   WHERE order_nr='$order_nr'";
    													   
    			if($archive=$core->Transact($sql)) { // get the data from pharma order list todo
    				$status='';
    				$deltodo=true;						
    			} else { echo "$LDDbNoRead<br>$sql"; } 
    			 break;
    			
     }
}
?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $title ?></title>

<script language=javascript>
function ack_print() {
	this.print()
	this.location.replace("products-bestellbot-print.php<?php echo URL_REDIRECT_APPEND."&userck=$userck&mode=ack_print&cat=$cat&dept_nr=$dept_nr&order_nr=$order_nr&status=$status"; ?>");
}
function move2arch() {
	if(document.opt3.clerk.value=="") {
		alert("<?php echo $LDAlertEnterName ?>");
		return;
	}
	c=document.opt3.clerk.value;
	this.location.replace("products-bestellbot-print.php<?php echo URL_REDIRECT_APPEND."&userck=$userck&mode=archive&cat=$cat&dept_nr=$dept_nr&order_nr=$order_nr&status=$status&clerk="; ?>"+c);
}
function parentref(n) {
    if(n==1) window.opener.location.replace("products-bestellbot.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&nofocus="+n+"&showlist=1");
    else window.opener.location.replace("products-bestellbot.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&showlist=1");
    //
	<?php if($statseen || $deltodo) { ?>
		setTimeout("parentref('')",10000);
    <?php } ?>
	return true;
}

</script>

</head>
<body  topmargin=20 leftmargin=30  marginwidth=30 marginheight=20  bgcolor=#fefefe onLoad="if (window.focus) window.focus();  if(parentref('1')) 1;" 
>
<p>

<?php
if($rows){
    include_once($root_path.'include/care_api_classes/class_department.php');
    $dept=new Department;

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

    $tog=1;
    echo '<p>
    		<font face="Verdana, Arial" size=2 >'.$LDOrderNrBrendshem.' '.$order_nr.'<p>'.$dept->FormalName($dept_nr).'</font><br>
    		<font face="Arial" size=2> '.$LDListindex[2].': '. formatDate2Local($content['order_date'],$date_format).  ' '.$LDAt.': '.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'<p>';
    		if($content['priority']=='urgent') echo "::::::::::::::::::::  $LDUrgent $LDUrgent $LDUrgent ::::::::::::::::::::::::";
    		echo'<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666" width="100%">
    		<tr><td>
    		<table border=0 cellspacing=1 cellpadding=3 width="100%">
      		<tr bgcolor="#ffffff">';
    	for($i=0;$i<sizeof($LDFinindex);$i++)
    	echo '<td><font face=Verdana,Arial size=2 >'.$LDFinindex[$i].'</td>';
    	echo '</tr>';	
    
    $i=1;
    $totali=0;
    
    $ergebnis->MoveFirst();
    while ($meds = $ergebnis->FetchRow()) {    
    	if($tog){ echo '<tr bgcolor="#ffffff">'; $tog=0; }else{ echo '<tr bgcolor="#ffffff">'; $tog=1; }
    	echo'<td>';
    	echo'<font face=Arial size=2 >'.$i.'</td>
    		<td align="left"><font face=Verdana,Arial size=2>'.$meds['artikelname'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2>'.$meds['pcs'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2>X '.$meds['proorder'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['dose'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['unit'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['price'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['price'] * $meds['pcs'] .'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['expiry_date'].'</td>
    		<td align="right"><font face=Verdana,Arial size=2> &nbsp;'.$meds['bestellnum'].'</td>
    			</tr>';
    	$i++;
    	$totali = $totali + $meds['price'] * $meds['pcs'];
    }
	echo "<tr bgcolor=\"#ffffff\"><td colspan=10>&nbsp;</td></tr>";
	echo "<tr bgcolor=\"#ffffff\"><td colspan=6></td><td><b>Totali : </b></td><td align=right ><b>".$totali."</b></td><td colspan=2><b> Lek</b></td></tr>";
 	echo '</table></td></tr></table>';
	if($content['priority']=='urgent') echo "::::::::::::::::::::  $LDUrgent $LDUrgent $LDUrgent ::::::::::::::::::::::::";
	echo'<p>'.$LDCreatedBy.': '.$content['create_id'].'<p><hr>';
    			
	switch($status) {
		case 'pending': 
				echo '<form name="opt" action="'.$thisfile.'" method="post" onSubmit="window.print()">	
		        <input type="submit" value="GO"> '.$LDOrderAck.'<p>
                 <input type="hidden" name="mode" value="ack_print">
				<input type="hidden" name="cat" value="'.$cat.'">
                 <input type="hidden" name="userck" value="'.$userck.'">
                 <input type="hidden" name="dept_nr" value="'.$dept_nr.'">
                 <input type="hidden" name="order_nr" value="'.$order_nr.'">
                 <input type="hidden" name="sid" value="'.$sid.'">
                 <input type="hidden" name="lang" value="'.$lang.'">
				 </form><p>';
				break;
		case 'ack_print':
			echo '<form name="opt2" action="'.$thisfile.'">	
				<input type="button" value="GO" onClick="window.print()"> <b>'.$LDOrderPrint.'</b><p>
				</form>
				<form name="opt3" action="'.$thisfile.'" method="post" >	
				'.$LDProcessedBy.':<input type="text" name="clerk" size=25 maxlength=40><br>
				<input type="button" value="GO"  onClick="move2arch()"> <b>'.$LDOrder2Archive.'</b>   
					 </form>
                <p>';
           break;
	}
} else {
    echo' <img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>'.$LDDataNoFoundTxt;
}
?>
<form name="opt4">
<p align=right><input type="button" value="<?php echo $LDClose ?>" onClick="if(parentref('')) window.close();"></p>
</form>
</font></body>
</html>
