<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
 * GNU General Public License
 * Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
$lang_tables [] = 'departments.php';
define ( 'LANG_FILE', 'konsil.php' );

/* Globalize the variables */

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
switch ($user_origin) {
	
	case 'lab' :
		$local_user = 'ck_lab_user';
		$breakfile = $root_path . "modules/laboratory/labor.php" . URL_APPEND;
		break;
	
	case 'patreg' :
		$local_user = 'aufnahme_user';
		$breakfile = 'javascript:window.close()';
		break;
	
	default :
		$local_user = 'ck_pflege_user';
		$breakfile = $root_path . "modules/nursing/nursing-station-patientdaten.php" . URL_APPEND . "&edit=$edit&station=$station&pn=$pn";
}

//$local_user='ck_lab_user';


require_once ($root_path . 'include/core/inc_front_chain_lang.php');

$thisfile = "labor_test_findings_" . $subtarget . ".php";

switch ($subtarget) {
	case "patho" :
		$bgc1 = "#cde1ec";
		$formtitle = $LDPathology;
		break;
	
	case 'radio' :
		$bgc1 = "#ffffff";
		$formtitle = $LDRadiology;
		break;
	
	case "baclabor" :
		$bgc1 = '#fff3f3';
		$formtitle = $LDBacteriologicalLaboratory;
		break;
}

$edit = 0; /* Set to no edit */

//$konsil="patho";


$db_request_table = $subtarget;
$db_request_table_sub = $subtarget . "_sub";

/* Here begins the real work */

require_once ($root_path . 'include/core/inc_date_format_functions.php');

/* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
if (isset ( $pn ) && $pn) {
	include_once ($root_path . 'include/care_api_classes/class_encounter.php');
	$enc_obj = new Encounter ( );
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
	}
}

if (! isset ( $mode ) && $batch_nr && $pn)
	$mode = "edit";

switch ($mode) {
	/* If mode is edit, get the stored test findings 
			*/
	case 'edit' :
		
		if ($subtarget == 'baclabor') {
			
			$sql = "SELECT * FROM care_test_request_" . $db_request_table . " WHERE batch_nr='" . $batch_nr . "'";
			
			if ($ergebnis = $db->Execute ( $sql )) {
				if ($editable_rows = $ergebnis->RecordCount ()) {
					
					$stored_request = $ergebnis->FetchRow ();
					
					parse_str ( $stored_request ['material'], $stored_material );
					parse_str ( $stored_request ['test_type'], $stored_test_type );
					
					$edit_form = 1;
					$read_form = 1;
				
				}
			}
		}
		

		if($subtarget == 'patho') {
			$sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		} else {
			$sql = "SELECT * FROM care_test_findings_" . $db_request_table . " ";
			$sql .= "INNER JOIN care_test_findings_" . $db_request_table_sub . " ON ";
			$sql .= "( care_test_findings_" . $db_request_table . ".batch_nr = care_test_findings_" . $db_request_table_sub . ".batch_nr) ";
			$sql .= "WHERE care_test_findings_" . $db_request_table . ".batch_nr='" . $batch_nr . "' ";			
		}
		if ($ergebnis = $db->Execute ( $sql )) {
			if ($editable_rows = $ergebnis->RecordCount ()) {
				if ($subtarget == 'baclabor') {
				    while ( !$ergebnis->EOF ) {
						$parsed_type[$ergebnis->fields['type_general']] = $ergebnis->fields['type_general'];
						$parsed_resist_anaerob[$ergebnis->fields['resist_anaerob']] = $ergebnis->fields['resist_anaerob'];
						$parsed_resist_aerob[$ergebnis->fields['resist_aerob']] = $ergebnis->fields['resist_aerob'];
						$parsed_findings[$ergebnis->fields['findings']] = $ergebnis->fields['findings'];
						$stored_findings=$ergebnis->GetRowAssoc($toUpper=false);
						$ergebnis->MoveNext();
					}	
				} else {
 					while ( !$ergebnis->EOF ) {
						$stored_findings=$ergebnis->GetRowAssoc($toUpper=false);
						$ergebnis->MoveNext();
					}						
				}
				
				if ($stored_findings ['status'] == "done")
					$edit_findings = 0; /* Inhibit editing of the findings */
				
				$mode = 'update';
				$edit_form = 1;
				$read_form = 1;
			}
		}
		
		break; ///* End of case 'edit': */
	

	default :
		$mode = "";

} // end of switch($mode)


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php
html_rtl ( $lang );
?>
<HEAD>
<?php
echo setCharSet ();
?>
 <TITLE><?php
	echo "$LDTestFindings #$batch_nr"?></TITLE>
<?php
require ($root_path . 'include/core/inc_js_gethelp.php');
require ($root_path . 'include/core/inc_css_a_hilitebu.php');

?>
<style type="text/css">
div.fva2_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
}

div.fa2_ml10 {
	font-family: arial;
	font-size: 12;
	margin-left: 10;
}

div.fva2_ml3 {
	font-family: verdana;
	font-size: 12;
	margin-left: 3;
}

div.fa2_ml3 {
	font-family: arial;
	font-size: 12;
	margin-left: 3;
}

.fva2_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
	color: #000099;
}

.fva2b_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
	color: #000000;
}

.fva0_ml10 {
	font-family: verdana, arial;
	font-size: 10;
	margin-left: 10;
	color: #000099;
}

.fvag_ml10 {
	font-family: verdana, arial;
	font-size: 10;
	margin-left: 10;
	color: #969696;
}

.lab {
	font-family: ms ui gothic;
	font-size: 9;
	color: #ee6666;
}

.lmargin {
	margin-left: 5;
}
</style>


</HEAD>

<BODY bgcolor=<?php
echo $cfg ['body_bgcolor'];
?>
	onLoad="if (window.focus) window.focus();window.print();">



<?php

require_once ('includes/inc_test_request_printout_fx.php');

if ($show_print_button)
	echo '<a href="javascript:window.print()"><img ' . createLDImgSrc ( $root_path, 'printout.gif', '0' ) . '></a><p>';

/**
 *  Load the form 
 */
if ($subtarget == 'baclabor') {
	echo '<img src="' . $root_path . 'main/imgcreator/barcode_label_single_large.php?sid=' . $sid . '&lang=' . $lang . '&fen=' . $full_en . '&en=' . $pn . '&batch_nr=' . $batch_nr . '&child_img=1&subtarget=' . $subtarget . '" >';
}
else
{
    include_once($root_path.'include/inc_test_findings_form_'.$subtarget.'.php');
}
?>

</BODY>
</HTML>
