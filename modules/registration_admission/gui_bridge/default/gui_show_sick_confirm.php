<script language="JavaScript">
<!-- Script Begin
function printForm() {
	urlholder="print_sick_confirm.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&get_nr=$get_nr" ?>";
	drgwin_<?php echo $sid ?>=window.open(urlholder,"drgwin_<?php echo $sid ?>","width=600,height=650,menubar=no,resizable=yes,scrollbars=yes");
	//window.drgwin_<?php echo $sid ?>.moveTo(100,100);
}
//  Script End -->
</script>
<?php 
# Prepare some values for the template
if($insurance){
	$TP_enc_insurance_name=$insurance['name']; 
	$TP_enc_insurance_nr=$insurance['insurance_nr']; 
	$TP_enc_insurance_subarea=$insurance['sub_area']; 
}

# Extract the  confirmation record for display
if($get_nr){
	$sickconfirm=$single_obj->FetchRow();
}elseif(is_object($sickconfirm_obj)){
	$sickconfirm=$sickconfirm_obj->FetchRow();
} 

# Take over the dept number
$dept_nr=$sickconfirm['dept_nr'];

$TP_insco_1='AOK';
$TP_insco_2='BKK';
$TP_insco_3='KKH';
$TP_insco_4='TKK';
$TP_insco_5='HKH';
$TP_insco_6='BGG';


$TP_date_birth=formatDate2Local($date_birth,$date_format);
$TP_care_logo=createLogo($root_path,'care_logo.gif','0','right','','nodim','25');
# Signature stamp of the department
$TP_dept_sigstamp=nl2br($sickconfirm['sig_stamp']); 
$TP_width='';
# Logo of the department
$logobuff=$root_path.'uploads/logos_dept/dept_'.$dept_nr.'.'.$sickconfirm['logo_mime_type'];
if(file_exists($logobuff)){
	$TP_dept_logo=$logobuff; 
	# Check the logo dimensions
	$logosize=GetImageSize($logobuff);
	# If height > $logo_ht_limit, use limit
	if($logosize[1]>$logo_ht_limit) $TP_height='height='.$logo_ht_limit;
		else $TP_height='height='.$logosize[1];
}else{
	$TP_dept_logo=$root_path.'gui/img/common/default/pixel.gif'; # Else output a transparent pixel
}

$TP_date_end=formatDate2Local($sickconfirm['date_end'],$date_format);
$TP_date_start=formatDate2Local($sickconfirm['date_start'],$date_format);
$TP_date_confirm=formatDate2Local($sickconfirm['date_confirm'],$date_format);

$TP_href_des='';
$TP_href_dss='';
$TP_href_dcs='';
$TP_href_end='';
$TP_img_calendar='';
$TP_date_format='';


$TP_diagnosis=nl2br($sickconfirm['diagnosis']);

# Get the address of the hospital from the global config table
$glob_obj->getConfig('main_info_address');
$TP_main_address=nl2br($GLOBAL_CONFIG['main_info_address']);

# Load the template
$TP_sickform=&$TP_obj->load('registration_admission/tp_show_sick_confirm.htm');
# Show the print button
echo '<a href="javascript:printForm(\''.$sickconfirm['nr'].'\')"><img '.createLDImgSrc($root_path,'printout.gif','0').'></a>';
# Output template
eval("echo $TP_sickform;");

# If more than 1 record available, list the remaining
if($rows>1){

	# Initialize template variable for the next templates
	$TP_tb_header='';
	$TP_tb_row='';

	$toggle=false;
	# List the remaining confirmation records if any
	
	while($other_row=$sickconfirm_obj->FetchRow()){
	
		if($toggle) $TP_bgcolor='#fdfdfd';
			else $TP_bgcolor='#ffffff';
		$toggle=!$toggle;
		
		if($other_row['nr']==$get_nr) continue;
		# If still empty, load and show the table header row.
		if($TP_tb_header==''){
			$TP_tb_header=$TP_obj->load('registration_admission/tp_show_sick_confirm_tb_header.htm');
			eval("echo $TP_tb_header;");
		}
		# Prepare the confim date & diagnosis and href url and dept name
		$TP_date_confirm=formatDate2Local($other_row['date_confirm'],$date_format);
		$TP_diagnosis=nl2br($other_row['diagnosis']);
		$TP_href=$thisfile.URL_APPEND.'&get_nr='.$other_row['nr'].'&dept_nr='.$dept_nr;
		if(isset($$other_row['LD_var'])&&!empty($$other_row['LD_var'])) $TP_dept_name=$$other_row['LD_var'];
			else $TP_dept_name=$other_row['name_formal'];
		# Load  item row template if still empty
		if($TP_tb_row==''){
			$TP_tb_row=$TP_obj->load('registration_admission/tp_show_sick_confirm_tb_row.htm');
		}
		eval("echo $TP_tb_row;");
	}
	echo '</table>';
}

if(!$is_discharged){
?>

<p>
<form method="post" name="newform" action="<?php echo $thisfile; ?>">
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<?php echo $LDCreateNewForm; ?>
	<select name="dept_nr">
	<option value=""></option>
	<?php
		while(list($x,$v)=each($dept_med)){
			echo '<option value="'.$v['nr'].'" ';
			if($v['nr']==$dept_nr) echo 'selected';
			echo '>';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>
			';
		}
	?>
	</select>
	<input type="hidden" name="sid" value="<?php echo $sid; ?>">
	<input type="hidden" name="lang" value="<?php echo $lang; ?>">
	<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
	<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
	<input type="hidden" name="mode" value="new">
	<input type="hidden" name="target" value="<?php echo $target; ?>">
<!-- <input type="submit" <?php echo createLDImgSrc($root_path,'ok.gif','0','absmiddle'); ?> >            
 -->
	<input type="submit"  value="go"> 
</form>
<?php
}
?>
