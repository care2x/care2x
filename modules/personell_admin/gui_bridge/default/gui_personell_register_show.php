<?php

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDPersonnelManagement :: $LDPersonellData ($full_pnr)");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('employment_show.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDPersonnelManagement :: $LDPersonellData ($full_pnr)");

# Colllect javascript code

ob_start();

require($root_path.'include/inc_js_barcode_wristband_popwin.php');
require('./include/js_poprecordhistorywindow.inc.php');


$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?> 

<table width=100% border=0 cellspacing=0 cellpadding=0>

<!-- Load tabs -->
<?php

//$target='entry';
include('./gui_bridge/default/gui_tabs_personell_reg.php') 

?>

<tr>
<td colspan=3>

<p><br>

<?php
if(empty($is_discharged)){
	if(!empty($sem)){
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPersonCurrentlyEmployed; ?></b></font></td>
<!--     <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
 -->  </tr>
</table>
<?php
	}
	else{
?>
	&nbsp;&nbsp;<font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPersonCurrentlyEmployed; ?></b></font>
<?php
	}
}
?>

<FONT   >

<table border=0>
  <tr>
    <td>&nbsp;
  </td>

  <td>
	
	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#999999">
   <tr>
     <td>

<table border="0" cellspacing=1 cellpadding=0>
<tr bgcolor="white" >
<td valign="top" class="adm_item">&nbsp;<?php echo $LDPersonellNr ?>:
</td>
<td class="adm_input">
<FONT color="#800000">&nbsp;<b><?php echo $full_pnr; ?></b><br>
<?php #
if(file_exists($root_path.'cache/barcodes/en_'.$full_pnr.'.png')) echo '<img src="'.$root_path.'cache/barcodes/en_'.$full_pnr.'.png" border=0 width=180 height=35>';
  else 
  {

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_pnr."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_pnr."&style=68&type=I25&width=180&height=40&xres=2&font=5' border=0>";
  }
?>
</td>
<td rowspan=8 align="center" class="photo_id"><img <?php echo $img_source; ?> hspace=5></td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;
</td>
<td class="adm_input">&nbsp;
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;
</td>
<td class="adm_input">&nbsp;</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDTitle ?>:
</td>
<td class="adm_input">&nbsp;<?php echo $title ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee"><FONT color="#800000">&nbsp;<b><?php echo $name_last; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT color="#800000">&nbsp;<b><?php echo $name_first; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee"><FONT color="#800000">&nbsp;<b><?php echo formatDate2Local($date_birth,$date_format);?></b>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDSex ?>:
</td>
<td bgcolor="#ffffee"><FONT color="#800000">&nbsp;<b><?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDAddress ?>:
</td>
<td class="adm_input" colspan=2>
<?php 

/* Note: The address is displayed in german format. */
echo $personell_obj->formattedAddress_DE();
/*echo $addr_str.' '.$addr_str_nr.'<br>';
echo $addr_zip.' '.$addr_citytown_name.'<br>';
*/
/*
if ($addr_province) echo $addr_province.'<br>';
if ($addr_region) echo $addr_region.'<br>';
if ($addr_country) echo $addr_country.'<br>';
*/
?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDShortID ?>:
</td>
<td colspan=2   class="adm_input">
<?php echo  $short_id; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDJobFunction ?>:
</td>
<td colspan=2   class="adm_input">
<?php echo  $job_function_title; 
?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDDateJoin ?>: 
</td>
<td colspan=2 class="adm_input">&nbsp;<?php  if($date_join != DBF_NODATE)   echo formatDate2Local($date_join,$date_format); ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDDateExit ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php  if($date_exit && $date_exit != DBF_NODATE) echo formatDate2Local($date_exit,$date_format,1,1); ?></td>
</tr>


<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDContractClass ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($contract_class) echo $contract_class; ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDContractStart ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php  if($contract_start != DBF_NODATE) echo formatDate2Local($contract_start,$date_format,1,1); ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDContractEnd ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php  if($contract_end && $contract_end != DBF_NODATE) echo formatDate2Local($contract_end,$date_format,1,1); ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDPayClass ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php echo $pay_class; ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDPaySubClass ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php echo $pay_class_sub; ?>
</td>
</tr>


<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDLocalPremiumID ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php echo $local_premium_id; ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDTaxAccountNr ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php echo $tax_account_nr; ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDInternalRevenueCode ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php echo $ir_code; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDNrWorkDay ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($nr_workday) echo $nr_workday; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDNrWeekHour ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($nr_weekhour>0) echo $nr_weekhour; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDNrVacationDay ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($nr_vacation_day) echo $nr_vacation_day; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDMultipleEmployer ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($multiple_employer) echo $multiple_employer; ?>
</td>
</tr>
<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDNrDependent ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if($nr_dependent) echo $nr_dependent; ?>
</td>
</tr>

<tr bgcolor="white">
<td class="adm_item">&nbsp;<?php echo $LDRecordedBy ?>:
</td>
<td colspan=2 class="adm_input">&nbsp;<?php if ($create_id) echo $create_id ;  ?> 
</td>
</tr>
</table>
	 
	 </td>
   </tr>
 </table>

	</td>
    <td valign="top">
		<?php include('./gui_bridge/default/gui_options_personell_register_show.php'); ?>
	</td>
  </tr>
</table>
<p>
&nbsp;
<a href="<?php echo $updatefile.URL_APPEND.'&personell_nr='.$personell_nr.'&update=1'; ?>"><img <?php echo createLDImgSrc($root_path,'update_data.gif','0','top') ?>></a>
</td>
</tr>
</table>        
<p>
&nbsp;
<a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

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

