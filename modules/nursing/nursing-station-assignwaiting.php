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
$lang_tables=array('aufnahme.php','prompt.php','person.php');
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
if (!isset($station)||empty($station)) { $station=$_SESSION['sess_nursing_station'];} # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

if(!isset($mode)) $mode='';

$breakfile='javascript:window.close()'; # Set default breakfile

/* Create ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj= new Ward;

# Load date formatter 
require_once($root_path.'include/core/inc_date_format_functions.php');
  
if(($mode=='')||($mode=='fresh')){
	if($ward_info=&$ward_obj->getWardInfo($ward_nr)){
		$room_obj=&$ward_obj->getRoomInfo($ward_nr,$ward_info['room_nr_start'],$ward_info['room_nr_end']);
		if(is_object($room_obj)) {
			$room_ok=true;
		}else{
			$room_ok=false;
		}
		# GEt the number of beds
		$nr_beds=$ward_obj->countBeds($ward_nr);
		# Get ward patients
		if($is_today) $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr);
			else $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr,$s_date);
		if(is_object($patients_obj)){
			# Prepare patients data into array matrix
			while($buf=$patients_obj->FetchRow()){
				$patient[$buf['room_nr']][$buf['bed_nr']]=$buf;
			}
			$patients_ok=true;
		}else{
				$patients_ok=false;
		}
				
		$ward_ok=true;
		
		# Load global person photo source path
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_foto_path');
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

		#Create encounter object and load encounter info
		$enc_obj=new Encounter($pn);
		$enc_obj->loadEncounterData();
		if($enc_obj->is_loaded) {
			$encounter=&$enc_obj->encounter;
		}
		
		# Set the foto filename
		$photo_filename=$encounter['photo_filename'];
		/* Prepare the photo filename */
		require_once($root_path.'include/core/inc_photo_filename_resolve.php');

		# Get billing type
		$billing_type=&$enc_obj->getInsuranceClassInfo($encounter['insurance_class_nr']);
			
	}else{
			$ward_ok=false;
	}
}
if(isset($transfer)&&$transfer){
	$TP_TITLE=$LDTransferPatient;
}else{
	$TP_TITLE= $LDAssignOcc.' '.strtoupper($station);
	$transfer=false;
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
 $smarty->assign('sToolbarTitle', $TP_TITLE);

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('inpatient_assignbed.php','$mode','$occup','$station','$LDStation')");

 # href for close button
 $smarty->assign('breakfile',"javascript:window.close();");

 # OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$TP_TITLE);

 # Hide Copyright footer
 $smarty->assign('bHideCopyright',TRUE);

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!--
  var urlholder;

function getrem(pn){
	urlholder="nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}

function belegen(pn,rm,bd){
<?php
if($encounter['current_ward_nr']!=$ward_nr){
echo '
if(confirm("'.$LDSureAssignRoomBed.'"))
';
}
?>
{
<?php
echo '
	urlholder="nursing-station.php?mode=newdata&sid='.$sid.'&lang='.$lang.'&rm="+rm+"&bd="+bd+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn="+pn+"&station='.$station.'&ward_nr='.$ward_nr.'"
';
?>
	window.opener.location.replace(urlholder);
	window.close();
}
}
function transferBed(pn,rm,bd){

<?php
echo '
urlholder="nursing-station-transfer-save.php?mode=transferbed&sid='.$sid.'&lang='.$lang.'&rm="+rm+"&bd="+bd+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn="+pn+"&station='.$station.'&ward_nr='.$ward_nr.'"
';
?>
window.opener.location.replace(urlholder);
window.close();
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
	$smarty->assign('sCrossImg','<img '.createComIcon($root_path,'blackcross_sm.gif','0','',TRUE).'>');
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

<table width=100% border=0 cellpadding="0" cellspacing=0>
	<tr valign=top >
		<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>


<!--  Show stop sign and warn if the initial ward assignment is different from this ward -->
<?php
if($encounter['current_ward_nr']!=$ward_nr){
?>
			<table border=0>
				<tr>
					<td><img <?php 	echo createLDImgSrc($root_path,'stop.png','0'); ?>></td>
					<td><?php  echo str_replace('~ward_id~',$pat_station,$LDChkWardConflict); ?></td>
				</tr>
			</table>

<?php
}else{
?>
			<table border=0>
				<tr>
					<td><img <?php 	echo createComIcon($root_path,'angle_down_l.gif','0','',TRUE); ?>></td>
					<td><FONT SIZE=3><?php 	echo $LDSelectRoomBed; ?></font></td>
					<td><img <?php 	echo createMascot($root_path,'mascot1_l.gif','0'); ?>></td>
				</tr>
			</table>

<?php
}

if($ward_ok){

	if($pyear.$pmonth.$pday<date('Ymd')){
	 	$smarty->assign('sWarningPrompt','
		<img '.createComIcon($root_path,'warn.gif','0','absmiddle',TRUE).'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b>');

		# Prevent adding new patients to the list  if list is old
		$edit=FALSE;
	}

	# Start here, create the occupancy list
	# Assign the column  names

	$smarty->assign('LDRoom',$LDRoom);
	$smarty->assign('LDBed',$LDPatListElements[1]);
	$smarty->assign('LDFamilyName',$LDLastName);
	$smarty->assign('LDName',$LDName);
	$smarty->assign('LDBirthDate',$LDBirthDate);
	$smarty->assign('LDPatNr',$LDPatListElements[5]);
	$smarty->assign('$LDBillType',$LDBillType);
	$smarty->assign('LDOptions',$LDPatListElements[7]);

	# Initialize help flags
	$toggle=1;
	$room_info=array();
	# Set occupied bed counter
	$occ_beds=0;
	$lock_beds=0;
	$males=0;
	$females=0;
	$cflag=$ward_info['room_nr_start'];

	# Initialize list rows container string
	$sListRows='';

	# Loop trough the ward rooms

	for ($i=$ward_info['room_nr_start'];$i<=$ward_info['room_nr_end'];$i++){

		if($room_ok){
			$room_info=$room_obj->FetchRow();
		}else{
			$room_info['nr_of_beds']=1;
			$edit=false;
		}

		// Scan the patients object if the patient is assigned to the bed & room
		# Loop through room beds

		for($j=1;$j<=$room_info['nr_of_beds'];$j++){

			# Reset elements

			$smarty->assign('sMiniColorBars','');
			$smarty->assign('sRoom','');
			$smarty->assign('sBed','');
			$smarty->assign('sBedIcon','');
			$smarty->assign('cComma','');
			$smarty->assign('sFamilyName','');
			$smarty->assign('sName','');
			$smarty->assign('sTitle','');
			$smarty->assign('sBirthDate','');
			$smarty->assign('sPatNr','');
			$smarty->assign('sAdmitDataIcon','');
			$smarty->assign('sChartFolderIcon','');
			$smarty->assign('sNotesIcon','');
			$smarty->assign('sTransferIcon','');
			$smarty->assign('sDischargeIcon','');

			$sAstart='';
			$sAend='';
			$sFamNameBuffer='';
			$sNameBuffer='';

			if($patients_ok){

				if(isset($patient[$i][$j])){
			 		$bed=&$patient[$i][$j];
    			 	$is_patient=true;
				 	# Increase occupied bed nr
				 	$occ_beds++;
		 		}else{
		 			$is_patient=false;
					$bed=NULL;
				}
			}
			# If same patient, highlight bacground
			if($transfer&&$bed['encounter_nr']==$pn){
				$smarty->assign('bHighlightRow',TRUE);
			}else{
				$smarty->assign('bHighlightRow',FALSE);
				# set room nr change flag , toggle row color
				if($cflag!=$i){
					$toggle=!$toggle;
					$cflag=$i;
				}
				# set row color/class
				if ($toggle){
					$smarty->assign('bToggleRowClass',TRUE);
				}else{
					$smarty->assign('bToggleRowClass',FALSE);
				}
			}


			# Check if bed is locked
			if(stristr($room_info['closed_beds'],$j.'/')){
				$bed_locked=true;
				$lock_beds++;
				# Consider locked bed as occupied so increase occupied bed counter
				$occ_bed++;
			}else{
				$bed_locked=false;
			}

			# If bed nr  is 1, show the room number
			if($j==1){
				$smarty->assign('sRoom',strtoupper($ward_info['roomprefix']).$i);
			} else{
				$smarty->assign('sRoom','');
			}

			//$smarty->assign('sBed',strtoupper(chr($j+96)));
			$smarty->assign('sBed',$j); //#162

			# If patient, show images by sex
			if($is_patient){
				$sBuffer = '<a href="javascript:popPic(\''.$bed['pid'].'\')">';
				switch(strtolower($bed['sex'])){
					case 'f':
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spf.gif','0','',TRUE).'></a>');
						$females++;
						break;
					case 'm':
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spm.gif','0','',TRUE).'></a>');
						$males++;
						break;
					default:
						$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'bn.gif','0','',TRUE).'></a>');
				}

			}elseif($bed_locked){
				$smarty->assign('sBedIcon','<img '.createComIcon($root_path,'delete2.gif','0','',TRUE).'>');
			}

			if($is_patient&&($bed['encounter_nr']!="")){

				$smarty->assign('sTitle',ucfirst($bed['title']));

				if(isset($sln)&&$sln) $smarty->assign('sFamilyName',str_ireplace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_last'])));
					else $smarty->assign('sFamilyName',ucfirst($bed['name_last']));

				if($bed['name_last']) $smarty->assign('cComma',',');
					else $smarty->assign('cComma','');

				if(isset($sfn)&&$sfn) $smarty->assign('sName',str_ireplace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_first'])));
					else $smarty->assign('sName',ucfirst($bed['name_first']));

			}else{
				if(!$bed_locked){
					if($transfer){
						$as_img='transfer_sm.gif';
						$js_fx='transferBed';
					}else{
						$as_img='assign_here.gif';
						$js_fx='belegen';
					}
					$sTransBuffer ='<a href="javascript:'.$js_fx.'(\''.$pn.'\',\''.$i.'\',\''.$j.'\')"><img '.createLDImgSrc($root_path,$as_img,'0','middle').' alt="'.$LDClk2Occupy.'"></a>';
					$smarty->assign('sFamilyName',$sTransBuffer);
				}else{
					$smarty->assign('sFamilyName',$LDLocked);
				}
				$smarty->assign('sName','');
				$smarty->assign('cComma','');
			}


			if($bed['date_birth']){

				if(isset($sg)&&$sg) $smarty->assign('sBirthDate',str_ireplace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($bed['date_birth'],$date_format)));
					else $smarty->assign('sBirthDate',formatDate2Local($bed['date_birth'],$date_format));
			}

			//if ($bed['encounter_nr']) $smarty->assign('sPatNr',$bed['encounter_nr']);

			$sBuffer = '';
			if($bed['insurance_class_nr']!=2) $sBuffer = $sBuffer.'<font color="#ff0000">';

			if(isset($$bed['insurance_LDvar'])&&!empty($$bed['insurance_LDvar']))  $sBuffer = $sBuffer.$$bed['insurance_LDvar'];
				else  $sBuffer = $sBuffer.$bed['insurance_name'];

			$smarty->assign('sInsuranceType',$sBuffer);

			if(($is_patient)&&!empty($bed['encounter_nr'])){

				$sBuffer = '<a href="javascript:getrem(\''.$bed['encounter_nr'].'\')"><img ';
				if($bed['ward_notes']) $sBuffer = $sBuffer.createComIcon($root_path,'bubble3.gif','0','',TRUE);
					else $sBuffer = $sBuffer.createComIcon($root_path,'bubble2.gif','0','',TRUE);
				$sBuffer = $sBuffer.' alt="'.$LDNoticeRW.'"></a>';

				$smarty->assign('sNotesIcon',$sBuffer);
			}

			# Create the rows using ward_transferbed_list_row.tpl template
			ob_start();
				$smarty->display('nursing/ward_transferbed_list_row.tpl');
				$sListRows = $sListRows.ob_get_contents();
			ob_end_clean();

		} // end of bed loop

		# Append the new row to the previous row in string

		$smarty->assign('sOccListRows',$sListRows);
	} // end of ward loop
	
	# Display the empty bed transfer list
	$smarty->display('nursing/ward_transferbed_list.tpl');

}else{
	echo '
			<ul><img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'><font face="Verdana, Arial" size=3>
			<font class="prompt"><b>'.str_replace("~station~",strtoupper($station),$LDNoInit).'</b></font><br>
			<a href="nursing-station-new.php'.URL_APPEND.'&station='.$station.'&edit='.$edit.'">'.$LDIfInit.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','',TRUE).'></a><p></font>
			</ul>';
}

?>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<p>

		</td>
	</tr>
</table>

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
