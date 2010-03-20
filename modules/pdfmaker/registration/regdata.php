<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$report_textsize=12;
$report_titlesize=16;
$report_auxtitlesize=10;
$report_authorsize=10;

require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
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
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
include_once($root_path.'include/inc_t1ps_ar2uni.php');


$insurance_obj=new PersonInsurance;
$person_obj=& new Person($pid);
# Get the person�s data
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


$logo=$root_path.'gui/img/logos/lopo/care_logo.png';
$arlogo=$root_path.'gui/img/logos/lopo/ar/care_logo.png';//added  by Waleed Fathalla at 06/03/2004
$pidbarcode=$root_path.'cache/barcodes/pn_'.$encounter['pid'].'.png';
$encbarcode=$root_path.'cache/barcodes/en_'.$enc.'.png';

//$idpic=$root_path.'fotos/registration/'.$encounter['photo_filename'];
# Patch for empty file names 2004-05-2 EL
if(empty($encounter['photo_filename'])){
	$idpic=$root_path.'fotos/registration/_nothing_';
 }else{
	$idpic=$root_path.'fotos/registration/'.$encounter['photo_filename'];
}

if($lang=='ar'||$lang=='fa') {// for arabic lang, added  by Waleed Fathalla at 06/03/2004

# Load the page header #1
require('../std_plates/pageheader1ar.php');
# Load the patient data plate #1
require('../std_plates/persondata1ar.php');

$data=NULL;
# make empty line
//$y=$pdf->ezText("\n",14);

$data[]=array(ar2uni($LDPatientRegister));
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555,'cols'=>array(0=>array('justification'=>'right'))));
# make empty line
$y=$pdf->ezText("\n",14);

# reset
$data=NULL;
$data[]=array(formatDate2Local($person['date_reg'],$date_format),ar2uni("$LDRegDate :"));
$data[]=array(formatDate2Local($person['date_reg'],$date_format,TRUE,TRUE),ar2uni("$LDRegTime :"));
$data[]=array('');
$data[]=array(ar2uni($person['title']),ar2uni("$LDTitle :"));
$data[]=array($person['sex'],ar2uni("$LDSex :"));
$data[]=array($person['blood_group'],ar2uni("$LDBloodGroup :"));

if (!$GLOBAL_CONFIG['person_name_2_hide']&&$person['name_2']){
	$data[]=array(ar2uni($person['name_2']),ar2uni("$LDName2 :"));
}

if (!$GLOBAL_CONFIG['person_name_3_hide']&&$person['name_3']){
	$data[]=array(ar2uni($person['name_3']),ar2uni("$LDName3 :"));
}

if (!$GLOBAL_CONFIG['person_name_middle_hide']&&$person['name_middle']){
	$data[]=array(ar2uni($person['name_middle']),ar2uni("$LDNameMid :"));
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide']&&$person['name_maiden']){
	$data[]=array(ar2uni($person['name_maiden']),ar2uni("$LDNameMaiden :"));
}

if (!$GLOBAL_CONFIG['person_name_others_hide']&&$person['name_others']){
	$data[]=array(ar2uni($person['name_others']),ar2uni("$LDNameOthers :"));
}

if($person['death_date']&&$person['death_date'] != DBF_NODATE){
	$data[]=array(formatDate2Local($person['death_date'],$date_format),ar2uni("$LDDeathDate :"));
}

if($person['civil_status']=="single") $civ= $LDSingle; 
 elseif($person['civil_status']=="married") $civ=$LDMarried; 
  elseif($person['civil_status']=="divorced") $civ=$LDDivorced;
   elseif($person['civil_status']=="widowed") $civ=$LDWidowed;
    elseif($person['civil_status']=="separated") $civ=$LDSeparated;
	
$data[]=array(ar2uni($civ),ar2uni("$LDCivilStatus :"));

# spacer
$data[]=array('');

if (!$GLOBAL_CONFIG['person_insurance_1_nr_hide']&&insurance_show&&$insurance_nr){
	$data[]=array($insurance_nr,ar2uni("$LDInsuranceNr :"));
	$data[]=array(ar2uni($insclass),ar2uni("$LDInsuranceClass :"));
	$data[]=array(ar2uni($insurance_firm_name),ar2uni("$LDInsuranceCo :"));
}

# spacer
$data[]=array('');

if (!$GLOBAL_CONFIG['person_phone_1_nr_hide']&&$person['phone_1_nr']){
	$data[]=array($person['phone_1_nr'],ar2uni("$LDPhone 1 :"));
}

if (!$GLOBAL_CONFIG['person_phone_2_nr_hide']&&$person['phone_2_nr']){
	$data[]=array($person['phone_2_nr'],ar2uni("$LDPhone 2 :"));
}

if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide']&&$person['cellphone_1_nr']){
	$data[]=array($person['cellphone_1_nr'],ar2uni("$LDCellPhone 1 :"));
}

if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide']&&$person['cellphone_2_nr']){
	$data[]=array($person['cellphone_2_nr'],ar2uni("$LDCellPhone 2 :"));
}

if (!$GLOBAL_CONFIG['person_fax_hide']&&$person['fax']){
	$data[]=array($person['fax'],ar2uni("$LDFax :"));
}

if (!$GLOBAL_CONFIG['person_email_hide']&&$person['email']){
	$data[]=array($person['email'],ar2uni("$LDEmail :"));
}

#spacer
//$data[]=array('');

if (!$GLOBAL_CONFIG['person_citizenship_hide']&&$person['citizenship']){
	$data[]=array(ar2uni($person['citizenship']),ar2uni("$LDCitizenship :"));
}

if (!$GLOBAL_CONFIG['person_sss_nr_hide']&&$person['sss_nr']){
	$data[]=array($person['sss_nr'],ar2uni("$LDSSSNr :"));
}

if (!$GLOBAL_CONFIG['person_nat_id_nr_hide']&&$person['nat_id_nr']){
	$data[]=array($person['nat_id_nr'],ar2uni("$LDNatIdNr :"));
}

if (!$GLOBAL_CONFIG['person_religion_hide']&&$person['religion']){
	$data[]=array(ar2uni($person['religion']),ar2uni("$LDReligion :"));
}

if (!$GLOBAL_CONFIG['person_ethnic_orig_hide']&&$person['ethnic_orig']){
	$data[]=array(ar2uni($person['ethnic_orig']),ar2uni("$LDEthnicOrigin :"));
}

$data[]=array(ar2uni($person['create_id']),ar2uni("$LDAdmitBy :"));

$pdf->ezTable($data,'','',array('xPos'=>'right','xOrientation'=>'left','showLines'=>0,'fontSize'=>$report_textsize,'showHeadings'=>0,'shaded'=>0,'cols'=>array(0=>array('justification'=>'right'))));

}else{

# Load the page header #1
require('../std_plates/pageheader1.php');
# Load the patient data plate #1
require('../std_plates/persondata1.php');

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

}


$pdf->ezStream();

?>
