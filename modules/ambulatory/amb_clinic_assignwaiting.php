<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('aufnahme.php','prompt.php','departments.php','person.php');
define('LANG_FILE','nursing.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

if(empty($_COOKIE[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}
/**
* Set default values if not available from url
*/

if(!isset($mode)) $mode='';

require_once($root_path.'include/care_api_classes/class_encounter.php');
#Create encounter object and load encounter info
$enc_obj=new Encounter($pn);

# Load date formatter 
require_once($root_path.'include/core/inc_date_format_functions.php');
  
if(($mode=='')||($mode=='fresh')){
		
		# Load global person photo source path
		require_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_foto_path');
		$default_photo_path='uploads/photos/registration';
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

		@$enc_obj->loadEncounterData();
		if($enc_obj->is_loaded) {
			$encounter=&$enc_obj->encounter;
		}else{
			$encounter=array();
		}
		
		if($encounter['current_dept_nr'] != $dept_nr){
			if(!isset($pdept)||empty($pdept)){
				require_once($root_path.'include/care_api_classes/class_department.php');
				$dept_obj=new Department;
				$dept=$dept_obj->FormalName($encounter['current_dept_nr']);
			}else{
				$dept=$pdept;
			}
		}

		# Set the foto filename
		$photo_filename=$encounter['photo_filename'];
		/* Prepare the photo filename */
		require_once($root_path.'include/core/inc_photo_filename_resolve.php');

		# Get billing type
		$billing_type=&$enc_obj->getInsuranceClassInfo($encounter['insurance_class_nr']);
		$breakfile='javascript:window.close()'; # Set default breakfile
		
}elseif($mode=='save'){

	# Save data
	if($enc_obj->assignInDept($pn,$dept_nr,$dept_nr)){
		//@$enc_obj->setInDept($pn);
		include($root_path.'js/reloadparent_closewin.js');
		exit;
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDAmbulant);

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_station.php','$mode','$occup','$station','$LDStation')");

 # href for close button
 $smarty->assign('breakfile',"javascript:window.close();");

 # OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDAmbulant);

 # Hide Copyright footer
 $smarty->assign('bHideCopyright',TRUE);

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!-- 
  var urlholder;


function admitOutpatient(){
	var g=true;
	if(<?php echo $encounter['current_dept_nr']; ?>!=<?php echo $dept_nr; ?>){
		if(!confirm("<?php echo $LDSureTakeOverPatient; ?>")){
			g=false;
		}
	}
	if(g){
		document.admitform.submit();
	}
}
// -->
</script>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('sClassItem','class="reg_item"');
$smarty->assign('sClassInput','class="reg_input"');

$smarty->assign('LDCaseNr',$LDAdmitNr);

$smarty->assign('sEncNrPID',$pn);

$smarty->assign('img_source',"<img $img_source>");

$smarty->assign('LDTitle',$LDTitle);
$smarty->assign('title',$encounter['title']);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('name_last',$encounter['name_last']);
$smarty->assign('LDFirstName',$LDFirstName);
$smarty->assign('name_first',$encounter['name_first']);

# If person is dead show a black cross and assign death date

if($encounter['death_date'] && $encounter['death_date'] != DBF_NODATE){
	$smarty->assign('sCrossImg','<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>');
	$smarty->assign('sDeathDate',@formatDate2Local($encounter['death_date'],$date_format));
}

# Set a row span counter, initialize with 5
$iRowSpan = 5;

if(trim($encounter['blood_group'])){
	$smarty->assign('LDBloodGroup',$LDBloodGroup);
	$buf=trim('LD'.$encounter['blood_group']);
	$smarty->assign('blood_group',$$buf);
	$iRowSpan++;
}

$smarty->assign('sRowSpan',"rowspan=\"$iRowSpan\"");

$smarty->assign('LDBday',$LDBday);
$smarty->assign('sBdayDate',@formatDate2Local($encounter['date_birth'],$date_format));

$smarty->assign('LDSex',$LDSex);
if($encounter['sex']=='m') $smarty->assign('sSexType',$LDMale);
	elseif($encounter['sex']=='f') $smarty->assign('sSexType',$LDFemale);

$smarty->assign('LDBillType',$LDBillType);
if (isset($$billing_type['LD_var'])&&!empty($$billing_type['LD_var'])) $smarty->assign('billing_type',$$billing_type['LD_var']);
    else $smarty->assign('billing_type',$billing_type['name']);

$smarty->assign('LDDiagnosis',$LDDiagnosis);
$smarty->assign('referrer_diagnosis',$encounter['referrer_diagnosis']);
$smarty->assign('LDTherapy',$LDTherapy);
$smarty->assign('referrer_recom_therapy',$encounter['referrer_recom_therapy']);
$smarty->assign('LDSpecials',$LDSpecials);
$smarty->assign('referrer_notes',$encounter['referrer_notes']);

# Buffer page output

ob_start();

$smarty->display('nursing/basic_data_admit.tpl');
?>

<!--  Show stop sign and warn if the initial ward assignment is different from this ward -->
<?php
if($encounter['current_dept_nr']!=$dept_nr){
	$ack_but='takeover.gif';
?>

<table border=0>
  <tr>
    <td><img <?php 	echo createLDImgSrc($root_path,'stop.png','0'); ?>></td>
    <td><?php 	echo str_replace('~dept_id~',$dept,$LDChkClinicConflict); ?>
	</td>
  </tr>
</table>

<?php
}else{
	$ack_but='admit.gif';
}
?>
<p>
<table border=0 width=100%>
  <tr>
    <td align=left><a href="javascript:admitOutpatient()"><img <?php echo createLDImgSrc($root_path,$ack_but,'0'); ?>></a></td>
    <td align=right><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a></td>
  </tr>
</table>

<form name="admitform" method="post">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="mode" value="save">
</form>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>