<?php

# Load std tags
require('./gui_bridge/default/gui_std_tags.php');


echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $title ?></TITLE>

</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>"  onLoad="window.print()" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


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
$TP_care_logo=createLogo($root_path,'care_logo.gif','0','right');
# Signature stamp of the department
$TP_dept_sigstamp=nl2br($sickconfirm['sig_stamp']); 
# Logo of the department
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

$TP_diagnosis=nl2br($sickconfirm['diagnosis']);

# Get the address of the hospital from the global config table
$glob_obj->getConfig('main_info_address');
$TP_main_address=nl2br($GLOBAL_CONFIG['main_info_address']);

# Load the template, default is "tp_show_sick_confirm.htm"
$TP_sickform=&$TP_obj->load('registration_admission/tp_show_sick_confirm'.$sickform_style.'.htm');

# Output template
eval("echo $TP_sickform;");	

?>

<?php
StdFooter();
?>
