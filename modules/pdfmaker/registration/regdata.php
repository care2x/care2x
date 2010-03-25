<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$report_textsize=12;
$report_titlesize=16;
$report_auxtitlesize=10;
$report_authorsize=10;

require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
//$lang_tables[]='startframe.php';

$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
//define('NO_CHAIN',TRUE);
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');


$insurance_obj=new PersonInsurance;
$person_obj=& new Person($pid);
# Get the person´s data
if($person_obj->preloadPersonInfo($pid)){
	$person=$person_obj->person;
	# copy to encounter variable 
	$encounter=& $person;
	//extract($encounter);
			
	$p_insurance=&$insurance_obj->getPersonInsuranceObject($pid);
	
	if($p_insurance==false) {
		$insurance_show=true;
	} else {
		if(!$p_insurance->RecordCount()) {
			$insurance_show=true;
		} elseif ($p_insurance->RecordCount()==1){
			$buffer= $p_insurance->FetchRow();
			extract($buffer);
			//while(list($x,$v)=each($buffer)) {$$x=$v; }
			$insurance_show=true;
	        # Get insurace firm name
			$insurance_firm_name=$insurance_obj->getFirmName($insurance_firm_id); 
			
		} else { $insurance_show=false;}
	} 
}

$insurance_class=$insurance_obj->getInsuranceClassInfo($insurance_class_nr);
# Resolve the insurance class name
if (isset($$insurance_class['LD_var'])&&!empty($$insurance_class['LD_var'])) $insclass=$$insurance_class['LD_var']; 
    else $insclass=$insurance_class['name']; 


# Get the global config for person's registration form*/
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');


require_once($root_path.'include/care_api_classes/class_insurance.php');
$insurance_obj=new Insurance;


$classpath=$root_path.'classes/phppdf/';
$fontpath=$classpath.'fonts/';
# Load and create pdf object
include($classpath.'class.ezpdf.php');
$pdf=& new Cezpdf();


$logo=$root_path.'gui/img/logos/care_logo_print.png';
$pidbarcode=$root_path.'cache/barcodes/pn_'.$encounter['pid'].'.png';
$encbarcode=$root_path.'cache/barcodes/en_'.$enc.'.png';

//$idpic=$root_path.'fotos/registration/'.$encounter['photo_filename'];
# Patch for empty file names 2004-05-2 EL
if(empty($encounter['photo_filename'])){
	$idpic=$root_path.'uploads/photos/registration/_nothing_';
 }else{
	$idpic=$root_path.'uploads/photos/registration/'.$encounter['photo_filename'];
}

# Load the page header #1
require('../std_plates/pageheader.php');
# Load the patient data plate #1
require('../std_plates/persondata.php');

$data=NULL;
# make empty line
//$y=$pdf->ezText("\n",14);

$data[]=array($LDPatientRegister);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
# make empty line
$y=$pdf->ezText("\n",14);

# reset
$data=NULL;
$data[]=array("$LDRegDate: ",formatDate2Local($person['date_reg'],$date_format));
$data[]=array("$LDRegTime: ",formatDate2Local($person['date_reg'],$date_format,TRUE,TRUE));
$data[]=array('');
$data[]=array("$LDTitle: ",$person['title']);
$data[]=array("$LDSex:",$person['sex']);
$data[]=array("$LDBloodGroup: ",$person['blood_group']);

if (!$GLOBAL_CONFIG['person_name_2_hide']&&$person['name_2']){
	$data[]=array("$LDName2: ",$person['name_2']);
}

if (!$GLOBAL_CONFIG['person_name_3_hide']&&$person['name_3']){
	$data[]=array("$LDName3: ",$person['name_3']);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide']&&$person['name_middle']){
	$data[]=array("$LDNameMid: ",$person['name_middle']);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide']&&$person['name_maiden']){
	$data[]=array("$LDNameMaiden: ",$person['name_maiden']);
}

if (!$GLOBAL_CONFIG['person_name_others_hide']&&$person['name_others']){
	$data[]=array("$LDNameOthers: ",$person['name_others']);
}

//$data[]=array("$LDBday: ",formatDate2Local($person['date_birth'],$date_format));

if($person['death_date']&&$person['death_date'] != DBF_NODATE){
	$data[]=array("$LDDeathDate: ",formatDate2Local($person['death_date'],$date_format));
}

if($person['civil_status']=="single") $civ= $LDSingle; 
 elseif($person['civil_status']=="married") $civ=$LDMarried; 
  elseif($person['civil_status']=="divorced") $civ=$LDDivorced;
   elseif($person['civil_status']=="widowed") $civ=$LDWidowed;
    elseif($person['civil_status']=="separated") $civ=$LDSeparated;
	
$data[]=array("$LDCivilStatus: ",$civ);
# spacer
$data[]=array('');

if (!$GLOBAL_CONFIG['person_insurance_1_nr_hide']&&insurance_show&&$insurance_nr){
	$data[]=array("$LDInsuranceNr: ",$insurance_nr);
	$data[]=array("$LDInsuranceClass: ",$insclass);
	$data[]=array("$LDInsuranceCo: ",$insurance_firm_name);
}

# spacer
$data[]=array('');

if (!$GLOBAL_CONFIG['person_phone_1_nr_hide']&&$person['phone_1_nr']){
	$data[]=array("$LDPhone 1: ",$person['phone_1_nr']);
}

if (!$GLOBAL_CONFIG['person_phone_2_nr_hide']&&$person['phone_2_nr']){
	$data[]=array("$LDPhone 2: ",$person['phone_2_nr']);
}

if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide']&&$person['cellphone_1_nr']){
	$data[]=array("$LDCellPhone 1: ",$person['cellphone_1_nr']);
}

if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide']&&$person['cellphone_2_nr']){
	$data[]=array("$LDCellPhone 2: ",$person['cellphone_2_nr']);
}

if (!$GLOBAL_CONFIG['person_fax_hide']&&$person['fax']){
	$data[]=array("$LDFax: ",$person['fax']);
}

if (!$GLOBAL_CONFIG['person_email_hide']&&$person['email']){
	$data[]=array("$LDEmail: ",$person['email']);
}

#spacer
//$data[]=array('');

if (!$GLOBAL_CONFIG['person_citizenship_hide']&&$person['citizenship']){
	$data[]=array("$LDCitizenship: ",$person['citizenship']);
}

if (!$GLOBAL_CONFIG['person_sss_nr_hide']&&$person['sss_nr']){
	$data[]=array("$LDSSSNr: ",$person['sss_nr']);
}

if (!$GLOBAL_CONFIG['person_nat_id_nr_hide']&&$person['nat_id_nr']){
	$data[]=array("$LDNatIdNr: ",$person['nat_id_nr']);
}

if (!$GLOBAL_CONFIG['person_religion_hide']&&$person['religion']){
	$data[]=array("$LDReligion: ",$person['religion']);
}

if (!$GLOBAL_CONFIG['person_ethnic_orig_hide']&&$person['ethnic_orig']){
	$data[]=array("$LDEthnicOrigin: ",$person['ethnic_orig']);
}

$data[]=array("$LDAdmitBy: ",$person['create_id']);

$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_textsize,'showHeadings'=>0,'shaded'=>0,'cols'=>array(0=>array('justification'=>'right'))));


$pdf->ezStream();

?>
