<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/inc_environment_global.php');

if (! extension_loaded ( 'gd' ))
	dl ( 'php_gd.dll' );
$lang_tables [] = 'aufnahme.php';
define ( 'LANG_FILE', 'konsil.php' );
define ( 'NO_CHAIN', 1 );
require_once ($root_path . 'include/inc_front_chain_lang.php');
header ( 'Content-type: image/png' );

include_once ($root_path . 'include/care_api_classes/class_ward.php');
$obj = new Ward ( );
if ($obj->loadEncounterData ( $en )) {
	$result = &$obj->encounter;
}

# Create insurance object
include_once ($root_path . 'include/care_api_classes/class_insurance.php');
$ins_obj = new Insurance ( );

$fen = $en;
include_once ($root_path . 'include/inc_date_format_functions.php');

# Get location data
$location = &$obj->EncounterLocationsInfo ( $en );

# Localize date data   
$result ['date_birth'] = @formatDate2Local ( $result ['date_birth'], $date_format );
$result ['pdate'] = @formatDate2Local ( $result ['encounter_date'], $date_format );
# Decode admission class
switch ($result ['encounter_class_nr']) {
	case 1 :
		$admit_type = $LDStationary;
		break;
	case 2 :
		$admit_type = $LDAmbulant;
		break;
	default :
		$admit_type = '';
}
if ($child_img) {
	if ($subtarget == 'chemlabor' || $subtarget == 'baclabor') {
		$sql = "SELECT * FROM care_test_request_" . $subtarget . " ";
		$sql .= "INNER JOIN care_test_request_" . $subtarget . "_sub ON ";
		$sql .= "( care_test_request_" . $subtarget . ".batch_nr = care_test_request_" . $subtarget . "_sub.batch_nr) ";
		$sql .= "WHERE care_test_request_" . $subtarget . ".batch_nr='" . $batch_nr . "'";
		if ($ergebnis = $db->Execute ( $sql )) {
			if ($editable_rows = $ergebnis->RecordCount ()) {
				
				$stored_request = $ergebnis->FetchRow ();
				
				while ( $ergebnis->MoveNext () ) {
					if (isset ( $ergebnis->fields ['paramater_name'] )) {
						$stored_param [$ergebnis->fields ['paramater_name']] = $ergebnis->fields ['parameter_value'];
                               }
							   // parse the material type 
					if (isset ( $ergebnis->fields ['material'] )) {
						$stored_param [$ergebnis->fields ['material']] = $ergebnis->fields ['material'];
							   }
							   // parse the test type 
					if (isset ( $ergebnis->fields ['test_type'] )) {
						$stored_param [$ergebnis->fields ['material']] = $ergebnis->fields ['material'];
					}
							   }
							}
			             }
	       }	   

	if ($subtarget == 'baclabor') {
		$sql = "SELECT * FROM care_test_request_" . $subtarget . " ";
		$sql .= "INNER JOIN care_test_request_" . $subtarget . "_sub ON ";
		$sql .= "( care_test_request_" . $subtarget . ".batch_nr = care_test_request_" . $subtarget . "_sub.batch_nr) ";
		$sql .= "WHERE care_test_request_" . $subtarget . ".batch_nr='" . $batch_nr . "'";
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
							}
			             }
	   
	       }
} // end of if($child_img)

		
$addr = explode ( "\r\n", $result ['address'] );

if ($lang == "de")
	$result ['sex'] = strtr ( $result ['sex'], "mfMF", "mwMW" );
if ($lang == "tr")
	$result ['sex'] = strtr ( $result ['sex'], "mfMF", "ekEK" );
    
# Load the image generation script based on the language
if ($lang == 'ar' || $lang == 'fa')
	include ($root_path . 'main/imgcreator/inc_label_single_large_ar.php');
if ($lang == 'tr')
	include ($root_path . 'main/imgcreator/inc_label_single_large_tr.php');
else
	include ($root_path . 'main/imgcreator/inc_label_single_large.php');
?>
