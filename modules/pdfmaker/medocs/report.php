<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$report_textsize=12;
$report_titlesize=16;
$report_auxtitlesize=10;
$report_authorsize=10;

require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//$lang_tables[]='startframe.php';

$lang_tables[]='person.php';
$lang_tables[]='departments.php';
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
//define('NO_CHAIN',TRUE);
# Resolve the local user based on the origin of the script
if(($_SESSION['sess_user_origin']=='admission')||($_SESSION['sess_user_origin']=='registration')){
	$local_user='aufnahme_user';
}else{
	$local_user='medocs_user';
}
//$local_user='medocs_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_medocs.php');
# Get the encouter data
$enc_obj=& new Encounter($enc);
if($enc_obj->loadEncounterData()){
	$encounter=$enc_obj->getLoadedEncounterData();
	//extract($encounter);
}

# Get the medocs document
$medocs_obj=& new Medocs();
$medocs=$medocs_obj->getMedocsDocument($mnr);

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
//$y=$pdf->ezText("\n",14);

/*$data[]=array($LDPatientData);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
*/# make empty line
//$y=$pdf->ezText("\n",14);

# reset
$data=NULL;
# Print the patient aux data
$data[]=array("$LDSex:",$encounter['sex']);
$data[]=array("$LDBloodGroup: ",$encounter['blood_group']);

$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_textsize,'showHeadings'=>0,'shaded'=>0,'cols'=>array(0=>array('justification'=>'right'))));

$y=$pdf->ezText(" \n",10);

$data=NULL;
# Print the doc title
$data[]=array($LDMedocs);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
# Print the author and date info
$y=$pdf->ezText("$LDBy ".$medocs['personell_name']." $LDDate: ".formatDate2Local($medocs['date'],$date_format)." $LDTime: ".$medocs['time']."\n",$report_authorsize);

$data=NULL;
# Print the add insurance info
$data[]=array("$LDExtraInfo : $LDInsurance");
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>1,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>0,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
$y=$pdf->ezText("\n".$medocs['aux_notes']."\n",$report_textsize);

# Check if patient got medical advice
if(stristr($medocs['short_notes'],'got_medical_advice')) $advice=$LDYes; 
	else $advice=$LDNo; 
$data=NULL;
# Print the add insurance info
$data[]=array($LDGotMedAdvice);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>1,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>0,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
$y=$pdf->ezText("\n$advice\n",$report_titlesize);

$data=NULL;
# Print the add insurance info
$data[]=array($LDDiagnosis);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>1,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>0,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));

# Print diagnosis
$y=$pdf->ezText("\n".$medocs['diagnosis']."\n",$report_textsize);

$data=NULL;
# Print the add insurance info
$data[]=array($LDTherapy);
$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>1,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>0,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
# Print therapy
$y=$pdf->ezText("\n".$medocs['therapy'],$report_textsize);

$pdf->ezStream();

?>
