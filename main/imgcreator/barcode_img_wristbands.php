<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.1 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

/*****************************************************
*  To align the entire image (4 images), 
* change only the $leftmargin and $topmargin variables
*****************************************************/
	
	$leftmargin=5;
	$topmargin=40;

//* Do not change anything below this line, unless you are sure of what you are doing */

//* The $yoffset variable determines the spacing between the wristbands */
	$yoffset=115;


if(!extension_loaded('gd')) dl('php_gd.dll');

define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
header ('Content-type: image/png');

    if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
    if($dblink_ok) {	
	    // get orig data
	    $dbtable='care_person';
	    //$sql="SELECT * FROM $dbtable WHERE patient_nr='$pn' ";
		
		$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c2.current_ward_nr, c2.current_dept_nr,
		           c2.insurance_firm_id, c2.insurance_2_firm_id, c2.encounter_class_nr, c2.encounter_nr
				   FROM care_encounter as c2 
				     LEFT JOIN care_person as c1 ON c1.pid=c2.pid 
				         WHERE c2.encounter_nr='$en'";
				 
	    if($ergebnis=$db->Execute($sql))
       	{
			if($ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
       
	   /* Load the date formatter */
	   include_once($root_path.'include/core/inc_date_format_functions.php');
       //$date_format=getDateFormat($link,$DBLink_OK);
	   
	   	/* Get the patient global configs */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
	   
	   $result['date_birth']=@formatDate2Local($result['date_birth'],$date_format);
	}
	else { print "$LDDbNoLink<br>$sql<br>"; exit;}
	
	/* Create full admission number */
/*	switch ($result['encounter_class_nr'])
    {
    case '2' :     $full_en = $en+ $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
						break;
	case '1' :     $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	default:       $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
    }
*/
	$full_en=$en;

	# Load the image generator according to the language version
    include($root_path.'main/imgcreator/inc_wristband.php');
?>
