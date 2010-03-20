<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$globdata="sid=$sid&lang=$lang&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear";

require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

//$db->debug=1;

if(($mode=="force_add") && !empty($artikelname) && !empty($pcs)){
	
	$dbtable='care_encounter_op';
	$sql="SELECT material_codedlist FROM $dbtable
					WHERE dept_nr='$dept_nr'
					AND op_room='$saal'
					AND op_nr='$op_nr'
					AND op_src_date='$pyear$pmonth$pday'
					AND encounter_nr='$enc_nr'";

	if($mat_result=$db->Execute($sql)){
		if($matrows=$mat_result->RecordCount()){
			$matlist=$mat_result->FetchRow();
		}
	}else{
		echo "$LDDbNoRead<br>$sql";
	}

	$newmat="b=?&a=?$artikelnum&n=$artikelname&g=$generic&i=$industrynum&c=$pcs\r\n";

	if(($matrows==1)&&($matlist[0]!="")){
		$matlist[0]=$matlist[0]."~".$newmat;
		$item_idx=substr_count($matlist[0],"~");
	}else{
		$matlist[0]=$newmat;
		$item_idx=0;
	}

	$matlist[0]=strtr($matlist[0]," ","+");
	$dbtable='care_encounter_op';
	$sql="UPDATE $dbtable SET
							material_codedlist='$matlist[0]',
							history = ".$core->ConcatHistory("Material added ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							modify_id = '".$_SESSION['sess_user_name']."',
							modify_time = '".date('YmdHis')."'
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND op_nr='$op_nr'
								AND op_src_date='$pyear$pmonth$pday'
								AND encounter_nr='$enc_nr'";
						//echo $sql;
	if($mat_result=$core->Transact($sql)){
		header("location:op-logbuch-material-list.php?$globdata&item_idx=$item_idx&chg=1");
		exit;
	}else{
		echo "$LDDbNoSave<br>$sql";
	}
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
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php echo $sid; ?>&keyword="+b+"&mode=search&cat=pharma";
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

<form name="plist" action="op-logbuch-material-entry-manual.php" method="post">
<table border=0>
<tr>
<?php
  for($i=0;$i<sizeof($LDMaterialElements);$i++)
  echo '
    <td class="v12b"><b>&nbsp;'.$LDMaterialElements[$i].'</b></td>';
?>
 <!--    <td class="v12b"><b>&nbsp;Art.Nr.</b></td>
    <td class="v12b"><b>Art.name</b></td>
    <td class="v12b"><b>Generic</b></td>
    <td class="v12b"><b>Zul.Nr.</b></td>
    <td class="v12b"><b>Anzahl</b></td> -->
  </tr>
   <tr>
    <td colspan=6 bgcolor="#0000ff"></td>
  </tr>
  <tr>
    <td><input type="text" name="artikelnum" size=15 maxlength=20 value="<?php echo $artikelnum ?>"></td>
    <td><input type="text" name="artikelname" size=15 maxlength=20></td>
    <td>&nbsp;</td>
    <td><input type="text" name="generic" size=15 maxlength=20></td>
    <td><input type="text" name="industrynum" size=15 maxlength=20></td>
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
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>  alt="<?php echo $LDSave ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.plist.reset()" title="<?php echo $LDReset ?>"><img <?php echo createLDImgSrc($root_path,'reset.gif','0','absmiddle') ?>></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="op-logbuch-material-list.php?<?php echo $globdata ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','absmiddle') ?> alt="<?php echo $LDCancel ?>"></a>
</form>


</body>
</html>
