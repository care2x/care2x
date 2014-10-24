<?php
if($rows) $pregnancy=$pregs->FetchRow();
?>

<script language="JavaScript">
<!-- Script Begin
function chkform(d) {
	if(d.delivery_date.value==""){
		alert("<?php echo $LDPlsEnterDeliveryDate; ?>");
		d.delivery_date.focus();
		return false;
	}else if(d.delivery_time.value==""){
		alert("<?php echo $LDPlsEnterDeliveryTime; ?>");
		d.delivery_time.focus();
		return false;
	}else if(isNaN(d.nr_of_fetuses.value)){
		d.bp_diastolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.nr_of_fetuses.focus();
		return false;
	}else if(d.nr_of_fetuses.value<0){
		d.bp_diastolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.nr_of_fetuses.focus();
		return false;
	}else if(isNaN(d.bp_systolic_high.value)){
		d.bp_diastolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.bp_systolic_high.focus();
		return false;
	}else if(d.bp_systolic_high.value<0){
		d.bp_diastolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.bp_systolic_high.focus();
		return false;
	}else if(isNaN(d.bp_diastolic_high.value)){
		d.bp_systolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.bp_diastolic_high.focus();
		return false;
	}else if(d.bp_diastolic_high.value<0){
		d.bp_systolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.bp_diastolic_high.focus();
		return false;
	}else if(isNaN(d.blood_loss.value)){
		d.bp_systolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.blood_loss.focus();
		return false;
	}else if(d.blood_loss.value<0){
		d.bp_systolic_high.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.blood_loss.focus();
		return false;
	}else if(d.docu_by.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.docu_by.focus();
		return false;
	}else{
		return true;
	}
}
//  Script End -->
</script>


<form method="post" name="report" onSubmit="return chkform(this)">
<?php
# Pregnancy nr
$TP_PREG_NR=$LD['this_pregnancy_nr'];
if($pregnancy['this_pregnancy_nr']) $TP_PNR=$pregnancy['this_pregnancy_nr'];
//#154
# Delivery date
//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();

$TP_IMG_PDATE = $calendar->show_calendar($calendar,$date_format,$pregnancy['delivery_date'],$pregnancy['delivery_date']);
//gjergji : end
//end : #154
# Delivery time
if($pregnancy['delivery_time']) $TP_PTIME=$pregnancy['delivery_time'];
# GRavida
$TP_GRAVIDA=$LD['gravida'];
if($pregnancy['gravida']) $TP_GRAV=$pregnancy['gravida'];
# Para
$TP_PARA=$LD['para'];
if($pregnancy['para']) $TP_PARA_VAL=$pregnancy['para'];
# Gestational age
$TP_GEST_AGE=$LD['pregnancy_gestational_age'];
if($pregnancy['pregnancy_gestational_age']) $TP_GAGE=$pregnancy['pregnancy_gestational_age'];
# Nr of fetuses , default = 1
if(!$pregnancy['nr_of_fetuses']) $pregnancy['nr_of_fetuses']=1;
$TP_NR_FETUSES=$LD['nr_of_fetuses'];
if($pregnancy['nr_of_fetuses']) $TP_NFETUS=$pregnancy['nr_of_fetuses'];
# Child enc nr.
$TP_CHILD_ENR=$LD['child_encounter_nr'];
$TP_SEPARATE=$LD['sepspace'];
$TP_CH_ENR=$pregnancy['child_encounter_nr'];
# Delivery mode
if(!isset($pregnancy['delivery_mode'])) $pregnancy['delivery_mode']=1;
$TP_DELIV_MODE=$LD['delivery_mode'];
# Delivery mode radio buttosn
$TP_DMODE_RADIOS='';
$dm=&$obj->DeliveryModes();
	if($obj->LastRecordCount()){
		while($dmod=$dm->FetchRow()){
			$TP_DMODE_RADIOS.='<input type="radio" name="delivery_mode" value="'.$dmod['nr'].'" ';
			if($pregnancy['delivery_mode']==$dmod['nr']) $TP_DMODE_RADIOS.='checked' ;
			$TP_DMODE_RADIOS.='>';
			if(isset($$dmod['LD_var']) && $$dmod['LD_var']) $TP_DMODE_RADIOS.=$$dmod['LD_var'];
				else $TP_DMODE_RADIOS.=$dmod['name'];
			$TP_DMODE_RADIOS.='&nbsp;';
		}
	}
# Is booked

if(!isset($pregnancy['is_booked'])) $pregnancy['is_booked']=1;
$TP_ISBOOKED=$LD['is_booked'];
$TP_ISBOOKED_YES='<input type="radio" name="is_booked" value="1" ';
if($pregnancy['is_booked']) $TP_ISBOOKED_YES.='checked';
$TP_ISBOOKED_YES.='>'.$LDYes;
$TP_ISBOOKED_NO='<input type="radio" name="is_booked" value="0" ';
if(!$pregnancy['is_booked']) $TP_ISBOOKED_NO.='checked';
$TP_ISBOOKED_NO.='>'.$LDNo;
 
$TP_VDRL=$LD['vdrl'];
$TP_VDRL_VAL=$pregnancy['vdrl'];
# Rh 
$TP_RH=$LD['rh'];
if($pregnancy['rh']) $TP_RH_VAL=$pregnancy['rh'];
# BP systolic
$TP_BPSYS=$LD['bp_systolic_high'];
if($pregnancy['bp_systolic_high']) $TP_BPSYS_VAL=$pregnancy['bp_systolic_high'];
$TP_BPDIAST=$LD['bp_diastolic_high'];
if($pregnancy['bp_diastolic_high']) $TP_BPDIAST_VAL= $pregnancy['bp_diastolic_high'];
# Proteinuria 
if(!isset($pregnancy['proteinuria'])) $pregnancy['proteinuria']=0; # Defaults to no proteinuria
$TP_PROTEINURIA=$LD['proteinuria'];
$TP_PROT_YES='<input type="radio" name="proteinuria" value="1" ';
if($pregnancy['proteinuria']) $TP_PROT_YES.='checked';
$TP_PROT_YES.='>'.$LDYes;
$TP_PROT_NO='<input type="radio" name="proteinuria" value="0" ';
if(!$pregnancy['proteinuria']) $TP_PROT_NO.='checked';
$TP_PROT_NO.='>'.$LDNo;
# Labour duration  	
$TP_LABOUR_DUR=$LD['labour_duration'];
if($pregnancy['labour_duration']) $TP_LABOUR_VAL=$pregnancy['labour_duration'];
# Induction method
$TP_INDUCT_METHOD=$LD['induction_method'];
# Induction radio buttons
if(!isset($pregnancy['induction_method'])||!$pregnancy['induction_method']) $pregnancy['induction_method']=1; # Defaults to 1 = not induced
$TP_INDUCT_RADIOS='';
# Fetch the induction methods
$ind=&$obj->InductionMethods();
if($obj->LastRecordCount()){
	while($induc=$ind->FetchRow()){
		$TP_INDUCT_RADIOS.=' <input type="radio" name="induction_method" value="'.$induc['nr'].'" ';
		if($pregnancy['induction_method']==$induc['nr']) $TP_INDUCT_RADIOS.='checked' ;
		$TP_INDUCT_RADIOS.='>';
		if(isset($$induc['LD_var']) && $$induc['LD_var']) $TP_INDUCT_RADIOS.=$$induc['LD_var'];
			else $TP_INDUCT_RADIOS.=$induc['name'];
		$TP_INDUCT_RADIOS.='&nbsp;';
	}
}

# Induction indication
$TP_INDUCT_INDIC.=$LD['induction_indication'];
$TP_INDUCT_VAL=$pregnancy['induction_indication'];
# Anaesthesia type default= 1 (none)
if(!$pregnancy['anaesth_type_nr'])  $pregnancy['anaesth_type_nr']=1;
$TP_ANAESTH=$LD['anaesth_type_nr'];
# Anaesthesia radio buttons 
$TP_ANAESTH_RADIOS='';
$ana=&$obj->AnaesthesiaTypes();

if($obj->LastRecordCount()){
	while($row=$ana->FetchRow()){
		$TP_ANAESTH_RADIOS.='<input type="radio" name="anaesth_type_nr" value="'.$row['nr'].'" ';
		if($pregnancy['anaesth_type_nr']==$row['nr']) $TP_ANAESTH_RADIOS.='checked';
		$TP_ANAESTH_RADIOS.='>';
		if(isset($$row['LD_var']) && $$row['LD_var']) $TP_ANAESTH_RADIOS.=$$row['LD_var'];
			else $TP_ANAESTH_RADIOS.=$row['name'];
		$TP_ANAESTH_RADIOS.='&nbsp;';
	}
}

# Complications	
$TP_COMPLICATION=$LD['complications'];
$TP_COMPLIC=$pregnancy['complications'];
# Perineum default = 1 (intact)
if(!$pregnancy['perineum']) $pregnancy['perineum']=1;
$TP_PERINEUM=$LD['perineum'];
# Perineum radio buttons
$TP_PERINEUM_RADIOS='';
$buf=&$obj->Perineums();
if($obj->LastRecordCount()){
	while($per=$buf->FetchRow()){
		$TP_PERINEUM_RADIOS.=' <input type="radio" name="perineum" value="'.$per['nr'].'" ';
		if($pregnancy['perineum']==$per['nr']) $TP_PERINEUM_RADIOS.='checked' ;
		$TP_PERINEUM_RADIOS.='>';
		if(isset($$per['LD_var']) && $$per['LD_var']) $TP_PERINEUM_RADIOS.=$$per['LD_var'];
			else $TP_PERINEUM_RADIOS.=$per['name'];
	}
}
# Blood loss
$TP_BLOODLOSS.=$LD['blood_loss'];
if($pregnancy['blood_loss']>0) $TP_BLOSS=$pregnancy['blood_loss']; 
# Blood loss unit of measure
# make ml (milliliter) the default
if(empty($pregnancy['blood_loss_unit'])) $pregnancy['blood_loss_unit']='ml';
$TP_BLOSS_OPTIONS='';
# Load the volume units
$unit=&$msr->VolumeUnits();
while(list($x,$v)=each($unit)){
	$TP_BLOSS_OPTIONS.='<option value="'.$v['id'].'" ';
	if($pregnancy['blood_loss_unit']==$v['id']) $TP_BLOSS_OPTIONS.='selected';
	$TP_BLOSS_OPTIONS.='>'.$v['id'];
}
# Retained placenta
$TP_RETPLACENTA=$LD['is_retained_placenta'];
$TP_RETPLACENTA_YES='<input type="radio" name="is_retained_placenta" value="1" ';
if($pregnancy['is_retained_placenta']) $TP_RETPLACENTA_YES.='checked';
$TP_RETPLACENTA_YES.='>'.$LDYes;
$TP_RETPLACENTA_NO='<input type="radio" name="is_retained_placenta" value="0" ';
if(!$pregnancy['is_retained_placenta']) $TP_RETPLACENTA_NO.='checked';
$TP_RETPLACENTA_NO.='>'.$LDNo;
# Post labour condition
$TP_POST_LABOUR=$LD['post_labour_condition'];
$TP_PLABOUR=$pregnancy['post_labour_condition'];
# Outcome default = 1 (living)
if(!$pregnancy['outcome']) $pregnancy['outcome']=1;
$TP_OUTCOME=$LD['outcome'];
# Outcome radio buttons
$TP_OUT_RADIOS='';
$oc=&$obj->Outcomes();
if($obj->LastRecordCount()){
	while($otc=$oc->FetchRow()){
		$TP_OUT_RADIOS.='<input type="radio" name="outcome" value="'.$otc['nr'].'" ';
		if($pregnancy['outcome']==$otc['nr']) $TP_OUT_RADIOS.='checked' ;
		$TP_OUT_RADIOS.='>';
		if(isset($$otc['LD_var']) && $$otc['LD_var']) $TP_OUT_RADIOS.=$$otc['LD_var'];
			else $TP_OUT_RADIOS.=$otc['name'];
		$TP_OUT_RADIOS.='&nbsp;';
	}
}
$TP_DOCBY=$LD['docu_by'];
$TP_DBY=$_SESSION['sess_user_name'];
# Load the template
$tp_preg=&$TP_obj->load('registration_admission/tp_input_show_pregnancy.htm');
eval("echo $tp_preg;");
?>

 <input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<input type="hidden" name="rec_nr" value="<?php echo $rec_nr; ?>">
<input type="hidden" name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type="hidden" name="target" value="<?php echo trim($target); ?>">
<input type="hidden" name="mode" value="newdata">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>

