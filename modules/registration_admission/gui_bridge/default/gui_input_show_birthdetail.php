<script language="JavaScript">
<!-- Script Begin
function popClassification() {
	urlholder="./neonatal_classifications.php<?php echo URL_REDIRECT_APPEND; ?>";
	CLASSWIN<?php echo $sid ?>=window.open(urlholder,"CLASSWIN<?php echo $sid ?>","menubar=no,width=300,height=450,resizable=yes,scrollbars=yes");

}
function clearClassification() {
	document.report.classification.value="";
	document.report.classification.focus();
}

function chkform(d){
	if(d.parent_encounter_nr.value==""){
		if(!confirm("<?php echo $LDParentEncNrMissing; ?>")){
			d.parent_encounter_nr.focus();
			return false;
		}
	}
	
	if(isNaN(d.parent_encounter_nr.value)){
		d.length.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.parent_encounter_nr.focus();
		return false;
	}else if(d.parent_encounter_nr.value<0){
		d.length.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.parent_encounter_nr.focus();
		return false;
	}else if(d.delivery_place.value==""){
		alert("<?php echo $LDPlsEnterDeliveryPlace; ?>");
		d.delivery_place.focus();
		return false;
	}else if(d.delivery_mode.value==""){
		alert("<?php echo $LDPlsSelectDeliveryMode; ?>");
		return false;
	}else if(isNaN(d.weight.value)){
		d.length.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.weight.focus();
		return false;
	}else if(d.weight.value<0){
		d.length.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.weight.focus();
		return false;
	}else if(isNaN(d.length.value)){
		d.weight.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.length.focus();
		return false;
	}else if(d.length.value<0){
		d.weight.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.length.focus();
		return false;
	}else if(isNaN(d.head_circumference.value)){
		d.weight.focus(); // patch for Konqueror
		alert("<?php echo $LDEntryInvalidChar; ?>");
		d.head_circumference.focus();
		return false;
	}else if(d.head_circumference.value<0){
		d.weight.focus(); // patch for Konqueror
		alert("<?php echo $LDNotNegValue; ?>");
		d.head_circumference.focus();
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
# Parent's (mother's) encounter nr.
$TP_PARENT_ENR= $LD['parent_encounter_nr'];

if($birth['parent_encounter_nr']) $TP_PENR= $birth['parent_encounter_nr'];

# Delivery nr.
$TP_DELIV_NR=$LD['delivery_nr'];

if($birth['delivery_nr']) $TP_DNR= $birth['delivery_nr'];

# Delivery place
$TP_DELIV_PLACE=$LD['delivery_place'];
$TP_DPLACE=$birth['delivery_place']; 

# Delivery mode
$TP_DELIV_MODE=$LD['delivery_mode'];

if(!$birth['delivery_mode']) $birth['delivery_mode']=1;  # 1= Normal delivery
# Delivery mode radio buttons
$TP_DMODE_RADIOS='';
$dm=&$obj->DeliveryModes();
if($obj->LastRecordCount()){
	while($dmod=$dm->FetchRow()){
		$TP_DMODE_RADIOS.='<input type="radio" name="delivery_mode" value="'.$dmod['nr'].'" ';
		if($birth['delivery_mode']==$dmod['nr']) $TP_DMODE_RADIOS.='checked' ;
		$TP_DMODE_RADIOS.='>';
		if(isset($$dmod['LD_var'])&&$$dmod['LD_var']) $TP_DMODE_RADIOS.=$$dmod['LD_var'];
			else $TP_DMODE_RADIOS.=$dmod['name'];
	}
}

# Ceasarean reason
$TP_CES_REASON=$LD['c_s_reason'];
$TP_CREASON=$birth['c_s_reason'];

# Born before arrival
$TP_BB_ARRIVAL=$LD['born_before_arrival'];
$TP_BB_AR_YES='<input type="radio" name="born_before_arrival" value="1" ';
if($birth['born_before_arrival']) $TP_BB_AR_YES.='checked';
$TP_BB_AR_YES.='>'.$LDYes;
$TP_BB_AR_NO='<input type="radio" name="born_before_arrival" value="0" ';
if(!$birth['born_before_arrival']) $TP_BB_AR_NO.='checked';
$TP_BB_AR_NO.='>'.$LDNo;

# Face presentation
$TP_FACE_PRES=$LD['face_presentation'];

if(!isset($birth['face_presentation'])) $birth['face_presentation']=1;
$TP_FACE_PRES_YES='<input type="radio" name="face_presentation" value="1" ';
if($birth['face_presentation']) $TP_FACE_PRES_YES.='checked';
$TP_FACE_PRES_YES.='>'.$LDYes;

$TP_FACE_PRES_NO='<input type="radio" name="face_presentation" value="0" ';
if(!$birth['face_presentation']) $TP_FACE_PRES_NO.='checked';
$TP_FACE_PRES_NO.='>'.$LDNo;
	 
# Posterio -occipital position
$TP_POS_OCCI=$LD['posterio_occipital_position'];
$TP_POS_OCCI_YES='<input type="radio" name="posterio_occipital_position" value="1" ';
if($birth['posterio_occipital_position']) $TP_POS_OCCI_YES.='checked';
$TP_POS_OCCI_YES.='>'.$LDYes;
$TP_POS_OCCI_NO='<input type="radio" name="posterio_occipital_position" value="0" ';
if(!$birth['posterio_occipital_position']) $TP_POS_OCCI_NO.='checked';
$TP_POS_OCCI_NO.='>'.$LDNo;

# Delivery rank
$TP_DELIV_RANK=$LD['delivery_rank'];
if($birth['delivery_rank']) $TP_DRANK=$birth['delivery_rank'];

# Apgar item names
$TP_APGAR1=$LD['apgar_1_min'];
if(!isset($birth['apgar_1_min'])) $birth['apgar_1_min']=-1;
$TP_APGAR5=$LD['apgar_5_min'];
if(!isset($birth['apgar_5_min'])) $birth['apgar_5_min']=-1;
$TP_APGAR10=$LD['apgar_10_min'];
if(!isset($birth['apgar_10_min'])) $birth['apgar_10_min']=-1;

# Apgar 1 min - radio buttons
$TP_APGAR1_RADIOS='<input type="radio" name="apgar_1_min" value="0" ';
if($birth['apgar_1_min']==0) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>0
	 	<input type="radio" name="apgar_1_min" value="1" ';
if($birth['apgar_1_min']==1) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>1
  	<input type="radio" name="apgar_1_min" value="2" ';
if($birth['apgar_1_min']==2) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>2
  	<input type="radio" name="apgar_1_min" value="3" ';
if($birth['apgar_1_min']==3) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>3
  	<input type="radio" name="apgar_1_min" value="4" ';
if($birth['apgar_1_min']==4) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>4
  	<input type="radio" name="apgar_1_min" value="5" ';
if($birth['apgar_1_min']==5) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>5
	 	<input type="radio" name="apgar_1_min" value="6" ';
if($birth['apgar_1_min']==6) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>6
	 	<input type="radio" name="apgar_1_min" value="7" ';
if($birth['apgar_1_min']==7) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>7
  	<input type="radio" name="apgar_1_min" value="8" ';
if($birth['apgar_1_min']==8) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>8
  	<input type="radio" name="apgar_1_min" value="9" ';
if($birth['apgar_1_min']==9) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>9
  	<input type="radio" name="apgar_1_min" value="10" ';
if($birth['apgar_1_min']==10) $TP_APGAR1_RADIOS.='checked';
$TP_APGAR1_RADIOS.='>10';

# Apgar 5 min radio buttons
$TP_APGAR5_RADIOS='<input type="radio" name="apgar_5_min" value="0" ';
if($birth['apgar_5_min']==0) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>0
	 	<input type="radio" name="apgar_5_min" value="1" ';
if($birth['apgar_5_min']==1) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>1
  	<input type="radio" name="apgar_5_min" value="2" ';
if($birth['apgar_5_min']==2) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>2
  	<input type="radio" name="apgar_5_min" value="3" ';
if($birth['apgar_5_min']==3) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>3
  	<input type="radio" name="apgar_5_min" value="4" ';
if($birth['apgar_5_min']==4) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>4
  	<input type="radio" name="apgar_5_min" value="5" ';
if($birth['apgar_5_min']==5) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>5
	 	<input type="radio" name="apgar_5_min" value="6" ';
if($birth['apgar_5_min']==6) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>6
	 	<input type="radio" name="apgar_5_min" value="7" ';
if($birth['apgar_5_min']==7) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>7
  	<input type="radio" name="apgar_5_min" value="8" ';
if($birth['apgar_5_min']==8) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>8
  	<input type="radio" name="apgar_5_min" value="9" ';
if($birth['apgar_5_min']==9) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>9
  	<input type="radio" name="apgar_5_min" value="10" ';
if($birth['apgar_5_min']==10) $TP_APGAR5_RADIOS.='checked';
$TP_APGAR5_RADIOS.='>10';

# Apgar 10 mins radio buttons
$TP_APGAR10_RADIOS='<input type="radio" name="apgar_10_min" value="0" ';
if($birth['apgar_10_min']==0) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>0
	 	<input type="radio" name="apgar_10_min" value="1" ';
if($birth['apgar_10_min']==1) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>1
  	<input type="radio" name="apgar_10_min" value="2" ';
if($birth['apgar_10_min']==2) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>2
  	<input type="radio" name="apgar_10_min" value="3" ';
if($birth['apgar_10_min']==3) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>3
  	<input type="radio" name="apgar_10_min" value="4" ';
if($birth['apgar_10_min']==4) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>4
  	<input type="radio" name="apgar_10_min" value="5" ';
if($birth['apgar_10_min']==5) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>5
	 	<input type="radio" name="apgar_10_min" value="6" ';
if($birth['apgar_10_min']==6) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>6
	 	<input type="radio" name="apgar_10_min" value="7" ';
if($birth['apgar_10_min']==7) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>7
  	<input type="radio" name="apgar_10_min" value="8" ';
if($birth['apgar_10_min']==8) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>8
  	<input type="radio" name="apgar_10_min" value="9" ';
if($birth['apgar_10_min']==9) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>9
  	<input type="radio" name="apgar_10_min" value="10" ';
if($birth['apgar_10_min']==10) $TP_APGAR10_RADIOS.='checked';
$TP_APGAR10_RADIOS.='>10';

# Time to spontan respiration
$TP_SPONTANRESP=$LD['time_to_spont_resp'];
if($birth['time_to_spont_resp']) $TP_SP_RESP=$birth['time_to_spont_resp'];

$TP_CONDITION=$LD['condition'];
$TP_COND=$birth['condition'];
$TP_WEIGHT=$LD['weight'];
if($birth['weight']>0) $TP_WT=$birth['weight'];
$TP_LENGTH=$LD['length'];
if($birth['length']>0) $TP_LEN=$birth['length'];
$TP_HEAD_CIRC=$LD['head_circumference'];
if($birth['head_circumference']>0) $TP_HCIRC=$birth['head_circumference'];
$TP_GEST_AGE=$LD['scored_gestational_age'];
if($birth['scored_gestational_age']>0) $TP_GAGE=$birth['scored_gestational_age'];
$TP_FEEDING=$LD['feeding'];

# Feeding, set default to "breast" = type #1
if(!isset($birth['feeding'])||!$birth['feeding']) $birth['feeding']=1;
# Feeding radio buttons
$TP_FEED_RADIOS='';
$fd=&$obj->FeedingTypes();
if($obj->LastRecordCount()){
	while($feed=$fd->FetchRow()){
		$TP_FEED_RADIOS.='<input type="radio" name="feeding" value="'.$feed['nr'].'" ';
		if($birth['feeding']==$feed['nr']) $TP_FEED_RADIOS.='checked' ;
		$TP_FEED_RADIOS.='>';
		if(isset($$feed['LD_var'])&&$$feed['LD_var']) $TP_FEED_RADIOS.=$$feed['LD_var'];
			else $TP_FEED_RADIOS.=$feed['name'];
	}
}

# congenital abnormality 
$TP_CONG_ABNORM=$LD['congenital_abnormality'];
if($birth['congenital_abnormality']) $TP_CABNORM=$birth['congenital_abnormality'];
	else $TP_CABNORM='';
# Classification 
$TP_CLASSIFICATION=$LD['classification'];
$TP_CLASSIF='';
if(!empty($birth['classification'])) $TP_CLASSIF=$birth['classification'];
# Image buttons for javascript activation
$TP_IMG_ADD=createLDImgSrc($root_path,'add_sm.gif','0');
$TP_IMG_CLEAR=createLDImgSrc($root_path,'clearall_sm.gif','0');

# Outcome
if(!$birth['outcome']) $birth['outcome']=1; # 1 = living
$TP_OUTCOME=$LD['outcome'];
# Outcome radio buttons
$TP_OUT_RADIOS='';
$oc=&$obj->Outcomes();
if($obj->LastRecordCount()){
	while($otc=$oc->FetchRow()){
		$TP_OUT_RADIOS.='<input type="radio" name="outcome" value="'.$otc['nr'].'" ';
		if($birth['outcome']==$otc['nr']) $TP_OUT_RADIOS.='checked' ;
		$TP_OUT_RADIOS.='>';
		if(isset($$otc['LD_var'])&&$$otc['LD_var']) $TP_OUT_RADIOS.=$$otc['LD_var'];
			else $TP_OUT_RADIOS.=$otc['name'];
	}
}
# Disease categories
$TP_DIS_CAT=$LD['disease_category'];
# Disease category radio buttons
$TP_DISCAT_RADIOS='';
$dc=&$obj->DiseaseCategories();
if($obj->LastRecordCount()){
	while($dcat=$dc->FetchRow()){
		$TP_DISCAT_RADIOS.='<input type="radio" name="disease_category" value="'.$dcat['nr'].'" ';
		if($birth['disease_category']==$dcat['nr']) $TP_DISCAT_RADIOS.='checked' ;
		$TP_DISCAT_RADIOS.='>';
		if(isset($$dcat['LD_var'])&&$$dcat['LD_var']) $TP_DISCAT_RADIOS.=$$dcat['LD_var'];
			else $TP_DISCAT_RADIOS.=$dcat['name'];
	}
}
# Documented by
$TP_DOCBY=$LD['docu_by'];
$TP_DBY=$_SESSION['sess_user_name'];

# Load the template
$tp_birth=$TP_obj->load('registration_admission/tp_input_show_birthdetail.htm');
eval("echo $tp_birth;");
?>


<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<input type="hidden" name="allow_update" value="<?php if(isset($allow_update)) echo $allow_update; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="delivery_date" value="<?php echo $date_birth; ?>">
<input type="hidden" name="mode" value="newdata">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
