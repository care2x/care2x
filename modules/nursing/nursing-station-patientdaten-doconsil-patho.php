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
$lang_tables[]='departments.php';
define('LANG_FILE','konsil.php');

/* We need to differentiate from where the user is coming:
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile='nursing-station-patientdaten-doconsil-patho.php';

$bgc1='#cde1ec'; 
//$konsil="patho";
$formtitle=$LDPathology;

$db_request_table='patho';

//$db->debug=1;

define('_BATCH_NR_INIT_',20000000);
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/
						
/* Here begins the real work */

require_once($root_path.'include/inc_date_format_functions.php');

require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

     /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn)&&$pn)
	 {		

	    if( $enc_obj->loadEncounterData($pn)) {
			$full_en=$pn;
			if($enc_obj->is_loaded){
				$result=&$enc_obj->encounter;
			}
		}else{
	      	$edit=0;
		  	$mode='';
		  	$pn='';
	   	}		
	}

	   
	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_request_".$db_request_table." 
								          (
										   batch_nr, encounter_nr, dept_nr, quick_cut, 
										   qc_phone, quick_diagnosis, qd_phone, material_type, 
										   material_desc, localization, clinical_note, extra_note, 
										   repeat_note, gyn_last_period, gyn_period_type, 
										   gyn_gravida, gyn_menopause_since, 
										   gyn_hysterectomy, gyn_contraceptive, 
										   gyn_iud, gyn_hormone_therapy, 
										   doctor_sign, op_date, send_date,
										   status, history, create_id, create_time)
										   VALUES 
										   (
										   '".$batch_nr."','".$pn."','".$dept_nr."', '".$quick_cut."', 
										   '".$qc_phone."', '".$quick_diagnosis."', '".$qd_phone."', '".$material_type."', 
										   '".addslashes(htmlspecialchars($material_desc))."', '".addslashes(htmlspecialchars($localization))."', '".addslashes(htmlspecialchars($clinical_note))."', '".addslashes(htmlspecialchars($extra_note))."', 
										   '".addslashes(htmlspecialchars($repeat_note))."', '".addslashes($gyn_last_period)."', '".addslashes($gyn_period_type)."', 
										   '".addslashes($gyn_gravida)."', '".addslashes($gyn_menopause_since)."', 
										   '".addslashes($gyn_hysterectomy)."', '".addslashes($gyn_contraceptive)."', 
										   '".addslashes($gyn_iud)."', '".addslashes($gyn_hormone_therapy)."', 
										   '".addslashes($doctor_sign)."', '".formatDate2Std($op_date,$date_format)."', '".date('Y-m-d H:i:s')."',
										   '".$status."',
										   'Create: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n',
										   '".$_SESSION['sess_user_name']."', '".date('YmdHis')."'
										   )";


							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=insert&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize&batch_nr=$batch_nr");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
								
								break; // end of case 'save'
								
		     case 'update':
			 
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
								          dept_nr = '".$dept_nr."', 
										  quick_cut = '".$quick_cut."', 
										  qc_phone = '".$qc_phone."', 
										  quick_diagnosis = '".$quick_diagnosis."',
										  qd_phone = '".$qd_phone."', 
										  material_type = '".$material_type."',
										  material_desc = '".htmlspecialchars($material_desc)."', 
										  localization = '".htmlspecialchars($localization)."',
										  clinical_note = '".htmlspecialchars($clinical_note)."', 
										  extra_note = '".htmlspecialchars($extra_note)."', 
										  repeat_note = '".htmlspecialchars($repeat_note)."',
										  gyn_last_period = '".htmlspecialchars($gyn_last_period)."', 
										  gyn_period_type = '".htmlspecialchars($gyn_period_type)."', 
										  gyn_gravida = '".htmlspecialchars($gyn_gravida)."',
										  gyn_menopause_since = '".htmlspecialchars($gyn_menopause_since)."', 
										  gyn_hysterectomy = '".htmlspecialchars($gyn_hysterectomy)."',
										  gyn_contraceptive = '".htmlspecialchars($gyn_contraceptive)."', 
										  gyn_iud = '".htmlspecialchars($gyn_iud)."', 
										  gyn_hormone_therapy = '".htmlspecialchars($gyn_hormone_therapy)."',
										  doctor_sign = '".htmlspecialchars($doctor_sign)."', 
										  op_date = '".formatDate2STD($op_date,$date_format)."',
										  status = '".$status."', 
										  history = ".$enc_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										  modify_id = '".$_SESSION['sess_user_name']."',
										  modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*
			*  If the "parameter" element is not empty, parse it to the $stored_param variable
			*/
			case 'edit':
			
		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft' OR status='')";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   $edit_form=1;

					         }
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode='';
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get a new batch number */
		  {
		                $sql="SELECT batch_nr FROM care_test_request_".$db_request_table." ORDER BY batch_nr DESC";
		                if($ergebnis=$db->SelectLimit($sql,1))
       		            {
				            if($batchrows=$ergebnis->RecordCount())
					        {
						       $bnr=$ergebnis->FetchRow();
							   $batch_nr=$bnr['batch_nr'];
							   if(!$batch_nr) $batch_nr=_BATCH_NR_INIT_; else $batch_nr++;
					         }
					         else
					         {
					            $batch_nr=_BATCH_NR_INIT_;
					          }
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode="save";
		   }

# Start the smarty templating
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 # param 2 = initialize gui
 # param 3 = display copyright footer
 # param 4 = load standard javascripts

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

 if(!isset($edit) || empty($edit)) $smarty->assign('edit',FALSE);

 $smarty->assign('bgc1',$bgc1);

# Title in toolbar

 $smarty->assign('sToolbarTitle',"$LDDiagnosticTest ::  $formtitle");

 if($user_origin=='lab' && $edit){
	$smarty->assign('pbAux1',$thisfile."?sid=$sid&lang=$lang&station=$station&user_origin=$user_origin&status=$status&target=patho&noresize=$noresize");
	$smarty->assign('gifAux1',createLDImgSrc($root_path,'newpat2.gif','0') );
 }

 # href for help button
 $smarty->assign('pbHelp','javascript:gethelp(\'request_patho.php\')');

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDDiagnosticTest ::  $formtitle");
 $smarty->assign('Name',$station);

 # Space gif for the input blocks

 $smarty->assign('gifVSpacer','<img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">');

 /**
 * collect JavaScript for Smarty
 */

 ob_start();

 ?>
<script language="javascript">
<!--

function chkForm(d){

    if((d.quick_cut.checked)&&(d.qc_phone.value==''))
	{
		alert("<?php echo $LDAlertQuickCut."\\n".$LDPlsEnterPhone ?>");
		d.qc_phone.focus();
		return false;
	}
	else if((!d.quick_cut.checked)&&(d.qc_phone.value!=''))
	        {
	            d.qc_phone.value='';
	        }
	 
    if((d.quick_diagnosis.checked)&&(d.qd_phone.value==''))
	{
		alert("<?php echo $LDAlertQuickDiagnosis."\\n".$LDPlsEnterPhone ?>");
		d.qd_phone.focus();
		return false;
	}
	else if((!d.quick_diagnosis.checked)&&(d.qd_phone.value!=''))
	        {
	            d.qd_phone.value='';
	        }
	
   if((d.op_date.value=='')||(d.op_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterOpDate ?>");
		d.op_date.focus();
		return false;
	}
	
    if((d.doctor_sign.value=='')||(d.doctor_sign.value==' '))
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.doctor_sign.focus();
		return false;
	}
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$jsbuffer='onLoad="if (window.focus) window.focus(); ';

if($pn=="") $smarty->assign('sOnLoadJs',$jsbuffer.' document.searchform.searchkey.focus();"');
	else $smarty->assign('sOnLoadJs',$jsbuffer.'"');

# Set the javascript resizer code
if(!$noresize){
	$smarty->assign('js_noresize','
<script>
      window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>');
}else{
	$smarty->assign('js_noresize','');
}

if($edit){

	$smarty->assign('edit',TRUE);

	# collect output to buffer
	ob_start();

?>
		<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php
	
	/* If in edit mode display the control buttons */
	$controls_table_width=700;

	require($root_path.'include/inc_test_request_controls.php');

 	$sTemp = ob_get_contents();
 	ob_end_clean();
 	$smarty->assign('form_headers',$sTemp);

}elseif(!$read_form && !$no_proc_assist){

	$smarty->assign('show_selectprompt',TRUE);
	$smarty->assign('imgAngledown','<img '.createComIcon($root_path,'angle_down_l.gif','0').'>');
    $smarty->assign('LDPlsSelectPatientFirst',$LDPlsSelectPatientFirst);
    $smarty->assign('imgMascot','<img '.createMascot($root_path,'mascot1_l.gif','0','absmiddle').'>');

}

if($edit){
	$smarty->assign('barcode_label_single_large','<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php'.URL_REDIRECT_APPEND.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>');
}elseif($pn==""){
	$smarty->assign('show_searchmask',TRUE);
	# Collect buffer output
	ob_start();
		$searchmask_bgcolor="#f3f3f3";
		include($root_path.'include/inc_test_request_searchmask.php');
		$sTemp = ob_get_contents();
	ob_end_clean();
	$smarty->assign('searchmask',$sTemp);
}

 $smarty->assign('formtitle',$formtitle);
 $smarty->assign('LDTel',$LDTel);
 $smarty->assign('LDEntryDate',$LDEntryDate);
 $smarty->assign('LDJournalNumber',$LDJournalNumber);
 $smarty->assign('LDBlockNumber',$LDBlockNumber);
 $smarty->assign('LDDeepCuts',$LDDeepCuts);
 $smarty->assign('LDSpecialDye',$LDSpecialDye);
 $smarty->assign('LDImmuneHistoChem',$LDImmuneHistoChem);
 $smarty->assign('LDHormoneReceptors',$LDHormoneReceptors);
 $smarty->assign('LDSpecials',$LDSpecials);

 $tpbuffer='<input type="checkbox" name="quick_cut" value="1"';
 if($mode=="edit" && $stored_request['quick_cut'])  $tpbuffer.=' checked';
 $smarty->assign('input_quick_cut',$tpbuffer.'>');

 $smarty->assign('LDSpeedCut',$LDSpeedCut);
 $smarty->assign('LDRelayResult',$LDRelayResult);
 
 $tpbuffer= '';
 if($mode=="edit") $tpbuffer.=$stored_request['qc_phone'];
 $smarty->assign('input_qc_phone',$tpbuffer);

 $smarty->assign('batch_nr',$batch_nr);
 $smarty->assign('gifBatchBarcode',"<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>");
 
 $tpbuffer='<input type="checkbox" name="quick_diagnosis" value="1"';
 if($mode=="edit" && $stored_request['quick_diagnosis']) $tpbuffer.=' checked';
 $smarty->assign('input_quick_diagnosis',$tpbuffer.'>');

 $smarty->assign('LDSpeedTest',$LDSpeedTest);
 $smarty->assign('LDRelayResult',$LDRelayResult);
 
 $tpbuffer='';
 if($mode=="edit") $tpbuffer.=$stored_request['qd_phone'];
 $smarty->assign('input_qd_phone',$tpbuffer);

 $smarty->assign('LDSpecialNotice',$LDSpecialNotice);
 $smarty->assign('LDMatType',$LDMatType);
 
 $tpbuffer='<input type="radio" name="material_type" value="pe"';
 if($mode=="edit" && $stored_request['material_type']=="pe") $tpbuffer.= "checked";
 $smarty->assign('input_material_type_pe',$tpbuffer.'>');
 $smarty->assign('LDPE',$LDPE);
 
 $tpbuffer='<input type="radio" name="material_type" value="op_specimen"';
 if($mode=="edit" && $stored_request['material_type']=="op_specimen") $tpbuffer.=" checked";
 $smarty->assign('input_material_type_op_specimen',$tpbuffer.'>');
 $smarty->assign('LDSpecimen',$LDSpecimen);

 $tpbuffer='<input type="radio" name="material_type" value="shave"';
 if($mode=="edit" && $stored_request['material_type']=="shave") $tpbuffer.= " checked";
 $smarty->assign('input_material_type_shave',$tpbuffer.'>');
 $smarty->assign('LDShave',$LDShave);
 
 $tpbuffer='<input type="radio" name="material_type" value="cytology"';
 if($mode=="edit" && $stored_request['material_type']=="cytology") $tpbuffer.= " checked";
 $smarty->assign('input_material_type_cytology',$tpbuffer.'>');
 $smarty->assign('LDCytology',$LDCytology);

 if($mode=="edit") $smarty->assign('val_material_desc', stripslashes($stored_request['material_desc']));

 $smarty->assign('LDLocalization',$LDLocalization);
 if($mode=="edit") $smarty->assign('val_localization', stripslashes($stored_request['localization']));

 $smarty->assign('LDClinicalQuestions',$LDClinicalQuestions);
 if($mode=="edit") $smarty->assign('val_clinical_note', stripslashes($stored_request['clinical_note']));

 $smarty->assign('LDExtraInfo',$LDExtraInfo);
 $smarty->assign('LDExtraInfoSample',$LDExtraInfoSample);
 if($mode=="edit") $smarty->assign('val_extra_note', stripslashes($stored_request['extra_note']));

 $smarty->assign('LDRepeatedTest',$LDRepeatedTest);
 $smarty->assign('LDRepeatedTestPls',$LDRepeatedTestPls);

 if($mode=="edit") $smarty->assign('val_repeat_note', stripslashes($stored_request['repeat_note']));

 $smarty->assign('LDForGynTests',$LDForGynTests);
 $smarty->assign('LDLastPeriod',$LDLastPeriod);

 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_last_period']);
 $smarty->assign('val_gyn_last_period',$tpbuffer);

 $smarty->assign('LDMenopauseSince',$LDMenopauseSince);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_menopause_since']);
 $smarty->assign('val_gyn_menopause_since',$tpbuffer);

 $smarty->assign('LDHormoneTherapy',$LDHormoneTherapy);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_hormone_therapy']);
 $smarty->assign('val_gyn_hormone_therapy',$tpbuffer);

 $smarty->assign('LDPeriodType',$LDPeriodType);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_period_type']);
 $smarty->assign('val_gyn_period_type',$tpbuffer);

 $smarty->assign('LDHysterectomy',$LDHysterectomy);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_hysterectomy']);
 $smarty->assign('val_gyn_hysterectomy',$tpbuffer);

 $smarty->assign('LDIUD',$LDIUD);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_iud']);
 $smarty->assign('val_gyn_iud',$tpbuffer);

 $smarty->assign('LDGravidity',$LDGravidity);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_gravida']);
 $smarty->assign('val_gyn_gravida',$tpbuffer);

 $smarty->assign('LDContraceptive',$LDContraceptive);
 $tpbuffer='';
 if($mode=="edit") $tpbuffer= stripslashes($stored_request['gyn_contraceptive']);
 $smarty->assign('val_gyn_contraceptive',$tpbuffer);

 $smarty->assign('LDOpDate',$LDOpDate);
 
	//gjergji : new calendar
	require_once ('../../js/jscalendar/calendar.php');
	$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
	$calendar->load_files();
	$smarty->assign('inputOpDate',$calendar->show_calendar($calendar,$date_format,'op_date',$stored_request['op_date']));
	//end : gjergji
	
  $smarty->assign('LDDoctor',$LDDoctor);
  $smarty->assign('LDDept',$LDDept);
  if($mode=="edit") $smarty->assign('val_doctor_sign',stripslashes($stored_request['doctor_sign']));

if($edit){

	# Collect buffer output
	ob_start();

	/* If in edit mode display the control buttons */
	include($root_path.'include/inc_test_request_controls.php');

	include($root_path.'include/inc_test_request_hiddenvars.php');

	echo '</form>';

	$sTemp = ob_get_contents();
	ob_end_clean();
	$smarty->assign('form_footers',$sTemp);
}

 /**
 * show Template
 */

 $smarty->assign('sMainBlockIncludeFile','laboratory/request_pathology.tpl');
 // $smarty->display('debug.tpl');

 $smarty->display('common/mainframe.tpl');
?>
