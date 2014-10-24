<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$report_textsize=12;
$report_titlesize=14;
$report_auxtitlesize=10;
$report_authorsize=10;
$filter='3,99'; # notes type number which are not allowed to be displayed

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

	global $db,$_SESSION,$rows,$result,$enc;

	$sql="SELECT n.nr,n.notes,n.short_notes, n.encounter_nr,n.date,n.time, n.personell_nr,n.personell_name
		FROM care_encounter AS e, 
					care_encounter_notes AS n 
		WHERE e.encounter_nr=".$enc." 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=".$type_nr."
		ORDER BY n.date DESC";
		
	if($result=$db->Execute($sql)){
		if($rows=$result->RecordCount()){
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		echo $sql;
		return FALSE;
	}
}


//$lang_tables[]='startframe.php';

$lang_tables[]='emr.php';
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

# Get the notes types first
$types=$enc_obj->getAllTypesSort('name');

$classpath=$root_path.'classes/phppdf/';
$fontpath=$classpath.'fonts/';

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
		$y=$pdf->ezText("\n",14);


		# Get the report data
		$notes=$enc_obj->getEncounterNotes($recnr);

		while(list($x,$v)=each($types)){

			extract($v);
			
			if(!stristr($filter,$nr)){
			
				#Get the report title
				if(isset($$LD_var)&&!empty($$LD_var)){
					$title=$$LD_var;
				}else{
					$title=$name;
				}
			
				$data=NULL;
				$data[]=array($title);
				$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>0,'fontSize'=>$report_titlesize,'showHeadings'=>0,'shaded'=>2,'shadeCol2'=>array(0.9,0.9,0.9),'width'=>555));


				if($notes=& getNotes($nr)){
					# get the report
					while($report=$result->FetchRow()){
						$y=$pdf->ezText("\n",6);
						$data=NULL;
						# create the tag infos inside a table
						$data[]=array(" $LDDate: ".formatDate2Local($report['date'],$date_format)."   $LDTime: ".$report['time']."   $LDBy: ".$report['personell_name']);
				
    					$pdf->ezTable($data,'','',array('xPos'=>'left','xOrientation'=>'right','showLines'=>1,'fontSize'=>$report_authorsize,'showHeadings'=>0,'shaded'=>0,'width'=>555));
    					//$y=$pdf->ezText("\n",$report_authorsize);
				
    					$y=$pdf->ezText("\n".$report['notes']."\n",$report_textsize);
    					if(!empty($report['short_notes'])){
							$y=$pdf->ezText("$LDShortNotes\n",$report_auxtitlesize);
							$y=$pdf->ezText($report['short_notes'],$report_textsize);
						}
						if(!empty($report['aux_notes'])){
							$y=$pdf->ezText($LDShortNotes."\n",$report_auxtitlesize);
							$y=$pdf->ezText($report['aux_notes']."\n",$report_textsize);
						}
					}
				}else{
					$y=$pdf->ezText("\n",14);
				}
			}
		}

$pdf->ezStream();


?>
