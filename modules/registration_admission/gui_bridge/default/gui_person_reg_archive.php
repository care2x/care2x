<?php

require('./gui_bridge/default/gui_std_tags.php');

function createTR($input_name, $ld_text, $input_val, $colspan = 2, $input_size = 35)
{

?>

<tr>
<td class="reg_item"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> class="reg_input"><input name="<?php echo $input_name; ?>" type="text" size="<?php echo $input_size; ?>" value="<?php if(isset($input_val)) echo $input_val; ?>">
</td>
</tr>

<?php
}

# Start buffering

ob_start();

?>

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

$sTemp = ob_get_contents();

$smarty->append('JavaScript',$sTemp);

# Empty the buffer variable
$sTemp = '';

/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patreg.php');

if(isset($mode)&&($mode=='search'||$mode=='paginate')){

  //  if(defined('SHOW_SEARCH_QUERY')&&SHOW_SEARCH_QUERY) echo $LDSearchKeyword.': '.$s2;
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td class="prompt">
	<b>
	<?php if($rows) echo str_replace("~nr~",$totalcount,$LDFoundData).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.'; else echo str_replace('~nr~','0',$LDSearchFound); ?></b></td>
  </tr>
</table>

<?php
}
?>

<?php

if(isset($rows) && $rows) {

 ?>

<table border=0 cellpadding=0 cellspacing=0>
  <tr class="reg_list_titlebar">
      <td><b>
	  <?php
	  	if($oitem=='sex') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDSex,'sex',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='name_last') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDLastName,'name_last',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='name_first') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDFirstName,'name_first',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='date_birth') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDBday,'date_birth',$odir,$flag); 
			 ?></b></td>
      <td align='center'><b>
	  <?php 
	  	if($oitem=='addr_zip') $flag=TRUE;
			else $flag=FALSE;
		 echo $pagen->SortLink($LDZipCode,'addr_zip',$odir,$flag); 
		 	
		?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='pid') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDRegistryNr,'pid',$odir,$flag); 
			 ?></b></td>
      <td><b>
	  <?php 
	  	if($oitem=='date_reg') $flag=TRUE;
			else $flag=FALSE; 
		echo $pagen->SortLink($LDRegDate,'date_reg',$odir,$flag); 
			 ?></b></td>
  </tr>
<?php 
# Load common icons
$img_arrow=createComIcon($root_path,'r_arrowgrnsm.gif','0');
$img_male=createComIcon($root_path,'spm.gif','0');
$img_female=createComIcon($root_path,'spf.gif','0');
 
 $toggle=0;
 while($result=$ergebnis->FetchRow()){
	if($result['status']==''||$result['status']=='normal'){
	
 	echo'
  <tr ';
  if($toggle){
  	//echo "bgcolor=#efefef"; 
	echo 'class="wardlistrow2"';
	$toggle=0;
	} else {
	//echo "bgcolor=#ffffff";
	echo 'class="wardlistrow1"';
	$toggle=1;
	}
  $buf='patient_register_show.php'.URL_APPEND.'&origin=archive&pid='.$result['pid'].'&target=archiv';
  echo '>
    <td>&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">';

	switch($result['sex']){
		case 'f': echo '<img '.$img_female.'>'; break;
		case 'm': echo '<img '.$img_male.'>'; break;
		default: echo '&nbsp;'; break;
	}

	echo '</a></td>
    <td>&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_last'].'</a></td>
    <td>&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$result['name_first'].'</a>';
	
	# If person is dead show a black cross
	if($result['death_date']&&$result['death_date']!=$dbf_nodate) echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0','absmiddle').'>';
	
	echo '</td>
    <td>&nbsp; &nbsp;'.@formatDate2Local($result['date_birth'],$date_format).'</td>
    <td align=right>&nbsp; &nbsp;'.$result['addr_zip'].'</td>
    <td align=right>&nbsp; &nbsp;'.$result['pid'].'</td>
    <td align=right>&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.@formatDate2Local($result['date_reg'],$date_format).'</a></td>
  </tr>
  <tr>
  <td colspan=8 height=1 class="thinrow_vspacer"><img src="../../gui/img/common/default/pixel.gif" border=0 width=1 height=1></td>
  </tr>';

	} 
 }
 
		echo '
			<tr><td colspan=6>'.$pagen->makePrevLink($LDPrevious).'</td>
			<td align=right>'.$pagen->makeNextLink($LDNext).'</td>
			</tr>';
 ?>
</table>
<p>

<form method="post"  action="patient_register_archive.php" >
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="?">
<input type="submit" value="<?php echo $LDAdvancedSearch ?>" >
                             </form>

<?php 
}
else
{
?>

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform">

<table border=0 cellspacing=0 cellpadding=0>

<?php
if(!isset($pid)) $pid='';
createTR('pid', $LDAdmitNr,$pid);
if(!isset($user_id)) $user_id='';
createTR( 'user_id', $LDRegBy,$user_id);
?>

<tr>
<td class="reg_item"><?php echo $LDRegDate ?>:
</td>
<td class="reg_input">
 <?php
 //gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();


if(!empty($date_start))
	echo $calendar->show_calendar($calendar,$date_format,'date_start',$date_start);
else 
	echo $calendar->show_calendar($calendar,$date_format,'date_start');
//end : gjergji
?>
</td>
<td class="reg_input"><nobr><?php echo $LDTo ?>: 
<?php
//gjergji : new calendar
if(!empty($date_end))
	echo $calendar->show_calendar($calendar,$date_format,'date_end',$date_end);
else 
	echo $calendar->show_calendar($calendar,$date_format,'date_end');
//end : gjergji
?>
</nobr></td>
</tr>


<?php
if(!isset($name_last)) $name_last='';
if(!isset($name_first)) $name_first='';
createTR('name_last', $LDLastName,$name_last);
createTR( 'name_first', $LDFirstName,$name_first);

if (!$GLOBAL_CONFIG['person_name_2_hide'])
{
if(!isset($name_2)) $name_2='';
createTR('name_2', $LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide'])
{
if(!isset($name_3)) $name_3='';
createTR('name_3', $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide'])
{
if(!isset($name_middle)) $name_middle='';
createTR('name_middle', $LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide'])
{
if(!isset($name_maiden)) $name_maiden='';
createTR('name_maiden', $LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide'])
{
if(!isset($name_others)) $name_others='';
createTR('name_others', $LDNameOthers,$name_others);
}

if(!isset($date_birth)) $date_birth='';
if(!isset($addr_str)) $addr_str='';
if(!isset($addr_str_nr)) $addr_str_nr='';
if(!isset($addr_zip)) $addr_zip='';
if(!isset($addr_city_town)) $addr_city_town='';
?>

<tr>
<td class="reg_item"><?php echo $LDBday ?>:
</td>
<td class="reg_input">
 <?php
//gjergji : new calendar
if(!empty($date_birth))
	echo $calendar->show_calendar($calendar,$date_format,'date_birth',$date_birth);
else 
	echo $calendar->show_calendar($calendar,$date_format,'date_birth');
//end : gjergji
?>
</td>
<td colspan=2 class="reg_input"><?php echo $LDSex ?>: <input name="sex" type="radio" value="m"><?php echo $LDMale ?>&nbsp;&nbsp;
<input name="sex" type="radio" value="f"><?php echo $LDFemale ?>
</td>
</tr>

<tr>
<td class="reg_item"><?php echo $LDCivilStatus ?>:
</td>
<td colspan=2 class="reg_input"> <input name="civil_status" type="radio" value="single"><?php echo $LDSingle ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="married"><?php echo $LDMarried ?>
 <input name="civil_status" type="radio" value="divorced"><?php echo $LDDivorced ?>&nbsp;&nbsp;
<input name="civil_status" type="radio" value="widowed"><?php echo $LDWidowed ?>
 <input name="civil_status" type="radio" value="separated"><?php echo $LDSeparated ?>&nbsp;&nbsp;
</td>
</tr>
 
 <tr>
<td colspan=3><?php echo $LDAddress ?>:
</td>

</tr>

<tr>
<td class="reg_item"><?php echo $LDStreet ?>:
</td>
<td class="reg_input"><input name="addr_str" type="text" size="35" value="<?php if(isset($addr_str)) echo $addr_str; ?>">
</td>
<td class="reg_input">&nbsp;&nbsp;&nbsp;<?php if (isset($errorstreetnr) && $errorstreetnr) echo "<font color=red>"; ?><?php echo $LDStreetNr ?>:<input name="addr_str_nr" type="text" size="10" value="<?php echo $addr_str_nr; ?>">
</td>
</tr>

<tr>
<td class="reg_item"><?php echo $LDTownCity ?>:
</td>
<td class="reg_input"><input name="addr_citytown_name" type="text" size="35" value="<?php if(isset($addr_citytown_name)) echo $addr_citytown_name; ?>">
<a href="javascript:popSearchWin('citytown','aufnahmeform.addr_citytown_nr','aufnahmeform.addr_citytown_name')"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a>
</td>
<td class="reg_input">&nbsp;&nbsp;&nbsp;<?php if (isset($errorzip) && $errorzip) echo "<font color=red>"; ?><?php echo $LDZipCode ?>:<input name="addr_zip" type="text" size="10" value="<?php echo $addr_zip; ?>">
</td>
</tr>

<?php

if (!$GLOBAL_CONFIG['person_phone_1_nr_hide'])
{
if(!isset($phone_1_nr)) $phone_1_nr='';
createTR('phone_1_nr', $LDPhone.' 1',$phone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_phone_2_nr_hide'])
{
if(!isset($phone_2_nr)) $phone_2_nr='';
createTR('phone_2_nr', $LDPhone.' 2',$phone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide'])
{
if(!isset($cellphone_1_nr)) $cellphone_1_nr='';
createTR('cellphone_1_nr', $LDCellPhone.' 1',$cellphone_1_nr,2);
}

if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide'])
{
if(!isset($cellphone_2_nr)) $cellphone_2_nr='';
createTR('cellphone_2_nr', $LDCellPhone.' 2',$cellphone_2_nr,2);
}

if (!$GLOBAL_CONFIG['person_fax_hide'])
{
if(!isset($fax)) $fax='';
createTR('fax', $LDFax,$fax,2);
}

if (!$GLOBAL_CONFIG['person_email_hide'])
{
if(!isset($email)) $email='';
createTR('email', $LDEmail,$email,2);
}

if (!$GLOBAL_CONFIG['person_citizenship_hide'])
{
if(!isset($citizenship)) $citizenship='';
createTR('citizenship', $LDCitizenship,$citizenship,2);
}

if (!$GLOBAL_CONFIG['person_sss_nr_hide'])
{
if(!isset($sss_nr)) $sss_nr='';
createTR('sss_nr', $LDSSSNr,$sss_nr,2);
}

if (!$GLOBAL_CONFIG['person_nat_id_nr_hide'])
{
if(!isset($nat_id_nr)) $nat_id_nr='';
createTR('nat_id_nr', $LDNatIdNr,$nat_id_nr,2);
}

if (!$GLOBAL_CONFIG['person_religion_hide'])
{
if(!isset($religion)) $religion='';
createTR('religion', $LDReligion,$religion,2);
}

if (!$GLOBAL_CONFIG['person_ethnic_orig_hide'])
{
if(!isset($ethnic_orig)) $ethnic_orig='';
createTR('ethnic_orig', $LDEthnicOrigin,$ethnic_orig,2);
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

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->assign('sMainDataBlock',$sTemp);

$smarty->assign('sMainBlockIncludeFile','registration_admission/reg_plain.tpl');

# Show mainframe

$smarty->display('common/mainframe.tpl');
?>

<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDPatientRegister ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>

 --><p>
<a href="<?php	echo 'patient.php'.URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>


