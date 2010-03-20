<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

//$db->debug=1;

$parsedstr=array();
$globdata="sid=$sid&lang=$lang&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear";
// clean the input data
$material_nr=strtr($material_nr,"§%&?/\+*~#';:,!$","                ");// convert chars to (15) spaces
$material_nr=trim($material_nr);
//$material_nr=str_replace(" ","",$material_nr);

	  	$dbtable='care_encounter_op';
		$sql="SELECT material_codedlist FROM $dbtable 
					WHERE dept_nr='$dept_nr'
					AND op_room='$saal'
					AND op_nr='$op_nr'
					AND op_src_date='$pyear$pmonth$pday'
					AND encounter_nr='$enc_nr'";
					
		if($mat_result=$db->Execute($sql))
       	{
			$matrows=$mat_result->RecordCount();
			if($matrows==1)
			{
				$matlist=$mat_result->FetchRow();
						//$datafound=1;
						//$pdata=$ergebnis->FetchRow();
						//echo $sql."<br>";
						//echo $rows;
			}
					//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
		}
		else { echo "$LDDbNoRead<br>"; } 

		switch($mode)	
		{
		case 'search':
	  		$dbtable="care_pharma_products_main";
			
			
			if(!empty($material_nr))
			{
				if(is_numeric($material_nr)) 
				{
					$material_nr=(int) $material_nr; 
		 			$sql="SELECT bestellnum,artikelnum,artikelname,industrynum,generic,description FROM $dbtable WHERE bestellnum=$material_nr";
					$nonumeric=0;
				}
				else
				{ 
					if(strlen($material_nr)>3) $material_nr="%".$material_nr;
		 			$sql="SELECT bestellnum,artikelnum,artikelname,industrynum,generic,description FROM $dbtable 
							WHERE artikelnum $sql_LIKE '$material_nr%'
							OR bestellnum  $sql_LIKE '$material_nr%'
							OR artikelname  $sql_LIKE '$material_nr%'
							OR generic  $sql_LIKE '$material_nr%'
							OR description  $sql_LIKE '$material_nr%'
							OR industrynum  $sql_LIKE '$material_nr%'
							";
					$nonumeric=1;
				}
			}
			else break;
			
			//echo $sql."<br>";
			
				if($ergebnis=$db->Execute($sql))
       			{
					$art_avail=0;
					//while( $pdata=$ergebnis->FetchRow()) $art_avail++;
					//if($art_avail)	$ergebnis->Move(); //reset the variable
					$art_avail = $ergebnis->RecordCount();
						//$datafound=1;
					if(($art_avail==1)&&(!$nonumeric))
					{
						$pdata=$ergebnis->FetchRow();
						//if($nonumeric) $material_nr=$pdata[artikelnum];
						if(($matrows==1)&&($matlist[0]!=""))
						{
							$matbuf=explode("~",$matlist[0]);
							for($i=0;$i<sizeof($matbuf);$i++)
							{
								reset($parsedstr);
								parse_str(trim($matbuf[$i]),$parsedstr);
								if((int)$parsedstr[b]==$material_nr)
								{
									 $parsedstr[c]=$parsedstr[c]+1;
									 $matbuf[$i]="b=$parsedstr[b]&a=".$parsedstr['a']."&n=$parsedstr[n]&g=$parsedstr[g]&i=$parsedstr[i]&c=$parsedstr[c]\r\n";
									 $item_idx=$i;
									 //echo $i."found ".$matbuf[$i]."<br>";
									 $listchg=1;
									 break;
								}
							}
							if(!$listchg)
							{
								$matbuf[$i]="b=$pdata[bestellnum]&a=$pdata[artikelnum]&n=$pdata[artikelname]&g=$pdata[generic]&i=$pdata[industrynum]&c=1\r\n";
								$item_idx=$i;
							}
    						$matlist[0]=implode("~",$matbuf);
						}
						else
						{
							$matlist[0]="b=$pdata[bestellnum]&a=$pdata[artikelnum]&n=$pdata[artikelname]&g=$pdata[generic]&i=$pdata[industrynum]&c=1\r\n";
							$item_idx=0;
						}
						
						$matlist[0]=strtr($matlist[0]," ","+");
						
						$dbtable='care_encounter_op';
						$sql="UPDATE $dbtable SET material_codedlist='$matlist[0]'
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND encounter_nr='$enc_nr'";
						
						//echo $sql;

						if($mat_result=$core->Transact($sql))
						{
  							header("location:op-logbuch-material-list.php?$globdata&item_idx=$item_idx&chg=1");
							exit;
						}	else { echo "$LDDbNoSave<br>"; } 
						
						//echo $sql."<br>";
						//echo $rows;
					}
					//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
				}
				else 
				{
					echo "$LDDbNoRead<br>";
				}
				
				break;
				
		case "delete":
			//echo "hello delete".$art_idx;

			$matbuf=explode("~",$matlist[0]);
			array_splice($matbuf,$art_idx,1);
			$matlist[0]=implode("~",$matbuf);
			$sql="UPDATE $dbtable SET 
							material_codedlist='$matlist[0]',
							history = ".$core->ConcatHistory("Material deleted ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							modify_id = '".$_SESSION['sess_user_name']."',
							modify_time = '".date('YmdHis')."'
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND encounter_nr='$enc_nr'";
			//echo $sql;
			if($mat_result=$core->Transact($sql))
			{
				
  				header("location:op-logbuch-material-list.php?$globdata");
				exit;
			}	else { echo "$LDDbNoSave<br>"; } 
			break;
			
		case 'update':
		
			$matbuf=explode("~",$matlist[0]);
			
			for($i=0;$i<sizeof($matbuf);$i++)
				{
					$pcs="pcs".$i;
					reset($parsedstr);
					parse_str(trim($matbuf[$i]),$parsedstr);
					$matbuf[$i]="b=$parsedstr[b]&a=".$parsedstr['a']."&n=$parsedstr[n]&g=$parsedstr[g]&i=$parsedstr[i]&c=".$$pcs."\r\n";
				}
				
			$matlist[0]=implode("~",$matbuf);
			
			$sql="UPDATE $dbtable SET
							material_codedlist='$matlist[0]',
							history = ".$core->ConcatHistory("Material updated ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							modify_id = '".$_SESSION['sess_user_name']."',
							modify_time = '".date('YmdHis')."'
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND encounter_nr='$enc_nr'";
			//echo "update ".$sql;
			
			if($mat_result=$core->Transact($sql))
			{
				
  				header("location:op-logbuch-material-list.php?$globdata");
				exit;
			}	
			else 
			{ echo "$LDDbNosave<br>"; } 
			 
			break;
		} //end of switch($mode

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
.v12b{ font-family:verdana,arial; color:#cc0000; font-size:12;}
.v12g{ font-family:verdana,arial; color:#9f9f9f; font-size:12; }
</style>

<script language="javascript">
<!-- 

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_APPEND; ?>&keyword="+b+"&mode=search&cat=pharma";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}
	
<?php if(empty($material_nr)||($art_avail==1)) : ?>	
function delete_item(x)
{
	window.location.replace('op-logbuch-material-list.php?<?php echo $globdata; ?>&mode=delete&art_idx='+x);
}

// -->
</script>

<SCRIPT language="JavaScript">
<!--
function ssm(menuId){
	if (brwsVer>=4) {
		if (curSubMenu!='') hsm();
		if (document.all) {
			eval('document.all.'+menuId).style.visibility='visible';
		} else {
			eval('document.'+menuId).visibility='show';
		}
		curSubMenu=menuId;
	}
}
function hsm(){
	if(curSubMenu=="") return;
	else
	if (brwsVer>=4) {
		if (document.all) {
			eval('document.all.'+curSubMenu).style.visibility='hidden';
		} else {
			eval('document.'+curSubMenu).visibility='hide';
		}
		curSubMenu='';
	}
}
var brwsVer=parseInt(navigator.appVersion);var timer;var curSubMenu='';
<?php endif ?>
// -->
</SCRIPT>

</head>
<body leftmargin=0 marginwidth=0>


<?php 
if(empty($material_nr)||(($art_avail==1)&&(!$nonumeric))){
	$matbuf=explode("~",trim($matlist[0]));
	$rows=sizeof($matbuf);
	if(($rows==1)&&(trim($matbuf[0])=="")) $rows=0;
	if($rows){
		echo'
<form action="op-logbuch-material-list.php" method="post" name="plist" onReset="hsm()">
<table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>';
  for($i=0;$i<sizeof($LDMaterialElements);$i++)
  echo '
    <td class="v12b"><b>&nbsp;'.$LDMaterialElements[$i].'</b></td>';
	echo '
  </tr>
   <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>
';
		for($i=0;$i<$rows;$i++){
			reset($parsedstr);
			parse_str(trim($matbuf[$i]),$parsedstr);
			if(strstr($parsedstr['a'],"?")) $f_class="v12g"; else $f_class="v12";
			echo'
 			<tr ';
 			if (($chg)&&($i==$item_idx)) echo 'bgcolor="#00cccc"';
 			echo '>
   			<td class="'.$f_class.'">&nbsp;'.$parsedstr[b].'&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;'.$parsedstr[n].'&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;';
			if($f_class=="v12") echo '<a href="javascript:popinfo('.$parsedstr[b].')"><img '.createComIcon($root_path,'info3.gif','0').' alt="'.$LDDbInfo.'"></a>';
				else echo '<a href="#"><img '.createComIcon($root_path,'info3-pale.gif','0').' alt="'.$LDArticleNoList.'" title="'.$LDArticleNoList.'"></a>';
			echo '
			&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;'.$parsedstr[g].'&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;'.$parsedstr[i].'&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;<input type="text" name="pcs'.$i.'" size=1 maxlength=2 value="'.$parsedstr[c].'" onKeyUp="ssm(\'savebut\')">&nbsp;</td>
    		<td class="'.$f_class.'">&nbsp;<a href="javascript:delete_item('.$i.')" title="'.$LDRemoveArticle.'"><img '.createComIcon($root_path,'delete2.gif','0').'></a>&nbsp;</td>
  			</tr>
  			<tr>
    		<td colspan=7 bgcolor="#0000ff"></td>
			</tr>';
	}
  
  	echo '
</table>
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="op_nr" value="'.$op_nr.'">
<input type="hidden" name="enc_nr" value="'.$enc_nr.'">
<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
<input type="hidden" name="saal" value="'.$saal.'">
<input type="hidden" name="pday" value="'.$pday.'">
<input type="hidden" name="pmonth" value="'.$pmonth.'">
<input type="hidden" name="pyear" value="'.$pyear.'">
</form>  

<DIV id=savebut
style=" VISIBILITY: hidden; POSITION: relative;">
<a href="javascript:document.plist.submit()" title="'.$LDSave.'"><img '.createLDImgSrc($root_path,'savedisc.gif','0').'></a>&nbsp;&nbsp;&nbsp;
<a href="javascript:document.plist.reset()" title="'.$LDReset.'"><img '.createLDImgSrc($root_path,'reset.gif','0').'>
</div>';
	}
}else{
	if($art_avail){

		echo '
			<font size=2 face="verdana,arial">
 			<font size=4 color="#009900">
 			<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> <b>'.$LDPlsClkArticle.'</b></font> 
			<br>';
		echo'
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
  			<tr>';
		for($i=0;$i<sizeof($LDSearchElements);$i++)
			echo '
    		<td class="v12b"><b>'.$LDSearchElements[$i].'</b></td>';
		echo '
   			<tr>
    		<td colspan=7 bgcolor="#0000ff"></td>
  			</tr>';
		while($pdata=$ergebnis->FetchRow()){
			echo'
 		<tr bgcolor="#ffffff">
    	<td class="v12" valign="top">&nbsp;<a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[bestellnum].'"><img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle').' alt="'.$LDSelectArticle.'"></a></td>
    	<td class="v12" valign="top">&nbsp;<a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[bestellnum].'" title="'.$LDSelectArticle.'">'.$pdata[artikelnum].'</a>&nbsp;</td>
    	<td class="v12" valign="top"><a href="op-logbuch-material-list.php?'.$globdata.'&mode=search&material_nr='.$pdata[bestellnum].'" title="'.$LDSelectArticle.'">'.$pdata[artikelname].'</a>&nbsp;</td>
    	<td class="v12" valign="top">'.$pdata[description].'&nbsp;</td>
   	 	<td class="v12" valign="top">&nbsp;<a href="javascript:popinfo(\''.$pdata[bestellnum].'\')"><img '.createComIcon($root_path,'info3.gif','0').'></a>&nbsp;</td>
    	<td class="v12" valign="top">&nbsp;'.$pdata[generic].'&nbsp;</td>
    	<td class="v12" valign="top">&nbsp;'.$pdata[industrynum].'&nbsp;</td>
  		</tr>
  		<tr>
    		<td colspan=7 bgcolor="#0000ff"></td>
  		</tr>';
 	 	}
		echo '
	  	</table>';
			
	}else{
 		echo '<center>
 			<font size=2 face="verdana,arial">
 			<font size=4 color="#cc0000">
 			<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> <b>'.$LDArticleNotFound.'</b><p></font> '.$LDNoArticleTxt.'<p>';
			$databuf="$sid&lang=$lang&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear";
		echo '
			<a href="op-logbuch-material-entry-manual.php?sid='.$databuf.'"><img '.createComIcon($root_path,'accessrights.gif','0','absmiddle').'> 
			<font size=3 > '.$LDClk2ManualEntry.'</font></a>
			</font><p>
			<a href="op-logbuch-material-list.php?sid='.$databuf.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').' alt="'.$LDCancel.'">
			</a>
			</center>
			';
	}
}
?>

</body>
</html>
