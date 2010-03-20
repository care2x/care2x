<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$globdata="sid=$sid&lang=$lang&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear";

if(($mode=='force_add')&&$containername&&$pcs){
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok){	
	  	$dbtable='care_encounter_op';
		$sql="SELECT container_codedlist FROM $dbtable 
					WHERE dept_nr='$dept_nr'
					AND op_room='$saal'
					AND op_nr='$op_nr'
					AND op_src_date='$pyear$pmonth$pday'
					AND encounter_nr='$enc_nr'";
		if($mat_result=$db->Execute($sql))
       	{
			if($matrows=$mat_result->RecordCount())
			{
				$matlist=$mat_result->FetchRow();
						//$datafound=1;
						//$pdata=$ergebnis->FetchRow();
						//echo $sql."<br>";
						//echo $rows;
			}
					//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
		}
		else { echo "$LDDbNoRead<br>$sql"; } 

		$newmat="b=?$bestellnum&a=?$containernum&n=$containername&i=$industrynum&c=$pcs\r\n";
		
						if(($matrows==1)&&($matlist[0]!=""))
						{
							$matlist[0]=$matlist[0]."~".$newmat;
							$item_idx=substr_count($matlist[0],"~");
						}
						else
						{
							$matlist[0]=$newmat;
							$item_idx=0;
						}
						
						$matlist[0]=strtr($matlist[0]," ","+");
						
						$dbtable='care_encounter_op';
						$sql="UPDATE $dbtable SET container_codedlist='$matlist[0]'
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND encounter_nr='$enc_nr'";
						//echo $sql;
						if($mat_result=$db->Execute($sql))
						{
  							header("location:op-logbuch-container-list.php?$globdata&item_idx=$item_idx&chg=1");
							exit;
						}	else { echo "$LDDbNoSave<br>$sql"; } 
						
						//echo $sql."<br>";
						//echo $rows;
	}
  	else { echo "$LDDbNoLink<br>"; } 
}

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
.v12b{ font-family:verdana,arial; color:#cc0000; font-size:12;}
</style>

<script language="javascript">
<!-- 

function popinfo(b)
{
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_APPEND; ?>&keyword="+b+"&mode=search&cat=pharma";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}

// -->
</script>

<SCRIPT language="JavaScript">
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
</SCRIPT>

</head>
<body leftmargin=0 marginwidth=0>

<form name="plist" action="op-logbuch-container-entry-manual.php" method="post">
<table border=0>
<tr>
<?php
  for($i=0;$i<sizeof($LDContainerElements);$i++)
  echo '
    <td class="v12b"><b>&nbsp;'.$LDContainerElements[$i].'</b></td>';
?>
 <!--    <td class="v12b"><b>&nbsp;Art.Nr.</b></td>
    <td class="v12b"><b>Art.name</b></td>
    <td class="v12b"><b>Generic</b></td>
    <td class="v12b"><b>Zul.Nr.</b></td>
    <td class="v12b"><b>Anzahl</b></td> -->
  </tr>
   <tr>
    <td colspan=5 bgcolor="#0000ff"></td>
  </tr>
  <tr>
    <td><input type="text" name="containernum" size=15 maxlength=20 value="<?php echo $artikelnum ?>"></td>
    <td><input type="text" name="containername" size=25 maxlength=25></td>
    <td>&nbsp;</td>
    <td><input type="text" name="industrynum" size=15 maxlength=20></td>
    <td><input type="text" name="bestellnum" size=15 maxlength=20></td>
    <td><input type="text" name="pcs" size=1 maxlength=3></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="force_add">
<input type="hidden" name="op_nr" value="<?php echo $op_nr ?>">
<input type="hidden" name="enc_nr" value="<?php echo $enc_nr ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="saal" value="<?php echo $saal ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<p>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 align="absmiddle" alt="<?php echo $LDSave ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.plist.reset()" title="<?php echo $LDReset ?>"><img <?php echo createLDImgSrc($root_path,'reset.gif','0','absmiddle') ?>></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="op-logbuch-material-list.php?<?php echo $globdata ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','absmiddle') ?> alt="<?php echo $LDCancel ?>"></a>
</form>


</body>
</html>
