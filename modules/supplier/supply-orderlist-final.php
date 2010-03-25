<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;

$sendok=false;
$ofinal=false;

//$db->debug=1;

if($cat=='pharma') {
 	$dbtable='care_pharma_orderlist';
	$title=$LDPharmacy;
	$breakfile=$root_path.'modules/pharmacy/apotheke.php';
}else{
 	$dbtable='care_med_orderlist';
	$title=$LDMedDepot;
	$breakfile=$root_path.'modules/med_depot/medlager.php';
}

$thisfile=basename(__FILE__);
$breakfile=$root_path.$breakfile.URL_APPEND;

// define the content array
$rows=0;
$count=0;

# Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');

if(($mode=='send') && isset($order_nr) && $order_nr){

	#Check authenticity of validator person
	   
	include_once($root_path.'include/care_api_classes/class_access.php');
	$user = & new Access($validator,$vpw);
	   
	if($user->isKnown()){
		  
		if($user->hasValidPassword()&&$user->isNotLocked()){
			 
			$sql="UPDATE $dbtable SET validator='$validator',
									priority='$prior',
									status='pending',
									sent_datetime='".date('Y-m-d H:i:s')."'
							   		WHERE order_nr='$order_nr'
									AND dept_nr='$dept_nr'";// save aux data to the order list
		
			if($ergebnis=$user->Transact($sql)){
				//echo $sql;
  				$ofinal=true;
				$sendok=true;
			}
			//echo $sql;
		}else{
			$error='password';
			$mode='';
		}
	}else{ 
		$error='validator';
		$mode='';
	} 
}
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_APPEND; ?>&cat=<?php echo $cat; ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}
function checkform(d)
{
	if (d.validator.value=="") 
	{
		alert("<?php echo $LDAlertNoValidator ?>");
		d.validator.focus();
		return false;
	}
	if (d.vpw.value=="") 
	{
		alert("<?php echo $LDAlertNoPassword ?>");
		d.vpw.focus();
		return false;
	}
 	return true;
}
<?php if (($mode=='send')&&($sendok))
{
$idbuf=$order_nr + 1;
echo "
		function hide_bcat()
		{
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
switch($mode)
{
	case "add":echo ' onLoad="location.replace(\'#bottom\')"   '; break;
	case "delete":echo ' onLoad="location.replace(\'#'.($idx-1).'\')"   '; break;
	case "send": if($sendok) echo ' onLoad="hide_bcat()" ';
}
echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a href="javascript:gethelp('products.php','final','<?php echo $sendok ?>','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>

<?php

/* Display event messages */

if ($sendok) echo '
			<font face="Verdana, Arial" size=2 color="#800000">'.$LDOrderSent.'<p></font>';
			
if ($error )
{
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


$sql="SELECT * FROM $dbtable WHERE order_nr='$order_nr' AND dept_nr='$dept_nr'";
						
if($ergebnis=$db->Execute($sql)){
	$rows=$ergebnis->RecordCount();
}else{
	echo "$LDDbNoRead<br>";
} 
			//echo $sql;

	 
# ++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
	
if ($rows>0)
{

$tog=1;
$content=$ergebnis->FetchRow();
echo '
		<font face="Verdana, Arial" size=2 color="#800000">'.$final_orderlist;
		
		$buff=$dept_obj->LDvar($dept_nr);
		if(isset($$buff)&&!empty($$buff)) echo $$buff;
			else echo $dept_obj->FormalName($dept_nr);
			
		echo ':</font><br>
		<font face="Arial" size=1> ('.$LDCreatedOn.': ';

		echo formatDate2Local($content['order_date'],$date_format);

		echo ' '.$LDTime.': '.convertTimeToLocal(str_replace('24','00',$content[order_time])).')</font>
		<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666" width="100%"><tr><td>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr bgcolor="#ffffff">';
	for ($i=0;$i<sizeof($LDFinindex);$i++)
	echo '
		<td><font face=Verdana,Arial size=1 color="#000080">'.$LDFinindex[$i].'</td>';
	echo '</tr>';	

$i=1;
$artikeln=explode(" ",$content[articles]);
for($n=0;$n<sizeof($artikeln);$n++)
 	{
	parse_str($artikeln[$n],$r);
	if($tog)
	{ echo '<tr bgcolor="#ffffff">'; $tog=0; }else{ echo '<tr bgcolor="#ffffff">'; $tog=1; }
	echo'
				<td>';
	if($mode=='delete') echo '<a name="'.$i.'"></a>';
	echo'	
				<font face=Arial size=1 color="#000080">'.$i.'</td>
				<td><font face=Verdana,Arial size=1>'.$r[artikelname].'</td>
				 <td><font face=Verdana,Arial size=1>'.$r[pcs].'</td>
					<td ><font face=Verdana,Arial size=1><nobr>X '.$r[proorder].'</nobr></td>
			<td><font face=Verdana,Arial size=1>'.$r[bestellnum].'</td>
				</tr>';
	$i++;
 	}
	echo '</table></td></tr></table><font face=Verdana,Arial size=2 color="#800000">';
	
	if(($mode!='send')&&(!$sendok))
	{
		echo '
			<form action="'.$thisfile.'" method="post" onSubmit="return checkform(this)">'.$LDListindex[4].'<br>
			<input type="text" name="sender" size=30 maxlength=40 value="';
		
		echo $_COOKIE[$local_user.$sid]; 
		
		echo '"> 
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
   			<p>
			<input type="submit" value="'.$LDSendOrder.'">   
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
