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
$lang_tables [] = 'departments.php';
$lang_tables [] = 'konsil.php';
define ( 'LANG_FILE', 'lab.php' );
/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if ($user_origin == 'lab') {
	$local_user = 'ck_lab_user';
	if ($target == 'radio')
		$breakfile = $root_path . 'modules/radiology/radiolog.php' . URL_APPEND;
	else
		$breakfile = $root_path . 'modules/laboratory/labor.php' . URL_APPEND;
} else {
	$local_user = 'ck_pflege_user';
	$breakfile = $root_path . 'modules/nursing/nursing-station-patientdaten.php' . URL_APPEND . '&pn=' . $pn . '&station=' . $station . '&edit=' . $edit . '&user_origin=' . $user_origin;
}

require_once ($root_path . 'include/inc_front_chain_lang.php');

/**
 * LOAD Smarty
 */

# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme
require_once ($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care ( 'nursing' );

$thisfile = basename ( __FILE__ );

$db_request_table = $target;
$db_request_table_sub = $target . "_sub";

//$db->debug=1;


/* Check for the patietn number = $pn. If available get the patients data, */
if (isset ( $pn ) && $pn) {
	include_once ($root_path . 'include/care_api_classes/class_encounter.php');
	$enc_obj = new Encounter ( );
	
	if ($enc_obj->loadEncounterData ( $pn )) {
		$edit = true;
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
		$_SESSION ['sess_en'] = $pn;
		$_SESSION ['sess_full_en'] = $full_en;
	}	
}

/* Here begins the real work */
require_once ($root_path . 'include/inc_date_format_functions.php');
     
if (!isset ( $mode ))
	$mode = '';
	   
if ($enc_obj->is_loaded) {
	if( $target == 'patho' || $target == 'blood'){
		$sql = "SELECT * FROM care_test_request_" . $db_request_table . " ";
		$sql .= "WHERE care_test_request_" . $db_request_table . ".batch_nr='" . $batch_nr . "' ";
	} else {
		$sql = "SELECT * FROM care_test_request_" . $db_request_table . " ";
		$sql .= "INNER JOIN care_test_request_" . $db_request_table_sub . " ON ";
		$sql .= "( care_test_request_" . $db_request_table . ".batch_nr = care_test_request_" . $db_request_table_sub . ".batch_nr) ";
		$sql .= "WHERE care_test_request_" . $db_request_table . ".batch_nr='" . $batch_nr . "' ";
	}
	if ($ergebnis = $db->Execute ( $sql )) {
		if ($editable_rows = $ergebnis->RecordCount ()) {
			if ($target == 'baclabor') {
				while ( !$ergebnis->EOF ) {
					$stored_material [$ergebnis->fields ['material']] = $ergebnis->fields ['material'];
					$stored_test_type [$ergebnis->fields ['test_type']] = $ergebnis->fields ['test_type'];
					$stored_param = $ergebnis->GetRowAssoc ( $toUpper = false );
					$ergebnis->MoveNext ();
				}
			} elseif ($target == 'chemlabor') {
				while ( !$ergebnis->EOF ) {
					$stored_param [$ergebnis->fields ['paramater_name']] = $ergebnis->fields ['parameter_value'];
					$stored_request = $ergebnis->GetRowAssoc ( $toUpper = false );
					$ergebnis->MoveNext ();
				}
			} else {
				while ( !$ergebnis->EOF ) {
     					       $stored_request=$ergebnis->FetchRow();
					$ergebnis->MoveNext ();
								   }
							}
			$read_form = 1;
			$printmode = 1;
			             }
	} else {
						     echo "<p>$sql<p>$LDDbNoRead"; 
						  }
}

# Detect the type of form
# $bgc1 = The main background color of the form


switch ($target) {
	case 'radio' :
		$formtitle = $LDRadiology;
		$bgc1 = '#ffffff';
		break;
	case 'generic' :
		include_once ($root_path . 'include/care_api_classes/class_department.php');
		$dept_obj = new Department ( );
		if ($dept_obj->preloadDept ( $stored_request ['testing_dept'] )) {
			$buffer = $dept_obj->LDvar ();
			if (isset ( $$buffer ) && !empty ( $$buffer ))
				$formtitle = $$buffer;
			else
				$formtitle = $dept_obj->FormalName ();
		}
		$bgc1 = '#bbdbc4';
		break;
	case 'chemlabor' :
		$formtitle = $LDChemicallaboratory;
		$bgc1 = '#fff3f3';
		if (file_exists ( $root_path . 'language/' . $lang . '/lang_' . $lang . '_konsil_chemlabor.php' )) {
			include_once ($root_path . 'language/' . $lang . '/lang_' . $lang . '_konsil_chemlabor.php');
		} else {
			include_once ($root_path . 'language/en/lang_en_konsil_chemlabor.php');
		}
		break;
	case 'baclabor' :
		$formtitle = $LDBacteriologicalLaboratory;
		$bgc1 = '#fff3f3';
		break;
	case 'blood' :
		$formtitle = $LDBloodBank;
		$bgc1 = '#99ffcc';
		break;
	case 'patho' :
		$formtitle = $LDPathology;
		$bgc1 = '#cde1ec';
		break;
	default :
		$bgc1 = '#ffffff';
}

# Start the smarty templating


/**
 * HEAD META definition
 */
$smarty->assign ( 'setCharSet', setCharSet () );

/**
 * Toolbar
 */

if (!isset ( $edit ) || empty ( $edit ))
	$smarty->assign ( 'edit', FALSE );
 
# Set it to be purely printout
$smarty->assign ( 'printmode', TRUE );

# Added for the html tag direction
$smarty->assign ( 'HTMLtag', html_ret_rtl ( $lang ) );

# Set colors
$smarty->assign ( 'top_txtcolor', $cfg ['top_txtcolor'] );
$smarty->assign ( 'top_bgcolor', $cfg ['top_bgcolor'] );
$smarty->assign ( 'body_bgcolor', $cfg ['body_bgcolor'] );
$smarty->assign ( 'body_txtcolor', $cfg ['body_txtcolor'] );
$smarty->assign ( 'bgc1', $bgc1 );

$smarty->assign ( 'gifHilfeR', createLDImgSrc ( $root_path, 'hilfe-r.gif', '0' ) );
$smarty->assign ( 'LDCloseAlt', $LDCloseAlt );
$smarty->assign ( 'gifClose2', createLDImgSrc ( $root_path, 'close2.gif', '0' ) );

# Added for the common header top block


$smarty->assign ( 'sToolbarTitle', "$LDTestRequest ::  $formtitle" );

$smarty->assign ( 'pbBack', 'javascript:window.history.back()' );
$smarty->assign ( 'gifBack2', createLDImgSrc ( $root_path, 'back2.gif', '0' ) );

# Added for the common header top block
$smarty->assign ( 'pbHelp', 'javascript:gethelp(\'request_aftersave.php\')' );

$smarty->assign ( 'breakfile', $breakfile );

if ($cfg ['dhtml']) {
	$smarty->assign ( 'dhtml', 'style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"' );
} else {
	$smarty->assign ( 'dhtml', '' );
}

# Window bar title
$smarty->assign ( 'title', $LDTestRequest );
$smarty->assign ( 'Name', $station );

if ($target == 'baclabor') {

	$smarty->assign ( 'css_lab', '.lab {font-family: arial; font-size: 9; color:#ee6666;}' );

} else {

	$smarty->assign ( 'css_lab', '.lab {font-family: arial; font-size: 9; color:purple;}' );

}

/**
 * collect JavaScript for Smarty
 */

ob_start ();

?>

<script language="javascript">
<!-- 
function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php
	echo $sid?>&lang=<?php
	echo $lang?>&user_origin=<?php
	echo $user_origin?>&subtarget=<?php
	echo $target?>&batch_nr=<?php
	echo $batch_nr?>&pn=<?php
	echo $pn?>";
	testprintout<?php
	echo $sid?>=window.open(urlholder,"testprintout<?php
	echo $sid?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    //testprintout<?php
				echo $sid?>.print();
}
// -->
</script>
<?php 
require ($root_path . 'include/inc_js_gethelp.php');
require ($root_path . 'include/inc_css_a_hilitebu.php');

$sTemp = ob_get_contents ();
ob_end_clean ();
$smarty->assign ( 'JavaScript', $sTemp );

$smarty->assign ( 'gifMascot', '<img ' . createMascot ( $root_path, 'mascot1_r.gif', '0', 'absmiddle' ) . '>' );

if ($status == "draft")
	$smarty->assign ( 'sAfterSavePrompt', $LDFormSaved [$saved] );
else
	$smarty->assign ( 'sAfterSavePrompt', $LDRequestSent [$saved] );

$smarty->assign ( 'LDWhatToDo', $LDWhatToDo );
$smarty->assign ( 'pbPrintOut', 'javascript:printOut()' );
$smarty->assign ( 'gifGrnArrow', '<img ' . createComIcon ( $root_path, 'bul_arrowgrnsm.gif', '0', 'absmiddle', TRUE ) . '>' );
$smarty->assign ( 'LDPrintForm', $LDPrintForm );
$smarty->assign ( 'pbEditForm', $root_path . "modules/nursing/nursing-station-patientdaten-doconsil-" . $target . ".php" . URL_APPEND . "&pn=$pn&edit=$edit&station=$station&target=$target&dept_nr=$dept_nr&user_origin=$user_origin&noresize=$noresize&mode=edit&batch_nr=$batch_nr" );
$smarty->assign ( 'LDEditForm', $LDEditForm );
$smarty->assign ( 'pbNewSamePatient', $root_path . "modules/nursing/nursing-station-patientdaten-doconsil-" . $target . ".php" . URL_APPEND . "&pn=$pn&edit=$edit&station=$station&target=$target&dept_nr=$dept_nr&user_origin=$user_origin&noresize=$noresize&mode=" );
$smarty->assign ( 'LDNewFormSamePatient', $LDNewFormSamePatient );

if ($user_origin == 'lab') {
	$smarty->assign ( 'user_origin_lab', TRUE );
	$smarty->assign ( 'pbNewForm', $root_path . "modules/nursing/nursing-station-patientdaten-doconsil-" . $target . ".php" . URL_APPEND . "&edit=0&station=$station&target=$target&dept_nr=$dept_nr&user_origin=$user_origin&noresize=$noresize" );
	$smarty->assign ( 'LDNewFormOtherPatient', $LDNewFormOtherPatient );

}

$smarty->assign ( 'breakfile', $breakfile );
$smarty->assign ( 'LDEndTestRequest', $LDEndTestRequest );

require_once ($root_path . 'include/inc_test_request_printout_fx.php');

/* Load the form for printing out 
* This is a hybrid compromise as long as not all forms are converted to smarty
* templates. In this case, when the form is pathology, the smarty assignments are done
* otherwise the output is buffered
*/
//$edit=0;
if ($target == 'patho') {

	$smarty->assign ( 'patho', TRUE );
	include ($root_path . 'include/inc_test_request_printout_patho.php');

} else {

	# Collect output buffer
	ob_start ();
	if ($target == 'baclabor') {
		include ($root_path . 'include/inc_test_findings_form_baclabor.php');
	} else {
		include ($root_path . 'include/inc_test_request_printout_' . $target . '.php');
	}
	$sTemp = ob_get_contents ();
	ob_end_clean ();
	$smarty->assign ( 'printout_form', $sTemp );
}

/**
 * show Copyright
 * managed in smarty_care.class.php
 */

$smarty->assign ( 'sCopyright', $smarty->Copyright () );
$smarty->assign ( 'sPageTime', $smarty->Pagetime () );

/**
 * show Template
 */

$smarty->display ( 'laboratory/request_aftersave.tpl' );
// $smarty->display('debug.tpl');
?>
