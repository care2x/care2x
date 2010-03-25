<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$report_textsize=12;
$report_titlesize=16;
$report_auxtitlesize=10;
$report_authorsize=10;

require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
//$lang_tables[]='startframe.php';

$lang_tables[]='person.php';
$lang_tables[]='departments.php';
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
//define('NO_CHAIN',TRUE);
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');


# Get the encouter data
$enc_obj=& new Encounter($enc);
if($enc_obj->loadEncounterData()){
	$encounter=$enc_obj->getLoadedEncounterData();
	//extract($encounter);
}

# Fetch insurance and encounter classes
$encounter_class=$enc_obj->getEncounterClassInfo($encounter['encounter_class_nr']);
$insurance_class=$enc_obj->getInsuranceClassInfo($encounter['insurance_class_nr']);

# Resolve the encounter class name
if (isset($$encounter_class['LD_var'])&&!empty($$encounter_class['LD_var'])){
	$eclass=$$encounter_class['LD_var'];
}else{
	$eclass= $encounter_class['name'];
} 
# Resolve the insurance class name
if (isset($$insurance_class['LD_var'])&&!empty($$insurance_class['LD_var'])) $insclass=$$insurance_class['LD_var']; 
    else $insclass=$insurance_class['name']; 

# Get ward or department infos
if($encounter['encounter_class_nr']==1){
	# Get ward name
	include_once($root_path.'include/care_api_classes/class_ward.php');
	$ward_obj=new Ward;
	$current_ward_name=$ward_obj->WardName($encounter['current_ward_nr']);
}elseif($encounter['encounter_class_nr']==2){
	# Get ward name
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	//$current_dept_name=$dept_obj->FormalName($current_dept_nr);
	$current_dept_LDvar=$dept_obj->LDvar($encounter['current_dept_nr']);
	if(isset($$current_dept_LDvar)&&!empty($$current_dept_LDvar)) $current_dept_name=$$current_dept_LDvar;
		else $current_dept_name=$dept_obj->FormalName($encounter['current_dept_nr']);
}

require_once($root_path.'include/care_api_classes/class_insurance.php');
$insurance_obj=new Insurance;


$classpath=$root_path.'classes/phppdf/';
$fontpath=$classpath.'fonts/';
# Load and create pdf object
include($classpath.'class.ezpdf.php');
$pdf=& new Cezpdf();


//$logo=$root_path.'gui/img/logos/care_logo.jpg';
$logo=$root_path.'gui/img/logos/care_logo_print.png';
$pidbarcode=$root_path.'cache/barcodes/pn_'.$encounter['pid'].'.png';
$encbarcode=$root_path.'cache/barcodes/en_'.$enc.'.png';

# Patch for empty file names 2004-05-2 EL
if(empty($encounter['photo_filename'])){
	$idpic=$root_path.'uploads/photos/registration/_nothing_';
 }else{
	$idpic=$root_path.'uploads/photos/registration/'.$encounter['photo_filename'];
}

# Load the page header #1
require('../std_plates/pageheader.php');
# Load the patient data plate #1
require('../std_plates/patientdata.php');

$data=NULL;
# make empty line
$y=$pdf->ezText("\n",14);

$data[]=array($LDPatientData);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
# make empty line
$y=$pdf->ezText("\n",14);

# reset
$data=NULL;
$data[]=array("$LDAdmitDate: ",formatDate2Local($encounter['encounter_date'],$date_format));
$data[]=array("$LDAdmitTime: ",formatDate2Local($encounter['encounter_date'],$date_format,TRUE,TRUE));
$data[]=array('');
$data[]=array("$LDTitle: ",$encounter['title']);
$data[]=array("$LDSex:",$encounter['sex']);
$data[]=array("$LDBloodGroup: ",$encounter['blood_group']);
$data[]=array("$LDAdmitType: ",$eclass);
if($encounter['encounter_class_nr']==1){
	$data[]=array("$LDWard: ",$current_ward_name);
}else{
	$data[]=array("$LDDepartment: ",$current_dept_name);
}
$data[]=array('');
$data[]=array("$LDDiagnosis: ",$encounter['referrer_diagnosis']);
$data[]=array("$LDRecBy: ",$encounter['referrer_dr']);
$data[]=array("$LDTherapy: ",$encounter['referrer_recom_therapy']);
$data[]=array("$LDSpecials: ",$encounter['referrer_notes']);
$data[]=array('');
$data[]=array("$LDBillType: ",$insclass);
$data[]=array("$LDInsuranceNr: ",$encounter['insurance_nr']);
$data[]=array("$LDInsuranceCo: ",$insurance_obj->getFirmName($encounter['insurance_firm_id']));
$data[]=array('');
$data[]=array("$LDAdmitBy: ",$encounter['create_id']);

$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_textsize,'showHeadings'=>0,'shaded'=>0,'cols'=>array(0=>array('justification'=>'right'))));


$pdf->ezStream();

?>
