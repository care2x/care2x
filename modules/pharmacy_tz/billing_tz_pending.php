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

$debug = FALSE;
echo 'help';
if ($debug) {
  echo $pn."<br>";
  echo $prescription_date."<br>";

}

if ($mode=="done" && isset($pn) && isset($prescription_date)) {

  // Update the datbase: Set this prescription as "done"
  $sql = "UPDATE
                care_encounter_prescription
          SET status = 'done'
          WHERE encounter_nr = ".$pn."
                AND prescribe_date = '".$prescription_date."'";
  ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  $db -> Execute ($sql);

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




						$sql_bill="DELETE FROM care_tz_billing";
						$requests=$db->Execute($sql_bill);
						$sql_bill="DELETE FROM care_tz_billing_elem";
						$requests=$db->Execute($sql_bill);
						echo $sql_bill;
		$sql="SELECT care_test_request_chemlabor.encounter_nr, care_test_request_chemlabor.parameters
					FROM care_test_request_chemlabor
					INNER JOIN care_tz_billing
					ON care_test_request_chemlabor.encounter_nr <> care_tz_billing.encounter_nr
					GROUP BY encounter_nr";

				if($requests=$db->Execute($sql)){
					echo $db->Affected_Rows()."-";
					if($db->Affected_Rows()<1)
					{
						$left_sql = "SELECT care_test_request_chemlabor.encounter_nr, care_test_request_chemlabor.parameters
						FROM care_test_request_chemlabor
						LEFT JOIN care_tz_billing
						ON care_test_request_chemlabor.encounter_nr <> care_tz_billing.encounter_nr";
						$requests=$db->Execute($left_sql);
					}
				}
				if($db->Affected_Rows()>0)
				{
					$requests->MoveFirst();
					$enc=0;
					$current_encounter="";
					while($tasks=$requests->FetchRow())
					{
						//Check for another Encounter-Nr. If true, increment our array-counter
						if($tasks['encounter_nr'] != $current_encounter)
						{
							$enc++;
							$current_encounter=$tasks['encounter_nr'];
						}
						$bill[$enc]['encounter_nr'] = $current_encounter;

						//Parse the "parameters" string and save the tasks into the subarray
						parse_str($tasks['parameters'],$arr_tasks);
						while(list($x,$v) = each($arr_tasks))
						{
							//Strip the string baggage off to get the task id
							$task_id = substr($x,5,strlen($x)-6);
							$bill[$enc]['tasks'][$task_id] = $bill[$enc]['tasks'][$task_id] + 1;
						}
					}
					//Now all arrays are filled. Insert the data into tbl_billing and tbl_billing_elem


					while(list($x_bill,$v_bill) = each($bill))
					{
						//First the header
						$sql_bill="INSERT INTO care_tz_billing (encounter_nr, first_date, create_id)
											 VALUES (".$v_bill['encounter_nr'].",".time().",".$_SESSION['sess_user_name'].")";
						echo $sql_bill."<br>";
						$requests=$db->Execute($sql_bill);
						$insertnr=$db->Insert_ID();

						//Second all the billing elems
						$timestamp = time();
						while(list($x_elem,$v_elem)= each($v_bill['tasks']))
						{
							$sql_bill_elem="INSERT INTO care_tz_billing_elem (nr, date_change, is_labtest, amount, description)
												 			VALUES (".$insertnr.",".$timestamp.",1,".$v_elem.",".$x_elem.")";
							$requests=$db->Execute($sql_bill_elem);
							echo $sql_bill_elem."<br>";

						}


					}
					// ENDE DER �BERPR�FUNG UND EINTRAGUNG


				}
		$sql="SELECT
		              name_first,
		              name_last,
		              req.encounter_nr,
		              req.create_time,
		              care_person.pid as batch_nr
		      FROM care_test_request_chemlabor req, care_encounter, care_person, care_tz_billing bi, care_tz_billing_elem biel
		      WHERE   (req.status='pending' OR req.status='')
		            AND  req.encounter_nr = care_encounter.encounter_nr
		            AND  care_encounter.pid = care_person.pid
		            AND bi.encounter_nr = req.encounter_nr
		            AND biel.nr = bi.nr
		            AND biel.is_paid = 0
		      group by req.create_time, req.encounter_nr
		      ORDER BY req.create_time DESC";

		if($requests=$db->Execute($sql)){

		  if ($requests->RecordCount()>0) {

  			/* If request is available, load the date format functions */

  			if ($debug) echo ($sql);
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

require ("gui/gui_billing_tz_pending.php");

?>
