<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*
 CARE2X Integrated Information System beta 2.0.1 - 2003-10-13 for Hospitals and Health Care Organizations and Services
 Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org

 GNU GPL. For details read file "copy_notice.txt".
 */

# Define to true if you want to draw a border around the labels
define('DRAW_BORDER',TRUE);

if(!extension_loaded('gd')) dl('php_gd.dll');

define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
header ('Content-type: image/png');

# Check the encounter number
if((!isset($en)||!$en) && $_SESSION['sess_en']) $en=$_SESSION['sess_en'];

/*
 if(file_exists("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png"))
 {
 $im = ImageCreateFrompng("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
 Imagepng($im);
 }
 else
 {
 */
if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok) {
	// get orig data
	//$dbtable='care_patient_encounter';
	$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c1.sex, c1.civil_status, c1.phone_1_nr,
		          c1.religion, c1.addr_str, c1.addr_str_nr, c1.addr_zip, c1.addr_citytown_nr, c1.contact_person, c1.blood_group,  
				  c2.*, ad.name
				 FROM care_encounter as c2 
				     LEFT JOIN care_person as c1 ON c1.pid=c2.pid 
					 LEFT JOIN care_address_citytown AS ad ON c1.addr_citytown_nr=ad.nr
				         WHERE c2.encounter_nr='$en'";
		
	if($ergebnis=$db->Execute($sql))
	{
		if($ergebnis->RecordCount())
		{
			$result=$ergebnis->FetchRow();
		}
	}
	// else {print "<p>$sql$LDDbNoRead"; exit;} /* Remove comment for debugging*/
	 
	include_once($root_path.'include/core/inc_date_format_functions.php');
	//$date_format=getDateFormat($link,$DBLink_OK);

	/* Get the patient global configs */
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');

	# Create insurance object
	include_once($root_path.'include/care_api_classes/class_insurance.php');
	$ins_obj=new Insurance;

	include_once($root_path.'include/care_api_classes/class_ward.php');
	$obj=new Ward;
	# Get location data
	$location=&$obj->EncounterLocationsInfo($en);


	//   $result['date_birth']=formatDate2Local($result['date_birth'],$date_format);
}
else
{ print "$LDDbNoLink<br>$sql<br>"; }



switch ($result['encounter_class_nr'])
{
	case '1':    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	$result['encounter_class']=$LDStationary;
	break;
	case '2':   $full_en= $en + $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
	$result['encounter_class']=$LDAmbulant;
	default:    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	$result['encounter_class']=$LDStationary;
}
	
include($root_path.'main/imgcreator/inc_etik.php');
?>
