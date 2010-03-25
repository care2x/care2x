<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

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

function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}


//$lang_tables[]='startframe.php';
$lang_tables[]='lab.php';
define('LANG_FILE','aufnahme.php');
$local_user='ck_lab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
$thisfile=basename(__FILE__);
require_once($root_path.'include/core/inc_date_format_functions.php');

require_once($root_path.'include/care_api_classes/class_access.php');
$access =& new Access();
$access->UserExists($_SESSION['sess_user_name']);

//get in the classes i need
/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=& new Encounter($encounter_nr);
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

//get the lab data
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab($encounter_nr);

//get the lab results..
$enc_obj->setWhereCondition("encounter_nr='$encounter_nr'");

if($encounterLab=&$enc_obj->getBasic4Data($encounter_nr)) {

	$patient=$encounterLab->FetchRow();

	$recs=&$lab_obj->getAllResults($encounter_nr);
	
	if ($rows=$lab_obj->LastRecordCount()){
	
		# Check if the lab result was recently modified
		$modtime=$lab_obj->getLastModifyTime();

		$lab_obj->getDBCache('chemlabs_result_'.$encounter_nr.'_'.$modtime,$cache);
		# If cache not available, get the lab results and param items
		if(empty($cache)){
			$records=array();
			$dt=array();
			while($buffer=&$recs->FetchRow()){
				# Prepare the values
				$tmp = array($buffer['paramater_name'] => $buffer['parameter_value']);
				$records[$buffer['job_id']][] = $tmp;
				$tdate[$buffer['job_id']]=&$buffer['test_date'];
				$ttime[$buffer['job_id']]=&$buffer['test_time'];				
			}
		}
	}else{
		exit;
	}

}else{
	echo $lab_obj->getLastQuery()."sql$LDDbNoRead";
	exit;
}

$classpath=$root_path.'classes/phppdf/';
$fontpath=$classpath.'fonts/';

include($classpath.'class.ezpdf.php');
$pdf=& new Cezpdf();


$logo=$root_path.'gui/img/logos/care_logo_print.png';
$pidbarcode=$root_path.'cache/barcodes/pn_'.$encounter['pid'].'.png';
$encbarcode=$root_path.'cache/barcodes/en_'.$encounter_nr.'.png';

// Patch for empty file names 2004-05-2 EL
if(empty($encounter['photo_filename'])){
	$idpic=$root_path.'uploads/photos/registration/_nothing_';
 }else{
	$idpic=$root_path.'uploads/photos/registration/'.$encounter['photo_filename'];
}


// Load the page header #1
require('../std_plates/pageheader.php');
// Load the patient data plate #1
$enc = $encounter_nr;
require('../std_plates/patientdata.php');

$data=NULL;
// make empty line
$y=$pdf->ezText("\n",14);
	
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
$notShow = explode("-",$skipme);

//ktu baj koken e tabeles
$laboratoryTable[] = array(
	"$LDParameter" =>"$LDParameter",
	"$LDNormalValue" => "$LDNormalValue",
	"$LDMsrUnit" => "$LDMsrUnit");
while(list($jid,$xval)=each($tdate)) {
	if(!in_array($jid,$notShow)) continue;
	array_push($laboratoryTable[0],$jid);
}

//gjergji
//looks much better like this :)
//order the values
$requestData=array();
reset($records);
while (list($job_id,$paramgroupvalue)=each($records)) {
		foreach($paramgroupvalue as $paramgroup_a => $paramvalue_a) {
			foreach($paramvalue_a as $paramgroup => $paramvalue) {
				$ext = substr(stristr($paramgroup, '__'), 2);
				$requestData[$ext][$paramgroup][$job_id] = $paramvalue;
			}
		}
}
while(list($x,$v)=each($laboratoryTable[0]))
	$tmpArray[0][$v] = '';
	
$laboratoryTable = array();
$laboratoryTable = $tmpArray;	
//#147
reset($tdate);
reset($ttime);
$pdf->ezText("\n",8);
while(list($jid,$date)=each($tdate)) {
	if(!in_array($jid,$notShow)) continue;
	$pdf->ezText("Data - " . $jid . " : " . formatDate2Local($date,$date_format) . " ". $ttime[$jid] ,12,array('justification'=>'left')); 
}

//now the print out
reset($requestData);
$tracker=0;
while(list($group,$pm)=each($requestData)) {
	$laboratoryTable = null;
	$laboratoryTable = $tmpArray;
	$gName = $lab_obj->getGroupName($group ) ;
	$groupName[] = array($gName->fields['name']);	
	$pdf->ezText("\n",6);
	$pdf->ezTable($groupName,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));	
	$pdf->ezText("\n",2);
	$tracker=0;	
	while (list($paramId,$encounterNr)=each($pm)) {
		$pName = $lab_obj->TestParamsDetails($paramId);		
		$laboratoryTable[$tracker][$LDParameter] = $pName['name'];
		$dobDiff = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
		switch ($dobDiff) {
		case ( ($dobDiff >= 1) and ($dobDiff <= 30 ) ) :
				$laboratoryTable[$tracker][$LDNormalValue] = $pName['median_n'];
				break;
		case ( ($dobDiff >= 31) and ($dobDiff <= 360 ) ) :
				$laboratoryTable[$tracker][$LDNormalValue] = $pName['median_y'];
				break;
		case ( $dobDiff >= 361) and ($dobDiff <= 5040 ) :
				$laboratoryTable[$tracker][$LDNormalValue] = $pName['median_c'];
				break;	
		case $dobDiff > 5040 :
			if($patient['sex']=='m'){
				$laboratoryTable[$tracker][$LDNormalValue] = $pName['median'];
			} elseif ($patient['sex']=='f')	{
				$laboratoryTable[$tracker][$LDNormalValue] = $pName['median_f'];																			
			}
			break;
		}	
		if(isset($laboratoryTable[$tracker][$LDNormalValue])) $laboratoryTable[$tracker][$LDNormalValue] = '';	
		$laboratoryTable[$tracker][$LDMsrUnit] = $pName['msr_unit'];			
		while (list($encNr,$paramValue)=each($encounterNr)) {
			if(!in_array($encNr,$notShow)) continue;
			$laboratoryTable[$tracker][$encNr] = $requestData[$group][$paramId][$encNr];

		}
		$tracker++;			
	}
	$pdf->ezTable($laboratoryTable,'','',array('xPos'=>'left','xOrientation'=>'right','shaded'=>0,'width'=>555));
	$groupName = null;
}

//end : #147
$pdf->ezText("\n",14);
// make empty line
$pdf->ezText("\n",14);
$pdf->ezText("Shenime : " .$prescriptionNotes,12);
$pdf->ezText("\n",14);$y=$pdf->ezText("\n",14);
$pdf->ezText("      Mjeku                 		                          			 Laboranti  ",12);
$pdf->ezText($presPrescriber,12);
$y=$pdf->ezText("\n",10);
$pdf->ezText("______________________                                   				 ".$access->login_id,10);
$y=$pdf->ezText("\n",10);
$pdf->ezStream();


?>
