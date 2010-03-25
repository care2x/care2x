<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.1 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','phone.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if(isset($user_origin)&&$user_origin=='pers'){
	$sBreakUrl = 'phone_edit.php'.URL_APPEND.'&user_origin='.$user_origin.'&nr='.$nr;
}else{
	$sBreakUrl = 'phone.php'.URL_APPEND;
}

$dbtable='care_phone';
# Filter invalid display size and set to default
if(empty($displaysize)||!is_numeric($displaysize)) $displaysize=10;

# Load the date formatter
include_once($root_path.'include/core/inc_date_format_functions.php');

$fielddata='item_nr, title, name, vorname, beruf, bereich1, bereich2,  inphone1, inphone2, inphone3, exphone1, exphone2, funk1, funk2,  roomnr';

if ($edit){
   $fielddata.=', date, time';
}

$sql='SELECT '.$fielddata.' FROM '.$dbtable.' ORDER BY name';

if( $ergebnis=$db->Execute($sql)){
   $rows=$ergebnis->RecordCount();
}
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<?php 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<?php if(!$edit) : ?>
<img <?php echo createComIcon($root_path,'phone.gif','0','absmiddle') ?>>
<?php endif; ?>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDPhoneDir ?></b></font>

<table  border=0 cellpadding=0 cellspacing=0 width="100%">
<tr>
<td colspan=3><nobr>
<?php 
if (!$edit) { echo '<a href="phone.php'.URL_APPEND.'"><img '.createLDImgSrc($root_path,'such-gray.gif','0').'';
if($cfg['dhtml'])echo' class="fadeOut" ';
echo '></a>'; } ?><img <?php echo createLDImgSrc($root_path,'phonedir-b.gif','0') ?>><?php if(!$edit) echo '<a href="phone_edit_pass.php'.URL_APPEND.'">';
	else echo "<a href=\"phone_edit.php".URL_APPEND."&remark=fromlist&sid=$sid&edit=$edit\">";
?><img <?php echo createLDImgSrc($root_path,'newdata-gray.gif','0') ?> border=0 <?php if($cfg['dhtml'])echo' class="fadeOut" '; ?>></a></nobr></td>
</tr>

<tr>
<td  class="passborder" colspan=3>
&nbsp;
</td>
</tr>
<tr>
<td  class="passborder">&nbsp;</td>
<td ><br>

<?php
if($rows){

		$colstop=$ergebnis->FieldCount();

		if(!$batchnum)
		{
            $linecount =$ergebnis->RecordCount();
			if(($linecount%$displaysize)>0)
			$pagecount=($linecount/$displaysize)+1;  else $pagecount=($linecount/$displaysize);
			$pagecount=(int)$pagecount;
			if($newdata)
				{
					$batchnum=$pagecount;
					$datanum=(($batchnum-1)*$displaysize);
				}else $datanum=0;	
		}
		 else	$datanum=(($batchnum-1)*$displaysize);

		if($update) echo "<font color=maroon size=3>$LDUpdateOk</font>";
		
        echo '<table  border=0 cellpadding=1 cellspacing=1>';
        echo "<tr nowrap >";
		echo "<td colspan=";
		if($currentuser=="") echo $colstop; else echo $colstop+1;
		echo ">&nbsp;<b> $LDActualDir</b> ( $LDMaxItem: ".($linecount)." )</font> </td>";
       	echo "</tr>"; 
        echo '<tr nowrap class="wardlisttitlerow">';
		for($i=2;$i<$colstop;$i++) 
 		{	
 		    echo '<td nowrap>&nbsp;'.$LDExtFields[$i].'</td>';
         }
		if ($edit) echo "<td>&nbsp;</td>";	
		echo "</tr>"; 

		$toggle=0; 
		$datacount=0;
		if ($linecount>1) $ergebnis->Move($datanum); 

		/* List the entries */
		
		while (($zeile=$ergebnis->FetchRow())and($datacount<$displaysize))
			{  
					if($toggle) {echo "<tr nowrap class=\"wardlistrow2\">\n";$toggle=0;} else { echo "<tr  nowrap class=\"wardlistrow1\">\n";$toggle=1;};

					$datacount++;
	
					for($i=2;$i<$colstop;$i++) 
					{
					echo "<td nowrap>";
					
					  if (($update)&&($zeile[item]==$itemname)) echo "<FONT SIZE=1 color=red>";
						  else echo "<FONT SIZE=1>";
					echo '<nobr>&nbsp;';
					
					if($edit)
					{
					   if($i == ($colstop-2)) echo formatDate2Local($zeile[$i],$date_format);
					     elseif($i==($colstop-1)) echo  convertTimeToLocal($zeile[$i]);
						   else echo htmlspecialchars($zeile[$i]);
					}
					else 
					{
					     echo htmlspecialchars($zeile[$i]);
					}
					
					echo "</td>\n";
					
					
					}
					if ($edit)
					{
						echo "<td nowrap><FONT size=1><nobr>
							<a href=\"phone_entry_update.php".URL_APPEND."&from=list&itemname=".$zeile['item_nr']."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDEdit</a> \n";
						echo "<a href=\"phone_entry_delete.php".URL_APPEND."&from=list&itemname=".$zeile['item_nr']."&batchnum=$batchnum&displaysize=$displaysize&linecount=$linecount&pagecount=$pagecount&edit=$edit\">
						$LDDelete</a> </td>";
					}
					echo "</tr>\n";
   		    };
        echo "</table><br>\n";
		
		/* If entry more than one show the controls */
		
		if($pagecount>1)
		 {  	
			if ($batchnum=="") $batchnum=1;
			echo " $LDMoreInfo: &nbsp;&nbsp;\n";
			if ($batchnum>1)
			echo '<a href=phone_list.php'.URL_APPEND.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum-1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red ><img src="../../gui/img/common/default/l-arrowgrnlrg.gif" border=0></font></a> - ';
			for($i=1;$i<=$pagecount;$i++)
			{ 	
				if ($i==$batchnum) echo "<b><font color=red >".$i."</font> - </b>"; else echo ' <a href=phone_list.php'.URL_APPEND.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.$i.'&displaysize='.$displaysize.'&edit='.$edit.'>'.$i.'</a> - ';
			}
	
			if ($batchnum<$pagecount)	echo '<a href=phone_list.php'.URL_APPEND.'&pagecount='.$pagecount.'&linecount='.$linecount.'&batchnum='.($batchnum+1).'&displaysize='.$displaysize.'&edit='.$edit.'><font color=red ><img src="../../gui/img/common/default/bul_arrowgrnlrg.gif" border=0></font></a>';
			echo "</FONT>\n";
		
		 }

		//echo "<p>$LDMaxItem: ".($linecount)."</font>\n";
		echo "<p><FORM method=post action=phone_list.php>
				
				<input type=hidden name=route value=validroute>
				<input type=hidden name=remark value=fromlist>
				<input type=hidden name=sid value=\"$sid\">
				<input type=hidden name=lang value=\"$lang\">
				<input type=hidden name=edit value=\"$edit\">
    				<input type=text name=displaysize value=".$displaysize." size=2> $LDRows ";
					
		echo '<INPUT type="image" src="../../gui/img/common/default/bul_arrowgrnlrg.gif"></font></FORM>';		
     
		//echo "<INPUT type=submit  value=\"$LDShow\".></font></FORM>";		
}// end of if(rows)
?>

<?php if ($edit) : ?>
<p>
<FORM method="post" action="phone_edit.php" >
<input type="hidden" name="remark" value="fromlist">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<INPUT type="submit"  value="<?php echo $LDNewPhoneEntry ?>"></font></FORM>
<p>
<?php else : ?>
<p>
<a href="<?php echo $sBreakUrl; ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0'); ?>></a>

<?php endif; ?>

</td>
<td  class="passborder">&nbsp;</td>
</tr>
<tr >
<td  class="passborder" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
 ?>
</BODY>
</HTML>
