<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
 * GNU General Public License
 * Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
$lang_tables = array ('departments.php' );
define ( 'LANG_FILE', 'konsil.php' );
$local_user = 'ck_lab_user';

require_once ($root_path . 'include/inc_front_chain_lang.php');
require_once ($root_path . 'global_conf/inc_global_address.php');
require_once ($root_path . 'include/inc_test_findings_fx_baclabor.php');
require_once ($root_path . 'include/inc_test_request_vars_baclabor.php');
require_once ($root_path . 'include/inc_diagnostics_report_fx.php');

/* Load additional language table */
if (file_exists ( $root_path . 'language/' . $lang . '/lang_' . $lang . '_konsil_baclabor.php' ))
	include_once ($root_path . 'language/' . $lang . '/lang_' . $lang . '_konsil_baclabor.php');
else
	include_once ($root_path . 'language/' . LANG_DEFAULT . '/lang_' . LANG_DEFAULT . '_konsil_baclabor.php');

$breakfile = 'labor.php' . URL_APPEND;
$returnfile = 'labor_test_request_admin_' . $subtarget . '.php' . URL_APPEND . '&target=' . $target . '&subtarget=' . $subtarget . '&user_origin=' . $user_origin . '&batch_nr=' . $batch_nr . '&pn=' . $pn . '&tracker=' . $tracker;

$thisfile = 'labor_test_findings_' . $subtarget . '.php';

///$db->debug = 1;

$bgc1 = '#fff3f3';
$edit = 0; /* Assume to not edit first */
$read_form = 1;
$edit_findings = 1;

//$konsil="patho";
$formtitle = $LDBacteriologicalLaboratory;
$dept_nr = 25; // 25 = department nr. of bacteriological lab
$db_request_table = $subtarget;
$db_request_table_sub = $subtarget . "_sub";

require_once ($root_path . 'include/care_api_classes/class_encounter.php');
$enc_obj = new Encounter ( );
//use this methods instead of using SQL inside the code
include_once ($root_path . 'include/care_api_classes/class_diagnostics.php');
$bac_obj = new Diagnostics ( );
$bac_obj->useBacLabFindingsTable ();
$bac_obj_sub = new Diagnostics ( );
$bac_obj_sub->useBacLabFindingsSubTable ();
/* Here begins the real work */
/* Establish db connection */
require_once ($root_path . 'include/inc_date_format_functions.php');
/* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
if (isset ( $pn ) && $pn) {
	
	if ($enc_obj->loadEncounterData ( $pn )) {
		
		include_once ($root_path . 'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG = array ();
		$glob_obj = new GlobalConfig ( $GLOBAL_CONFIG );
		$glob_obj->getConfig ( 'patient_%' );
		switch ($enc_obj->EncounterClass ()) {
			case '1' :
				$full_en = ($pn + $GLOBAL_CONFIG ['patient_inpatient_nr_adder']);
		                   break;
			case '2' :
				$full_en = ($pn + $GLOBAL_CONFIG ['patient_outpatient_nr_adder']);
							break;
			default :
				$full_en = ($pn + $GLOBAL_CONFIG ['patient_inpatient_nr_adder']);
			}						

		$result = &$enc_obj->encounter;
	} else {
		$edit = 0;
		$mode = '';
		$pn = '';
     }
}

if (! isset ( $mode ) && $batch_nr && $pn)
	$mode = 'edit_findings';
	 
if ($mode == 'save' || $mode == 'update') {
	 	 /* Process the variables */
	$type_general = &processFindings ( $lab_TestType, 0 );
								 
	$resist_ana_1 = &processFindings ( $lab_ResistANaerob_1, 1 );
	$resist_ana_2 = &processFindings ( $lab_ResistANaerob_2, 1 );
	$resist_ana_3 = &processFindings ( $lab_ResistANaerob_3, 1 );
	
	$resist_anaerob = $resist_ana_1 . '&' . $resist_ana_2 . '&' . $resist_ana_3;
	
	$resist_a_1 = &processFindings ( $lab_ResistAerob_1, 1 );
	$resist_a_2 = &processFindings ( $lab_ResistAerob_2, 1 );
	$resist_a_3 = &processFindings ( $lab_ResistAerob_3, 1 );
	$resist_a_x = &processFindings ( $lab_ResistAerobExtra_1, 1 );
	$resist_a_x2 = &processFindings ( $lab_ResistAerobExtra_2, 1 );
	$resist_a_x3 = &processFindings ( $lab_ResistAerobExtra_3, 1 );
	
	$resist_aerob = $resist_a_1 . '&' . $resist_a_2 . '&' . $resist_a_3 . '&' . $resist_a_x . '&' . $resist_a_x2 . '&' . $resist_a_x3;
	
	$findings_1 = &processFindings ( $lab_TestResult_1, 1 );
	$findings_2 = &processFindings ( $lab_TestResult_2, 1 );
	$findings_3 = &processFindings ( $lab_TestResult_3, 1 );
	
	$findings = $findings_1 . '&' . $findings_2 . '&' . $findings_3;
}
switch ($mode) {
	case 'save' :
		$data ['batch_nr'] = $batch_nr;
		$data ['encounter_nr'] = $pn;
		$data ['room_nr'] = $room_nr;
		$data ['dept_nr'] = $dept_nr;
		$data ['notes'] = htmlspecialchars ( $notes );
		$data ['findings_init'] = $findings_init;
		$data ['findings_current'] = $findings_current;
		$data ['findings_final'] = $findings_final;
		$data ['entry_nr'] = $entry_nr;
		$data ['rec_date'] = formatDate2Std ( $rec_date, $date_format );
		$data ['doctor_id'] = $doctor_id;
		$data ['status'] = 'initial';
		$data ['history'] = "Create: " . date ( 'Y-m.d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n";
		$data ['create_id'] = $_SESSION ['sess_user_name'];
		$data ['create_time'] = date ( 'YmdHis' );
		$bac_obj->setDataArray ( $data );
		if ($bac_obj->insertDataFromInternalArray ()) {
			//type general
			$singleParamTypeGeneral = explode ( "&", $type_general );
			foreach ( $singleParamTypeGeneral as $key => $value ) {
				$tmpTest = explode ( "=", $value );
				if($tmpTest[0] != '' ) {
					$singleParamTG ['batch_nr'] = $batch_nr;
					$singleParamTG ['encounter_nr'] = $pn;
					$singleParamTG ['type_general'] = $tmpTest[0];
					$singleParamTG ['status'] = 'initial';
					$singleParamTG ['history'] = "Create: " . date ( 'Y-m.d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n";
					$singleParamTG ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamTG ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamTG );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//resist anaerob
			$singleParamResistAnaerob = explode ( "&", $resist_anaerob );
			foreach ( $singleParamResistAnaerob as $key => $value ) {
				$tmpTest = explode ( "=", $value );
				if($tmpTest[0] != '' ) {
					$singleParamRA ['batch_nr'] = $batch_nr;
					$singleParamRA ['encounter_nr'] = $pn;
					$singleParamRA ['resist_anaerob'] = $tmpTest[0];
					$singleParamTG ['type_general'] = '0';
					$singleParamRA ['status'] = 'initial';
					$singleParamRA ['history'] = "Create: " . date ( 'Y-m.d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n";
					$singleParamRA ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamRA ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamRA );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//resist aerob
			$singleParamResistAerob = explode ( "&", $resist_aerob );
			foreach ( $singleParamResistAerob as $key => $value ) {
				$tmpTest = explode ( "=", $value );
				if($tmpTest[0] != '' ) {
					$singleParamRAE ['batch_nr'] = $batch_nr;
					$singleParamRAE ['encounter_nr'] = $pn;
					$singleParamRAE ['resist_aerob'] = $tmpTest[0];
					$singleParamRAE ['resist_anaerob'] = '0';
					$singleParamRAE ['type_general'] = '0';
					$singleParamRAE ['status'] = 'initial';
					$singleParamRAE ['history'] = "Create: " . date ( 'Y-m.d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n";
					$singleParamRAE ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamRAE ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamRAE );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//findings
			$singleParamFindings = explode ( "&", $findings );
			foreach ( $singleParamFindings as $key => $value ) {
				$tmpTest = explode ( "=", $value ); 
				if($tmpTest[0] != '' ) {
					$singleParamF ['batch_nr'] = $batch_nr;
					$singleParamF ['encounter_nr'] = $pn;
					$singleParamF ['findings'] = $tmpTest[0];
					$singleParamF ['resist_aerob'] = '0';
					$singleParamF ['resist_anaerob'] = '0';
					$singleParamF ['type_general'] = '0';
					$singleParamF ['status'] = 'initial';
					$singleParamF ['history'] = "Create: " . date ( 'Y-m.d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n";
					$singleParamF ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamF ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamF );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
	  }
			signalNewDiagnosticsReportEvent ();
									//echo $sql;
			header ( "location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date" );
			exit ();
		} else {
								     echo "<p>$sql<p>$LDDbNoSave"; 
			$mode = "";
								  }
								
								break; // end of case 'save'
								
			 
	case 'update' :
										   							  							
		$data ['batch_nr'] = $batch_nr;
		$data ['encounter_nr'] = $pn;
		$data ['room_nr'] = $room_nr;
		$data ['dept_nr'] = $dept_nr;
		$data ['notes'] = htmlspecialchars ( $notes );
		$data ['findings_init'] = $findings_init;
		$data ['findings_current'] = $findings_current;
		$data ['findings_final'] = $findings_final;
		$data ['entry_nr'] = $entry_nr;
		$data ['rec_date'] = formatDate2Std ( $rec_date, $date_format );
		$data ['doctor_id'] = $doctor_id;
		$data ['status'] = 'initial';
		$data ['history'] = $enc_obj->ConcatHistory ( "Update: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
		$data ['create_id'] = $_SESSION ['sess_user_name'];
		$data ['create_time'] = date ( 'YmdHis' );
		$bac_obj->setDataArray ( $data );
		$bac_obj->setWhereCond ( " batch_nr=$batch_nr" );
		if ($bac_obj->updateDataFromInternalArray ( $batch_nr )) {
			//sub values management
			//$diag_obj->useChemLabRequestSubTable();
			//first i delete the old request values
			//then i insert the new ones.
			$bac_obj_sub->deleteOldValues ( $batch_nr, $pn );
			$singleParamTypeGeneral = explode ( "&", $type_general );
			foreach ( $singleParamTypeGeneral as $key => $value ) {
				$tmpTest = explode ( "=", $value );
				if($tmpTest[0] != '' ) {
					$singleParamTG ['batch_nr'] = $batch_nr;
					$singleParamTG ['encounter_nr'] = $pn;
					$singleParamTG ['type_general'] = $tmpTest[0];
					$singleParamTG ['status'] = 'initial';
					$singleParamTG ['history'] = $enc_obj->ConcatHistory ( "Update: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
					$singleParamTG ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamTG ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamTG );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//resist anaerob
			$singleParamResistAnaerob = explode ( "&", $resist_anaerob );
			foreach ( $singleParamResistAnaerob as $key => $value ) {
				$tmpTest = explode ( "=", $value );
				if($tmpTest[0] != '' ) {			
					$singleParamRA ['batch_nr'] = $batch_nr;
					$singleParamRA ['encounter_nr'] = $pn;
					$singleParamRA ['resist_anaerob'] = $tmpTest[0];
					$singleParamRA ['type_general'] = '0';
					$singleParamRA ['status'] = 'initial';
					$singleParamRA ['history'] = $enc_obj->ConcatHistory ( "Update: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
					$singleParamRA ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamRA ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamRA );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//resist aerob
			$singleParamResistAerob = explode ( "&", $resist_aerob );
			foreach ( $singleParamResistAerob as $key => $value ) {
				$tmpTest = explode ( "=", $value );	
				if($tmpTest[0] != '' ) {		
					$singleParamRAE ['batch_nr'] = $batch_nr;
					$singleParamRAE ['encounter_nr'] = $pn;
					$singleParamRAE ['resist_aerob'] = $tmpTest[0];
					$singleParamRAE ['resist_anaerob'] = '0';
					$singleParamRAE ['type_general'] = '0';
					$singleParamRAE ['status'] = 'initial';
					$singleParamRAE ['history'] = $enc_obj->ConcatHistory ( "Update: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
					$singleParamRAE ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamRAE ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamRAE );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			//findings
			$singleParamFindings = explode ( "&", $findings );
			foreach ( $singleParamFindings as $key => $value ) {
				$tmpTest = explode ( "=", $value );	
				if($tmpTest[0] != '' ) {	
					$singleParamF ['batch_nr'] = $batch_nr;
					$singleParamF ['encounter_nr'] = $pn;
					$singleParamF ['findings'] = $tmpTest[0];
					$singleParamF ['resist_aerob'] = '0';
					$singleParamF ['resist_anaerob'] = '0';
					$singleParamF ['type_general'] = '0';
					$singleParamF ['status'] = 'initial';
					$singleParamF ['history'] = $enc_obj->ConcatHistory ( "Update: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
					$singleParamF ['create_id'] = $_SESSION ['sess_user_name'];
					$singleParamF ['create_time'] = date ( 'YmdHis' );
					$bac_obj_sub->setDataArray ( $singleParamF );
					$bac_obj_sub->insertDataFromInternalArray ();
				}
			}
			signalNewDiagnosticsReportEvent ();
			header ( "location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date" );
			exit ();
		} else {
								      echo "<p>$sql<p>$LDDbNoSave"; 
			$mode = "";
								   }
								
								break; // end of case 'save'
								
										  							
	case 'done' :
		$data['status'] = 'done';
		$data['history'] = $enc_obj->ConcatHistory ( "Done: " . date ( 'Y-m-d H:i:s' ) . " = " . $_SESSION ['sess_user_name'] . "\n" );
		$data['modify_id'] =  $_SESSION ['sess_user_name'];
		$data['modify_time'] =  date ( 'YmdHis' );
		$bac_obj->setDataArray ( $data );
		$bac_obj->setWhereCond ( " batch_nr=$batch_nr" );
		if ($bac_obj->updateDataFromInternalArray ( $batch_nr )) {	
			$bac_obj_sub->setDataArray ( $data );
			$bac_obj_sub->setWhereCond ( " batch_nr=$batch_nr" );		
			if ($bac_obj_sub->updateDataFromInternalArray ( $batch_nr )) {
				$bac_obj->useBacLabRequestTable();
				$bac_obj->setDataArray($data);	
				$bac_obj->setWhereCond ( " batch_nr=$batch_nr" );
				$bac_obj->updateDataFromInternalArray ( $batch_nr );
								  		// Load the visual signalling functions
				include_once ($root_path . 'include/inc_visual_signalling_fx.php');
										// Set the visual signal 
				setEventSignalColor ( $pn, SIGNAL_COLOR_DIAGNOSTICS_REPORT );
				header ( "location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date" );
				exit ();
			} else {
								          echo "<p>$sql<p>$LDDbNoSave"; 
				$mode = 'save';
									}
		} else {
								      echo "<p>$sql<p>$LDDbNoSave"; 
			$mode = 'save';
								   }
								
								break; // end of case 'save'
	        

			/* If mode is edit, get the stored test findings */
	case 'edit_findings' :
							   
	    $sql  = "SELECT * FROM care_test_findings_".$db_request_table." ";
		$sql .= "INNER JOIN care_test_findings_".$db_request_table_sub." ON ";
		$sql .= "( care_test_findings_".$db_request_table.".batch_nr = care_test_findings_".$db_request_table_sub.".batch_nr) ";
		$sql .= "WHERE care_test_findings_".$db_request_table.".batch_nr='".$batch_nr."' ";

		if ($ergebnis = $db->Execute ( $sql )) {
			if ($editable_rows = $ergebnis->RecordCount ()) {
			    while ( !$ergebnis->EOF ) {
					$parsed_type[$ergebnis->fields['type_general']] = $ergebnis->fields['type_general'];
					$parsed_resist_anaerob[$ergebnis->fields['resist_anaerob']] = $ergebnis->fields['resist_anaerob'];
					$parsed_resist_aerob[$ergebnis->fields['resist_aerob']] = $ergebnis->fields['resist_aerob'];
					$parsed_findings[$ergebnis->fields['findings']] = $ergebnis->fields['findings'];
					$stored_findings=$ergebnis->GetRowAssoc($toUpper=false);
					$ergebnis->MoveNext();
				}					
		
				if ($stored_findings ['status'] == "done")
					$edit_findings = 0; /* Inhibit editing of the findings */
				
				$mode = 'update';
				$edit_form = 1;
			} else {
				$mode = 'save';
					         }
		} else {
			$mode = 'save';
						  }
						 
						 break; ///* End of case 'edit': */
						 
			 
	default :
		$mode = '';

} // end of switch($mode)


/* Get the stored request for displayint only*/			           
$sql  = "SELECT * FROM care_test_request_".$db_request_table." ";
$sql .= "INNER JOIN care_test_request_".$db_request_table_sub." ON ";
$sql .= "( care_test_request_".$db_request_table.".batch_nr = care_test_request_".$db_request_table_sub.".batch_nr) ";
$sql .= "WHERE care_test_request_".$db_request_table.".batch_nr='".$batch_nr."' ";

if ($ergebnis = $db->Execute ( $sql )) {
	if ($editable_rows = $ergebnis->RecordCount ()) {
	    while ( !$ergebnis->EOF ) {
			$stored_material[$ergebnis->fields['material']] = $ergebnis->fields['material'];
			$stored_test_type[$ergebnis->fields['test_type']] = $ergebnis->fields['test_type'];
			$stored_request=$ergebnis->GetRowAssoc($toUpper=false);
			$ergebnis->MoveNext();
		}			
		if ($stored_request ['status'] == 'done')
			$edit = 0; /* Inhibit editing of the findings */
		
		$edit_form = 1;
	} else {
		$mode = 'save';
		echo $sql;
	}
} else {
	$mode = 'save';
	echo $sql;
}

# Start Smarty templating here
/**
 * LOAD Smarty
 */

# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme


require_once ($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care ( 'common' );

# Title in toolbar
$smarty->assign ( 'sToolbarTitle', "$LDDiagnosticTest (#$batch_nr)" );

# href for help button
$smarty->assign ( 'pbHelp', "javascript:gethelp('pending_baclabor_findings.php')" );

# hide return  button
$smarty->assign ( 'pbBack', $returnfile );

# href for close button
$smarty->assign ( 'breakfile', $breakfile );

# Window bar title
$smarty->assign ( 'sWindowTitle', "$LDDiagnosticTest (#$batch_nr)" );

# Prepare Body onLoad javascript code
$sTemp = 'onLoad="if (window.focus) window.focus(); loadM(\'form_test_request\');"';

$smarty->assign ( 'sOnLoadJs', $sTemp );

# collect extra javascript code
ob_start ();
?>

<style type="text/css">
.lab {
	font-family: ms ui gothic;
	font-size: 9;
	color: #ee6666;
}

.lmargin {
	margin-left: 5;
}
</style>

<script language="javascript">
<!-- 
function chkForm(d){

   if((d.entry_nr.value=='')||(d.entry_nr.value==' '))
	{
		alert("<?php
		echo $LDPlsEnterLEN?>");
		d.entry_nr.focus();
		return false;
	}
	else  if((d.rec_date.value=='')||(d.rec_date.value==' '))
	{
		alert("<?php
		echo $LDPlsEnterDate?>");
		d.rec_date.focus();
		return false;
	}
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}


function setThis(prep,elem,begin,end,step)
{
  for(i=begin;i<end;i=i+step)
  {
     x=prep + i;
     if(elem!=i)
     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}


function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php
	echo $sid?>&lang=<?php
	echo $lang?>&user_origin=<?php
	echo $user_origin?>&subtarget=<?php
	echo $subtarget?>&batch_nr=<?php
	echo $batch_nr?>&pn=<?php
	echo $pn?>&entry_date=<?php
	echo $entry_date?>";
	findings_printout<?php
	echo $sid?>=window.open(urlholder,"findings_printout<?php
	echo $sid?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    findings_printout<?php
				echo $sid?>.print();
}
   
<?php
require ($root_path . 'include/inc_checkdate_lang.php');
?>
//-->
</script>

<?php
$sTemp = ob_get_contents ();
ob_end_clean ();

$smarty->append ( 'JavaScript', $sTemp );

# Buffer page output


ob_start ();

if ($edit_findings) {
	?>
<form name="form_test_request" method="post"
	action="<?php
	echo $thisfile?>" onSubmit="return chkForm(this)">
<?php
}

echo '<ul>';

if ($edit_findings) {
	?>
 <input type="image"
	<?php
	echo createLDImgSrc ( $root_path, 'savedisc.gif', '0' )?>>
<?php
}
?>  
 <a href="javascript:printOut()"><img
	<?php
	echo createLDImgSrc ( $root_path, 'printout.gif', '0' )?>></a>
<?php
if (isset ( $stored_findings ['status'] ) && $stored_findings ['status'] != 'done' && $stored_findings ['status'] != 'final') {
	echo '
         <a href="' . $thisfile . '?sid=' . $sid . '&lang=' . $lang . '&edit=' . $edit . '&mode=done&target=' . $target . '&subtarget=' . $subtarget . '&batch_nr=' . $batch_nr . '&pn=' . $pn . '&user_origin=' . $user_origin . '&entry_date=' . $entry_date . '"><img ' . createLDImgSrc ( $root_path, 'done.gif', '0' ) . '></a>';
}

/* Load the image functions */
require_once ($root_path . 'include/inc_test_request_printout_fx.php');
/* Load the findings part of the form */
require ($root_path . 'include/inc_test_findings_form_baclabor.php');

?>


<?php
if ($edit_findings) {
	/* Load the common hidden post vars */
	require ($root_path . "include/inc_test_request_hiddenvars.php");
	
	?>
<input type="hidden" name="entry_date"
	value="<?php
	echo $entry_date?>">
<?php
}

if ($edit_findings) {
	?>
 <input type="image"
	<?php
	echo createLDImgSrc ( $root_path, 'savedisc.gif', '0' )?>>
<?php
}
?>    
         <a href="javascript:printOut()"><img
	<?php
	echo createLDImgSrc ( $root_path, 'printout.gif', '0' )?>></a>
<?php
if (isset ( $stored_findings ['status'] ) && $stored_findings ['status'] != "done" && $stored_findings ['status'] != "final") {
	echo '
         <a href="' . $thisfile . '?sid=' . $sid . '&lang=' . $lang . '&edit=' . $edit . '&mode=done&target=' . $target . '&subtarget=' . $subtarget . '&batch_nr=' . $batch_nr . '&pn=' . $pn . '&user_origin=' . $user_origin . '&entry_date=' . $entry_date . '"><img ' . createLDImgSrc ( $root_path, 'done.gif', '0' ) . '></a>';
}

echo '</ul>';

if ($edit_findings)
	echo '</form>';

$sTemp = ob_get_contents ();
ob_end_clean ();

# Assign the page output to main frame template


$smarty->assign ( 'sMainFrameBlockData', $sTemp );

/**
 * show Template
 */
$smarty->display ( 'common/mainframe.tpl' );

?>
