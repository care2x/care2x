<?php

define('SIGNAL_COLOR_LEVEL_FULL',2);   // integer for full signal

define('SIGNAL_COLOR_LEVEL_HALF',1);  // integer for half signal
                                                            //  As of beta 1.0.04, the half level signalling
                                                            //  is not yet implemented
define('SIGNAL_COLOR_LEVEL_ZERO',0);  // integer for no event

/**
*  Valid colors for signalling are:
*
*  yellow
*  black
*  blue_pale
*  brown
*  pink
*  yellow_pale
*  red
*  green_pale
*  violet
*  blue
*  biege
*  orange
*  green
*  rose
*/

define('SIGNAL_COLOR_DIAGNOSTICS_REPORT','brown');   // color to be set for signalling a diagnostic report 
define('SIGNAL_COLOR_DIAGNOSTICS_REQUEST','blue_pale');   // color to be set for signalling a diagnostic/consult request 

define('SIGNAL_COLOR_BLOOD_REQUEST','red'); //color to be set for blood request / transfusion

define('SIGNAL_COLOR_QUERY_DOCTOR','yellow');    // color to be set for signalling a query to the doctor
define('SIGNAL_COLOR_DOCTOR_INFO','black');             // color to be set for signalling a doctor's instruction or answer
define('SIGNAL_COLOR_NURSE_REPORT','blue');             // color to be set for signalling a newly written nurse report

define('SIGNAL_COLOR_ANTIBIOTIC','green_pale');    // color to be set for signalling the prescription of antibiotics
define('SIGNAL_COLOR_DIURETIC','yellow_pale');             // color to be set for signalling the prescription of diuretics
define('SIGNAL_COLOR_ANTICOAG','violet');             // color to be set for signalling the prescription of anticoagulants
define('SIGNAL_COLOR_IV','pink');             // color to be set for signalling the prescription of IV
//gjergji :
//pink modified to show the hour to do the prescription
//maybe not a good idea, but usefull :)

/* ****************** Do not edit the following functions **************************/

function setEventSignalColor($pn, $color, $status = SIGNAL_COLOR_LEVEL_FULL ) {
   	global $db,  $LDDbNoSave;
	$nogo=false;
	
	//$event_table='care_nursing_station_patients_event_signaller'; 
	$event_table='care_encounter_event_signaller'; 
	
	$sql="SELECT encounter_nr FROM $event_table WHERE encounter_nr=$pn";
   	if($ergebnis=$db->Execute($sql)) {
   		if($ergebnis->RecordCount()){
   			$sql="UPDATE $event_table SET $color ='$status' WHERE encounter_nr=$pn";
   			//echo $sql;
			$db->Execute($sql);
			if(!$db->Affected_Rows()){
   				//echo $sql;
   				//gjergji : changed $nogo to false...
				$nogo=false;
			}
		}else{
			$nogo=true;
		}
   	}else{
   		$nogo=true;
	}	   
	//echo $sql;
	if($nogo){
	    $sql="INSERT INTO ".$event_table." ( encounter_nr, ".$color.") VALUES ( ".$pn.", ".$status.")";
        $db->Execute($sql);
	}
   //echo $sql;
}

//gjergji
//clear all the rose bars before subbmiting the new ones
function cleanRoseBars($pn) {
	global $db;
	$event_table='care_encounter_event_signaller'; 
		
	for($i=1;$i<=24;$i++){
		$roseColumn = 'rose_'.$i;
		$sql="UPDATE $event_table SET $roseColumn ='0' WHERE encounter_nr=$pn";
		$db->Execute($sql);		
	}
}
?>