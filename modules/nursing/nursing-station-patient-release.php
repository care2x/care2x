<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
//$db->debug=true;
if(!$encoder) $encoder=$_COOKIE[$local_user.$sid];

$breakfile="nursing-station.php".URL_APPEND."&edit=1&station=$station&ward_nr=$ward_nr";
$thisfile=basename(__FILE__);

# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;
	
if( $enc_obj->loadEncounterData($pn)) {

	if(($mode=='release')&&!(isset($lock)||$lock)){
		$date=(empty($x_date))?date('Y-m-d'):formatDate2STD($x_date,$date_format);
		$time=(empty($x_time))?date('H:i:s'):convertTimeToStandard($x_time);
		switch($relart)
		{
			case 1: {}
			case 2: {}
			case 7: {}
			case 3: $released=$enc_obj->Discharge($pn,$relart,$date,$time);
						break;
			case 4: $released=$enc_obj->DischargeFromWard($pn,$relart,$date,$time);
						break;
			case 5: $released=$enc_obj->DischargeFromRoom($pn,$relart,$date,$time);
						break;
			case 6: $released=$enc_obj->DischargeFromBed($pn,$relart,$date,$time);
						break;
			default: $released=false;
		}
												
		if($released){
			if(!empty($info)){
				$data_array['notes']=$info;
				$data_array['encounter_nr']=$pn;
				$data_array['date']=$date;
				$data_array['time']=$time;
				$data_array['personell_name']=$encoder;
				$enc_obj->saveDischargeNotesFromArray($data_array);
			}
			# If patient died
			if($relart==7){
				include_once($root_path.'include/care_api_classes/class_person.php');
				$person=new Person;
				$death['death_date']=$date;
				$death['death_encounter_nr']=$pn;
				$death['history']=$enc_obj->ConcatHistory("Discharged (cause: death) ".date('Y-m-d H:i:s')." $encoder\n");
				$death['modify_id']=$encoder;
				$death['modify_time']=date('YmdHis');
				@$person->setDeathInfo($enc_obj->PID(),$death);
				//echo $person->getLastQuery();
			}
			//echo ("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&ward_nr=$ward_nr");
			header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&ward_nr=$ward_nr");
			exit;
		}

	}	// end of if (mode=release)		

		
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('patient_%');	
		$glob_obj->getConfig('person_%');	

		$result=&$enc_obj->encounter;
		/* Check whether config foto path exists, else use default path */			
		$default_photo_path='fotos/registration';
		$photo_filename=$result['photo_filename'];
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
		require_once($root_path.'include/inc_photo_filename_resolve.php');
		/* Load the discharge types */
		$discharge_types=&$enc_obj->getDischargeTypesData();
		
		$patient_ok=TRUE;
}else{
	$patient_ok=FALSE;
}
		
# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDReleasePatient);

 # href for the return button
 $smarty->assign('pbBack',FALSE);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('inpatient_discharge.php','','','$station','$LDReleasePatient')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDReleasePatient);

 # Collect extra javascrit code if patient is not released yet
 
 if(!$released){

	ob_start();
?>

<script language="javascript">
<!-- 

function pruf(d){
	if(!d.sure.checked){
		return false;
	}else{
		if(!d.encoder.value){ 
			alert("<?php echo $LDAlertNoName ?>"); 
			d.encoder.focus();
			return false;
		}
		if (!d.x_date.value){ alert("<?php echo "$LDAlertNoDate ";
 $dfbuffer="LD_".strtr($date_format,".-/","phs");
  echo $$dfbuffer;
?>"); d.x_date.focus();return false;}
		if (!d.x_time.value){ alert("<?php echo $LDAlertNoTime ?>"); d.x_time.focus();return false;}
		// Check if death
		if(d.relart[6].checked==true&&d.x_date.value!=""){
			if(!confirm("<?php echo $LDDeathDateIs ?> "+d.x_date.value+". <?php echo "$LDIsCorrect $LDProceedSave" ?>")) return false;
		}
		return true;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

//-->
</script>
<?php

	$sTemp = ob_get_contents();
	ob_end_clean();

	$smarty->append('JavaScript',$sTemp);

} // End of if !$released

if(($mode=="release")&&($released)){
	$smarty->assign('sPrompt',$LDJustReleased);
}

if($patient_ok){

	$smarty->assign('thisfile',$thisfile);
	$smarty->assign('sBarcodeLabel','<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>');
	$smarty->assign('img_source','<img '.$img_source.' align="top">');
	$smarty->assign('LDLocation',$LDPatListElements[0]);
	$smarty->assign('sLocation',$rm.strtoupper(chr($bd+96)));
	$smarty->assign('LDDate',$LDDate);
	
	//gjergji : new calendar
	require_once ('../../js/jscalendar/calendar.php');
	$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
	$calendar->load_files();
	//end gjergji
	
	if($released){
		$smarty->assign('released',TRUE);
		$smarty->assign('x_date',nl2br($x_date));
	}else{
		//gjergji : new calendar
		$smarty->assign('sDateMiniCalendar',$calendar->show_calendar($calendar,$date_format,'x_date'));
		//end gjergji
	}
	$smarty->assign('LDClockTime',$LDClockTime);

	if($released) $smarty->assign('x_time',nl2br($x_time));
		else $smarty->assign('sTimeInput','<input type="text" name="x_time" size=12 maxlength=12 value="'.convertTimeToLocal(date('H:i:s')).'" onKeyUp=setTime(this,\''.$lang.'\')>');
	$smarty->assign('LDReleaseType',$LDReleaseType);

	$sTemp = '';
	if($released){

		while($dis_type=$discharge_types->FetchRow()){
			if($dis_type['nr']==$relart){
				$sTemp = $sTemp.'&nbsp;';
				if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) $sTemp = $sTemp.$$dis_type['LD_var'];
					else $sTemp = $sTemp.$dis_type['name'];
				break;
			}
		}
	}else{
		$init=1;
		while($dis_type=$discharge_types->FetchRow()){
              # We will display only discharge types 1 to 7
              if($dis_type['nr']<8){
			     $sTemp = $sTemp.'&nbsp;';
			     $sTemp = $sTemp.'<input type="radio" name="relart" value="'.$dis_type['nr'].'"';
			     if($init){
				    $sTemp = $sTemp.' checked';
				    $init=0;
		         }
			     $sTemp = $sTemp.'>';
			     if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) $sTemp = $sTemp.$$dis_type['LD_var'];
				    else $sTemp = $sTemp.$dis_type['name'];
			     $sTemp = $sTemp.'<br>';
              }
		}
	}
	$smarty->assign('sDischargeTypes',$sTemp);

	$smarty->assign('LDNotes',$LDNotes);

	if($released) $smarty->assign('info',nl2br($info));

	$smarty->assign('LDNurse',$LDNurse);

	$smarty->assign('encoder',$encoder);

	if(!(($mode=='release')&&($released))) {

		$smarty->assign('bShowValidator',TRUE);
		$smarty->assign('pbSubmit','<input type="submit" value="'.$LDRelease.'">');
		$smarty->assign('sValidatorCheckBox','<input type="checkbox" name="sure" value="1">');
		$smarty->assign('LDYesSure',$LDYesSure);
	}

	$sTemp = '<input type="hidden" name="mode" value="release">';

	if(($released)||($lock)) $sTemp = $sTemp.'<input type="hidden" name="lock" value="1">';

	$sTemp = $sTemp.'<input type="hidden" name="sid" value="'.$sid.'">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type="hidden" name="station" value="'.$station.'">
		<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
		<input type="hidden" name="dept" value="'.$dept.'">
		<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
		<input type="hidden" name="pday" value="'.$pday.'">
		<input type="hidden" name="pmonth" value="'.$pmonth.'">
		<input type="hidden" name="pyear" value="'.$pyear.'">
		<input type="hidden" name="rm" value="'.$rm.'">
		<input type="hidden" name="bd" value="'.$bd.'">
		<input type="hidden" name="pn" value="'.$pn.'">
		<input type="hidden" name="s_date" value="'."$pyear-$pmonth-$pday".'">';

	$smarty->assign('sHiddenInputs',$sTemp);


}else{
	$smarty->assign('sPrompt',"$LDErrorOccured $LDTellEdpIfPersist");
}

if(($mode=='release')&&($released)) $sBreakButton= '<img '.createLDImgSrc($root_path,'close2.gif','0').'>';
	else $sBreakButton= '<img '.createLDImgSrc($root_path,'cancel.gif','0').' border="0">';

$smarty->assign('pbCancel','<a href="'.$breakfile.'">'.$sBreakButton.'</a>');

$smarty->assign('sMainBlockIncludeFile','nursing/discharge_patient_form.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>