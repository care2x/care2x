<?php if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$$ck_sid_buffer)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require_once($root_path.'include/core/inc_config_color.php'); // load color preferences

$thisfile="nursing-station-patientdaten-rootinfo.php";
$breakfile="nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn";

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok)
	{	
		// get orig data
		$dbtable='care_admission_patient';
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
		if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $result=$ergebnis->FetchRow()) $rows++;
				if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$result=$ergebnis->FetchRow();
					}
				}
			else {echo "<p>$sql$LDDbNoRead";exit;}
		
		
		if($mode=='save')
		{
			if((($dateput)&&($timeput)&&($berichtput)&&($author))||(($dateput2)&&($berichtput2)&&($author2)))
			{
				$report="d=$dateput&t=$timeput&b=$berichtput&a=$author&w=$warn\r\n";
				$report=strtr($report," ","+");
				$np_report="d=$dateput2&t=$timeput2&b=$berichtput2&a=$author2&w=$warn2\r\n";
				$np_report=strtr($np_report," ","+");
				if((!$dateput)&&($dateput2)) $dateput=$dateput2;
				
				// check if entry is already existing
				$dbtable="nursing_station_patients_root";
				$sql="SELECT report,np_report FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=$db->Execute($sql))
       			{
					$rows=0;
					if( $content=$ergebnis->FetchRow()) $rows++;
					if($rows==1)
						{
							mysql_data_seek($ergebnis,0);
							$content=$ergebnis->FetchRow();
							$report=$content[report]."_".$report;
							$np_report=$content[np_report]."_".$np_report;
							
							$sql="UPDATE $dbtable SET report='$report', np_report='$np_report',le_date='$dateput'
									WHERE patnum='$pn'";
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql;
									
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station");
								}
								else {echo "<p>$sql$LDDbNoUpdate";exit;}
						} // else create new entry
						else
						{
							$sql="INSERT INTO $dbtable 
										(
										patnum,
										lastname,
										firstname,
										bday,
										fe_date,
										le_date,
										report,
										np_report
										)
									 	VALUES
										(
										'$pn',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'$dateput',
										'$dateput',
										'$report',
										'$np_report'
										)";

							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql;
									
									header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station");
								}
								else {echo "<p>$sql$LDDbNoSave";exit;}
						}
				}
				else {echo "<p>$sql$LDDbNoRead";exit;}
			}
			else $saved=0;
		}// end of if(mode==save)
		
		$dbtable='care_nursing_station_patients_report';
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
		if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $content=$ergebnis->FetchRow()) $rows++;
				if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$content=$ergebnis->FetchRow();
						//echo $sql;
						//echo $content[report];
					}
				}
			else{echo "<p>$sql$LDDbNoRead";exit;}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');

?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
  var focusflag=0;
  var formsaved=0;
  
function pruf(d){
	if(((d.dateput.value)&&(d.timeput.value)&&(d.berichtput.value)&&(d.author.value))||((d.dateput2.value)&&(d.berichtput2.value)&&(d.author2.value))) return true;
	else 
	{
		alert("Es fehlen noch Angaben!");
		return false;
	}
}

function submitform(){
	document.forms[0].submit();
	}

function closewindow(){
	opener.window.focus();
	window.close();
	}

function resetinput(){
	document.berichtform.reset();
/*
	var elemlen=document.berichtform.elements.length;
	for (var i=0;i<elemlen;i++){ document.berichtform.elements[i].value="";}
	document.berichtform.elements[focusflag].focus();
	*/
	}

function select_this(formtag){
		document.berichtform.elements[formtag].select();
	}
	
function getinfo(patientID){
	urlholder="nursing-station.php?route=validroute&patient=" + patientID + "&user=<?php echo $aufnahme_user.'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}
function sethilite(d){
	d.focus();
	d.value=d.value+"~";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"~~";
	d.focus();
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<script language="javascript" src="../js/setdatetime.js">
</script>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<?php if(($mode=='save')||($saved)) echo ";window.location.href='#bottom';document.berichtform.berichtput.focus()"; ?>"  
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo "$LDRootData $station"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<form name="berichtform" method="get" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<?php
echo '
		<table   cellpadding="0" cellspacing=1 border="0" width=700>';
echo '
		<tr  valign="top">
		<td  bgcolor="#ffffff" ><div class=fva2b_ml10><span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <p><font size=1>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div></td>';
echo '
		<td bgcolor="#ffffff"  class=fva2_ml10><div   class=fva2_ml10><font size=5 color="#0000ff"><b>Stammblatt</b>
		<table border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td class=fva2_ml10>Kontaktperson 1&nbsp;</td>
      <td class=fva2_ml10><input type="text" name="cperson1" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td  class=fva2_ml10>Telefonnummer:</td>
      <td class=fva2_ml10><input type="text" name="cphone1" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td class=fva2_ml10>Kontaktperson 2&nbsp;</td>
      <td class=fva2_ml10><input type="text" name="cperson2" size=25 maxlength=30></td>
    </tr>
    <tr>
      <td class=fva2_ml10>Telefonnummer:</td>
      <td class=fva2_ml10><input type="text" name="cphone2" size=25 maxlength=30></td>
    </tr>
  </table>
  		</div>
		</td></tr>';


?>
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		<b>Grund der Aufnahme</b>
		<input type="text" name="reason" size=60 maxlength=100>
  </div></td>
		</tr>	
		<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="glass" >
		Brille > 		
		<input type="checkbox" name="clens" >
		Kontaktlens >  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="glass_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="fteeth" >
		Zahnprothese > 		
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="fteeth_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		<input type="checkbox" name="hws" >
		HWS > 		
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		 weitere Angaben:
		<input type="text" name="hws_info" size=40 maxlength=60>
		
  </div></td>
</tr>
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		Allergy:
		<input type="text" name="allergy" size=60 maxlength=100>
  </div></td>
		</tr>	
	<tr bgcolor="#ffffff">
		<td colspan=2><div class=fva2_ml10><font color="#000099">
		Medication: 
		<input type="text" name="medx" size=60 maxlength=100>
  </div></td>
		</tr>	
	<tr bgcolor="#ffffff">
		<td ><div class=fva2_ml10><font color="#000099">
		 Datum:
		<input type="text" name="edate" size=15 maxlength=60>
  </div></td>
			<td ><div class=fva2_ml10><font color="#000099">
		Aufgenommen von:
		<input type="text" name="encoder" size=40 maxlength=60>
		
  </div></td>
</tr>

		</table>


<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr><td>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 alt="<?php echo $LDSave ?>">
</td>
<td align=right>
<a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?>  width=156 height=24 alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
</td>
</tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="mode" value="save">

</form>


</FONT>

</ul>

<p>
</td>


</tr>
</table>        
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
<a name="bottom"></a>
</BODY>
</HTML>
