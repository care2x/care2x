<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department();
require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product();
$sendok=false;
$ofinal=false;
///$db->debug=1;
if($cat=='pharma') {
 	$dbtable='care_pharma_orderlist';
	$title=$LDPharmacy;
	$breakfile='modules/pharmacy/apotheke.php';
}else{
 	$dbtable='care_med_orderlist';
	$title=$LDMedDepot;
	$breakfile='modules/med_depot/medlager.php';
}

$thisfile=basename(__FILE__);
$breakfile=$root_path.$breakfile.URL_APPEND;

// define the content array
$rows=0;
$count=0;
//this is a bit of horror, but it works...
function createOrderList($validator,$prior,$dept_nr) {
	global $REMOTE_ADDR,$encbuf,$product_obj,$db,$_SESSION;
	$oid = '';
	$order_nr = '';
	//select where i'm working
	if($_POST['cat']=='pharma') {
		$dbtable='care_pharma_orderlist'; 
		$dbtablesub='care_pharma_orderlist_sub';
		$dbcatalog='care_pharma_ordercatalog';
	} else {
		$dbtable='care_med_orderlist'; 
		$dbtablesub='care_med_orderlist_sub';
		$dbcatalog='care_med_ordercatalog';
	}	
	
	$db->BeginTrans();
	//create the new orderlist
	$sql="INSERT INTO $dbtable ( dept_nr,order_date,order_time,ip_addr,status,create_id,create_time,validator,priority,sent_datetime) 
				VALUES ('$dept_nr','".date('Y-m-d')."','".date('H:i:s')."','".$REMOTE_ADDR."','pending','".$_SESSION['sess_user_name']."',
    					".date('YmdHis').",'$validator','$prior',".date('YmdHis').")";
    if($ergebnis=$product_obj->Transact($sql)) {
			$oid=$db->Insert_ID(); // if the last action was insert get the last id
			$product_obj->coretable=$dbtable;
			$order_nr=$product_obj->LastInsertPK('order_nr',$oid);
	}else { echo "$sql<br>$LDDbNoSave<br>";$db->RollbackTrans();exit(); }
	
    for($i=0;$i<=$_POST['maxnum'];$i++) {
        $art = 'art' . $i;
    	$p = 'p' . $i;
    	$proorder = 'proorder' . $i;
    	$bestellnum = 'bestellnum' . $i;
    	$idsub = 'idsub' . $i;
    	$dose = 'dose' .$i;
    	$unit = 'unit' .$i;
    	$price = 'price' .$i;
    	$value = 'value' .$i;
    	$expiry_date = 'expiry_date' . $i;

    	if($_POST[$art]) {
        	$sqlSub = "INSERT INTO $dbtablesub(order_nr_sub,bestellnum,idsub,artikelname,pcs,proorder,unit,expiry_date,price,dose,value)
        				VALUES ('$order_nr','$_POST[$bestellnum]','$_POST[$idsub]','$_POST[$art]','$_POST[$p]','$_POST[$proorder]','$_POST[$unit]','$_POST[$expiry_date]','$_POST[$price]','$_POST[$dose]','$_POST[$value]')";
        	if($ergebnis=$product_obj->Transact($sqlSub)) {
        		$saveok = true;	
        	}else { echo "$sql<br>$LDDbNoSave<br>";$db->RollbackTrans(); exit();}
    	}
    }
    //update prices in the care_encounter_prescription_sub
    if($_POST['cat'] == 'pharma') {
        if($product_obj->updatePrescriptionPrices($dept_nr) && $saveok) {
        	//delete the ordercatalog, i don't need it anymore
        	$sqlDel = "DELETE FROM $dbcatalog WHERE dept_nr ='$dept_nr'";
            if($ergebnis=$product_obj->Transact($sqlDel)) {
        		$saveok = true;	
        	}else { echo "$sql<br>$LDDbNoSave<br>";$db->RollbackTrans(); exit();}
        }
    }
    $db->CommitTrans();
}    

// Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');

if(($mode=='send') && isset($_SESSION['current_order']) ){
	
	//Check authenticity of validator person
	include_once($root_path.'include/care_api_classes/class_access.php');
	$user = & new Access($validator,$vpw);
	if($user->isKnown()){
		if($user->hasValidPassword() && $user->isNotLocked()){ 
			createOrderList($validator,$prior,$dept_nr);
  				$ofinal=true;
				$sendok=true;
		}else{
			$error='password';
			$mode='';
		}
	}else{ 
		$error='validator';
		$mode='';
	} 
}

if( $ofinal && $sendok )
	unset($_SESSION['current_order']);
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b) {
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_APPEND; ?>&cat=<?php echo $cat; ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}
function checkform(d) {
	if (d.validator.value=="") 	{
		alert("<?php echo $LDAlertNoValidator ?>");
		d.validator.focus();
		return false;
	}
	if (d.vpw.value=="") {
		alert("<?php echo $LDAlertNoPassword ?>");
		d.vpw.focus();
		return false;
	}
 	return true;
}
<?php 
if (($mode=='send')&&($sendok)) {
    $idbuf=$order_nr + 1;
    echo "function hide_bcat() {
    			window.parent.BESTELLKATALOG.location.replace('products-bestellkatalog.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&userck=$userck&cat=$cat&order_nr=$idbuf')
    	  }";
}
?>

</script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 
<?php 			
switch($mode) {
	case "add":echo ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":echo ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
	case "send": if($sendok) echo ' onLoad="hide_bcat()" ';
}
echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a href="javascript:gethelp('products.php','final','<?php echo $sendok ?>','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>

<?php

/* Display event messages */

if ($sendok) echo '<font face="Verdana, Arial" size=2 color="#800000">'.$LDOrderSent.'<p></font>';
			
if ($error ) {
    ?>
    <table border=0>
      <tr>
        <td><img <?php echo createMascot($root_path,'mascot1_r.gif') ?>></td>
        <td><font face="Verdana, Arial" size=3 color="#800000"><b><?php echo ($error=='password') ? $LDInvalidPassword : $LDUnknownValidator; echo '<br>'.$LDPlsEnterInfo; ?></b></font></td>
      </tr>
    </table>
    <hr>
    <?php
}

if($cat=='pharma') $dbtable='care_pharma_orderlist';
	else $dbtable=$dbtable='care_med_orderlist';

if ($_POST['maxnum']>0) {
    $tog=1;
    //$content=$ergebnis->FetchRow();
    echo '<font face="Verdana, Arial" size=2 color="#800000">'.$final_orderlist;
    echo '<form action="'.$thisfile.'" method="post" onSubmit="return checkform(this)">';
    		
    		$buff=$dept_obj->LDvar($dept_nr);
    		if(isset($$buff)&&!empty($$buff)) echo $$buff;
    			else echo $dept_obj->FormalName($dept_nr);
    			
    		echo ':</font><br>
    		<font face="Arial" size=1> ('.$LDCreatedOn.': '. formatDate2Local(date('d-m-Y'),$date_format). ' '.$LDTime.': '.convertTimeToLocal(str_replace('24','00',date('H:i:s'))).')</font>
    		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666" width="100%"><tr><td>
    		<table border=0 cellspacing=1 cellpadding=3 width="100%">
      		<tr bgcolor="#ffffff">';
    	for ($i=0;$i<sizeof($LDFinindex);$i++)
    		echo '<td><font face=Verdana,Arial size=1 color="#000080">'.$LDFinindex[$i].'</font></td>';
    	echo '</tr>';	
    $n=1;
    for($i=0;$i<=$_POST['maxnum'];$i++) {
    	//parse_str($artikeln[$n],$r);
        $art = 'art' . $i;
    	$p = 'p' . $i;
    	$proorder = 'proorder' . $i;
    	$bestellnum = 'bestellnum' . $i;
    	$idsub = 'idsub' . $i;
    	$prodInfo = $product_obj->ProductInformation($_POST[$idsub],$cat);
    	if($_POST[$art]) {
        	if($tog) { echo '<tr bgcolor="#ffffff">'; $tog=0; }else{ echo '<tr bgcolor="#ffffff">'; $tog=1; }
        	echo'<td>
        		<font face="Arial" size="1" color="#000080">'.$n++.'</font></td>
        		<td><font face="Verdana,Arial" size="1">'.$_POST[$art].'</font><input type="hidden" name="art'.$i.'" value="'.$_POST[$art].'"></td>
        		<td align="right"><font face="Verdana,Arial" size="1">'.$_POST[$p].'</font><input type="hidden" name="p'.$i.'" value="'.$_POST[$p].'"></td>
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['proorder'].'</font><input type="hidden" name="proorder'.$i.'" value="'.$prodInfo['proorder'].'"></td>
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['dose'].'</font><input type="hidden" name="dose'.$i.'" value="'.$prodInfo['dose'].'"></td>
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['packing'].'</font><input type="hidden" name="unit'.$i.'" value="'.$prodInfo['packing'].'"></td>					
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['price'].'</font><input type="hidden" name="price'.$i.'" value="'.$prodInfo['price'].'"></td>									
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['price'] * $_POST[$p].'</font><input type="hidden" name="value'.$i.'" value="'.$prodInfo['price'] * $_POST[$p].'"></td>									
        		<td align="right"><font face="Verdana,Arial" size="1">'.$prodInfo['expiry_date'].'</font><input type="hidden" name="expiry_date'.$i.'" value="'.$prodInfo['expiry_date'].'"></td>										
        		<td align="right"><font face="Verdana,Arial" size="1">'.$_POST[$bestellnum].'</font>
        			<input type="hidden" name="bestellnum'.$i.'" value="'.$_POST[$bestellnum].'"></td>
        			<input type="hidden" name="idsub'.$i.'" value="'.$_POST[$idsub].'"></td>
        		</tr>';
    	}
    }
    echo '</table></td></tr></table><font face=Verdana,Arial size=2 color="#800000">';
    	
    if(($mode!='send')&&(!$sendok)) {
		echo $LDListindex[4].'<br>
			<input type="text" name="sender" size=30 maxlength=40 value="'. $_COOKIE[$local_user.$sid].'"> 
			 &nbsp;'.$LDNormal.'<input type="radio" name="prior" value="normal" ';
			 
			 if(!isset($prior) || $prior=='normal' || $prior=='') echo ' checked';
			 echo '> 
			'.$LDUrgent.'<input type="radio" name="prior" value="urgent" ';
			
			 if(isset($prior) && $prior=='urgent') echo ' checked';
			
			echo '> <br>
   			<p>
			'.$LDValidatedBy.':<br>
			<input type="text" name="validator" size=30 maxlength=40 value="'.$validator.'"><br>
			<font size=1>'.$LDPassword.':</font><br>
			<input type="password" name="vpw" size=30 maxlength=20>
       		<input type="hidden" name="sid" value="'.$sid.'">
       		<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="order_nr" value="'.$order_nr.'">
   			<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
   			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="hidden" name="mode" value="send">
			<input type="hidden" name="maxnum" value="'.$_POST['maxnum'].'">
   			<p>
			<input type="submit" value="'.$LDSendOrderDepo.'">   
   			</form></font><p>
			<font face=Verdana,Arial size=2>
			<a href="products-bestellkorb.php'.URL_APPEND.'&cat='.$cat.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&userck='.$userck.'" ><< '.$LDBack2Edit.'</a></font>
			';
    }else{
    	echo '
    		<p><font face=Verdana,Arial size=1 color="#000080"><a href="'.$breakfile.'" target="_parent">
    		<img '.createComIcon($root_path,'arrow-blu.gif','0').'> '.$LDEndOrder.'</a>
    		<p>
    		<a href="products-bestellung.php'.URL_APPEND.'&dept_nr='.$dept_nr.'&cat='.$cat.'&userck='.$userck.'" target="_parent"><img '.createComIcon($root_path,'arrow-blu.gif','0').'> '.$LDCreateBasket.'</a>
    		</font>';
    }
}
?>
<a name="bottom"></a>
</body>
</html>
