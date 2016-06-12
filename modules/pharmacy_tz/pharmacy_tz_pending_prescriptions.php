<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

$prescrServ=$_GET['prescrServ'];
$admission =$_GET['admission'];
$locationcode=$_GET['loccode'];

$and_admission_class='';

if($admission=='inpatient')
{
$and_admission_class = 'AND care_encounter.encounter_class_nr=1';
}
else {
if($admission=='outpatient')
{
$and_admission_class ='AND care_encounter.encounter_class_nr=2';
}
else {
$and_admission_class='';
}
}

$debug = FALSE;

if ($debug) {
  echo $pn."<br>";
  echo $prescription_date."<br>";
  echo "comming from ".$comming_from."<br>";
  echo "back path:".$back_path."<br>";
  echo "prescrServ: ".$prescrServ."<br>";
  echo "admission: ".$admission."<br>";
  //echo "loccode: ".$loccode."<br>";

}

if (empty($back_path))
  $RETURN_PATH= $root_path."modules/pharmacy_tz/pharmacy_tz.php?ntid=false&lang=$lang";
else {
  if ($back_path=="billing")
    $RETURN_PATH= $root_path."modules/billing_tz/billing_tz.php";
  if ($back_path=="laboratory")
    $RETURN_PATH=$root_path."modules/laboratory/labor.php";
}

if ($mode=="done" && isset($pn) && isset($prescription_date)) {


//The lines below were changed by Israel Pascal to include subtores in pharmacy
  // Update the datbase: Set this prescription as "done"
  $sql = "UPDATE
                care_encounter_prescription
          SET status = 'done',taken='1',sub_store='".$_SESSION['substore']."',issuer='".$_SESSION['sess_user_name']."'
          WHERE encounter_nr = ".$pn."
                AND prescribe_date = '".$prescription_date."'";


 $sql3="SELECT nr FROM care_encounter_prescription WHERE encounter_nr=".$pn." AND prescribe_date = '".$prescription_date."'";
       ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
      $result_nr=$db -> Execute ($sql3);
     $data=array();
     while($store_rows=$result_nr->FetchRow()){
        $data['nr'][]=$store_rows;
     }
      while(list($x,$v)=each($data['nr'])){
      $sql4="UPDATE care_tz_billing_archive_elem SET sub_store='".$_SESSION['substore']."' WHERE prescriptions_nr='".$v['nr']."'";
      $db->Execute($sql4);
      }

//echo $sql;
  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  $db -> Execute ($sql);
  if($discharge)
  	header ( 'Location: ../ambulatory/amb_clinic_discharge.php'.URL_REDIRECT_APPEND.'&pn='.$encounter.'&pyear='.date("Y").'&pmonth='.date("n").'&pday='.date(j).'&tb='.str_replace("#","",$cfg['top_bgcolor']).'&tt='.str_replace("#","",$cfg['top_txtcolor']).'&bb='.str_replace("#","",$cfg['body_bgcolor']).'&d='.$cfg['dhtml'].'&station='.$station.'&backpath='.urlencode('../pharmacy_tz/pharmacy_tz_pending_prescriptions.php').'&dept_nr='.$dept_nr);


  // Clear the status:
  $mode = "";
  $pn="";
  $prescription_date="";
} else {
  // Fall back, either mode is not done or batch number is missing
  // => make a usual form here
  $mode = "";
}
	if(!$mode) /* Get the pending test requests */
	{

		$sql="SELECT care_person.pid, " .
		"care_person.selian_pid, " .
		"name_first, name_last, " .
		"care_encounter_prescription.encounter_nr, " .
		"care_encounter_prescription.prescribe_date, " .
		"care_person.pid as batch_nr " .
		"FROM care_encounter_prescription " .
		"inner join care_encounter on care_encounter_prescription.encounter_nr = care_encounter.encounter_nr " .
		"and (care_encounter_prescription.status='pending' OR care_encounter_prescription.status='' "." $and_admission_class) " .
					"inner join care_person on care_encounter.pid = care_person.pid " .
					"inner join care_tz_drugsandservices on care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id " .
							"and ( care_tz_drugsandservices.purchasing_class = 'drug_list' OR care_tz_drugsandservices.purchasing_class ='supplies' OR care_tz_drugsandservices.purchasing_class ='dental' OR care_tz_drugsandservices.purchasing_class = 'drug_list_ctc' OR care_tz_drugsandservices.purchasing_class = 'drug_list_nhif' OR care_tz_drugsandservices.purchasing_class ='special_ctc_list' OR care_tz_drugsandservices.purchasing_class ='special_others_list') " .
					"group by care_encounter_prescription.prescribe_date, care_encounter_prescription.encounter_nr, care_person.pid, care_person.selian_pid, name_first, name_last " .
					"ORDER BY care_encounter_prescription.prescribe_date ASC";


		if($requests=$db->Execute($sql)){

		  if ($requests->RecordCount()>0) {

  			/* If request is available, load the date format functions */

  			if ($debug) echo $requests;
  			require_once($root_path.'include/core/inc_date_format_functions.php');

  			$batchrows=$requests->RecordCount();
  			//if($batchrows && (!isset($batch_nr) || !$batch_nr)) {
  			if($batchrows ) {

  			  if ($debug) echo "<br>got rows...";

  				$test_request=$requests->FetchRow();
  				 /* Check for the patietn number = $pn. If available get the patients data */
  				$requests->MoveFirst();
  				/*
  				while($test_request=$requests->FetchRow())
  				  echo $test_request['encounter_nr']."<br>";
  				*/
  				if (empty($pn))
  				  $pn=$test_request['encounter_nr'];
  				if (empty($prescription_date))
  				  $prescription_date = $test_request['prescribe_date'];
  				if (empty($batch_nr))
  				  $batch_nr=$test_request['batch_nr'];
  				if ($debug) echo $batch_nr."<br>".$prescription_date."<br>";

  			}
  		} else {
  		    $NO_PENDING_PRESCRIPTIONS = TRUE;
  	  }
		}else{
			echo "<p>$sql<p>$LDDbNoRead";
			exit;
		}
		$mode="show";

	}

$lang_tables[]='billing.php';

require($root_path.'include/core/inc_front_chain_lang.php');


require ("gui/gui_pharmacy_tz_pending_prescriptions.php");

?>
