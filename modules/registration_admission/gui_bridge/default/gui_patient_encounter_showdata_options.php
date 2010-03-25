<script language="javascript" >
<!-- 
function openDRGComposite(){
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $_SESSION['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$_SESSION['sess_full_en']."&edit=$edit&is_discharged=$is_discharged&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $_SESSION['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
} 

function getinfo(pn){
<?php /* if($edit)*/
	{ echo '
	urlholder="'.$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=$station"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
}
function cancelEnc(){
	if(confirm("<?php echo $LDSureToCancel ?>")){
		usr=prompt("<?php echo $LDPlsEnterFullName ?>","");
		if(usr&&usr!=""){
			pw=prompt("Please enter your password.","");
			if(pw&&pw!=""){
				window.location.href="aufnahme_cancel.php<?php echo URL_REDIRECT_APPEND ?>&mode=cancel&encounter_nr=<?php echo $_SESSION['sess_en'] ?>&cby="+usr+"&pw="+pw;
			}
		}
	}
}
//-->
</script>
<?php
# Let us detect if data entry is allowed
	//echo $enc_status['is_disharged'].'<p>'. $enc_status['encounter_status'].'<p>d= '. $enc_status['in_dept'].'<p>w= '. $enc_status['in_ward'];
/*	if($enc_status['is_disharged']){
		if(stristr('cancelled',$enc_status['encounter_status'])){
			$data_entry=false;
		}
	}elseif(!$enc_status['encounter_status']||stristr('cancelled',$enc_status['encounter_status'])){
		if(!$enc_status['in_ward']&&!$enc_status['in_dept']) $data_entry=false;
	}
*/
if(!$is_discharged&&!$enc_status['in_ward']&&!$enc_status['in_dept']&&(!$enc_status['encounter_status']||stristr('cancelled',$enc_status['encounter_status']))){
//if(!$enc_status['is_discharged']&&!$enc_status['in_ward']&&!$enc_status['in_dept']&&(!$enc_status['encounter_status']||stristr('cancelled',$enc_status['encounter_status']))){
	$data_entry=false;
}else{
	$data_entry=true;
}


# Create the template object
if(!is_object($TP_obj)){
	include_once($root_path.'include/care_api_classes/class_template.php');
	$TP_obj=new Template($root_path);
}

# Assign the icons

if($cfg['icons'] != 'no_icon'){
	$TP_iconPost = '<img '.createComIcon($root_path,'post_discussion.gif','0').'>';
	$TP_iconFolder = '<img '.createComIcon($root_path,'open.gif','0').'>';
	$TP_iconBubble = '<img '.createComIcon($root_path,'bubble.gif','0').'>';
	$TP_iconTalk = '<img '.createComIcon($root_path,'discussions.gif','0').'>';
	$TP_iconEye = '<img '.createComIcon($root_path,'eye_s.gif','0').'>';
	$TP_iconOGuy = '<img '.createComIcon($root_path,'prescription.gif','0').'>';
	$TP_iconHeads = '<img '.createComIcon($root_path,'new_group.gif','').'>';
	$TP_iconWGuy = '<img '.createComIcon($root_path,'people_search_online.gif','0').'>';
	$TP_iconWTorso = '<img '.createComIcon($root_path,'man-whi.gif','0').'>';
	$TP_iconIDCard = '<img '.createComIcon($root_path,'new_address.gif','0').'>';
	$TP_iconGTeen = '<img '.createComIcon($root_path,'bn.gif','0').'>';
	$TP_iconCrossTeen = '<img '.createComIcon($root_path,'bnplus.gif','0').'>';
	$TP_iconPDF = '<img '.createComIcon($root_path,'icon_acro.gif','0').'>';
	$TP_iconXPaper = '<img '.createComIcon($root_path,'nopmuser.gif','0').'>';
}else{
	$TP_iconPost = '';
	$TP_iconFolder = '';
	$TP_iconBubble = '';
	$TP_iconTalk = '';
	$TP_iconEye = '';
	$TP_iconOGuy = '';
	$TP_iconHeads = '';
	$TP_iconWGuy ='';
	$TP_iconWTorso = '';
	$TP_iconIDCard = '';
	$TP_iconGTeen = '';
	$TP_iconCrossTeen = '';
	$TP_iconPDF = '';
	$TP_iconXPaper = '';
}


$TP_href_1="show_sick_confirm.php".URL_APPEND ."&pid=$pid&target=$target";
if($data_entry){
	$TP_SICKCONFIRM="<a href=\"show_sick_confirm.php".URL_APPEND ."&pid=$pid&target=$target\">$LDSickReport</a>";
}else{
	$TP_SICKCONFIRM="<font color='#333333'>$LDSickReport</font>";
}

if($data_entry){
	$TP_DIAGXRESULTS="<a href=\"show_diagnostics_result.php".URL_APPEND."&pid=$pid&target=$target\">$LDDiagXResults</a>";
}else{
	$TP_DIAGXRESULTS="<font color='#333333'>$LDDiagXResults</font>";
}

if($data_entry){
	$TP_DIAGNOSES="<a href=\"show_diagnosis.php".URL_APPEND."&pid=$pid&target=$target\">$LDDiagnoses</a>";
}else{
	$TP_DIAGNOSES="<font color='#333333'>$LDDiagnoses</font>";
}

if($data_entry){
	$TP_PROCEDURES="<a href=\"show_procedure.php".URL_APPEND."&pid=$pid&target=$target\">$LDProcedures</a>";
}else{
	$TP_PROCEDURES="<font color='#333333'>$LDProcedures</font>";
}

if($data_entry){
	$TP_DRG="<a href=\"javascript:openDRGComposite()\">$LDDRG</a>";
}else{
	$TP_DRG="<font color='#333333'>$LDDRG</font>";
}

if($data_entry){
	$TP_PRESCRIPTIONS="<a href=\"show_prescription.php".URL_APPEND."&pid=$pid&target=$target\">$LDPrescriptions</a>";
}else{
	$TP_PRESCRIPTIONS="<font color='#333333'>$LDPrescriptions</font>";
}

if($data_entry){
	$TP_NOTESREPORTS="<a href=\"show_notes.php".URL_APPEND."&pid=$pid&target=$target\">$LDNotes $LDAndSym $LDReports</a>";
}else{
	$TP_NOTESREPORTS="<font color='#333333'>$LDNotes $LDAndSym $LDReports</font>";
}
$TP_href_11="show_immunization.php".URL_APPEND."&pid=$pid&target=$target";
if($data_entry){
	$TP_IMMUNIZATION="<a href=\"show_immunization.php".URL_APPEND."&pid=$pid&target=$target\">$LDImmunization</a>";
}else{
	$TP_IMMUNIZATION="<font color='#333333'>$LDImmunization</font>";
}

if($data_entry){
	$TP_MSRMNTS="<a href=\"show_weight_height.php".URL_APPEND."&pid=$pid&target=$target\">$LDMeasurements</a>";
}else{
	$TP_MSRMNTS="<font color='#333333'>$LDMeasurements</font>";
}

# If the sex is female, show the pregnancies option link
if($data_entry&&$sex=='f') {
	$TP_preg_BLK="<a href=\"show_pregnancy.php".URL_APPEND."&pid=$pid&target=$target\">$LDPregnancies</a>";
}else{
	$TP_preg_BLK="<font color='#333333'>$LDPregnancies</font>";
}
				  
if($data_entry){
	$TP_BIRTHDX="<a href=\"show_birthdetail.php".URL_APPEND."&pid=$pid&target=$target\">$LDBirthDetails</a>";
}else{
	$TP_BIRTHDX="<font color='#333333'>$LDBirthDetails</font>";
}
$TP_HISTORY="<a href=\"javascript:popRecordHistory('care_encounter',".$_SESSION['sess_en'].")\">$LDRecordsHistory</a>";
# Links to chart folder
$TP_href_17='javascript:getinfo(\''.$_SESSION['sess_en'].'\')';
if($data_entry){
	$TP_CHARTSFOLDER="<a href=\"javascript:getinfo('".$_SESSION['sess_en']."')\">$LDChartsRecords</a>";
}else{
	$TP_CHARTSFOLDER="<font color='#333333'>$LDChartsRecords</font>";
}
# Links to patient registration data display
$TP_PATREGSHOW="<a href=\"patient_register_show.php".URL_APPEND."&pid=".$_SESSION['sess_pid']."&from=$from&newdata=1&target=$target\">$LDShow $LDPatientRegister</a>";
$TP_PATREGUPDATE="<a href=\"patient_register.php".URL_APPEND."&pid=$pid&update=1\">$LDUpdate $LDPatientRegister</a>";

# Links to medocs module
if($data_entry){
	$TP_MEDOCS="<a href=\"".$root_path."modules/medocs/show_medocs.php".URL_APPEND."&encounter_nr=".$_SESSION['sess_en']."&edit=$edit&from=$from&is_discharged=$is_discharged&target=$target\">$LDMedocs</a>";
}else{
	$TP_MEDOCS="<font color='#333333'>$LDMedocs</font>";
}

# Links to pdf doc generator
if($data_entry){
	$TP_PRINT_PDFDOC="<a href=\"".$root_path."modules/pdfmaker/admission/admitdata.php".URL_APPEND."&enc=".$_SESSION['sess_en']."\" target=_blank>$LDPrintPDFDoc</a>";
}else{
	$TP_PRINT_PDFDOC="<font color='#333333'>$LDPrintPDFDoc</font>";
}



# If encounter_status empty or 'allow_cancel', show the cancel option link
//if(!$enc_status['is_discharged']&&!$enc_status['in_ward']&&!$enc_status['in_dept']&&(empty($enc_status['encounter_status'])||$enc_status['encounter_status']=='allow_cancel')){
if(!$data_entry&&($enc_status['encounter_status']!='cancelled')&&!$enc_status['is_discharged']){
	$TP_xenc_BLK="<a href=\"javascript:cancelEnc('".$_SESSION['sess_en']."')\">$LDCancelThisAdmission</a>";
}else{
	$TP_xenc_BLK="<font color='#333333'>$LDCancelThisAdmission</font>";
}

# Load the template
$TP_options=$TP_obj->load('registration_admission/tp_pat_admit_options.htm');
eval("echo $TP_options;");
?>
