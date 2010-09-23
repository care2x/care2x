<?php
# Prepare title

$sTitle="$LDPersonnelManagement :: $LDNewEmployee ";
if($full_nr) $sTitle=$sTitle.$full_pnr;

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('employee_how2new.php','$personell_nr','$pid')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

# Colllect javascript code

ob_start();
?>

<script  language="javascript">
<!--
function chkForm(d){
	if(d.job_function_title.value==""){
		alert("<?php echo $LDPlsEnterJobFunction ?>");
		d.job_function_title.focus();
		return false;
	}else if(d.date_join.value==""){
		alert("<?php echo "$LDDateJoin\\n$LDPlsEnterDate" ?>");
		d.date_join.focus();
		return false;
	}else if(d.contract_start.value==""){
		alert("<?php echo "$LDContractStart\\n$LDPlsEnterDate" ?>");
		d.contract_start.focus();
		return false;
	}else if(d.encoder.value==""){
		alert("<?php echo $LDPlsEnterFullName ?>");
		d.encoder.focus();
		return false;
	}else{
		return true;
	}
}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php
if(!$personell_nr && !$pid)
{
?>
onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();" 
<?php
}

?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<!-- Load tabs -->
<?php

$target='personell_reg';
include('./gui_bridge/default/gui_tabs_personell_reg.php') 

?>

<tr>
<td colspan=3>

<ul>

<?php 

# If the origin is admission link, show the search prompt
if(!$pid&&!$personell_nr){
	ob_start();
?>
		<table border=0>
			<tr>
				<td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
				<td class="prompt"><?php echo $LDPlsFindPersonFirst ?></td>
				<td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
			</tr>
		</table>
<?php
		$sPretext=ob_get_contents();
	ob_end_clean();

	$user_origin='admit';
	
	require_once($root_path.'include/care_api_classes/class_gui_search_person.php');
	$psearch = & new GuiSearchPerson;

	$psearch->setSearchFile('personell_register_search.php');

	$psearch->setTargetFile('person_register_show.php');

	$psearch->setCancelFile($root_path.'main/spediens.php');

	# Set to TRUE if you want to auto display a single result
	//$psearch->auto_show_byalphanumeric =TRUE;
	# Set to TRUE if you want to auto display a single result based on a numeric keyword
	# usually in the case of barcode scanner data
	$psearch->auto_show_bynumeric = TRUE;

	$psearch->setPrompt($LDEnterPersonSearchKey);

	$psearch->pretext=$sPretext;

	$psearch->display();

}else{

?>

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform" onSubmit="return chkForm(this)">

<table border="0" cellspacing=1 cellpadding=0 width=450>

<?php 

if($error) 
{

?>
<tr>
<td colspan=4><center>
<font class="warnprompt">
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php echo $LDDataNoSaved; ?>
</center>
</td>
</tr>
<?php
}
 ?>


<tr>
<td  class="adm_item"><?php echo $LDPersonellNr ?>:
</td>
<td class="adm_input">
<?php echo $full_pnr;  ?>
</td>
<td rowspan=8 align="center" class="photo_id"><img <?php echo $img_source ?>>
</td>
</tr>

<tr>
<td  class="adm_item">&nbsp;<?php //echo $LDDateJoin ?>
</td>
<td class="adm_input"><FONT color="#800000">&nbsp;
<?php 
    // if($date_join!='0000-00-00') echo @formatDate2Local($date_join,$date_format); 
?>
</td>
</tr>

<tr>
<td class="adm_item">&nbsp;<?php// echo $LDDateExit ?>
</td>
<td class="adm_input"><FONT color="#800000">&nbsp;<?php //if($date_exit!='0000-00-00') echo @formatDate2Local($date_exit,$date_format);  ?>
</td>
</tr>

<tr>
<td class="adm_item"><?php echo $LDTitle ?>:
</td>
<td class="adm_input"><?php echo $title ?>
</td>

</tr>
<tr>
<td class="adm_item"><?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee">&nbsp;<FONT color="#800000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td class="adm_item"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee">&nbsp;<FONT color="#800000"><b><?php echo $name_first; ?></b>
</td>
</tr>

<?php if($GLOBAL_CONFIG['patient_name_2_show'])
{
?>
<tr>
<td class="adm_item"><?php echo $LDName2 ?>:
</td>
<td bgcolor="#ffffee" colspan=2>&nbsp;<FONT color="#800000"><b><?php echo $name_2; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_3_show'])
{
?>
<tr>
<td class="adm_item"><?php echo $LDName3 ?>:
</td>
<td bgcolor="#ffffee" colspan=2>&nbsp;<FONT color="#800000"><b><?php echo $name_3; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_middle_show'])
{
?>
<tr>
<td class="adm_item"><?php echo $LDNameMid ?>:
</td>
<td bgcolor="#ffffee" colspan=2>&nbsp;<FONT color="#800000"><b><?php echo $name_middle; ?></b>
</td>
</tr>
<?php
}
?>

<tr>
<td class="adm_item"><?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee">&nbsp;<FONT color="#800000"><b><?php echo @formatDate2Local($date_birth,$date_format);?></b>
</td>

</tr>

<tr>
<td class="adm_item">&nbsp;<?php echo $LDSex ?>
</td>
<td bgcolor="#ffffee">&nbsp;<FONT color="#800000"><?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?>
</td>
</tr>

<tr>
<td class="adm_item"><?php echo $LDShortID; ?>:
</td>
<td colspan=2 class="adm_input"><input name="short_id" type="text" size="30"  maxlength="10" value="<?php echo $short_id; ?>" >
</td>
</tr>

<!--
<tr>
<td class="adm_item"><?php //echo $LDJobNr; ?>:
</td>
<td colspan=2 class="adm_input"><input name="job_type_nr" type="text" size="30" maxlength="3" value="<?php if($job_type_nr) echo $job_type_nr; ?>" >
</td>
</tr>
-->

<tr>
<td class="adm_item"><?php echo $LDJobFunction; ?>:
</td>
<td colspan=2 class="adm_input"><input name="job_function_title" type="text" size="30"  maxlength="60" value="<?php echo $job_function_title; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDDateJoin; ?>:
</td>
<td colspan=2 class="adm_input">
<?php
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'date_join',$date_join);	
//end : gjergji
  ?> 
  </font>
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDDateExit ?>:
</td>
<td colspan=2 class="adm_input">
<?php
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'date_exit',$date_exit);	
//end : gjergji
  ?>  
  </font>
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDContractClass ?>:
</td>
<td colspan=2 class="adm_input"><input name="contract_class" type="text" size="30" maxlength="35" value="<?php if($contract_class) echo $contract_class; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDContractStart ?>:
</td>
<td colspan=2 class="adm_input">
<?php
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'contract_start',$contract_start);	
//end : gjergji
?>  
</font>
 </td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDContractEnd ?>:
</td>
<td colspan=2 class="adm_input">
<?php
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'contract_end',$contract_end);	
//end : gjergji
?>  
</font></td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDPayClass ?>:
</td>
<td colspan=2 class="adm_input"><input name="pay_class" type="text" size="30" maxlength="25" value="<?php echo $pay_class; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDPaySubClass ?>:
</td>
<td colspan=2 class="adm_input"><input name="pay_class_sub" type="text" size="30" maxlength="25" value="<?php echo $pay_class_sub; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDLocalPremiumID ?>:
</td>
<td colspan=2 class="adm_input"><input name="local_premium_id" type="text" size="30" maxlength="5" value="<?php echo $local_premium_id; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDTaxAccountNr ?>:
</td>
<td colspan=2 class="adm_input"><input name="tax_account_nr" type="text" size="30" maxlength="60" value="<?php echo $tax_account_nr; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDInternalRevenueCode ?>:
</td>
<td colspan=2 class="adm_input"><input name="ir_code" type="text" size="30" maxlength="25" value="<?php echo $ir_code; ?>" >
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDNrWorkDay ?>:
</td>
<td colspan=2 class="adm_input">
<select name="nr_workday">
	<?php 
		for($x=1; $x<8;$x++){
			echo "<option value=\"$x\" ";
			if($nr_workday==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_workday" type="text" size="30" value="<?php // if($nr_workday) echo $nr_workday; ?>" > -->
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDNrWeekHour ?>:
</td>
<td colspan=2 class="adm_input">
<select name="nr_weekhour">
	<?php 
		for($x=0; $x<61;$x++){
			echo "<option value=\"$x\" ";
			if($nr_weekhour==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_weekhour" type="text" size="30" value="<?php //if($nr_weekhour>0) echo $nr_weekhour; ?>" > -->
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDNrVacationDay ?>:
</td>
<td colspan=2 class="adm_input">
<select name="nr_vacation_day">
	<?php 
		for($x=0; $x<60;$x++){
			echo "<option value=\"$x\" ";
			if($nr_vacation_day==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_vacation_day" type="text" size="30" value="<?php // if($nr_vacation_day) echo $nr_vacation_day; ?>" > -->
</td>
</tr>
<tr>
<td class="adm_item"><?php echo $LDNrDependent ?>:
</td>
<td colspan=2 class="adm_input">
<select name="nr_dependent">
	<?php 
		for($x=0; $x<20;$x++){
			echo "<option value=\"$x\" ";
			if($nr_dependent==$x) echo 'selected';
			echo "> $x </option>";
		}
	?>
</select>

<!-- <input name="nr_dependent" type="text" size="30" value="<?php //if($nr_dependent) echo $nr_dependent; ?>" > -->
</td>
</tr>

<tr>
<td class="adm_item"><?php echo $LDMultipleEmployer ?>:
</td>
<td colspan=2 class="adm_input">

<input name="multiple_employer" type="radio"  value="1"  <?php  if($multiple_employer) echo 'checked'; ?>><?php  echo $LDYes; ?>
<input name="multiple_employer" type="radio"  value="0"  <?php  if(!$multiple_employer)  echo 'checked'; ?>><?php  echo $LDNo; ?>

</td>
</tr>

<tr>
<td class="adm_item"><?php echo $LDAdmitBy ?>:
</td>
<td colspan=2 class="adm_input"><input  name="encoder" type="text" value="<?php if ($create_id) echo $create_id; else echo $_SESSION['sess_user_name']; ?>" size="30" >
</nobr>
</td>
</tr>

</table>
<p>
<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">

<?php if($update) echo '<input type="hidden" name=update value=1>'; ?>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSaveData ?>" align="absmiddle"> 
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a>
<!-- Note: uncomment the ff: line if you want to have a reset button  -->
<!-- 
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"   align="absmiddle"></a> 
-->
<?php if($error==1) 
echo '<input type="hidden" name="forcesave" value="1"><input  type="submit" value="'.$LDForceSave.'">';
 ?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type="hidden" name="sid" value=<?php echo $sid; ?>>
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type=submit value="<?php echo $LDNewForm ?>" >
</form>
<?php endif; ?>
<p>

<?php
}  // end of if !isset($pid...
?>
</ul>

<p>
</td>
</tr>
</table>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
