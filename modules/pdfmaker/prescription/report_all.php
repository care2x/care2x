<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
///$db->debug=true;
$report_textsize=12;
$report_titlesize=14;
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

function getNotes($type_nr){

	global $db,$_SESSION,$rows,$result,$enc,$presnr;

	$sql="SELECT care_encounter_prescription.*,
       			 care_encounter_prescription_sub.*,
       			 care_encounter_prescription.nr as id
			FROM care_encounter_prescription_sub
     				INNER JOIN care_encounter_prescription
     				ON (care_encounter_prescription.nr = care_encounter_prescription_sub.prescription_nr)
			WHERE care_encounter_prescription.encounter_nr = $enc
				AND care_encounter_prescription.nr = $presnr
				AND care_encounter_prescription_sub.is_stopped IN ('', 0)
			ORDER BY care_encounter_prescription.nr,
         			care_encounter_prescription_sub.companion desc  ";
	//echo $sql;
	if($result=$db->Execute($sql)){
		if($rows=$result->RecordCount()){
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

function dec2frac( $decimal ) {
  $decimal = (string)$decimal;
  $num = '';
  $den = 1;
  $dec = false;
 
  // find least reduced fractional form of number
  for( $i = 0, $ix = strlen( $decimal ); $i < $ix; $i++ ) {
    // build the denominator as we 'shift' the decimal to the right
    if( $dec ) $den *= 10;
   
    // find the decimal place/ build the numberator
    if( $decimal{$i} == '.' ) $dec = true;
    else $num .= $decimal{$i};
  }
  $num = (int)$num;
   
  // whole number, just return it
  if( $den == 1 ) return $num;
   
  $num2 = $num;
  $den2 = $den;
  $rem  = 1;
  // Euclid's Algorithm (to find the gcd)
  while( $num2 % $den2 ) {
    $rem = $num2 % $den2;
    $num2 = $den2;
    $den2 = $rem;
  }
  if( $den2 != $den ) $rem = $den2;
   
  // now $rem holds the gcd of the numerator and denominator of our fraction
  return ($num / $rem ) . "/" . ($den / $rem);
}


//$lang_tables[]='startframe.php';
$lang_tables[]='emr.php';
define('LANG_FILE','aufnahme.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
$thisfile=basename(__FILE__);
require_once($root_path.'include/core/inc_date_format_functions.php');

// Get the prescription data
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($objPrescription))
$objPrescription=new Prescription;
$app_types=$objPrescription->getAppTypes();
$pres_types=$objPrescription->getPrescriptionTypes();
//gjergji
//update the status of the prescription to printed
$objPrescription->setPrescriptionStatus($presnr,'printed');

// Get the encouter data
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=& new Encounter($enc);
$encounter = '';
if($enc_obj->loadEncounterData()){
	$encounter=&$enc_obj->getLoadedEncounterData();
}


// Get the Deparment name
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj = new Department();
$deptName = $dept_obj->FormalName($enc_obj->encounter['current_dept_nr']);
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj = new Ward();
$wardName = $ward_obj->getWardInfo($enc_obj->encounter['current_ward_nr']);
$roomName = $ward_obj->_getActiveRoomInfo($enc_obj->encounter['current_room_nr'],$enc_obj->encounter['current_ward_nr']);
$roomNumber = $enc_obj->encounter['current_room_nr'];

// get Allergy notes type = 22
include_once($root_path.'include/care_api_classes/class_charts.php');
$charts_obj= new Charts;
$allergy=&$charts_obj->getChartNotes($enc,22);
$patientAllergy = '';
if(is_object($allergy)){
	while($buff=$allergy->FetchRow()){
		$patientAllergy = nl2br($buff['notes']);
	}
}
if( $patientAllergy == "" ) $patientAllergy = " -- ";
include_once($root_path.'include/care_api_classes/class_drg.php');
$patientDiagnosis = '';
$diag=new DRG();
$diagnosis=&$diag->DiagnosisCodes(0,$enc);
if(is_object($diagnosis)){
	while($buff=$diagnosis->FetchRow()){
		if($buff['localization'] == "1")
			$patientDiagnosis = nl2br($buff['description']);
	}
}
if( $patientDiagnosis == "" ) $patientDiagnosis = " -- ";
$classpath=$root_path.'classes/phppdf/';
$fontpath=$classpath.'fonts/';

include($classpath.'class.ezpdf.php');
$pdf=& new Cezpdf();


$logo=$root_path.'gui/img/logos/care_logo_print.png';
$pidbarcode=$root_path.'cache/barcodes/pn_'.$encounter['pid'].'.png';
$encbarcode=$root_path.'cache/barcodes/en_'.$enc.'.png';

// Patch for empty file names 2004-05-2 EL
if(empty($encounter['photo_filename'])){
	$idpic=$root_path.'uploads/photos/registration/_nothing_';
 }else{
	$idpic=$root_path.'uploads/photos/registration/'.$encounter['photo_filename'];
}


// Load the page header #1
require('../std_plates/pageheader.php');
// Load the patient data plate #1
require('../std_plates/patientdata.php');

$data=NULL;
// make empty line
$y=$pdf->ezText("\n",14);

if(!stristr($filter,$nr)){
	
	// Get the report title
	if(isset($$LD_var)&&!empty($$LD_var)){
		$title=$$LD_var;
	}else{
		$title=$name;
	}

	$data=NULL;
	$data[]=array($title);
	$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
	$data[]=array(" $LDDate: ".formatDate2Local($report['date'],$date_format)."   $LDTime: ".$report['time']."   $LDBy: ".$report['personell_name']);
	$dataInfo[] = array (
		'Reparti :' => 'Reparti : ' . $deptName ,
		'Pavijon :' => 'Pavijon : ' . $wardName['name'],
		'Dhoma :'   => 'Dhoma : ' . $wardName['roomprefix'].$roomName,
		'Shtrati :' => 'Shtrati : ' . $roomNumber
	);
	$pdf->ezTable($dataInfo,'','',array('showHeadings'=>0,'shaded'=>0,'showLines'=>0,'xPos'=>'307','shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));
	$y=$pdf->ezText("\n",6);
	$pdf->ezText("Alergji : " .$patientAllergy . "                    Diagnoza : " .$patientDiagnosis ,13);
	$y=$pdf->ezText("\n",6);
	$prescriptionData=array();
	
	$columnNames = array('Medikamenti','Dose','Ora','Menyra','Shpejtesia','Shenime');
	$tableoptions = array('cols' => array(
		'Medikamenti'=>array('justification'=>'left','width'=>220),
		'Sasi'=>array('justification'=>'right'),
		'Ora'=>array('justification'=>'right'),
		'Menyra'=>array('justification'=>'left'),
		'Shpejtesia'=>array('justification'=>'right'),
		'Shenime'=>array('justification'=>'left','width'=>100)
		),'width'=>555,'showLines'=> 2,'shaded'=> 0,'titleFontSize' => 14);
		
	$billTableOptions = array('cols' => array(
		'Medikamenti'=>array('justification'=>'left','width'=>220),
		'Sasi'=>array('justification'=>'right'),
		'Cmimi'=>array('justification'=>'right'),
		'Vlera'=>array('justification'=>'right')
		),'width'=>555,'showLines'=> 2,'shaded'=> 0,'titleFontSize' => 14);
		
	$presPrescriber = '';
	$prescribeDate = '';
	$countCompanions = 0;
	if($notes=& getNotes($nr,$presnr)){
		// get the report
		while($report=$result->FetchRow()){
			$presPrescriber = $report['prescriber'];
			$prescribeDate = formatDate2Local($report['create_time'],$date_format,1);
			$prescriptionNotes = $report['notes'];
			reset($app_types);
			while(list($x,$v)=each($app_types)){
				if( $report['application_type_nr'] == $v['nr'] ) {
					if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) $app_type =  $$v['LD_var'];
						else $app_type =  $v['name'];
						break;
				}
			}
			$prescriptionData[] = array(
				 'bestellnum' => $report['bestellnum'],
				 'article' => $report['article'] ,
				 'dosage' => dec2frac($report['dosage']),
				 'admin_time' => $report['admin_time'],
				 'application_type_nr' => $app_type,
				 'sub_speed' => $report['sub_speed'] ,
				 'notes_sub' => $report['notes_sub'],
				 'companion' => unserialize($report['companion']));
		}
	}
}
$prescriptionTable = array();
$billTable = array();
$countPrescriptionData = count($prescriptionData);
if ($countPrescriptionData > 1 ) {
	for($i=0;$i<=$countPrescriptionData; $i++) {
		if($prescriptionData[$i]['companion'] != '0') {
			$companionNr = explode(",",$prescriptionData[0]['companion']);
			for($j=$i;$j<count($companionNr)&&(in_array($prescriptionData[$j]['bestellnum'],$companionNr,true));$j++){
				if($prescriptionTable[$i]['Medikamenti']) {
					$prescriptionTable[$i]['Medikamenti'] = $prescriptionTable[$i]['Medikamenti'] . "\n" . $prescriptionData[$j]['article'];
					$prescriptionTable[$i]['Sasi'] = $prescriptionTable[$i]['Sasi'] . "\n" . $prescriptionData[$j]['dosage'];
					$prescriptionTable[$i]['Ora'] = $prescriptionTable[$i]['Ora'] ;
					$prescriptionTable[$i]['Menyra'] = $prescriptionTable[$i]['Menyra'] ;
					$prescriptionTable[$i]['Shpejtesia'] = $prescriptionTable[$i]['Shpejtesia'] . "\n" . $prescriptionData[$j]['sub_speed'];
					$prescriptionTable[$i]['Shenime'] = $prescriptionTable[$i]['Shenime'] . "\n" . $prescriptionData[$j]['notes_sub'];
					$billTable[$i]['Medikamenti'] = $prescriptionTable[$i]['Medikamenti'] . "\n" . $prescriptionData[$j]['article'];
					$billTable[$i]['Sasi'] = $prescriptionTable[$i]['Sasi'] . "\n" . $prescriptionData[$j]['dosage'];
					$billTable[$i]['Cmimi'] = '';
					$billTable[$i]['Vlera'] = '';
				} else {
					$prescriptionTable[$i]['Medikamenti'] = $prescriptionData[$j]['article'];
					$prescriptionTable[$i]['Sasi'] = $prescriptionData[$j]['dosage'];
					$prescriptionTable[$i]['Ora'] = $prescriptionData[$j]['admin_time'];
					$prescriptionTable[$i]['Menyra'] = $prescriptionData[$j]['application_type_nr'];
					$prescriptionTable[$i]['Shpejtesia'] = $prescriptionData[$j]['sub_speed'];
					$prescriptionTable[$i]['Shenime'] = $prescriptionData[$j]['notes_sub'];
					$billTable[$i]['Medikamenti'] = $prescriptionData[$j]['article'];
					$billTable[$i]['Sasi'] = $prescriptionData[$j]['dosage'];
					$billTable[$i]['Cmimi'] = '';
					$billTable[$i]['Vlera'] = '';
				}
			}
		}
		if($j) $i=$j;
		if ($prescriptionData[$i]['companion'] == '0'){
			$prescriptionTable[$i]['Medikamenti'] = $prescriptionData[$i]['article'];
			$prescriptionTable[$i]['Sasi'] = $prescriptionData[$i]['dosage'];
			$prescriptionTable[$i]['Ora'] = $prescriptionData[$i]['admin_time'];
			$prescriptionTable[$i]['Menyra'] = $prescriptionData[$i]['application_type_nr'];
			$prescriptionTable[$i]['Shpejtesia'] = $prescriptionData[$i]['sub_speed'];
			$prescriptionTable[$i]['Shenime'] = $prescriptionData[$i]['notes_sub'];
			$billTable[$i]['Medikamenti'] = $prescriptionData[$i]['article'];
			$billTable[$i]['Sasi'] = $prescriptionData[$i]['dosage'];
			$billTable[$i]['Cmimi'] = '';
			$billTable[$i]['Vlera'] = '';
		}
		
	}
} else {
	$prescriptionTable[0]['Medikamenti'] = $prescriptionData[0]['article'];
	$prescriptionTable[0]['Sasi'] = $prescriptionData[0]['dosage'];
	$prescriptionTable[0]['Ora'] = $prescriptionData[0]['admin_time'];
	$prescriptionTable[0]['Menyra'] = $prescriptionData[0]['application_type_nr'];
	$prescriptionTable[0]['Shpejtesia'] = $prescriptionData[0]['sub_speed'];
	$prescriptionTable[0]['Shenime'] = $prescriptionData[0]['notes_sub'];
	$billTable[0]['Medikamenti'] = $prescriptionData[0]['article'];
	$billTable[0]['Sasi'] = $prescriptionData[0]['dosage'];
	$billTable[0]['Cmimi'] = '';
	$billTable[0]['Vlera'] = '';

}
//sort them out depending on the Hour to be administered
foreach($prescriptionTable as $res)
     $sortAux[] = substr($res['Ora'],0,2);
     
array_multisort($sortAux, SORT_ASC, SORT_NUMERIC, $prescriptionTable);

$pdf->ezTable($prescriptionTable,'','',$tableoptions);
// make empty line
$pdf->ezText("\n",14);
//gjergji : added new table to be filled with prices
$pdf->ezTable($billTable,'','',$billTableOptions);
// make empty line
$pdf->ezText("\n",14);
$pdf->ezText("Data : " . $prescribeDate ,12,array('justification'=>'left'));
$pdf->ezText("Shenime : " .$prescriptionNotes,12);
$pdf->ezText("\n",14);$y=$pdf->ezText("\n",14);
$pdf->ezText("      Mjeku                                            Farmacisti  ",12);
$pdf->ezText($presPrescriber,12);
$y=$pdf->ezText("\n",10);
$pdf->ezText("______________________                                        ______________________ ",10);
$y=$pdf->ezText("\n",10);
$pdf->ezStream();


?>
