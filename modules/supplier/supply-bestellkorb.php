<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

if(!isset($supplier_nr)||!$supplier_nr)
{
	if(isset($_COOKIE['ck_thispc_dept'])&&!empty($_COOKIE['ck_thispc_dept'])) $dept=$_COOKIE['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}

$thisfile=basename(__FILE__);

$dbtable='care_supply' ;


$encbuf=$_SESSION['sess_user_name'];

//$db->debug=1;

// define the content array
$rows=0;
$count=0;

# Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');
# Create department object
require_once($root_path.'include/care_api_classes/class_supplier.php');
$supplier_obj=new Supplier;
# Create products object
require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

if($mode!=''){
			$sql="SELECT * FROM $dbtable
							WHERE idcare_supply='$idcare_supply'
							AND idcare_supplier='$supplier_nr'";
							
			if($ergebnis=$db->Execute($sql))			{
				$rows=$ergebnis->RecordCount();
			}
			else { echo "$LDDbNoRead<br>"; } 
			
		 	$content=$ergebnis->FetchRow();
			$artikeln=explode(' ',$content['articles']);
			$ocount=sizeof($artikeln);
			
		if(($mode=='delete')&&($idx!='')) {
			if($ocount==1){
        		$product_obj->DeleteOrderSupplier($idcare_supply,$cat);
		 	}else{
			
			    $trash=array_splice($artikeln,$idx-1,1);
			    $content['articles']=implode(' ',$artikeln);
			
			    $sql="UPDATE $dbtable SET
							 		order_date='".$content['order_date']."',
							  		articles='".$content['articles']."',
									validator='".$content['validator']."',
									order_time='".$content['order_time']."',
									sent_datetime='".$content['sent_datetime']."',
									ip_addr='".$content['ip_addr']."',
									modify_id= '".$_COOKIE[$local_user.$sid]."'
							   		WHERE idcare_supply='".$content['idcare_supply']."'
									AND idcare_supplier='$supplier_nr'";
									
			     if(!$ergebnis=$product_obj->Transact($sql)) { echo "$sql<br>$LDDbNoSave<br>"; }
		  	}	
		}

//*** Mode add ******

		if($mode=='add'){
			$dbtable='care_med_products_main';
			// data on the meds from the comming bill
			for($i=1;$i<=$maxcount;$i++){
					$o='order'.$i; 
					if(!$$o) continue;
					$b='bestellnum'.$i; 
					// get the needed info from the main pharma db
					$sql="SELECT artikelname, minorder, maxorder, proorder FROM $dbtable WHERE bestellnum='".$$b."'";
					if($ergeb=$db->Execute($sql)){
						$result=$ergeb->FetchRow();
							$a='artikelname'.$i;
							$$a=str_replace('&','%26',strtr($result['artikelname'],' ','+')); 
							$mi='minorder'.$i;
							$$mi=$result['minorder'];
							$mx='maxorder'.$i;
							$$mx=$result['maxorder'];
							$po='porder'.$i;
							$$po=$result['proorder'];
					}else { echo "$sql<br>$LDDbNoRead<br>"; } 
			}
			
		    if($rows) $tart=$content['articles']; else $tart="";
		    
			for ($i=1;$i<=$maxcount;$i++){
				$o='order'.$i; 
				if(!$$o) continue;
				$b='bestellnum'.$i; 
				$a='artikelname'.$i;
				$po='porder'.$i;
				$pc='p'.$i;
				$c="c".$i; 
				$v="v".$i;
				$s="s".$i;
				$tart.=' bestellnum='.$$b.'&artikelname='.$$a.'&pcs='.$$pc.'&minorder='.$$mi.'&maxorder='.$$mx.'&proorder='.$$po.'&price='.$$c.'&value='.$$v.'&expiry_date='.$$s; // append new bestellnum to articles
				$tart=trim($tart);
			
			}
			
		    $saveok=false;
			//save the orderlisr
			$dbtable='care_supply';
			//if existed...
			if($rows){
			    $sql="UPDATE $dbtable SET articles='$tart',  modify_id='$encbuf' WHERE idcare_supply='".$content['idcare_supply']."' AND idcare_supplier='$supplier_nr'";
			}
			//else...
			else{
				$sql="INSERT INTO $dbtable
						(
							idcare_supplier,
							order_date,
							articles,
							sasi,
							order_time,
							ip_addr,
							status,
							create_id,
							create_time
							)
						VALUES (
							'$supplier_nr',
							'".date('Y-m-d')."',
							'".$tart."',
							'".$$pc."',
							'".date('H:i:s')."',
							'".$REMOTE_ADDR."',
							'draft',
							'".$encbuf."',
							".date('YmdHis')."
							)";
			}
        	if($ergebnis=$product_obj->Transact($sql))	{
				if(!$rows){
						$oid=$db->Insert_ID(); // if the last action was insert get the last id
						$product_obj->coretable=$dbtable;
						$idcare_supply=$product_obj->LastInsertPK('idcare_supply',$oid);
				}
						$cat_table='care_med_ordercatalog';
					for($i=1;$i<=$maxcount;$i++) {
						$b='bestellnum'.$i;
 						$sql="UPDATE $cat_table SET hit= hit +1  WHERE bestellnum='".$$b."' AND supplier_nr='$supplier_nr'";
						$product_obj->Transact($sql);
					}
					$saveok=true;
				}
				else { echo "$sql<br>$LDDbNoSave<br>"; }
		}// end of if ($mode=="add")
//++++++++++++++++++++++++++++++++++++++++
}


$rows=0;
$wassent=false;
//me e perdore te final & te print
$sql="SELECT * FROM $dbtable WHERE idcare_supply='$idcare_supply' AND idcare_supplier='$supplier_nr'";

if($ergebnis=$db->Execute($sql)){
	//reset result
	if ($rows=$ergebnis->RecordCount())	{
		// check status again to be sure that the list is not sent by somebody else
	   $content=$ergebnis->FetchRow();
	   if(($content['sent_datetime']>DBF_NODATETIME)||($content['validator']!='')){
			$wassent=true;
			 $rows=0;
		} // if sent_stamp or validator filled then reject this data
	}
}else{ echo "$LDDbNoRead<br>$sql"; } 

	 
# Load common icon images
$img_warn=createComIcon($root_path,'warn.gif','0');	
$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');
$img_info=createComIcon($root_path,'info3.gif','0');
$img_delete=createComIcon($root_path,'delete2.gif','0');
 
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b)
{
	urlholder="supplier-bestellkatalog-popinfo.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}

function resize() {
	parent.document.getElementById("products").cols = "60%,20%";
}
</script>

<script language="javascript" src="../js/products_validate_order_num.js"></script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<?php 
switch($mode)
{
	case "add"://echo ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete"://echo ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
}
echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table><tr><td>
<a href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo 
$LDOpenHelp ?>"></a>
</td><td>
<a href="javascript:resize()"><img <?php echo createComIcon($root_path,'r_arrowgrnsm.gif','0'); ?> alt="Zgjero"></a>
</td></tr></table>
<br>
<?php

if($rows>0){
#++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

$tog=1;
echo '<form name=actlist>
		<font size=2 color="#800000">'.$LDActualOrderSupply.':</font>
		<font size=1> ('.$LDOn.': ';
		
		echo formatDate2Local($content['order_date'],$date_format);

		echo ' '.$LDTime.': '.str_replace('24','00',convertTimeToLocal($content['order_time'])).')</font>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDcatindexSupply);$i++)
	echo '
		<td>'.$LDcatindexSupply[$i].'</td>';
	echo '</tr>';	

$i=1;

$artikeln=explode(" ",$content['articles']);
for($n=0;$n<sizeof($artikeln);$n++)	{
	parse_str($artikeln[$n],$r);
	if(!$r['minorder']) $r['minorder']=0;
	if(!$r['maxorder']) $r['maxorder']=0;
	if($tog)
	{ echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
	echo'
				<td>';
	if($mode=='delete') echo '<a name="'.$i.'"></a>';
	echo'	
				<font ize=1 color="#000080">'.$i.'</td>
				<td><font size=1>'.$r['artikelname'].'</td>';				 
    echo '<td><font size=1>'.$r['pcs'].'</td>
				<td ><font size=1><nobr>X '.$r['proorder'].'</nobr></td>
				<td>'.$r['price'].'</td>
				<td>'.$r['value'].'</td>			
				<td>'.$r['expiry_date'].'</td>
				<td><font size=1>'.$r['bestellnum'].'</td>
				<td><a href="javascript:popinfo(\''.$r['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$r['artikelname'].'"></a></td>
				<td><a href="'.$thisfile.URL_APPEND.'&supplier_nr='.$supplier_nr.'&idcare_supply='.$idcare_supply.'&mode=delete&cat='.$cat.'&idx='.$i.'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';
	$i++;

 	}
	echo '</table>
			</form>
			<form action="supplier-orderlist-final.php" method="post">
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="idcare_supply" value="'.$idcare_supply.'">
   			<input type="hidden" name="supplier_nr" value="'.$supplier_nr.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
   			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDFinalizeListFur.'">   
   			</form>	';
}else{
	if($itwassent) echo '<font size=2>'.$LDWasSent.'<p></font>';

	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'><font size=2>'.$LDBasketEmpty.'<p>';

	// get all lists that are not sent

    $rows=0;

    $ergebnis=&$product_obj->OrderDraftsSupplier($supplier_nr,$cat);
	$rows=$product_obj->LastRecordCount();

# +++++++++ show the last lists+++++++++++++++++++++++++++++++++++++++++

	if($rows>0)
	{	
	
		if ($rows>1) echo $LDListNotSentManyF;
			 else echo $LDListNotSentSupply; 
		echo $LDClk2SeeEdit.'<br></font><p>';

		$tog=1;
		echo '
		<font size=2 color="#800000">'.$last_orderlist.$supplier_obj->FormalName($supplier_nr).':</font>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr class="wardlisttitlerow">';
		echo '
			<td>'.$LDOrderNr.'</td>
			<td>'.$LDEditList.'</td>
			<td>'.$LDListindex[2].'</td>
			<td>'.$LDListindex[3].'</td>
			<td>'.$LDListindex[4].'</td>
			<td>'.$LDListindex[5].'</td>
			';
		echo '</tr>';

		$i=1;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog) { echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
			echo '
				<td><font size=1>'.$content['idcare_supply'].'</td>
				<td align="center"><a href="supply.php'.URL_APPEND.'&supplier_nr='.$supplier_nr.'&cat='.$cat.'&idcare_supply='.$content['idcare_supply'].'&userck='.$userck.'"  target="_parent" ><img '.$img_uparrow.' alt="'.$LDEditList.'"></a></td>
				<td><font size=1>'.formatDate2Local($content['order_date'],$date_format);
				
			echo '</td>
				 <td><font size=1>'.convertTimeToLocal(str_replace('24','00',$content['order_time'])).'</td>
				<td ><font size=1>'.$content['modify_id'].'</td>
				<td align="center"><font size=1><img '.$img_warn.' alt="'.$LDNotSent.'">
			 	</td>
				</tr>';
			$i++;

 		}
		echo '</table>';
	}
}
?>
<a name="bottom"></a>
</body>
</html>
