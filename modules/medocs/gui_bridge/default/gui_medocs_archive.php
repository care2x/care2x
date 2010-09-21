<?php

require('./gui_bridge/default/gui_std_tags.php');

function createTR($input_name, $ld_text, $input_val, $colspan = 2, $input_size = 55)
{
	global $root_path;

?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> bgcolor="#eeeeee"><input name="<?php echo $input_name; ?>" type="text" size="<?php echo $input_size; ?>" value="<?php if(isset($input_val)) echo $input_val; ?>">
</td>
</tr>

<?php
}

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>


<script  language="javascript">
<!-- 

function popSearchWin(target,obj_val,obj_name) {
	urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
	DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

-->
</script>
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister.' - '.$LDArchive ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php 
if($_COOKIE["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile."?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_medocs.php');
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<ul>

<FONT    SIZE=-1  FACE="Arial">

<?php

 if(isset($mode) && $mode=='search')
 {
   echo '<FONT  SIZE=2 FACE="verdana,Arial">'.$LDSearchKeyword.': '.$where; 
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><FONT  SIZE=3 FACE="verdana,Arial" color=#800000>
<b><?php if($rows) echo str_replace("~nr~",$rows,$LDFoundData); else echo str_replace("~nr~",$rows,$LDSearchFoundAdmit); ?></b></font></td>
  </tr>
</table>

<?php
}
?>

<?php
// if(isset($rows) && $rows>1) 
 if(!empty($rows)) 
{
 ?>

<table border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor=#0000aa background="<?php echo $root_path; ?>gui/img/common/default/tableHeaderbg.gif">

      <td>&nbsp;</td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;<?php echo $LDLastName; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;<?php echo $LDFirstName; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;<?php echo $LDBirthDate; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;<?php echo $LDAdmitNumber; ?></b></td>
      <td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;<?php echo $LDAdmitDate; ?></b></td>

  <?php
/*for($j=0;$j<sizeof($LDElements);$j++)
		echo '
			<td><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b>&nbsp;&nbsp;'.$LDElements[$j].'</b></td>';
*/	?>
  </tr>
 <?php 
 /* Load common icons*/
 $img_arrow=createComIcon($root_path,'r_arrowgrnsm.gif','0');
 
 $toggle=0;
 while($result=$ergebnis->FetchRow())
 {
 	echo'
  <tr ';
  if($toggle){ echo "bgcolor=#efefef"; $toggle=0;} else {echo "bgcolor=#ffffff"; $toggle=1;}
  $buf='aufnahme_daten_zeigen.php'.URL_APPEND.'&origin=archive&encounter_nr='.$result['encounter_nr'].'&target=archiv';
  echo '>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'"><img '.$img_arrow.'></a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_last'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_first'].'</a></td>
    <td><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.@formatDate2Local($result['date_birth'],$date_format).'</td>';
	if($result['encounter_class_nr']==1) $adder=$GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	if($result['encounter_class_nr']==2) $adder=$GLOBAL_CONFIG['patient_outpatient_nr_adder'];
	echo '
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;'.($result['encounter_nr']+$adder).'</td>
    <td align=right><FONT  SIZE=-1  FACE="Arial">&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.@formatDate2Local($result['encounter_date'],$date_format).'</a></td>
  </tr>
  <tr bgcolor=#0000ff>
  <td colspan=8 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
 ?>
</table>
<p>

<form method="post"  action="aufnahme_list.php" >
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDNewArchive ?>" >
                             </form>

<?php 
}
else
{
?>

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform">

<table border=0 cellspacing=1 cellpadding=0>

<?php
if(!isset($pid)) $pid='';
createTR('encounter_nr', $LDAdmitNr,$encounter_nr);
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>: 
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<input name="date_start" type="text" size=10 maxlength=10    onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
<td bgcolor="#eeeeee"><nobr><FONT SIZE=-1  FACE="Arial"><?php echo $LDTo ?>: <input name="date_end" type="text" size=10 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
[ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</nobr></td>
</tr>


<?php
if(!isset($name_last)) $name_last='';
if(!isset($name_first)) $name_first='';
createTR('name_last', $LDLastName,$name_last);
createTR( 'name_first', $LDFirstName,$name_first);

if ($GLOBAL_CONFIG['patient_name_2_show'])
{
if(!isset($name_2)) $name_2='';
createTR('name_2', $LDName2,$name_2);
}

if ($GLOBAL_CONFIG['patient_name_3_show'])
{
if(!isset($name_3)) $name_3='';
createTR('name_3', $LDName3,$name_3);
}
if ($GLOBAL_CONFIG['patient_name_middle_show'])
{
if(!isset($name_3)) $name_3='';
createTR('name_3', $LDName3,$name_3);
}




if(!isset($date_birth)) $date_birth='';
if(!isset($addr_str)) $addr_str='';
if(!isset($addr_str_nr)) $addr_str_nr='';
if(!isset($addr_zip)) $addr_zip='';
if(!isset($addr_city_town)) $addr_city_town='';
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td bgcolor="#eeeeee" colspan=2><FONT SIZE=-1  FACE="Arial">
<input name="date_birth" type="text" size="15" maxlength=10 value="<?php   echo $date_birth;  ?>"
 onFocus="this.select();"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
 [ <?php   
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
 ?> ]
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>:
</td>

<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <input name="sex" type="radio" value="m" <?php if ($sex=='m') echo 'checked' ?>><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f" <?php if ($sex=='f') echo 'checked' ?>><?php echo $LDFemale ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAdmitClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee" ><FONT SIZE=-1  FACE="Arial">
<?php

while($result=$encounter_classes->FetchRow()) {
?>
<input name="encounter_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>"  <?php if($encounter_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php 
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDWard ?>:
</td>
<td colspan=2 bgcolor="#eeeeee">
<select name="current_ward_nr">
	<option value="">_______________________________________________</option>
<?php 
if(!empty($ward_info) && $ward_info->RecordCount()){
    while($station=$ward_info->FetchRow()){
	    echo '
	    <option value="'.$station['nr'].'" ';
	    if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) echo 'selected';
		echo '>'.$station['name'].'</option>';
    }
}
?>
</select>

</td>
</tr>

<?php
createTR( 'referrer_diagnosis', $LDDiagnosis,$referrer_diagnosis);
createTR( 'referrer_dr', $LDRecBy,$referrer_dr);
createTR( 'referrer_recom_therapy', $LDTherapy,$referrer_recom_therapy);
createTR( 'referrer_notes', $LDSpecials,$referrer_notes);
?>


<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if ($errorkassetype) echo "<font color=red>"; ?><?php echo $LDBillType ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php
if($insurance_classes){
    while($result=$insurance_classes->FetchRow()) {
?>
<input name="insurance_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>" >
<?php 
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
} 
?>
</td>
</tr>

<?php
createTR( 'insurance_nr', $LDInsuranceNr,$insurance_nr);
createTR( 'insurance_firm_name', $LDInsuranceCo,$insurance_firm_name);
?>

<?php

//if (!$GLOBAL_CONFIG['patient_care_service_hide'] && $care_ok)
if (!$GLOBAL_CONFIG['patient_service_care_hide'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDCareServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><nobr>
<select name="sc_care_class_nr" onFocus="hidecat()">
<option value=""> </option>

<?php
while($buffer=$care_service->FetchRow())
{
   echo '
	<option value="'.$buffer['class_nr'].'">';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
	}
?>
</select>
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_room_hide'] && $room_ok)
if (!$GLOBAL_CONFIG['patient_service_room_hide'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDRoomServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_room_class_nr" onFocus="hidecat()">
<option value="" > </option>
<?php
while($buffer=$room_service->FetchRow())
{
   echo '
	<option value="'.$buffer['class_nr'].'">';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
	}
?>
</select>
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_att_dr_hide'] && $att_dr_ok)
if (!$GLOBAL_CONFIG['patient_service_att_dr_hide'])
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial"><?php echo $LDAttDrServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_att_dr_class_nr" onFocus="hidecat()">
<option value="" > </option>

<?php
while($buffer=$att_dr_service->FetchRow())
{
   echo '
	<option value="'.$buffer['class_nr'].'">';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
	
}
?>
</select>
</td>
</tr>
<?php
}

?>


</table>
<p>
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="addr_citytown_nr">

<input  type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0') ?> alt="<?php echo $LDSaveData ?>" align="absmiddle"> 

</form>

<?php
}
?>






<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDPatientRegister ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>

 --><p>
<a href="
<?php if($_COOKIE['ck_login_logged'.$sid]) echo 'startframe.php';
	else echo 'patient.php';
	echo URL_APPEND;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<hr>
<?php
StdCopyright();
?>
</FONT>
<?php
StdFooter();
?>
