<?php
if($edit || $read_form){
	$smarty->assign('barcode_label_single_large','<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>');
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
//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end gjergji
 # Collect buffer output
 ob_start();

 if($printmode){
	if($stored_request['entry_date']!=DBF_NODATE) $smarty->assign('entry_date', formatDate2Local($stored_request['entry_date'],$date_format));
 }else{

	if($stored_request['status']=='pending'){
		//gjergji : new calendar
		$smarty->assign('entry_date',$calendar->show_calendar($calendar,$date_format,'entry_date',$stored_request['entry_date']));
		//end gjergji
	}else{
		$smarty->assign('entry_date',@formatDate2Local($stored_request['entry_date'],$date_format));
	}
}

printLabInterns('journal_nr');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_journal_nr',$tpbuffer);

printLabInterns('blocks_nr');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_blocks_nr',$tpbuffer);

printLabInterns('deep_cuts');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_deep_cuts',$tpbuffer);

printLabInterns('special_dye');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_special_dye',$tpbuffer);

printLabInterns('immune_histochem');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_immune_histochem',$tpbuffer);

printLabInterns('hormone_receptors');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_hormone_receptors',$tpbuffer);

printLabInterns('specials');
$tpbuffer=ob_get_contents();
ob_clean();

$smarty->assign('val_specials',$tpbuffer);

ob_end_clean();

if($stored_request['quick_cut']) $smarty->assign('input_quick_cut','<img '.createComIcon($root_path,'chkbox_chk.gif','0','absmiddle'));
  else $smarty->assign('input_quick_cut','<img '.createComIcon($root_path,'chkbox_blk.gif','0','absmiddle'));

$smarty->assign('LDSpeedCut',$LDSpeedCut);
$smarty->assign('LDRelay',$LDRelayResult);

$smarty->assign('val_qc_phone',$stored_request['qc_phone']);
 
$smarty->assign('batch_nr',$batch_nr);

$smarty->assign('gifBatchBarcode',"<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>");


if($stored_request['quick_diagnosis']) $smarty->assign('input_quick_diagnosis','<img '.createComIcon($root_path,'chkbox_chk.gif','0','absmiddle').'>');
else $smarty->assign('input_quick_diagnosis', '<img '.createComIcon($root_path,'chkbox_blk.gif','0','absmiddle').'>');

$smarty->assign('LDSpeedTest',$LDSpeedTest);

$smarty->assign('LDRelayResult',$LDRelayResult);
$smarty->assign('val_qd_phone',$stored_request['qd_phone']);

$smarty->assign('LDSpecialNotice',$LDSpecialNotice);

$smarty->assign('LDMatType',$LDMatType);

if($stored_request['material_type']=="pe") $tpbuffer='<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle');
	else $tpbuffer='<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle');
$smarty->assign('input_material_type_pe',$tpbuffer.'>');

$smarty->assign('LDPE',$LDPE);

if($stored_request['material_type']=="op_specimen") $tpbuffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle');
	else $tpbuffer= '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle');
$smarty->assign('input_material_type_op_specimen',$tpbuffer.'>');

$smarty->assign('LDSpecimen',$LDSpecimen);

if($stored_request['material_type']=="shave") $tpbuffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle');
	else $tpbuffer= '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle');
$smarty->assign('input_material_type_shave',$tpbuffer.'>');

$smarty->assign('LDShave',$LDShave);

if($stored_request['material_type']=="cytology") $tpbuffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle');
	      else $tpbuffer= '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle');
$smarty->assign('input_material_type_cytology',$tpbuffer.'>');

$smarty->assign('LDCytology',$LDCytology);

$smarty->assign('val_material_desc',nl2br(stripslashes($stored_request['material_desc'])));

$smarty->assign('LDLocalization',$LDLocalization);
$smarty->assign('gifVSpacer','<img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">');

$smarty->assign('val_localization',nl2br(stripslashes($stored_request['localization'])));

$smarty->assign('LDClinicalQuestions',$LDClinicalQuestions);

$smarty->assign('val_clinical_note',nl2br(stripslashes($stored_request['clinical_note'])));

$smarty->assign('LDExtraInfo',$LDExtraInfo);
$smarty->assign('LDExtraInfoSample',$LDExtraInfoSample);

$smarty->assign('val_extra_note',nl2br(stripslashes($stored_request['extra_note'])));

$smarty->assign('LDRepeatedTest',$LDRepeatedTest);
$smarty->assign('LDRepeatedTestPls',$LDRepeatedTestPls);

$smarty->assign('val_repeat_note',nl2br(stripslashes($stored_request['repeat_note'])));

$smarty->assign('LDForGynTests',$LDForGynTests);

$smarty->assign('LDLastPeriod',$LDLastPeriod);
$smarty->assign('val_gyn_last_period',stripslashes($stored_request['gyn_last_period']));
$smarty->assign('LDMenopauseSince',$LDMenopauseSince);
$smarty->assign('val_gyn_menopause_since',stripslashes($stored_request['gyn_menopause_since']));
$smarty->assign('LDHormoneTherapy',$LDHormoneTherapy);
$smarty->assign('val_gyn_hormone_therapy',stripslashes($stored_request['gyn_hormone_therapy']));
$smarty->assign('LDPeriodType',$LDPeriodType);
$smarty->assign('val_gyn_period_type',stripslashes($stored_request['gyn_period_type']));
$smarty->assign('LDHysterectomy',$LDHysterectomy);
$smarty->assign('val_gyn_hysterectomy',stripslashes($stored_request['gyn_hysterectomy']));
$smarty->assign('LDIUD',$LDIUD);
$smarty->assign('val_gyn_iud',stripslashes($stored_request['gyn_iud']));
$smarty->assign('LDGravidity',$LDGravidity);
$smarty->assign('val_gyn_gravida',stripslashes($stored_request['gyn_gravida']));
$smarty->assign('LDContraceptive',$LDContraceptive);
$smarty->assign('val_gyn_contraceptive',stripslashes($stored_request['gyn_contraceptive']));

$smarty->assign('LDOpDate',$LDOpDate);
$smarty->assign('inputOpDate',@formatDate2Local($stored_request['op_date'],$date_format));

$smarty->assign('LDDoctor',$LDDoctor);
$smarty->assign('LDDept',$LDDept);
$smarty->assign('val_doctor_sign',stripslashes($stored_request['doctor_sign']));
?>
